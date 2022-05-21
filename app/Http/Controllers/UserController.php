<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getToken(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user == null) {
            return response("no user", 406);
        }

        if (Hash::check($request->password, $user->password)) {
            // if ($user->email == 'admin@') {
            //     $abilities = ['can-add', 'can-delete', 'can-edit'];
            // } else {
            $abilities = ['*'];
            //}

            $token = $user->createToken($request->device_name, $abilities)->plainTextToken;
            $user->remember_token = $token;
            $user->save();

            return response($token, 201);

        } else {
            return response("incorrect password", 403);
        }
    }

    public function registrateUser(Request $request) {
        $user = new User;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $abilities = ['*'];
        $token = $user->createToken($request->device_name, $abilities)->plainTextToken;
        $user->remember_token = $token;

        $user->save();

        return response($token, 201);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
    }

    public function getUser(Request $request){
        $user = User::where("remember_token", $request->token)->get()->first();
        return json_encode($user);
    }
}
