<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    public function getOnlineUsers()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();

        return response()->json(data: ['users' => $users]);
    }
}