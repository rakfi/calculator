<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApitSalaryController;
use App\Http\Controllers\ApitBonusController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\EstimatedTaxController;
use App\Http\Controllers\ServiceExportController;
use App\Http\Controllers\VatController;

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

//aPI T/PAYE Salary Tax Calculator routes
Route::get('/tax-calculators/apit-salary-tax', [ApitSalaryController::class, 'index'])->name('tax.apit.salary');
Route::post('/tax-calculators/apit-salary-tax/calculate', [ApitSalaryController::class, 'calculate'])->name('tax.apit.salary.calculate');

// PDF Download for APIT/PAYE Salary Tax Calculation
Route::get('/tax/apit/salary/pdf', [ApitSalaryController::class, 'downloadPdf'])->name('tax.apit.salary.pdf');

// aPIT Bonus Tax Calculator routes
Route::get('/tax-calculators/apit-bonus-tax', [ApitBonusController::class, 'index'])->name('tax.apit.bonus');
Route::post('/tax-calculators/apit-bonus-tax/calculate', [ApitBonusController::class, 'calculate'])->name('tax.apit.bonus.calculate');

// Annual Tax Calculator routes
Route::get('/tax/annual', [TaxController::class, 'annualTax'])->name('tax.annual');
Route::post('/tax/annual/calculate', [TaxController::class, 'annualTaxCalculate'])->name('tax.annual.calculate');

// Estimated Tax Calculator routes
Route::get('/tax/estimated', [EstimatedTaxController::class, 'index'])->name('tax.estimated');
Route::post('/tax/estimated/calculate', [EstimatedTaxController::class, 'calculate'])->name('tax.estimated.calculate');

// Service Export routes
Route::get('/tax/service-exporter', [ServiceExportController::class, 'index'])->name('tax.service.exporter');
Route::post('/tax/service-exporter/calculate', [ServiceExportController::class, 'calculate'])->name('tax.service.exporter.calculate');

// VAT Calculator routes
Route::get('/tax/vat-calculator', [VatController::class, 'index'])->name('tax.vat');
Route::post('/tax/vat-calculator/calculate', [VatController::class, 'calculate'])->name('tax.vat.calculate');   