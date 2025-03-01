<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;

Route::get('/', function () {
    return redirect()->route('schedules.index');
});

Route::resource('schedules', ScheduleController::class)->middleware('auth');
Route::get('schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
Route::post('schedules/store', [ScheduleController::class, 'store'])->name('schedules.store');
Route::post('schedules/confirm', [ScheduleController::class, 'confirm'])->name('schedules.confirm');
Route::get('schedules/{schedule}/confirm-delete', [ScheduleController::class, 'confirmDelete'])->name('schedules.confirmDelete');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');