@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="media text-break bg-white border border-secondary p-3 rounded-2">
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
                <div class="media text-break bg-white border border-secondary p-3 mt-3 rounded-2">
                    @if($ticket->taker_id == auth()->id() || $ticket->user_id == auth()->id())
                        <h4 class="ps-2">Vytvořit komentář</h4>
                        <form action="/comment/store/{{ $ticket->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group m-2">
                                <textarea name="content" rows="4" class="form-control"></textarea>
                            </div>
                            <div class="form-group m-2 col-md-7">
                                <label for="file">Soubor</label>
                                <input type="file" accept="image/*" class="form-control" name="file">
                            </div>
                            <button type="submit" class="ms-2 mb-2 btn btn-primary btn-block">Vytvořit</button>
                            @if ($errors->any())
                                <div class="alert alert-danger ms-2">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </form>
                        <hr>
                    @endif
                    @foreach($comments as $comment)
                        <div class="border border-secondary p-2 rounded-2 mb-2">
                            <div class="d-flex justify-content-between">
                                <h5>{{ $comment->user->name }} <span class="h6 text-muted">{{ $comment->created_at->diffForHumans() }}</span></h5>
                                <div class="d-flex">
                                    <a href="{{ route('comment.edit', [$comment]) }}" class="btn btn-sm btn-info text-white mx-1">
                                        Změnit
                                    </a>

                                    <form id="deleteForm" action="{{ route('comment.destroy', [$comment]) }}" method="POST">
                                        @method("DELETE")
                                        @csrf

                                        <button type="submit" class="btn btn-sm btn-danger">Smazat</button>
                                    </form>
                                </div>
                            </div>
                                <p>{{ $comment->content }}</p>
                            <img src="{{ $comment->file }}" class="img-fluid">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
