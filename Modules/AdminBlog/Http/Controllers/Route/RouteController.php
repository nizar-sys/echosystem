<?php

namespace Modules\AdminBlog\Http\Controllers\route;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function dashboard()
    {
        try {
            return view('adminblog::layouts.master');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->with('error', 'Error '.$th->getMessage());
        }
    }

    public function index() // login
    {
        return redirect()->route('login.index');
    }

    public function logout()
    {
        try {
            Auth::logout();
            return redirect()->route('login.index');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return back()->with('error', 'Error '.$th->getMessage());
        }
    }
}
