<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::controller(FormController::class)
->prefix('form-test')->group(function(){
    Route::get('register', 'register');
});


Route::prefix('user')
->middleware('can:user-higher')
->group(function() {
    Route::get('index', function() {
        return dd('user');
    });
});

Route::prefix('manager')
->middleware('can:manager-higher')
->group(function() {
    Route::get('events/past', [EventController::class, 'past'])->name('events.past'); 
    Route::resource('events', EventController::class);
});
