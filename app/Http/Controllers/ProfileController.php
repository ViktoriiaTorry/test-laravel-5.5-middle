<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Show the user's profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::where('id', $id)->with('comments', 'posts', 'followers')
            ->withCount('comments', 'posts', 'followers')->first();
        $followers = $user->followers->pluck('id')->toArray();

        return view('profile', ['user' => $user, 'followers' => $followers]);
    }

    /**
     * Follow the user.
     *
     * @param $profileId
     */
    public function followUser(int $profileId)
    {
        $user = User::find($profileId);

        if (!$user) {
            return redirect()->back()->with('error', 'User does not exist.');
        }

        $user->followers()->attach(auth()->user()->id);
        return redirect()->back()->with('success', 'Successfully followed the user.');
    }

    /**
     * Follow the user.
     *
     * @param $profileId
     */
    public function unFollowUser(int $profileId)
    {
        $user = User::find($profileId);
        if (!$user) {
            return redirect()->back()->with('error', 'User does not exist.');
        }
        $user->followers()->detach(auth()->user()->id);
        return redirect()->back()->with('success', 'Successfully unfollowed the user.');
    }
}
