<?php

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
})->name('login');

Route::get('exit', function (){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->route('login');
})->name('exit');

Route::middleware('auth')->group(function (){
   Route::get('dashboard', [\App\Http\Controllers\UserCabController::class, 'index'])->name('dashboard');
   Route::get('settings', [\App\Http\Controllers\UserCabController::class, 'settings'])->name('settings');
   Route::get('stats', [\App\Http\Controllers\UserCabController::class, 'statsList'])->name('stats');
   Route::get('orders', [\App\Http\Controllers\UserCabController::class, 'orders'])->name('orders');
   Route::get('users', [\App\Http\Controllers\UserCabController::class, 'usersList'])->name('users');

   Route::get('user/{id}', [\App\Http\Controllers\UserCabController::class, 'userItem'])->name('users-edit');
   Route::get('user/create', [\App\Http\Controllers\UserCabController::class, 'userItemCreate'])->name('users-create');

    Route::get('restoran/{id}', [\App\Http\Controllers\UserCabController::class, 'restoranItem'])->name('restoran-edit');
    Route::get('restoran/create', [\App\Http\Controllers\UserCabController::class, 'restoranItemCreate'])->name('restoran-create');
});


Route::get('/test', function (){

});
