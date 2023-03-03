<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\VfCash;
use App\Traits\FilesTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use FilesTrait;

    protected $model;
    protected $viewsDomain = 'dashboard.user.';

    public function __construct()
    {
        $this->model = new User();
    }

    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

    public function index(Request $request)
    {
        $records = $this->model->query();
        if ($request->filled('first_name')) {
            $records = $records->where('first_name', 'LIKE', "%{$request->first_name}%");
        }
        if ($request->filled('last_name')) {
            $records = $records->where('last_name', 'LIKE', "%{$request->last_name}%");
        }
        if ($request->filled('email')) {
            $records = $records->where('email', 'LIKE', "%{$request->email}%");
        }
        if ($request->filled('phone')) {
            $records = $records->where('phone', 'LIKE', "%{$request->phone}%");
        }
        if ($request->filled('active')) {
            $records = $records->where('active', '=', $request->active);
        }
        if ($request->filled('admin')) {
            $records = $records->where('admin', '=', $request->admin);
        }
        $records = $records->with('currency')
            ->orderBy('active', 'desc')
            ->orderByDesc('id')->paginate(10);
        return $this->view('index', compact('records'));
    }


    public function create()
    {
        return $this->view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => ['required', 'regex:/[0-9]([0-9]|-(?!-))+/', 'unique:users,phone'],
            'location' => 'nullable|string',
            'balance' => 'nullable|numeric|min:0',
            'password' => 'required|string|min:6|confirmed',
            'active' => 'boolean',
            'admin' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'currency_id' => 'required|numeric',
        ]);
        $request['active'] = $request['active'] ?? 0;
        $request['balance'] = $request['balance'] ?? 0;
        $data = $request->except('_token', 'image', 'password', 'password_confirmation');
        if ($request->hasFile('image')) {
            $data['image'] = $this->saveFile($request->image, "images/users")['name'];
        } else {
            $data['image'] = 'avatar.png';
        }
        $data['password'] = Hash::make($request->password);
        $this->model->create($data);
        return redirect(route('users.index'))->with(['success' => __('added successfully')]);
    }


    public function show($id)
    {
        return redirect()->back();
    }


    public function edit($id)
    {
        $record = $this->model->findOrFail($id);
        return $this->view('edit', compact('record'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => ['required', 'regex:/[0-9]([0-9]|-(?!-))+/', 'unique:users,phone,' . $id],
            'location' => 'nullable|string',
            'balance' => 'nullable|numeric|min:0',
            'password' => 'nullable',
            'active' => 'boolean',
            'admin' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'currency_id' => 'required|numeric',
        ]);
        $request['active'] = $request['active'] ?? 0;
        $request['admin'] = $request['admin'] ?? 0;
        $data = $request->except('_token', 'image', 'password', 'password_confirmation');
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:6|confirmed',
            ]);
            $data['password'] = Hash::make($request->password);
        }
        if ($request->hasFile('image')) {
            $data['image'] = $this->saveFile($request->image, "images/users")['name'];
        }
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return redirect(route('users.index'))->with(['success' => __('updated successfully')]);
    }

    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        $record->delete();
        return redirect()->back()->with(['success' => __('deleted successfully')]);
    }

    public function profile($id, Request $request)
    {
        $record = $this->model->findOrFail($id);
        $posts = Post::with('user', 'currency')
            ->where('created_by', $id);

        if ($id != auth()->id()) {
            $posts = $posts->where('active', 1);
        }
        if ($request->filled('sort_by') && $request->sort_by == 'asc') {
            $posts = $posts->orderBy('id', 'asc');
        } elseif ($request->filled('sort_by') && $request->sort_by == 'desc') {
            $posts = $posts->orderBy('id', 'desc');
        }
        $posts = $posts->orderBy('status', 'desc');
        $posts = $posts->paginate(3);
        return $this->view('profile', compact('record', 'posts'));
    }

    public function updateProfile()
    {
        $record = $this->model->findOrFail(auth('web')->id());
        return $this->view('update-profile', compact('record'));
    }

    public function updateUserProfile(Request $request)
    {
        $record = $this->model->findOrFail(auth('web')->id());
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $record->id,
            'phone' => ['required', 'regex:/[0-9]([0-9]|-(?!-))+/', 'unique:users,phone,' . $record->id],
            'location' => 'nullable|string',
            'password' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);

        $data = $request->except('_token', 'image', 'password', 'password_confirmation');

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:6|confirmed',
            ]);
            $data['password'] = Hash::make($request->password);
        }
        if ($request->hasFile('image')) {
            $data['image'] = $this->saveFile($request->image, "images/users")['name'];
        }

        $record->update($data);
        return back()->with(['success' => __('updated successfully')]);
    }

    public function wallet()
    {
        $record = $this->model->with('soldPosts', 'boughtPosts')->findOrFail(auth('web')->id());
        return $this->view('wallet', compact('record'));
    }

    public function addBalance()
    {
        $numbers = DB::table('vf_numbers')->where('show','1')->select('number')->get();
        return $this->view('add-balance')->with('numbers',$numbers);
    }

    public function rechargeRequest(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0|not_in:0',
            'number' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $data = $request->only('amount', 'number');
        if ($request->hasFile('image')) {
            $data['image'] = $this->saveFile($request->image, "images/recharge_requests")['name'];
        }
        DB::table('recharge_requests')->insert([
            "user_id" => auth()->id(),
            "amount" => $data['amount'],
            "number" => $data['number'],
            "status" => 'pending',
            "img" => $data['image'],
            "currency_id" => auth()->user()->currency_id,
            "currency_rate" => auth()->user()->currency->rate ?? 1,
            "created_at" => Carbon::now()
        ]);
        return back()->with(['success' => __('Recharge Request Sent successfully')]);
    }

    public function rechargeRequests(Request $request)
    {
        $records = DB::table('recharge_requests')
            ->join('users', 'recharge_requests.user_id', '=', 'users.id')
            ->join('currencies', 'currencies.id', '=', 'users.currency_id')
            ->when($request->filled('user'), function ($q) use ($request) {
                return $q->where(function ($q2) use ($request) {
                    $q2->where("users.first_name", "LIKE", "%" . $request->user . "%")
                        ->orWhere("users.last_name", "LIKE", "%" . $request->user . "%")
                        ->orWhere("users.email", "LIKE", "%" . $request->user . "%")
                        ->orWhere("users.phone", "LIKE", "%" . $request->user . "%");
                });
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                return $q->where('recharge_requests.status', $request->status);
            })
            ->when($request->filled('number'), function ($q) use ($request) {
                return $q->where('recharge_requests.number', "LIKE", "%" . $request->number . "%");
            })
            ->orderByDesc("recharge_requests.id")
            ->select('recharge_requests.*', 'users.first_name',
                'users.last_name', 'users.email', 'users.phone', 'users.balance',
                'currencies.name_' . app()->getLocale())
            ->paginate(10);

        return $this->view('recharge-requests', compact('records'));
    }

    public function updateRechargeRequests(Request $request, $id)
    {
        $request->validate([
            'accepted_amount' => 'required|numeric',
            'status' => 'required|in:refused,confirmed',
        ]);
        $data = $request->only('accepted_amount', 'status');
        $record = DB::table('recharge_requests')->where('id', $id)->find($id);
        if ($record) {
            $user = User::find($record->user_id);
            if ($user) {
                DB::table('recharge_requests')->where('id', $id)->update([
                    "admin_id" => auth()->id(),
                    "accepted_amount" => $data['accepted_amount'],
                    "status" => $data['status'],
                    "accept_date" => Carbon::now()
                ]);
                if ($data['status'] == 'confirmed') {
                    $user->balance = $user->balance + $data['accepted_amount'];
                    $user->save();
                }
                return back()->with(['success' => __('Updated successfully')]);
            }
        }
        return back();
    }
}
