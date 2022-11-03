<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;


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


//Home
//Route::get('/', [HomeController::class, 'index'])->name('home');

//All methods after this will require an authorization
Auth::routes();

//Jobs
Route::post('apply/{job}', [Controllers\ApplyController::class, 'store'])->name('job.store');

Route::get('/', 'JobsController@index');

Route::get('/', [Controllers\JobsController::class, 'index'])->name('job.show');
Route::get('/job/create', [Controllers\JobsController::class, 'create'])->name('job.create');
Route::post('/job', [Controllers\JobsController::class, 'store'])->name('job.store');
Route::get('/job/{job}', [Controllers\JobsController::class, 'show'])->name('job.show');


//Profile
Route::get('/member/{user}', [Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::get('/member/{user}/edit', [Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/member/{user}', [Controllers\ProfilesController::class, 'update'])->name('profile.update');

