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
                                    <strong class="h3">{{ $ticket->title }}</strong>
                                    <div>
                                        <span> #{{ $ticket->id }}</span>
                                        @if ($ticket->user_id == auth()->id() || $userRole == 'IT')
                                            <a href="{{ route('ticket.edit', $ticket->id) }}">Edit</a>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-truncate text-muted">
                                    {{ $ticket->description }}
                                    {{ $userRole }}
                                </p>
                                <p>
                                    @if (isset($ticket->taker_id))
                                        Převzáno: {{ $ticket->taker->name }}
                                    @elseif ($userRole === $ticket->department->role || $userRole == 'IT')
                                        <a href="{{ route('ticket.takeTicket', [$ticket->id, auth()->id()]) }}">Vzít ticket</a>
                                    @endif

                                    <span class="text-muted">{{ $ticket->created_at->diffForHumans() }}</span>
                                    <a href="#">2 komentáře</a> {{--TODO: komentare--}}
                                </p>

                            </div>
                        </div>
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
    </div>
@endsection
