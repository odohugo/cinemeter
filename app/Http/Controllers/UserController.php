<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!$request->session()->get('user-id')) {
            return redirect()->route('index');
        }

        $username = $request->input('name');
        $users = null;

        if ($username) {
            $users = User::where('name', 'like', '%' . $username . '%')->select('id', 'name')
                ->paginate();
        }

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.signup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'name' => 'required|min:4|max:30',
            'password' => 'required|min:8|max:30'
        ]);

        $user = User::create($data);

        $request->session()->regenerate();
        $request->session()->put('user-id', $user->id);
        $request->session()->put('user-name', $user->name);

        return redirect()->route('users.show', $user->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (!Session::get('user-id')) {
            return redirect()->route('index');
        }
        $authUser = User::findOrFail(Session::get('user-id'));

        return view('users.show', ['targetUser' => $user, 'authUser' => $authUser]);
    }

    public function following(User $targetUser)
    {
        if (!Session::get('user-id')) {
            return redirect()->route('index');
        }

        return view('users.following', ['targetUser' => $targetUser]);
    }

    public function followers(User $targetUser)
    {
        if (!Session::get('user-id')) {
            return redirect()->route('index');
        }

        return view('users.followers', ['targetUser' => $targetUser]);
    }

    public function reviews(User $targetUser)
    {
        if (!Session::get('user-id')) {
            return redirect()->route('index');
        }

        return view('users.reviews', ['targetUser' => $targetUser]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
