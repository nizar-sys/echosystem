<?php

namespace App\Http\Controllers;

use App\Models\Post;
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

            return response()->json(['url' => $url, 'filename' => $fileName]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function postStory(Request $request)
    {
        try {

            if ($request->has('story_id')) {
                $newPost = Post::all()->where('id', $request->story_id)->first()->update([
                    'title' => $request->title,
                    'content' => $request->content,
                    'thumbnail' => $request->thumbnail == '' ? 'thumbPost.png' : $request->thumbnail,
                ]);
            } else {
                $newPost = Post::create([
                    'user_id' => $request->user()->id,
                    'tags' => '',
                    'title' => $request->title,
                    'content' => $request->content,
                    'thumbnail' => $request->thumbnail == '' ? 'thumbPost.png' : $request->thumbnail,
                ]);
            }

            return response()->json([
                'id' => base64_encode($newPost->id),
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $story = Post::findOrFail($request->story_id);
            $story->update([
                'status' => $request->newStatus,
                'tags' => $request->tags,
            ]);
            return response()->json([
                'message' => $request->newStatus == 'published' ? "Your story now is published" : 'Your story drafted',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function deleteStory(Request $request)
    {
        try {
            $story = Post::findOrFail($request->story_id);
            $story->delete();
            return response()->json([
                'message' => 'Your story successfully deleted',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => $th->getMessage(),
            ]);
        }
    }
}
