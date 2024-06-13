<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('details')->paginate(10);
        return view('user.index', compact('users'));
    }

    public function show(User $user)
    {
        $user = $user->load('details');
        $orders = $user->orders()->paginate(10);
        return view('user.show', compact('user', 'orders'));
    }
}
