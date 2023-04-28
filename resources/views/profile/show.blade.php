@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($tickets as $ticket)
                <ul class="list-group fa-padding m-3">
                    <li class="list-group-item text-break">
                        <div class="media">
                            <div>
                                <div class="d-flex justify-content-between">
                                    <a class="nav-link" href="{{ route('ticket.show', $ticket->id) }}">
                                        <strong class="h3">{{ $ticket->title }}</strong>
                                    </a>
                                    <div>
                                        <span> #{{ $ticket->id }}</span>
                                        @if ($ticket->user_id == auth()->id() || $userRole == 'IT')
                                            <a href="{{ route('ticket.edit', $ticket->id) }}">Edit</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="pb-2">
                                    {{ $ticket->user->name }}
                                    <span class="text-muted">{{ $ticket->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-truncate text-muted">
                                    {{ $ticket->description }}
                                </p>
                                <div>
                                    @if (isset($ticket->taker_id))
                                        Převzáno: {{ $ticket->taker->name }}
                                    @endif
                                    <a href="{{ route('ticket.show', $ticket->id) }}">{{ $ticket->comments_count }} komentáře</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
    </div>
@endsection
