<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TicketController;

Auth::routes();

Route::group(['middleware' => ['auth', 'verified']], function (){
    Route::get('/', [TicketController::class, 'create']);
    Route::resource('/departments', DepartmentController::class);
});
