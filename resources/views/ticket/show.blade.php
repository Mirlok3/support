@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="media text-break bg-white border border-secondary p-3">
                    <span class="d-flex justify-content-between text-muted">
                        {{ $ticket->department->name }}
                        <div>
                            <span> #{{ $ticket->id }}</span>
                            @if ($ticket->user_id == auth()->id() || $userRole == 'IT')
                                <a href="{{ route('ticket.edit', $ticket->id) }}">Edit</a>
                            @endif
                        </div>
                    </span>
                    <div >
                        <strong class="h3">{{ $ticket->title }}</strong>
                    </div>
                    <div class="pb-2">
                        {{ $ticket->user->name }}
                        <span class="text-muted">{{ $ticket->created_at->diffForHumans() }}</span>
                    </div>

                    <p class="text-break text-black">
                        {{ $ticket->description }}
                    </p>
                    <div class="pb-2 d-flex flex-column text-muted">
                        <span>Číslo: {{ $ticket->phone_number }}</span>
                        <span>Číslo zařízení: {{ $ticket->device_number }}</span>
                    </div>

                    <img src="{{ $ticket->file }}" class="img-fluid">


                    <div>
                        <div class="pb-2">
                            @if (isset($ticket->taker_id))
                                Převzáno: {{ $ticket->taker->name }}
                            @endif
                        </div>
                        @if($ticket->department->user_id === auth()->id())
                            <form class="input-group w-25" method="POST" action="/ticket/take/{{ $ticket->id }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm rounded-start">Předat ticket</button>

                                <select name="user" class="form-control form-select">
                                    <option name="user" value="null" selected="selected">
                                        Nikomu
                                    </option>
                                    @foreach($departmentUsers as $departmentUser)
                                        <option value="{{ $departmentUser->id }}">
                                            {{ $departmentUser->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        @elseif ($userRole === $ticket->department->role && !isset($ticket->taker_id))
                            <form method="POST" action="/ticket/take/{{ $ticket->id }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm rounded-start">Vzít ticket</button>
                                <input type="hidden" name="user" value="{{ auth()->id() }}">
                            </form>
                        @elseif ($ticket->taker_id == auth()->id())
                            <form method="POST" action="/ticket/take/{{ $ticket->id }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm rounded-start">Vzdát se ticketu</button>
                                <input type="hidden" name="user" value="null">
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
