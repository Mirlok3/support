@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="bg-white p-2">
                    <div class="form-group m-2">
                        <label for="inputAddress">Problém</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="Co se stalo?">
                    </div>

                    <div class="d-flex justify-content-between m-2">
                        <div class="form-group col-md-5">
                            <label for="inputEmail4">Číslo zařízení</label>
                            <input type="text" placeholder='"TO2843"' class="form-control" id="inputEmail4">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="inputPassword4">Vaše číslo</label>
                            <input type="text" placeholder='"232 503 200"' class="form-control" id="inputPassword4">
                        </div>
                    </div>

                    <div class="form-group m-2">
                        <label for="inputAddress2">Více informací...</label>
                        <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                    </div>

                    <div class="form-group m-2">
                        <label for="inputAddress">Soubory</label>
                        <input type="file" class="form-control" id="inputAddress" placeholder="1234 Main St">
                    </div>
                    <button type="submit" class="m-2 btn btn-primary">Sign in</button>
                </form>
            </div>
        </div>
    </div>
@endsection
