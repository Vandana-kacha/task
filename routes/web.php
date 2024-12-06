<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasklistController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/addtask',[TasklistController::class,'store']);

Route::get('/',[TasklistController::class,'show']);

Route::get('/edittask/{id}', [TasklistController::class, 'edit']);

Route::post('/updatetask/{id}', [TasklistController::class, 'update']);

Route::delete('deletetask/{id}', [TasklistController::class, 'destroy']);
