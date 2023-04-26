@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="media text-break bg-white border border-secondary p-3">
                    <div class="d-flex justify-content-between">
                        <strong class="h3">{{ $ticket->title }}</strong>
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
                    <div class="pb-2">
                        @if (isset($ticket->taker_id))
                            Převzáno: {{ $ticket->taker->name }}
                        @elseif ($userRole === $ticket->department->role || $userRole == 'IT')
                            <a href="{{ route('ticket.takeTicket', [$ticket->id, auth()->id()]) }}">Vzít ticket</a>
                        @endif
                        {{--<select name="" id=""> TODO: names in department
                            <option value="">Tomas</option>
                            <option value="">Jan</option>
                        </select>--}}
                    </div>
                    <p class="text-break text-black">
                        {{ $ticket->description }}
                    </p>
                    <div class="pb-2 d-flex flex-column text-muted">
                        <span>Číslo: {{ $ticket->phone_number }}</span>
                        <span>Číslo zařízení: {{ $ticket->device_number }}</span>
                    </div>
                    <img src="{{ $ticket->file }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection
