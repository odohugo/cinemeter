<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class ListsController extends Controller
{
    public function follow(User $targetUser)
    {
        $authUser = User::findOrFail(Session::get('user-id'));
        $authUser->follow($targetUser);

        return redirect()->back();
    }

    public function unfollow(User $targetUser)
    {
        $authUser = User::findOrFail(Session::get('user-id'));
        $authUser->unfollow($targetUser);

        return redirect()->back();
    }
}
