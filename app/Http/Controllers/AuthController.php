<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Login user
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->input('username'))->first();

        if (Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'status' => 'success',
                'token' => $user->api_token
            ]);
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }
}
