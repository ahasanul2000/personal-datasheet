<?php

use App\Http\Controllers\pdsController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/pds', [pdsController::class, 'pds'])->name('pds');
    Route::get('/creatPds', [pdsController::class, 'creatPds'])->name('creatPds');
    Route::post('/storePdsData', [PdsController::class, 'storePdsData'])->name('storePdsData');
    Route::get('/editPds/{id}', [PdsController::class, 'editPds']);
    Route::post('/updatePds', [PdsController::class, 'updatePds'])->name('updatePds');
    Route::get('/deletePds/{id}', [PdsController::class, 'deletePds']);
    Route::get('/viewPdsData/{id}', [PdsController::class, 'viewPdsData']);




    // //soft delete 
    // Routes for soft delete operations
    Route::get('/softdeleted', [PdsController::class, 'softDeleted'])->name('softDeleted');
    Route::post('/restore/{id}', [PdsController::class, 'restore'])->name('restore');
    Route::delete('/forceDelete/{id}', [PdsController::class, 'forceDelete'])->name('forceDelete');
});
require __DIR__ . '/auth.php';
