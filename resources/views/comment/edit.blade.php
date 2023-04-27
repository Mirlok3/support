@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('comment.update', $comment->id) }}" class="media text-break bg-white border border-secondary p-3 rounded-2" enctype="multipart/form-data">
                    <h4 class="ps-2">Změnit komentář</h4>
                    @method('PATCH')
                    @csrf

                    <div class="form-group m-2">
                        <textarea name="content" rows="6" class="form-control">{{ $comment->content }}</textarea>
                    </div>
                    <div class="form-group m-2 col-md-7">
                        <label for="file">Soubor</label>
                        <input type="file" accept="image/*" class="form-control" name="file">
                    </div>
                    <button type="submit" class="ms-2 mb-2 btn btn-primary btn-block">Změnit</button>
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
            </div>
        </div>
    </div>
@endsection
