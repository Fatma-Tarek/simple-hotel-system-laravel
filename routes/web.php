<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('articles', ArticleController::class);
Route::get('get-rooms', [ReservationsController::class, 'getAvailableRooms'])->name('get-rooms');
Route::get('/rooms', [RoomController::class, 'index'])->name('room.index');
Route::get('/rooms/create',[RoomController::class, 'create'])->name('room.create');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('room.show');
Route::post('/rooms',[RoomController::class, 'store'])->name('room.store');
Route::get('/rooms/{room}/rent', [ReservationController::class, 'store'])->name('reservation.store');



Route::get('reservations/all',[ReservationsController::class, 'index'])->name('reservation.list');
Route::get('reservations',[ReservationsController::class,'index']);          //show available rooms
Route::get('reservations/{room}',[ReservationsController::class,'create'])->name('reservation.create');
Route::post('reservations',[ReservationsController::class, 'store'])->name('reservation.store');


// Route::get('students', [StudentController::class, 'index']);
// Route::get('students/list', [StudentController::class, 'getStudents'])->name('students.list');

