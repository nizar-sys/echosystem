<?php

namespace App\Http\Controllers\route;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    public function blogHome()
    {
        try {
            $story = Post::latest()->where('status', 'published')->get();
            return view('blog.index', compact('story'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Error '.$th->getMessage());
        }
    }

    public function postDetail($storyID)
    {
        try {
            $story = Post::findOrFail(base64_decode($storyID));
            $stories = Post::latest()->where('status', 'published')->limit(3)->get();
            $data = [
                'story' => $story,
                'stories' => $stories
            ];
            return view('blog.post', compact('data'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Error '.$th->getMessage());
        }
    }

    public function newStory()
    {
        try {
            return view('blog.newStory');
        } catch (\Throwable $th) {
            return back()->with('error', 'Error '.$th->getMessage());
        }
    }

    public function editStory($storyID)
    {
        try {
            $storyID = substr($storyID,20);
            $storyID = base64_decode($storyID);
            $story = Post::all()->where('id', $storyID)->first();
            return view('blog.editStory', compact('story'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Error '.$th->getMessage());
        }
    }

    public function listStory()
    {
        try {
            $story = Post::latest()->where('user_id', Auth::id())->get();
            return view('blog.listStory', compact('story'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Error '.$th->getMessage());
        }
    }
}
