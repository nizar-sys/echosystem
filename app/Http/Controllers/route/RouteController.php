<?php

namespace App\Http\Controllers\route;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function blogHome()
    {
        try {
            return view('blog.index');
        } catch (\Throwable $th) {
            return back()->with('error', 'Error '.$th->getMessage());
        }
    }

    public function postDetail($slugPost)
    {
        try {
            return view('blog.post');
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
            $story = Post::all()->where('id', $storyID)->first();
            return view('blog.editStory', compact('story'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Error '.$th->getMessage());
        }
    }
}
