<?php

use App\Livewire\edit;
use App\Livewire\Kategoris\Kategoris;
use Illuminate\Support\Facades\Route;
use App\Livewire\Products\Products;

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

Route::get('/products', Products::class)->name("products");
Route::get('/kategoris', Kategoris::class)->name("kategoris");

Route::get('/products/edit/{id}', edit::class)->name('product.edit');