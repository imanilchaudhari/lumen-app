<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
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
     * Get list of posts
     */
    public function index(Request $request)
    {
        $token = $request->bearerToken();

        return response()->json([
            'token' => $token,
            'data' => Post::all()
        ]);
    }

    /**
     * Get current post
     */
    public function view(Request $request, $id)
    {
        $token = $request->bearerToken();
        $model = Post::find($id);

        return response()->json([
            'token' => $token,
            'data' => $model
        ]);
    }

    /**
     * Update current post
     */
    public function update(Request $request, $id)
    {
        $token = $request->bearerToken();
        $values = $request->json()->all();

        $model = Post::find($id);
        $this->authorize('update', $model);

        $model->update($values);

        return response()->json([
            'token' => $token,
            'data' => $model
        ]);
    }

    /**
     * Delete current post
     */
    public function delete(Request $request, $id)
    {
        $model = Post::find($id);
        $this->authorize('delete', $model);

        $model->delete();

        return response()->json();
    }
}