<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\SurnameController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/person',PersonController::class)->middleware(['auth']);
Route::post('/searchParent',[PersonController::class, 'searchParent'])->middleware(['auth']);
Route::resource('/surname',SurnameController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
 
    return "Cleared!";
 
 });