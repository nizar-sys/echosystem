<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function bioProfile(Request $request)
    {
        try {

            $user = User::findOrFail($request->userID);
            $user->update([
                'biodata' => $request->biodata,
            ]);

            return response()->json([
                'message' => 'Biodata saved'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }
}
