<?php

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
//dddd
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices', App\Http\Controllers\InvoiceController::class);

Route::resource('sections',App\Http\Controllers\SectionController::class);
Route::get('/section/{id}',[App\Http\Controllers\InvoiceController::class, 'getproducts']);

Route::resource('products',App\Http\Controllers\ProductController::class);

Route::resource('InvoiceAttachments', App\Http\Controllers\InvoiceAttachmentController::class);

Route::get('/InvoicesDetails/{id}', [App\Http\Controllers\InvoiceDetailController::class, 'edit']);


Route::get('download/{invoice_number}/{file_name}', [App\Http\Controllers\InvoiceDetailController::class, 'get_file']);

Route::get('View_file/{invoice_number}/{file_name}', [App\Http\Controllers\InvoiceDetailController::class, 'open_file']);
Route::post('delete_file', [App\Http\Controllers\InvoiceDetailController::class, 'destroy'])->name('delete_file');


Route::get('/{page}', [App\Http\Controllers\AdminController::class, 'index']);
