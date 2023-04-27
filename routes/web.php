<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentsController;

Auth::routes();

Route::group(['middleware' => ['auth', 'verified']], function (){
    Route::get('/', [TicketController::class, 'create']);
    Route::resource('/ticket', TicketController::class);
    Route::post('/ticket/take/{ticket:id}', [TicketController::class, 'takeTicket'])->name('ticket.takeTicket');

    Route::get('/profile/{user:id}', [UserController::class, 'show'])->name('profile.show');
    Route::get('/profile/taken/{user:id}', [UserController::class, 'showTaken'])->name('profile.showTaken');
    Route::resource('/departments', DepartmentController::class);

    Route::post('/comment/store/{ticket:id}', [CommentsController::class, 'store'])->name('comment.store');
    Route::get('/comment/edit/{comment:id}', [CommentsController::class, 'edit'])->name('comment.edit');
    Route::patch('/comment/update/{comment:id}', [CommentsController::class, 'update'])->name('comment.update');
    Route::delete('/comment/destroy/{comment:id}', [CommentsController::class, 'destroy'])->name('comment.destroy');
});
