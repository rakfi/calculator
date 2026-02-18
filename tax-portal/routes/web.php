<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tax\ApitSalaryController;
use App\Http\Controllers\Tax\ApitBonusController;
use App\Http\Controllers\Tax\AnnualTaxController;
use App\Http\Controllers\Tax\EstimatedTaxController;
use App\Http\Controllers\Tax\ServiceExportController;
use App\Http\Controllers\Tax\VatController;

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

Route::get('/admin', fn() => view('admin.dashboard'))->name('dashboard');
Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
Route::get('/admin/calculators/regular_salary', [ApitSalaryController::class, 'editRates']);
Route::post('/admin/calculators/regular_salary/{id}', [ApitSalaryController::class, 'updateRates']);
Route::get('/admin/calculators/annual_income', [AnnualTaxController::class, 'editRates']);
Route::post('/admin/calculators/annual_income/{id}', [AnnualTaxController::class, 'updateRates']);
Route::get('/admin/calculators/service_export', [ServiceExportController::class, 'editRates']);
Route::post('/admin/calculators/service_export/{id}', [ServiceExportController::class, 'updateRates']);
Route::get('/admin/calculators/estimated_tax', [EstimatedTaxController::class, 'editRates']);
Route::post('/admin/calculators/estimated_tax/individual/{id}', [EstimatedTaxController::class, 'updateRates']);
Route::post('/admin/calculators/estimated_tax/corporate/{id}', [EstimatedTaxController::class, 'updateCorporateRates']);


Route::get('/tax-calculators/apit-salary-tax', [ApitSalaryController::class, 'index'])->name('tax.apit.salary');
Route::post('/tax-calculators/apit-salary-tax/calculate', [ApitSalaryController::class, 'calculate'])->name('tax.apit.salary.calculate');
// PDF Download for aPIT Salary Tax Calculation
Route::get('/tax-calculators/apit-salary-tax/pdf', [ApitSalaryController::class, 'downloadPdf'])->name('tax.apit.salary.pdf');


// aPIT Bonus Tax Calculator routes
Route::get('/tax-calculators/apit-bonus-tax', [ApitBonusController::class, 'index'])->name('tax.apit.bonus');
Route::post('/tax-calculators/apit-bonus-tax/calculate', [ApitBonusController::class, 'calculate'])->name('tax.apit.bonus.calculate');
// PDF Download for aPIT Bonus Tax Calculation
Route::get('/tax-calculators/apit-bonus-tax/pdf', [ApitBonusController::class, 'downloadPdf'])->name('tax.apit.bonus.pdf'); 

// Annual Tax Calculator routes
Route::get('/tax/annual', [AnnualTaxController::class, 'annualTax'])->name('tax.annual');
Route::post('/tax/annual/calculate', [AnnualTaxController::class, 'annualTaxCalculate'])->name('tax.annual.calculate');
// PDF Download for Annual Tax Calculation
Route::get('/tax/annual/pdf', [AnnualTaxController::class, 'downloadPdf'])->name('tax.annual.pdf');


// Estimated Tax Calculator routes
Route::get('/tax/estimated', [EstimatedTaxController::class, 'index'])->name('tax.estimated');
    
Route::post('/tax/estimated/individual', [EstimatedTaxController::class, 'calculate'])->name('tax.estimated.individual');
Route::post('/tax/estimated/corporate', [EstimatedTaxController::class, 'calculateBusiness'])->name('tax.estimated.corporate');
// PDF Download for Estimated Tax Calculation

Route::get('/tax/estimated/individual/pdf', [EstimatedTaxController::class, 'downloadPdf'])->name('tax.estimated.individual.pdf');
Route::get('/tax/estimated/corporate/pdf', [EstimatedTaxController::class, 'downloadCorporatePdf'])->name('tax.estimated.corporate.pdf');

// Service Export routes
Route::get('/tax/service-exporter', [ServiceExportController::class, 'index'])->name('tax.service.exporter');
Route::post('/tax/service-exporter/calculate', [ServiceExportController::class, 'calculate'])->name('tax.service.exporter.calculate');
// PDF Download for Service Exporter Tax Calculation
Route::get('/tax/service-exporter/pdf', [ServiceExportController::class, 'downloadPdf'])->name('tax.service.exporter.pdf');

// VAT Calculator routes
Route::get('/tax/vat-calculator', [VatController::class, 'index'])->name('tax.vat');
Route::post('/tax/vat-calculator/calculate', [VatController::class, 'calculate'])->name('tax.vat.calculate'); 
// PDF Download for VAT Calculation
Route::get('/tax/vat-calculator/pdf', [VatController::class, 'downloadPdf'])->name('tax.vat.pdf');  

require __DIR__ . '/payroll.php';