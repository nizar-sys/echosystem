<?php

namespace App\Http\Controllers\route;

use App\Http\Controllers\Controller;
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
}
