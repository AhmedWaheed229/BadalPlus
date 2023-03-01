<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use FilesTrait;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'data'=>$validator->messages()]);
        }
        //Check email

        $user = User::where('email', $request->email)->first();

        //Check Password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Invalid Credentials'
            ], 401);
        }

        if (!$user->api_token) {
            $user->api_token = Str::random(60);
            $user->save();
        }

        return response()->json([
            "status" => true,
            "data" => $user,
            "token" => $user->api_token
        ]);
    }

    public function user(){
        $user = auth('api')->user();
        if ($user){
            return response()->json([
                "status" => true,
                "data" => $user,
            ]);
        }else{
            return response()->json([
                "status" => false,
                "msg" => __("user not found"),
            ]);
        }
    }

    public function updateUser(Request $request){

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.auth('api')->id(),
            'phone' => ['required','regex:/[0-9]([0-9]|-(?!-))+/','unique:users,phone,'.auth('api')->id()],
            'location' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'data'=>$validator->messages()]);
        }
        $data = $request->except('api_token', 'image');
        if ($request->hasFile('image')){
            $data['image'] = $this->saveFile($request->image,"images/users")['name'];
        }

        $user = User::find(auth('api')->id());
        if ($user){
            $user->update($data);
            return response()->json([
                "status" => true,
                "msg" => __('updated successfully'),
            ]);
        }else{
            return response()->json([
                "status" => false,
                "msg" => __("user not found"),
            ]);
        }
    }


    public function logout(){
        $user = auth('api')->user();
        if ($user){
            $user = User::find(auth('api')->id());
            $user->api_token = null;
            $user->save();
            return response()->json([
                "status" => true,
                "msg" => __('logout successfully'),
            ]);
        }else{
            return response()->json([
                "status" => false,
                "msg" => __("user not found"),
            ]);
        }
    }
}
