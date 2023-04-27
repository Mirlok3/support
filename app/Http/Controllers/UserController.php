<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $tickets = Ticket::with('taker', 'department', 'user')->where('user_id', $id)->get();
        return view('profile.show', ['tickets' => $tickets]);
    }

    public function showTaken($id)
    {
        $tickets = Ticket::with('taker', 'department', 'user')->where('taker_id', $id)->get();
        return view('profile.show_taken', ['tickets' => $tickets]);
    }
}
