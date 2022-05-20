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
            $user->save();

            return response($token, 201);

        } else {
            return response("incorrect password", 403);
        }
    }
}
