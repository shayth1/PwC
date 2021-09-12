<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkOnController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Routs 

Route::post('/login', [AuthController::class, 'login']);
Route::post('/newEmployee', [AuthController::class, 'register']);


// Manager Routs

Route::group(['middleware' => ['auth:sanctum']], function () {

    // auth Routes:
    Route::post('/logout', [AuthController::class, 'logout']);

    // Project Routes:
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
    Route::get('/projects/search/{name}', [ProjectController::class, 'search']);

    //Department Routes:
    Route::get('/department', [DepartmentController::class, 'index']);
    Route::post('/department/add', [DepartmentController::class, 'store']);
    Route::put('/department/edit/{id}', [DepartmentController::class, 'update']);
    Route::delete('/department/delete/{id}', [DepartmentController::class, 'destroy']);
    Route::get('/department/search/{key}', [DepartmentController::class, 'search']);


    // Employee Routes:
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users/add', [UserController::class, 'store']);
    Route::put('/users/edit/{id}', [UserController::class, 'update']);
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy']);
    Route::get('/users/search/{key}', [UserController::class, 'search']);

    // assign employee to project
    Route::post('/users/assign', [WorkOnController::class, 'store']);
    Route::delete('/users/unassign/{assign_id}', [WorkOnController::class, 'destroy']);
    // get assign employee into project
    Route::get('/users/assign/inform/{project_id}', [WorkOnController::class, 'index']);



    // Route::resource('projects', ProjectController::class);
});
