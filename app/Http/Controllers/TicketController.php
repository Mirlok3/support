<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Department;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    public function show($id)
    {
        $ticket = Ticket::with('taker', 'department', 'user')->where('id', $id)->firstOrFail();
        $departmentUsers = User::where('role', $ticket->department->role)->get();
        $comments = Comments::with('user')->where('ticket_id', $ticket->id)->orderBy('created_at', 'desc')->get();
        return view('ticket.show', ['ticket' => $ticket, 'departmentUsers' => $departmentUsers, 'comments' => $comments]);
    }

    public function create()
    {
        return view('home');
    }

    public function store(Request $request)
    {
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
        } else $file = Null;

        $ticket->user_id = auth()->id();
        $ticket->department_id = $request['department'];
        $ticket->title = $request['title'];
        $ticket->description = $request['description'];
        $ticket->device_number = $request['device_number'];
        $ticket->phone_number = $request['phone_number'];
        $ticket->file = $file;

        $ticket->save();

        return redirect()->route('ticket.show', ['ticket' => $ticket]);
    }

    public function edit(Ticket $ticket)
    {
        if (! Gate::allows('update-ticket', $ticket)) {
            abort(403);
        }

        return view('ticket.edit', ['ticket' => $ticket]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['max:1024'],
            'device_number' => ['required', 'max:255'],
            'phone_number' => ['required'], // TODO: validate if phone number
            'file' => 'max:10240',
        ]);

        $ticket = Ticket::findOrFail($id);
        if (! Gate::allows('update-ticket', $ticket)) {
            abort(403);
        }

        if ($request->hasFile('file')) { //TODO: delete old file
            $imageName = $request['file']->hashName();
            $request['file']->move(public_path('ticket_files'), $imageName);
            $file = '/ticket_files/' . $imageName;
            $ticket->file = $file;
        }

        $ticket->department_id = $request['department'];
        $ticket->title = $request['title'];
        $ticket->description = $request['description'];
        $ticket->device_number = $request['device_number'];
        $ticket->phone_number = $request['phone_number'];

        $ticket->update();

        return view('ticket.show', ['ticket' => $ticket]);
    }

    public function destroy($id)
    {
        Ticket::destroy($id);
        return redirect('/');
    }

    public function takeTicket($ticketId, Request $request)
    {
        $ticket = Ticket::findOrFail($ticketId);
        $department = Department::where('id', $ticket->department_id)->value('role');
        if (! Gate::allows('take-ticket', $department)) {
            abort(403);
        }

        if ($request->user === 'null') {
            $ticket->taker_id = NULL;
        } else $ticket->taker_id = $request->user;

        $ticket->update();
        return back();
    }
}
