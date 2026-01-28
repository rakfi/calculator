<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonalTaxController;
use App\Http\Controllers\BusinessTaxController;
use App\Http\Controllers\VatTaxController;

// Home page
Route::get('/', fn() => view('home'))->name('home');

// About page
Route::get('/about', fn() => view('about'))->name('about');

// Services page
Route::get('/services', fn() => view('services'))->name('services');

// Tax Calculators page
Route::get('/tax-calculators', fn() => view('tax-calculators'))->name('tax.calculators');

// News page
Route::get('/news', fn() => view('news'))->name('news');

// Downloads page (used in navbar dropdown)
Route::get('/downloads', fn() => view('downloads'))->name('downloads');

// Contact page
Route::get('/contact', fn() => view('contact'))->name('contact');

// Login page
Route::get('/login', fn() => view('login'))->name('login');

// Personal Tax Calculator routes
Route::get('/tax-calculators/personal-tax', [PersonalTaxController::class, 'index'])->name('tax.personal');
Route::post('/tax-calculators/personal-tax/calculate', [PersonalTaxController::class, 'calculate'])->name('tax.personal.calculate');

// Business Tax Calculator routes
Route::get('/tax-calculators/business-tax', [BusinessTaxController::class, 'index'])->name('tax.business');
Route::post('/tax-calculators/business-tax/calculate', [BusinessTaxController::class, 'calculate'])->name('tax.business.calculate');

// VAT Calculator routes
Route::get('/tax-calculators/vat-tax', [VatTaxController::class, 'index'])->name('tax.vat');
Route::post('/tax-calculators/vat-tax/calculate', [VatTaxController::class, 'calculate'])->name('tax.vat.calculate');   