<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//index, store, update, destroy
//show

//index
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::post('/students',[StudentController::class, 'store'])->name('students.store');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');


//show  kokiu metodu man gauti individualu studenta?
Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
