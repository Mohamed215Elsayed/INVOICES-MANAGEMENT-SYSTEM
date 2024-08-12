<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoicesReport;
use App\Http\Controllers\CustomersReport;
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
/*============================================*/
Route::get('/', function () {
    // return view('welcome');
    return view('auth.login');
});

Auth::routes();
// Auth::routes(['register'=> false]);
Route::get('/home', [HomeController::class, 'index'])->name('home');//->middleware('checkstatus');
/*=============================================================*/
/****************************SectionsController***************************** */
Route::get('sections', [SectionsController::class, 'index']);
Route::post('sections', [SectionsController::class, 'store'])->name('sections.store');
Route::put('sections', [SectionsController::class, 'update'])->name('sections.update');
Route::delete('sections', [SectionsController::class, 'destroy'])->name('sections.delete');
/**********************************ProductsController*********************** */
Route::get('products', [ProductsController::class, 'index']);
Route::post('products', [ProductsController::class, 'store'])->name('products.store');
Route::put('products',  [ProductsController::class, 'update'])->name('products.update');
Route::delete('products', [ProductsController::class, 'destroy'])->name('products.delete');
/*********************************InvoicesController*****************اضافه فاتوره احترافيه******* *******/
Route::get('getall_invoices', [InvoicesController::class, 'index']);
Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);
Route::get('invoices', [InvoicesController::class, 'create'])->name('invoices.create');
Route::post('invoices', [InvoicesController::class, 'store'])->name('invoices.store');
Route::get('edit_invoice/{id}', [InvoicesController::class, 'edit'])->name('invoices.edit');
Route::patch('invoices', [InvoicesController::class, 'update'])->name('invoices.update');
Route::delete('invoices', [InvoicesController::class, 'destroy'])->name('invoices.destroy');
Route::get('/Status_show/{id}',[InvoicesController::class, 'show'])->name('Status_show');
Route::post('/Status_Update/{id}',[InvoicesController::class, 'Status_Update'])->name('Status_Update');

Route::get('Invoice_Paid',[InvoicesController::class,'Invoice_Paid']);
Route::get('Invoice_UnPaid',[InvoicesController::class,'Invoice_UnPaid']);
Route::get('Invoice_Partial',[InvoicesController::class,'Invoice_Partial']);
Route::get('Print_invoice/{id}',[InvoicesController::class,'Print_invoice']);
Route::get('export_invoices', [InvoicesController::class,'export']);
/*********************************************************************************** */
Route::resource('Archive', InvoiceAchiveController::class);//->names('Archive')
/************************************InvoicesDetailsController************************/
Route::get('/InvoicesDetails/{id}',[InvoicesDetailsController::class,'edit']);
Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'open_file']);
Route::get('download/{invoice_number}/{file_name}',[InvoicesDetailsController::class,'get_file']);
Route::post('delete_file', [InvoicesDetailsController::class,'destroy'])->name('delete_file');
/*************************************InvoiceAttachmentsController***********************/
Route::post('InvoiceAttachments', [InvoiceAttachmentsController::class,'store']);
/***********************************************************/
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
/********************************************** */
Route::get('invoices_report', [InvoicesReport::class,'index']);
Route::post('Search_invoices', [InvoicesReport::class,'Search_invoices']);
Route::get('customers_report', [CustomersReport::class,'index'])->name("customers_report");
Route::post('Search_customers', [CustomersReport::class,'Search_customers']);
/************************************************* */
Route::get('MarkAsRead_all',[InvoicesController::class,'MarkAsRead_all'])->name('MarkAsRead_all');
Route::get('unreadNotifications_count', [InvoicesController::class,'unreadNotifications_count'])->name('unreadNotifications_count');
Route::get('unreadNotifications', [InvoicesController::class,'unreadNotifications'])->name('unreadNotifications');
/*************************************************** */
Route::get('/{page}', [AdminController::class, 'index']);
