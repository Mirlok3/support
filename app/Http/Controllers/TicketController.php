<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function create()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'title' => ['required','max:255'],
            'description' => ['max:1024'],
            'device_number' => ['required','max:255'],
            'phone_number' => ['required'], // TODO: validate if phone number
            'file' => 'max:10240',
        ]);

        $ticket = new Ticket();
        if ($request->hasFile('file')) {
            $imageName = $request['file']->hashName();
            $request['file']->move(public_path('ticket_files'), $imageName);
            $file = '/ticket_files/' . $imageName;
        }

        $ticket->user_id = auth()->id();
        $ticket->department_id = $request['department'];
        $ticket->title = $request['title'];
        $ticket->description = $request['description'];
        $ticket->device_number = $request['device_number'];
        $ticket->phone_number = $request['phone_number'];
        $ticket->file = $file;

        $ticket->save();

        return redirect('/');
    }
}
