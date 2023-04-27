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

                                <div class="pb-2">
                                    @if (isset($ticket->taker_id))
                                        Převzáno: {{ $ticket->taker->name }}
                                    @endif
                                    <a href="#">2 komentáře</a> {{--TODO: komentare--}}
                                </div>

                                <div>
                                    @if($department->user_id === auth()->id())
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
                                    @elseif ($userRole === $department->role && !isset($ticket->taker_id))
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
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
    </div>
@endsection
