<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoicesReportController;
use App\Http\Controllers\CustomersController;






###################### start dashboard routes #######################
Route::get('/', function () {
    return view('auth.login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
###################### end profile routes #######################


###################### start profile routes #######################
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
###################### end profile routes #######################

###################### start Invoices routes #######################
Route::get('/export_invoice', [InvoicesController::class, 'export']);
Route::get('/Status_show/{id}', [InvoicesController::class,'show'])->name('Status_show');
Route::post('/Status_update/{id}', [InvoicesController::class,'Status_update'])->name('Status_update');
Route::get('/edit_invoice/{id}', [InvoicesController::class,'edit']);
Route::get('/print_invoice/{id}', [InvoicesController::class,'print_invoice']);
Route::get('MarkAsRead_all',[InvoicesController::class,'MarkAsRead_all'])->name('MarkAsRead_all');

Route::get('unreadNotifications_count', [InvoicesController::class,'unreadNotifications_count'])->name('unreadNotifications_count');

Route::get('unreadNotifications', [InvoicesController::class,'unreadNotifications'])->name('unreadNotifications');


Route::get('/section/{id}', [InvoicesController::class,'getproducts']);
Route::resource('/Invoices', InvoicesController::class);
###################### end Invoices routes #######################

###################### start Archive routes #######################
Route::resource('/Archive', InvoiceArchiveController::class);
###################### start Archive routes #######################


###################### start Sections routes #######################
Route::resource('/Sections', SectionsController::class);
###################### end Sections routes #######################


###################### start Products routes #######################
Route::resource('/Products', ProductsController::class);
###################### end Sections routes #######################

###################### start Products routes #######################
Route::get('/Invoices_details/{id}', [InvoicesDetailsController::class,'edit']);
Route::get('/download/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'get_file']);
Route::get('/view_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'open_file']);
Route::post('/delete_file', [InvoicesDetailsController::class, 'destroy'])->name('delete_file');
Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class,'edit']);
Route::resource('/Invoices_details', InvoicesDetailsController::class);
###################### end Sections routes #######################

###################### start InvoiceAttachments routes #######################
Route::post('/Attachments', [InvoiceAttachmentsController::class,'store']);
Route::resource('/InvoiceAttachments', InvoiceAttachmentsController::class);

###################### end InvoiceAttachments routes #######################

###################### start Archive routes #######################
Route::group(['middleware'=>['auth']], function(){
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

});
###################### start Archive routes #######################

###################### start Reports routes #######################
Route::get('invoices_report', [InvoicesReportController::class,'index']);
Route::post('Search_invoices', [InvoicesReportController::class,'searchInvoices'])->name('search.invoices');
###################### end Reports routes #######################

###################### start Customers routes #######################
Route::get('customers_report', [CustomersController::class,'index'])->name("customers_report");
Route::post('Search_customers', [CustomersController::class,'Search_customers'])->name('search.customers');
###################### start Customers routes #######################

Route::get('/{page}', [AdminController::class,'index']);
require __DIR__.'/auth.php';
