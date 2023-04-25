@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('ticket.store') }}" class="bg-white p-2" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group m-2">
                        <label for="title">Problém</label>
                        <input type="text" class="form-control" name="title" placeholder="Co se stalo?">
                    </div>

                    <div class="d-flex justify-content-between m-2">
                        <div class="form-group col-md-5">
                            <label for="device_number">Číslo zařízení</label>
                            <input type="text" placeholder='"TO2843"' class="form-control" name="device_number">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="phone_number">Vaše číslo</label>
                            <input type="text" placeholder='"232 503 200"' class="form-control" name="phone_number">
                        </div>
                    </div>

                    <div class="form-group m-2">
                        <label for="description">Více informací...</label>
                        <textarea name="description" rows="4" class="form-control"></textarea>
                    </div>

                    <div class="d-flex justify-content-between m-2">
                        <div class="form-group m-2 col-md-7">
                            <label for="file">Soubory</label>
                            <input type="file" class="form-control" name="file" placeholder="1234 Main St">
                        </div>

                        <div class="form-group m-2 col-md-3">
                            <label for="department">Oddělení</label>
                            <select name="department" class="form-select" aria-label="Default select example">
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
                    <button type="submit" class="m-3 btn btn-primary">Vytvořit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
