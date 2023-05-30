<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Classes\DataProvider;
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
        $paginator = Post::paginate();
        $provider = new DataProvider($paginator);

        return $provider->toResponse();
    }

    /**
     * Create current post
     */
    public function create(Request $request)
    {
        $token = $request->bearerToken();
        $values = $request->json()->all();

        $model = new Post();
        $model->fill($values);
        $model->created_by = auth()->user()->id;
        $model->updated_by = auth()->user()->id;
        $model->created_at = date('Y-m-d H:i:s');
        $model->updated_at = date('Y-m-d H:i:s');
        $model->save();

        return response()->json([
            'token' => $token,
            'data' => $model
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
