<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $tickets = Ticket::where('user_id', $id)->get();
        return view('show', ['tickets' => $tickets]);
    }
}
