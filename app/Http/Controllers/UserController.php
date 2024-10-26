<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
    public function show(int $id)
    {
        $user = User::with([
            'reviews' => fn($query) => $query->latest()
        ])->findOrFail($id);
        return view('users.show', ['user' => $user]);
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
