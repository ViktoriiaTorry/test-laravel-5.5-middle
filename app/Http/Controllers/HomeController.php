<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Notifications\NewUserPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Models\Comment;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Rules\ValidTitle;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application newsline.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $parentId = $request->input('parent_id');
            $userId = $request->input('user_id');

            /*validation example through custom validation rule class */
            $this->validate(request(), [
                'text' => ['required', new ValidTitle()],
                'user_id' => 'required|integer|min:1',
                'parent_id' => 'integer'
            ]);

            Comment::create(['text' => $request->input('text'), 'user_id' => $userId,
                'post_id' => $request->input('post_id'), 'parent_id' => $parentId]);

            Session::flash('success', 'Comment was added successfully !');
            return redirect()->back();
        }
        $posts = Post::with('comments.children', 'parentComments', 'user')->get();

        return view('index', ['posts' => $posts]);
    }

    /**
     * Show the popular posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPopular(Request $request)
    {
        /*get most popular posts*/
        $popularPosts = Post::
        whereHas('comments')
            ->withCount('comments')
            ->having('comments_count', '=', 2)
            ->orderBy('comments_count', 'DESC')
            ->take(5)
            ->get();

        return view('index', ['posts' => $popularPosts]);
    }

    /**
     * Add new post
     *
     * @return \Illuminate\Http\Response
     */
    public function addPost(Request $request)
    {

        if ($request->isMethod('post')) {
            $userId = $request->input('user_id');
            $this->validate(request(), [
                'title' => 'unique:posts,title,title|min:3,except,user_id',
                'user_id' => 'exists:posts,user_id|integer|min:1',
                'description' => 'required',
                'parent_id' => 'integer'
            ]);

            $post = Post::create(['title' => $request->input('title'), 'description' => $request->input('description'),
                'user_id' => $userId]);
            $users = Auth::user()->followers;

            Notification::send($users, new NewUserPost($post));
            return redirect()->route('home');
        }
        return view('post-add');
    }
}
