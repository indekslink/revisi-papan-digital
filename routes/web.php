<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\SheetController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/presentation/play', [PresentationController::class, 'play_content'])->name('play_content');


Route::get('/items/{slug}/create-sheet', [ItemController::class, 'createSheet'])->name('createSheet');
Route::resources([
    'items' => ItemController::class,
    'sheets' => SheetController::class,
    'presentation' => PresentationController::class,
]);
