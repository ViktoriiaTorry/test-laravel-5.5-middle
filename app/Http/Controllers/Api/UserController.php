<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        if (!$users) {
            throw new HttpException(400, "Invalid data");
        }
        return response()->json(
            $users,
            200
        );
    }
    public function show($id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }
        $user = User::find($id);
        return response()->json([
            $user,
        ], 200);
    }
    public function store(Request $request)
    {
        $user = new User;
        $user->title = $request->input('title');
        $user->price = $request->input('price');
        $user->author = $request->input('author');
        $user->editor = $request->input('editor');
        if ($user->save()) {
            return $user;
        }
        throw new HttpException(400, "Invalid data");
    }
    public function update(Request $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }
        $user = User::find($id);
        $user->title = $request->input('title');
        $user->price = $request->input('price');
        $user->author = $request->input('author');
        $user->editor = $request->input('editor');
        if ($user->save()) {
            return $user;
        }
        throw new HttpException(400, "Invalid data");
    }
    public function destroy($id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'message' => 'book deleted',
        ], 200);
    }
}
