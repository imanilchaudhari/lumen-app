<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get list of users
     */
    public function index(Request $request) 
    {
        $token = $request->bearerToken();   

        return response()->json([
            'token' => $token,
            'data' => User::all()
        ]);
    }
}
