@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($tickets as $ticket)
                <ul class="list-group fa-padding m-3">
                    <li class="list-group-item">
                        <div class="media">
                            <div>
                                <div class="d-flex justify-content-between">
                                    <strong class="h3">{{ $ticket->title }}</strong>
                                    <span> #{{ $ticket->id }}</span>
                                </div>
                                <p class="text-truncate text-muted">
                                    {{ $ticket->description }}
                                </p>
                                <p>
                                    Převzáno: @if(isset($tickets->taker_id)) {{ $tickets->taker_id }} @else Nikým @endif
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
