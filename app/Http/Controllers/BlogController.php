<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function uploadCkEditor(Request $request)
    {
        try {
            //code...
            $path_url = 'storage/blog/' . Auth::user()->username;

            if ($request->hasFile('upload')) {
                $originName = $request->file('upload')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('upload')->getClientOriginalExtension();
                $fileName = Str::slug($fileName) . '_' . time() . '.' . $extension;
                $request->file('upload')->move(public_path($path_url), $fileName);
                $url = asset($path_url . '/' . $fileName);
            }

            return response()->json(['url' => $url]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => $th->getMessage(),
            ]);
        }
    }
}
