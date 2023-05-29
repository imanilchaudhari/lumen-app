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

    /**
     * Get current user
     */
    public function view(Request $request, $id)
    {
        $token = $request->bearerToken();
        $model = User::find($id);

        return response()->json([
            'token' => $token,
            'data' => $model
        ]);
    }

    /**
     * Update current user
     */
    public function update(Request $request, $id)
    {
        $token = $request->bearerToken();
        $values = $request->json()->all();

        $model = User::find($id);
        $this->authorize('update', $model);

        $model->update($values);

        return response()->json([
            'token' => $token,
            'data' => $model
        ]);
    }
}
