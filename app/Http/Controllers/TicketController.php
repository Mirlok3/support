<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function create()
    {
        $departments = DB::table('departments')->get();
        return view('home', ['departments' => $departments]);
    }
}
