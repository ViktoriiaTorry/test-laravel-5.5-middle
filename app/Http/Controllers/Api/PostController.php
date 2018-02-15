<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::paginate(10);
        if (!$post) {
            throw new HttpException(400, "Invalid data");
        }
        return response()->json(
            $post,
            200
        );
    }
    public function show($id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }
        $post = Post::find($id);
        return response()->json([
            $post,
        ], 200);
    }
    public function store(Request $request)
    {
        $post = new Post;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->user_id = $request->input('user_id');
        if ($post->save()) {
            return $post;
        }
        throw new HttpException(400, "Invalid data");
    }
    public function update(Request $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->user_id = $request->input('user_id');
        if ($post->save()) {
            return $post;
        }
        throw new HttpException(400, "Invalid data");
    }
    public function destroy($id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }
        $post = Post::find($id);
        $post->delete();
        return response()->json([
            'message' => 'Post deleted',
        ], 200);
    }
}
