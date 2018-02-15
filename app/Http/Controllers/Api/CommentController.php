<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::paginate(10);
        if (!$comments) {
            throw new HttpException(400, "Invalid data");
        }
        return response()->json(
            $comments,
            200
        );
    }
    public function show($id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }
        $comment = Comment::find($id);
        return response()->json([
            $comment,
        ], 200);
    }
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->text = $request->input('text');
        $comment->user_id = $request->input('user_id');
        $comment->post_id = $request->input('post_id');
        $comment->parent_id = $request->input('parent_id');
        if ($comment->save()) {
            return $comment;
        }
        throw new HttpException(400, "Invalid data");
    }
    public function update(Request $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }
        $comment = Comment::find($id);
        $comment->title = $request->input('title');
        $comment->price = $request->input('price');
        $comment->author = $request->input('author');
        $comment->editor = $request->input('editor');
        if ($comment->save()) {
            return $comment;
        }
        throw new HttpException(400, "Invalid data");
    }
    public function destroy($id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json([
            'message' => 'book deleted',
        ], 200);
    }
}
