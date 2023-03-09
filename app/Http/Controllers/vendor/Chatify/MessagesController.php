<?php

namespace App\Http\Controllers\vendor\Chatify;

use App\Models\ChMessage;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\ChMessage as Message;
use App\Models\ChFavorite as Favorite;
use App\Models\Currency;
use App\Models\Post;
use Chatify\Facades\ChatifyMessenger as Chatify;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MessagesController extends Controller
{
    protected $perPage = 30;
    protected $messengerFallbackColor = '#FBD540';

    public function pusherAuth(Request $request)
    {
        return Chatify::pusherAuth(
            $request->user(),
            Auth::user(),
            $request['channel_name'],
            $request['socket_id']
        );
    }

    public function index($id = null, $post_id = null)
    {
        if ($id == auth()->id()) {
            return redirect(route(config('chatify.routes.prefix')));
        }
        $routeName = FacadesRequest::route()->getName();
        $type = in_array($routeName, ['user', 'group']) ? $routeName : 'user';

        return view('Chatify::pages.app', [
            'id' => $id ?? 0,
            'post_id' => $post_id ?? 0,
            'type' => $type ?? 'user',
            'messengerColor' => Auth::user()->messenger_color ?? $this->messengerFallbackColor,
            'dark_mode' => Auth::user()->dark_mode < 1 ? 'light' : 'dark',
            'post' => Post::find($post_id)
        ]);
    }

    public function idFetchData(Request $request)
    {
        // Favorite
        $favorite = Chatify::inFavorite($request['id']);

        // User data
        if ($request['type'] == 'user') {
            $fetch = User::where('id', $request['id'])->first();
            if ($fetch) {
                $userAvatar = Chatify::getUserWithAvatar($fetch)->avatar;
            }
        }

        // send the response
        return Response::json([
            'favorite' => $favorite,
            'fetch' => $fetch ?? [],
            'user_avatar' => $userAvatar ?? null,
        ]);
    }

    /**
     * This method to make a links for the attachments
     * to be downloadable.
     *
     * @param string $fileName
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|void
     */
    public function download($fileName)
    {
        if (Chatify::storage()->exists(config('chatify.attachments.folder') . '/' . $fileName)) {
            return Chatify::storage()->download(config('chatify.attachments.folder') . '/' . $fileName);
        } else {
            return abort(404, "Sorry, File does not exist in our server or may have been deleted!");
        }
    }

    /**
     * Send a message to database
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function send(Request $request)
    {
        // default variables
        $error = (object)[
            'status' => 0,
            'message' => null
        ];
        $attachment = null;
        $attachment_title = null;


        $post = Post::with('user', 'currency', 'category')
            ->where('active', 1)->find($request['post_id']);

        if ($post->created_by == Auth::user()->id) {
            $user_id = $request['id'];
        } else {
            $user_id = Auth::user()->id;
        }
        $check = DB::table("post_user")
            ->where("post_id", $request['post_id'])
            ->where("user_id", $user_id)->exists();

        if ($request->has("escrow")) {
            if (!$check && $request->escrow == "escrow") {
                if (auth()->user()->balance >= rateNum(auth()->user()->currency_id, $post->currency_id, $post->price)) {
                    DB::table("users")->where('id', auth()->id())
                        ->update([
                            'balance' => auth()->user()->balance - rateNum(auth()->user()->currency_id, $post->currency_id, $post->price)
                        ]);
                    DB::table("post_user")->insert([
                        "user_id" => auth()->id(),
                        "post_id" => $request['post_id'],
                        "status" => "escrow",
                        "price" => rateNum(auth()->user()->currency_id, $post->currency_id, $post->price),
                        "currency_id" => auth()->user()->currency_id,
                        "currency_rate" => Currency::find(auth()->user()->currency_id)->rate ?? "",
                    ]);
                } else {
                    return response()->json([
                        'error' => 1,
                        "error_msg" => __("There is not enough balance")
                    ]);
                }
            }
        }
        if ($request->has("hold")) {
            DB::table("post_user")
                ->where("post_id", $request['post_id'])
                ->where("user_id", $request['id'])
                ->where("status", "escrow")
                ->update([
                    "status" => "hold"
                ]);
        }
        if ($request->has("release")) {
            $user = DB::table("users")->where('id', $post->created_by)->first();

            DB::table("post_user")
                ->where("post_id", $request['post_id'])
                ->where("user_id", $user_id)
                ->where("status", "hold")
                ->update([
                    "status" => "release"
                ]);

            $post_u = DB::table("post_user")
                ->where("post_id", $request['post_id'])
                ->where("user_id", $user_id)
                ->where("status", "release")
                ->first();

            DB::table("users")->where('id', $user->id)->update([
                'balance' => $user->balance + rateNumV($user->currency_id, $post_u->price, $post_u->currency_rate)
            ]);

            $post_users = DB::table("post_user")
                ->where("post_id", $request['post_id'])
                ->where("user_id", '!=', $user_id)
                ->get();
            foreach ($post_users as $p) {
                $u = DB::table("users")->where('id', $p['user_id'])->first();
                DB::table("users")->where('id', $u->id)->update([
                    'balance' => $u->balance + $p['price']
                ]);
            }
            DB::table("posts")->where("id", $post->id)->update([
               'status' => 0,
               'bought_at' => Carbon::now(),
               'bought_by' => $user_id,
            ]);
        }

        $post_user = DB::table("post_user")
                ->join("currencies", "currencies.id", "post_user.currency_id")
                ->where("post_id", $request['post_id'])
                ->where("user_id", $user_id)
                ->select('post_user.*', 'currencies.name_' . app()->getLocale() . ' as name')->first() ?? "";

        // if there is attachment [file]
        if ($request->hasFile('file')) {
            // allowed extensions
            $allowed_images = Chatify::getAllowedImages();
            $allowed_files = Chatify::getAllowedFiles();
            $allowed = array_merge($allowed_images, $allowed_files);

            $file = $request->file('file');
            // check file size
            if ($file->getSize() < Chatify::getMaxUploadSize()) {
                if (in_array(strtolower($file->getClientOriginalExtension()), $allowed)) {
                    // get attachment name
                    $attachment_title = $file->getClientOriginalName();
                    // upload attachment and store the new name
                    $attachment = Str::uuid() . "." . $file->getClientOriginalExtension();
                    $file->storeAs(config('chatify.attachments.folder'), $attachment, config('chatify.storage_disk_name'));
                } else {
                    $error->status = 1;
                    $error->message = "File extension not allowed!";
                }
            } else {
                $error->status = 1;
                $error->message = "File size you are trying to upload is too large!";
            }
        }

        if (!$error->status) {
            // send to database
            $messageID = mt_rand(9, 999999999) + time();
            Chatify::newMessage([
                'id' => $messageID,
                'post_id' => $request['post_id'],
                'type' => $request['type'],
                'from_id' => Auth::user()->id,
                'to_id' => $request['id'],
                'body' => htmlentities(trim($request['message']), ENT_QUOTES, 'UTF-8'),
                'attachment' => ($attachment) ? json_encode((object)[
                    'new_name' => $attachment,
                    'old_name' => htmlentities(trim($attachment_title), ENT_QUOTES, 'UTF-8'),
                ]) : null,
            ]);

            // fetch message to send it with the response
            $messageData = Chatify::fetchMessage($messageID, $request['post_id']);

            // send to user using pusher
            Chatify::push("private-chatify." . $request['id'], 'messaging', [
                'from_id' => Auth::user()->id,
                'to_id' => $request['id'],
                'post_id' => $request['post_id'],
                'message' => Chatify::messageCard($messageData, 'default'),
                'post' => $post,
                'convert_price' => rate(auth()->user()->currency_id, $post->currency_id, $post->price),
                "post_user" => $post_user,
                "user_id" => $user_id,
            ]);
        }


        // send the response
        return Response::json([
            'status' => '200',
            'error' => $error,
            'message' => Chatify::messageCard(@$messageData),
            'tempID' => $request['temporaryMsgId'],
            'post' => $post,
            'convert_price' => rate(auth()->user()->currency_id, $post->currency_id, $post->price),
            "post_user" => $post_user,
            "user_id" => $user_id,
        ]);
    }

    /**
     * fetch [user/group] messages from database
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function fetch(Request $request)
    {
        $post_id = $request['post_id'] ?? 0;
        $query = Chatify::fetchMessagesQuery($request['id'], $post_id)->latest();
        $post = Post::with('user', 'currency', 'category')
            ->where('active', 1)->find($post_id);


        if ($post->created_by == Auth::user()->id) {
            $user_id = $request['id'];
        } else {
            $user_id = Auth::user()->id;
        }
        $post_user = DB::table("post_user")
                ->join("currencies", "currencies.id", "post_user.currency_id")
                ->where("post_id", $post_id)
                ->where("user_id", $user_id)
                ->select('post_user.*', 'currencies.name_' . app()->getLocale() . ' as name')->first() ?? "";


        $messages = $query->paginate($request->per_page ?? $this->perPage);
        $totalMessages = $messages->total();
        $lastPage = $messages->lastPage();
        $response = [
            'total' => $totalMessages,
            'last_page' => $lastPage,
            'last_message_id' => collect($messages->items())->last()->id ?? null,
            'messages' => '',
        ];
        $response['post'] = $post;
        $response['convert_price'] = rate(auth()->user()->currency_id, $post->currency_id, $post->price);
        $response['post_user'] = $post_user;
        // if there is no messages yet.
        if ($totalMessages < 1) {
            $response['messages'] = '<p class="message-hint center-el"><span>' . __("Say hi and start messaging") . '</span></p>';
            return Response::json($response);
        }
        if (count($messages->items()) < 1) {
            $response['messages'] = '';
            return Response::json($response);
        }
        $allMessages = null;
        foreach ($messages->reverse() as $index => $message) {
            $allMessages .= Chatify::messageCard(
                Chatify::fetchMessage($message->id, $index)
            );
        }

        $response['messages'] = $allMessages;

        return Response::json($response);
    }


    public function seen(Request $request)
    {
        // make as seen
        $seen = Chatify::makeSeen($request['id'], $request['post_id']);
        // send the response
        return Response::json([
            'status' => $seen,
        ], 200);
    }


    public function getContacts(Request $request)
    {
        // get all users that received/sent message from/to [Auth user]
        $users = Message::join('users', function ($join) {
            $join->on('ch_messages.from_id', '=', 'users.id')
                ->orOn('ch_messages.to_id', '=', 'users.id');
        })
            ->join('posts', function ($q) {
                $q->on('ch_messages.post_id', '=', 'posts.id');
            })
            ->where(function ($q) {
                $q->where('ch_messages.from_id', Auth::user()->id)
                    ->orWhere('ch_messages.to_id', Auth::user()->id);
            })
            ->where('users.id', '!=', Auth::user()->id)
            ->select('users.*', DB::raw('MAX(ch_messages.created_at) max_created_at'),
                'posts.id as post_id', 'posts.title as post_title',
                'posts.price as post_price', 'posts.image as post_image',
         )
            ->orderBy('max_created_at', 'desc')
            ->groupBy('users.id', 'ch_messages.post_id')
            ->paginate($request->per_page ?? $this->perPage);
        //
        $usersList = $users->items();
        if (count($usersList) > 0) {
            $contacts = '';
            foreach ($usersList as $user) {
                $contacts .= Chatify::getContactItem($user, $user->post_id);
            }
        } else {
            $contacts = '<p class="message-hint center-el"><span>Your contact list is empty</span></p>';
        }

        return Response::json([
            'contacts' => $contacts,
            'total' => $users->total() ?? 0,
            'last_page' => $users->lastPage() ?? 1,
        ], 200);
    }

    /**
     * Update user's list item data
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateContactItem(Request $request)
    {
        //dd($request->all());
        // Get user data
        $user = User::join('ch_messages', function ($join) {
            $join->on('users.id', '=', 'ch_messages.from_id')
                ->orOn('users.id', '=', 'ch_messages.to_id');
        })
            ->join('posts', function ($q) use ($request) {
                $q->on('ch_messages.post_id', '=', 'posts.id')
                    ->on('users.id', '=', 'ch_messages.from_id')
                    ->orOn('users.id', '=', 'ch_messages.to_id')
                    ->where('posts.id', $request['post_id']);
            })
            ->select('users.*',
                'posts.id as post_id', 'posts.title as post_title',
                'posts.price as post_price', 'posts.image as post_image',
         )
            ->where('users.id', $request['user_id'])
            ->where('post_id', $request['post_id'])
            ->first();
        $post_id = $request['post_id'] ?? 0;
        if (!$user) {
            return Response::json([
                'message' => 'User not found!',
            ], 401);
        }
        $contactItem = Chatify::getContactItem($user, $post_id);


        $post = Post::with('user', 'currency', 'category')
            ->where('active', 1)->find($post_id);

        if ($post->created_by == Auth::user()->id) {
            $user_id = $request['id'];
        } else {
            $user_id = Auth::user()->id;
        }
        $post_user = DB::table("post_user")
                ->join("currencies", "currencies.id", "post_user.currency_id")
                ->where("post_id", $post_id)
                ->where("user_id", $user_id)
                ->select('post_user.*', 'currencies.name_' . app()->getLocale() . ' as name')->first() ?? "";

        // send the response
        return Response::json([
            'contactItem' => $contactItem,
            'post' => $post,
            'convert_price' => rate(auth()->user()->currency_id, $post->currency_id, $post->price),
            'post_user' => $post_user
        ], 200);
    }

    /**
     * Put a user in the favorites list
     *
     * @param Request $request
     * @return JsonResponse|void
     */
    public function favorite(Request $request)
    {
        // check action [star/unstar]
        if (Chatify::inFavorite($request['user_id'])) {
            // UnStar
            Chatify::makeInFavorite($request['user_id'], 0);
            $status = 0;
        } else {
            // Star
            Chatify::makeInFavorite($request['user_id'], 1);
            $status = 1;
        }

        // send the response
        return Response::json([
            'status' => @$status,
        ], 200);
    }

    /**
     * Get favorites list
     *
     * @param Request $request
     * @return JsonResponse|void
     */
    public function getFavorites(Request $request)
    {
        $favoritesList = null;
        $favorites = Favorite::where('user_id', Auth::user()->id);
        foreach ($favorites->get() as $favorite) {
            // get user data
            $user = User::where('id', $favorite->favorite_id)->first();
            $favoritesList .= view('Chatify::layouts.favorite', [
                'user' => $user,
            ]);
        }
        // send the response
        return Response::json([
            'count' => $favorites->count(),
            'favorites' => $favorites->count() > 0
                ? $favoritesList
                : 0,
        ], 200);
    }

    /**
     * Search in messenger
     *
     * @param Request $request
     * @return JsonResponse|void
     */
    public function search(Request $request)
    {
        $getRecords = null;
        $input = trim(filter_var($request['input']));
        $records = User::where('id', '!=', Auth::user()->id)
            ->where(function ($q) use ($input) {
                $q->where('first_name', 'LIKE', "%{$input}%")
                    ->orWhere('last_name', 'LIKE', "%{$input}%");
            })
            ->paginate($request->per_page ?? $this->perPage);
        foreach ($records->items() as $record) {
            $getRecords .= view('Chatify::layouts.listItem', [
                'get' => 'search_item',
                'type' => 'user',
                'user' => Chatify::getUserWithAvatar($record),
            ])->render();
        }
        if ($records->total() < 1) {
            $getRecords = '<p class="message-hint center-el"><span>Nothing to show.</span></p>';
        }
        // send the response
        return Response::json([
            'records' => $getRecords,
            'total' => $records->total(),
            'last_page' => $records->lastPage()
        ], 200);
    }

    /**
     * Get shared photos
     *
     * @param Request $request
     * @return JsonResponse|void
     */
    public function sharedPhotos(Request $request)
    {
        $shared = Chatify::getSharedPhotos($request['user_id']);
        $sharedPhotos = null;

        // shared with its template
        for ($i = 0; $i < count($shared); $i++) {
            $sharedPhotos .= view('Chatify::layouts.listItem', [
                'get' => 'sharedPhoto',
                'image' => Chatify::getAttachmentUrl($shared[$i]),
            ])->render();
        }
        // send the response
        return Response::json([
            'shared' => count($shared) > 0 ? $sharedPhotos : '<p class="message-hint"><span>Nothing shared yet</span></p>',
        ], 200);
    }

    /**
     * Delete conversation
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteConversation(Request $request)
    {
        // delete
        $delete = Chatify::deleteConversation($request['id']);

        // send the response
        return Response::json([
            'deleted' => $delete ? 1 : 0,
        ], 200);
    }

    /**
     * Delete message
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteMessage(Request $request)
    {
        // delete
        $delete = Chatify::deleteMessage($request['id']);

        // send the response
        return Response::json([
            'deleted' => $delete ? 1 : 0,
        ], 200);
    }

    public function updateSettings(Request $request)
    {
        $msg = null;
        $error = $success = 0;

        // dark mode
        if ($request['dark_mode']) {
            $request['dark_mode'] == "dark"
                ? User::where('id', Auth::user()->id)->update(['dark_mode' => 1])  // Make Dark
                : User::where('id', Auth::user()->id)->update(['dark_mode' => 0]); // Make Light
        }

        // If messenger color selected
        if ($request['messengerColor']) {
            $messenger_color = trim(filter_var($request['messengerColor']));
            User::where('id', Auth::user()->id)
                ->update(['messenger_color' => $messenger_color]);
        }
        // if there is a [file]
        if ($request->hasFile('avatar')) {
            // allowed extensions
            $allowed_images = Chatify::getAllowedImages();

            $file = $request->file('avatar');
            // check file size
            if ($file->getSize() < Chatify::getMaxUploadSize()) {
                if (in_array(strtolower($file->getClientOriginalExtension()), $allowed_images)) {
                    // delete the older one
                    if (Auth::user()->avatar != config('chatify.user_avatar.default')) {
                        $avatar = Auth::user()->avatar;
                        if (Chatify::storage()->exists($avatar)) {
                            Chatify::storage()->delete($avatar);
                        }
                    }
                    // upload
                    $avatar = Str::uuid() . "." . $file->getClientOriginalExtension();
                    $update = User::where('id', Auth::user()->id)->update(['avatar' => $avatar]);
                    $file->storeAs(config('chatify.user_avatar.folder'), $avatar, config('chatify.storage_disk_name'));
                    $success = $update ? 1 : 0;
                } else {
                    $msg = "File extension not allowed!";
                    $error = 1;
                }
            } else {
                $msg = "File size you are trying to upload is too large!";
                $error = 1;
            }
        }

        $post = Post::with('user', 'currency', 'category')
            ->where('active', 1)->find($request->post_id);

        // send the response
        return Response::json([
            'status' => $success ? 1 : 0,
            'error' => $error ? 1 : 0,
            'message' => $error ? $msg : 0,
            'post' => $post,
            'convert_price' => rate(auth()->user()->currency_id, $post->currency_id, $post->price),
        ], 200);
    }

    /**
     * Set user's active status
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function setActiveStatus(Request $request)
    {
        $update = $request['status'] > 0
            ? User::where('id', $request['user_id'])->update(['active_status' => 1])
            : User::where('id', $request['user_id'])->update(['active_status' => 0]);
        // send the response
        return Response::json([
            'status' => $update,
        ], 200);
    }
}
