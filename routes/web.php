<?php

use Illuminate\Support\Facades\Route;
//Config cache clear
Route::get('clear', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('key:generate');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('optimize');
    dd("All clear!");
});
Route::get('/', function () {
    return view('frontend.home.index');
});
Route::get('/customer/logout', function () {
    \Illuminate\Support\Facades\Session::flush();
    return redirect('/')->with('message','you are successfully logout');
});

Auth::routes();
//    Route::group([ 'middleware' => 'admin'], function () {
//        Route::get('/logout',function (){
//            \Illuminate\Support\Facades\Session::flush();
//            return redirect('/login')->with('message','you are successfully logout');
//        });
        Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout']);
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/customers', [App\Http\Controllers\Frontend\CustomerController::class, 'index']);
        Route::post('/customer-store', [App\Http\Controllers\Frontend\CustomerController::class, 'customerStore']);
        Route::get('/customer-edit/{id}', [App\Http\Controllers\Frontend\CustomerController::class, 'customerEdit']);
        Route::post('/customer-update', [App\Http\Controllers\Frontend\CustomerController::class, 'customerUpdate']);
        Route::get('/viewcustomer/{id}', [App\Http\Controllers\Frontend\CustomerController::class, 'customerView']);
        ////invoice manage route
        Route::get('/invoice-create', [App\Http\Controllers\Frontend\InvoiceController::class, 'invoiceCreate']);
        Route::post('/invoice-store', [App\Http\Controllers\Frontend\InvoiceController::class, 'invoiceStore']);
        Route::get('/invoice-edit/{id}', [App\Http\Controllers\Frontend\InvoiceController::class, 'invoiceEdit']);
        Route::post('/invoice-update/{id}', [App\Http\Controllers\Frontend\InvoiceController::class, 'invoiceUpdate']);
        Route::get('/invoice-delete/{id}', [App\Http\Controllers\Frontend\InvoiceController::class, 'invoiceDelete']);
        Route::get('/invoice-list', [App\Http\Controllers\Frontend\InvoiceController::class, 'invoiceList']);
        ////bank route manage
        Route::get('/banks', [App\Http\Controllers\Frontend\BankController::class, 'index']);
        Route::post('/bank-store', [App\Http\Controllers\Frontend\BankController::class, 'bankStore']);
        Route::get('/bank-edit/{id}', [App\Http\Controllers\Frontend\BankController::class, 'bankEdit']);
        Route::post('/bank-update', [App\Http\Controllers\Frontend\BankController::class, 'bankUpdate']);
        Route::get('/viewbank/{id}', [App\Http\Controllers\Frontend\BankController::class, 'bankView']);
        Route::get('/bank-delete/{id}', [App\Http\Controllers\Frontend\BankController::class, 'bankDelete']);
        ////invoice manage route
        Route::get('/entry-create', [App\Http\Controllers\Frontend\InvoiceController::class, 'entryCreate']);
        Route::post('/entry-store', [App\Http\Controllers\Frontend\InvoiceController::class, 'entryStore']);
        Route::get('/entry-edit/{id}', [App\Http\Controllers\Frontend\InvoiceController::class, 'entryEdit']);
        Route::post('/entry-update/{id}', [App\Http\Controllers\Frontend\InvoiceController::class, 'entryUpdate']);
        Route::get('/entry-delete/{id}', [App\Http\Controllers\Frontend\InvoiceController::class, 'entryDelete']);
        Route::get('/entry-list', [App\Http\Controllers\Frontend\InvoiceController::class, 'entryList']);

        ///dependency Dropdown route
        Route::get('/customer-bank-data/{value}', [App\Http\Controllers\Frontend\CustomerController::class, 'customerBankData']);
//    });
