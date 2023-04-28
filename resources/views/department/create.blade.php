@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" action="{{ route('departments.store') }}" class="bg-white border border-secondary p-3 rounded-2">
                    <h4>Vytvořit oddělení</h4>
                    @csrf
                    <div class="form-outline mb-4">
                        <label class="form-label" for="name">Jméno oddělení</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"/>
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

                    <button type="submit" class="btn btn-primary btn-block">Vytvořit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
