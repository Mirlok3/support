<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;

Auth::routes();

Route::group(['middleware' => ['auth', 'verified']], function (){
    Route::get('/', [TicketController::class, 'create']);
    Route::post('/', [TicketController::class, 'store'])->name('ticket.store');
    Route::get('/profile/{user:id}', [UserController::class, 'show'])->name('profile.show');
    Route::resource('/departments', DepartmentController::class);
});
