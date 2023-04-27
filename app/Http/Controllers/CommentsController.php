<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Ticket;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store($ticketId, Request $request)
    {
        $request->validate([
            'content' => 'required|max:2048',
            'file' => 'max:10240',
        ]);

        $comment = New Comments();
        if ($request->hasFile('file')) {
            $imageName = $request['file']->hashName();
            $request['file']->move(public_path('comment_files'), $imageName);
            $file = '/comment_files/' . $imageName;
        } else $file = Null;

        $comment->user_id = auth()->id();
        $comment->ticket_id = $ticketId;
        $comment->content = $request['content'];
        $comment->file = $file;
        $comment->save();

        return back();
    }

    public function edit(Comments $comment)
    {
        return view('comment.edit', ['comment' => $comment]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|max:2048',
            'file' => 'max:10240',
        ]);

        $comment = Comments::findOrFail($id);
        if ($request->hasFile('file')) {
            $imageName = $request['file']->hashName();
            $request['file']->move(public_path('comment_files'), $imageName);
            $file = '/comment_files/' . $imageName;
            $comment->file = $file;
        }

        $comment->content = $request['content'];
        $comment->update();

        return redirect()->route('ticket.show', [$comment->ticket_id]);
    }

    public function destroy($id)
    {
        $ticketId = Comments::where('id', $id)->value('ticket_id');
        Comments::destroy($id);
        return redirect()->route('ticket.show', $ticketId);
    }
}
