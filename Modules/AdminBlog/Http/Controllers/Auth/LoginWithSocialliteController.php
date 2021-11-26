<?php

namespace Modules\AdminBlog\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class LoginWithSocialliteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function redirect($provider)
    {
        try {
            return Socialite::driver($provider)->redirect();
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', 'Error '.$th->getMessage());
        }
    }

    public function callback($provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
            $authUser = $this->findOrCreateUser($user, $provider);
            Auth::login($authUser, true);
            return redirect('/'); // redirect ke halaman home masing-masing yaa:D
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', 'Error ' . $th->getMessage());
        }
    }

    public function findOrCreateUser($user, $provider)
    {
        try {
            $authUser = User::where('provider_id', $user->id)->first();
            if ($authUser) {
                return $authUser;
            }
            return User::create([
                'avatar' => $provider == 'google' ? $user->getAvatar() : $user->avatar,
                'fullname'     => $user->name,
                'username' => $user->nickname == null ? '@'.Str::slug(substr($user->name, 0, 10)) : '@'. $user->nickname,
                'email'    => $user->email,
                'provider' => $provider,
                'provider_id' => $user->id,
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Error ' . $th->getMessage());
        }
    }

    public function index()
    {
        return view('adminblog::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('adminblog::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('adminblog::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('adminblog::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
