<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Traits\FilesTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use FilesTrait;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uid' => 'required|max:20',
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => $validator->messages()]);
        }

        //Check Credentials
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response([
                'message' => 'Invalid Credentials'
            ], 401);
        }
        $user = auth()->user();
        $usercheck = DB::table('personal_access_tokens')->where('tokenable_id',$user->id);
        if ($usercheck->get()=='[]') {
            $usercheck->delete();
            User::where('id',$user->id)->update([
                'uid'=>$request->uid
            ]);
            $token = $user->createToken(auth()->user()->name);
        }elseif($request->uid == $user->uid){
            return response([
                'message'=> 'already used device'
            ]);
        }else{
            $usercheck->delete();
            User::where('id',$user->id)->update([
                'uid'=>$request->uid
            ]);
            $token = $user->createToken(auth()->user()->name);
        }

        return response()->json([
            "status" => true,
            "data" => $user,
            "token" => $token->plainTextToken
        ]);
    }

    public function user()
    {
        $user = auth('api')->user();
        if ($user) {
            return response()->json([
                "status" => true,
                "data" => $user,
            ]);
        } else {
            return response()->json([
                "status" => false,
                "msg" => __("user not found"),
            ]);
        }
    }

    public function updateUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . auth('api')->id(),
            'phone' => ['required', 'regex:/[0-9]([0-9]|-(?!-))+/', 'unique:users,phone,' . auth('api')->id()],
            'location' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => $validator->messages()]);
        }
        $data = $request->except('api_token', 'image');
        if ($request->hasFile('image')) {
            $data['image'] = $this->saveFile($request->image, "images/users")['name'];
        }

        $user = User::find(auth('api')->id());
        if ($user) {
            $user->update($data);
            return response()->json([
                "status" => true,
                "msg" => __('updated successfully'),
            ]);
        } else {
            return response()->json([
                "status" => false,
                "msg" => __("user not found"),
            ]);
        }
    }


    public function logout()
    {
        $user = auth('api')->user();
        if ($user) {
            $user = User::find(auth('api')->id());
            $user->api_token = null;
            $user->save();
            return response()->json([
                "status" => true,
                "msg" => __('logout successfully'),
            ]);
        } else {
            return response()->json([
                "status" => false,
                "msg" => __("user not found"),
            ]);
        }
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string','regex:/(01)[0-9]{9}/', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => $validator->messages()]);
        }
        User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
        ]);
        $user= User::where('email',$request['email']);
        $token = $user->createToken($user->get()[0]->name);
        return response()->json([
            "status" => true,
            "data" => $user->get()[0],
            "token" => $token->plainTextToken
        ]);
    }
}
