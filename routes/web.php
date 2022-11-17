<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
    HTTP Methods
    GET - Request a resource
    POST - Create a new resource
    PUT - Update a resource (Update whole row)
    PATCH - Modify a resource (Update only changed values)
    DELETE - Delete a resource
    OPTIONS - Ask the server which verbs are allowed
*/

//All methods after this will require an authorization
Auth::routes();

//Apply
Route::post('apply/{job}', [Controllers\ApplyController::class, 'store'])->name('job.store');

//Accept
//Route::post('applycallback/{apply}', [Controllers\ApplicationController::class, 'store'])->name('job.store');

//Home
Route::get('/', Controllers\HomeController::class);

//Job
//Route::get('/', [Controllers\JobsController::class, 'index'])->name('job.show');
Route::get('/job/create', [Controllers\JobsController::class, 'create'])->name('job.create');
Route::post('/job', [Controllers\JobsController::class, 'store'])->name('job.store');
Route::get('/job/{job}/edit', [Controllers\JobsController::class, 'edit'])->name('job.edit');
Route::patch('/job/{job}', [Controllers\JobsController::class, 'update'])->name('job.update');
Route::get('/job/{job}', [Controllers\JobsController::class, 'show'])->name('job.show');
Route::delete('/job/{id}', [Controllers\JobsController::class, 'destroy'])->name('job.destroy');

//Profile
Route::get('/member/{user}', [Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::get('/member/{user}/edit', [Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/member/{user}', [Controllers\ProfilesController::class, 'update'])->name('profile.update');

