<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\SavingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->controller(AuthController::class)->group(function () {
    Route::get('/login', 'viewLogin')->name('view.login');
    Route::get('/register', 'viewRegister')->name('view.register');
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->controller(LoanController::class)->group(function () {
    Route::get('/loans', 'index')->name('loans.index');
    Route::post('/loans', 'store')->name('loans.store');
    Route::get('/loans/{loan}', 'show')->name('loans.show');
    Route::get('/loans/{loan}/payment', 'paymentForm')->name('loans.payment.form');
    Route::post('/loans/{loan}/payment', 'recordPayment')->name('loans.payment.record');
    Route::delete('/loans/{loan}', 'destroy')->name('loans.destroy');
});

Route::middleware(['auth'])->controller(SavingController::class)->group(function () {
    Route::get('/savings', 'index')->name('savings.index');
    Route::post('/savings', 'store')->name('savings.store');
    Route::get('/savings/{saving}', 'show')->name('savings.show');
    Route::get('/savings/{saving}/add-amount', 'addAmountForm')->name('savings.add-amount.form');
    Route::post('/savings/{saving}/add-amount', 'addAmount')->name('savings.add-amount');
    Route::delete('/savings/{saving}', 'destroy')->name('savings.destroy');
});

Route::middleware(['auth'])->controller(FundController::class)->group(function () {
    Route::get('/funds', 'index')->name('funds.index');
    Route::post('/funds', 'store')->name('funds.store');
    Route::get('/funds/{fund}', 'show')->name('funds.show');
    Route::get('/funds/{fund}/add-contribution', 'addContributionForm')->name('funds.add-contribution.form');
    Route::post('/funds/{fund}/add-contribution', 'addContribution')->name('funds.add-contribution');
    Route::delete('/funds/{fund}', 'destroy')->name('funds.destroy');
});
