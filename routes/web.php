<?php

use App\Http\Controllers\AverageController;
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

Route::get('/', [AverageController::class, 'index'])->name('students.index');
Route::post('students', [AverageController::class, 'store'])->name('students.store');
Route::delete('students/{student}', [AverageController::class, 'destroy'])->name('students.destroy');
