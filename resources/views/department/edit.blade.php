@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" action="{{ route('departments.update', $department->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-outline mb-4">
                        <label class="form-label" for="name">Jméno oddělení</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $department->name }}">
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

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-block">Vytvořit</button>

                        <form id="deleteForm" action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display: none">
                            @method("DELETE")
                            @csrf

                            <button type="submit" class="btn btn-sm btn-danger">
                                Smazat
                            </button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
