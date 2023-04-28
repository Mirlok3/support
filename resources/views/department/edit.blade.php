@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="bg-white border border-secondary p-3 rounded-2">
                    <div class="d-flex justify-content-between">
                        <h4>Přejmenovat oddělení</h4>
                        <form id="deleteForm" action="{{ route('departments.destroy', $department->id) }}"
                              method="POST">
                            @method("DELETE")
                            @csrf

                            <button type="submit" class="btn btn-sm btn-danger">
                                Smazat
                            </button>
                        </form>
                    </div>
                    <form method="POST" action="{{ route('departments.update', $department->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-outline mb-4">
                            <label class="form-label" for="name">Jméno oddělení</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ $department->name }}">
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
    </div>
@endsection
