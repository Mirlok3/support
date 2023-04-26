@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="d-flex justify-content-between">
                    <h3 >Změnte ticket</h3>
                    <form id="deleteForm" action="{{ route('ticket.destroy', $ticket->id) }}" method="POST">
                        @method("DELETE")
                        @csrf

                        <button type="submit" class="btn btn-sm btn-danger">
                            Smazat
                        </button>
                    </form>
                </div>
                <form action="{{ route('ticket.update', $ticket->id) }}" class="bg-white p-2" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group m-2">
                        <label for="title">Problém</label>
                        <input type="text" class="form-control" name="title" value="{{ $ticket->title }}" placeholder="Co se stalo?">
                    </div>

                    <div class="d-flex justify-content-between m-2">
                        <div class="form-group col-md-5">
                            <label for="device_number">Číslo zařízení</label>
                            <input type="text" placeholder='"TO2843"' class="form-control" name="device_number" value="{{ $ticket->device_number }}">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="phone_number">Vaše číslo</label>
                            <input type="text" placeholder='"232 503 200"' class="form-control" name="phone_number" value="{{ $ticket->phone_number }}">
                        </div>
                    </div>

                    <div class="form-group m-2">
                        <label for="description">Více informací...</label>
                        <textarea name="description" rows="4" class="form-control">{{ $ticket->description }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between m-2">
                        <div class="form-group m-2 col-md-7">
                            <label for="file">Soubory</label> {{--TODO: fill out file in the input--}}
                            <input type="file" class="form-control" name="file" placeholder="1234 Main St" value="{{ $ticket->file }}">
                        </div>

                        <div class="form-group m-2 col-md-3">
                            <label for="department">Oddělení</label>
                            <select name="department" class="form-select" aria-label="Default select example">
                                <option selected value="{{ $departments[0]->id }}">{{ $departments[0]->name }}</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="m-3 d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-block">Vytvořit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
