<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tax\ApitSalaryController;
use App\Http\Controllers\Tax\ApitBonusController;
use App\Http\Controllers\Tax\AnnualTaxController;
use App\Http\Controllers\Tax\EstimatedTaxController;
use App\Http\Controllers\Tax\ServiceExportController;
use App\Http\Controllers\Tax\VatController;
use App\Http\Controllers\ProfileController;

// Public pages
Route::get('/', fn() => view('home'))->name('home');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/services', fn() => view('services'))->name('services');
Route::get('/tax-calculators', fn() => view('tax-calculators'))->name('tax.calculators');
Route::get('/news', fn() => view('news'))->name('news');
Route::get('/downloads', fn() => view('downloads'))->name('downloads');
Route::get('/contact', fn() => view('contact'))->name('contact');

// Admin routes - Protected with auth middleware
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', fn() => view('admin.dashboard'))->name('dashboard');
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
    
    // Tax calculator settings
    Route::get('/admin/calculators/regular_salary', [ApitSalaryController::class, 'editRates']);
    Route::post('/admin/calculators/regular_salary/{id}', [ApitSalaryController::class, 'updateRates']);
    Route::get('/admin/calculators/annual_income', [AnnualTaxController::class, 'editRates']);
    Route::post('/admin/calculators/annual_income/{id}', [AnnualTaxController::class, 'updateRates']);
    Route::get('/admin/calculators/service_export', [ServiceExportController::class, 'editRates']);
    Route::post('/admin/calculators/service_export/{id}', [ServiceExportController::class, 'updateRates']);
    Route::get('/admin/calculators/estimated_tax', [EstimatedTaxController::class, 'editRates']);
    Route::post('/admin/calculators/estimated_tax/individual/{id}', [EstimatedTaxController::class, 'updateRates']);
    Route::post('/admin/calculators/estimated_tax/corporate/{id}', [EstimatedTaxController::class, 'updateCorporateRates']);
});

// Tax calculator routes - Public
Route::get('/tax-calculators/apit-salary-tax', [ApitSalaryController::class, 'index'])->name('tax.apit.salary');
Route::post('/tax-calculators/apit-salary-tax/calculate', [ApitSalaryController::class, 'calculate'])->name('tax.apit.salary.calculate');
Route::get('/tax-calculators/apit-salary-tax/pdf', [ApitSalaryController::class, 'downloadPdf'])->name('tax.apit.salary.pdf');

Route::get('/tax-calculators/apit-bonus-tax', [ApitBonusController::class, 'index'])->name('tax.apit.bonus');
Route::post('/tax-calculators/apit-bonus-tax/calculate', [ApitBonusController::class, 'calculate'])->name('tax.apit.bonus.calculate');
Route::get('/tax-calculators/apit-bonus-tax/pdf', [ApitBonusController::class, 'downloadPdf'])->name('tax.apit.bonus.pdf'); 

Route::get('/tax/annual', [AnnualTaxController::class, 'annualTax'])->name('tax.annual');
Route::post('/tax/annual/calculate', [AnnualTaxController::class, 'annualTaxCalculate'])->name('tax.annual.calculate');
Route::get('/tax/annual/pdf', [AnnualTaxController::class, 'downloadPdf'])->name('tax.annual.pdf');

Route::get('/tax/estimated', [EstimatedTaxController::class, 'index'])->name('tax.estimated');
Route::post('/tax/estimated/individual', [EstimatedTaxController::class, 'calculate'])->name('tax.estimated.individual');
Route::post('/tax/estimated/corporate', [EstimatedTaxController::class, 'calculateBusiness'])->name('tax.estimated.corporate');
Route::get('/tax/estimated/individual/pdf', [EstimatedTaxController::class, 'downloadPdf'])->name('tax.estimated.individual.pdf');
Route::get('/tax/estimated/corporate/pdf', [EstimatedTaxController::class, 'downloadCorporatePdf'])->name('tax.estimated.corporate.pdf');

Route::get('/tax/service-exporter', [ServiceExportController::class, 'index'])->name('tax.service.exporter');
Route::post('/tax/service-exporter/calculate', [ServiceExportController::class, 'calculate'])->name('tax.service.exporter.calculate');
Route::get('/tax/service-exporter/pdf', [ServiceExportController::class, 'downloadPdf'])->name('tax.service.exporter.pdf');

Route::get('/tax/vat', [VatController::class, 'index'])->name('tax.vat');
Route::post('/tax/vat/calculate', [VatController::class, 'calculate'])->name('tax.vat.calculate');
Route::get('/tax/vat/pdf', [VatController::class, 'downloadPdf'])->name('tax.vat.pdf');

// Profile routes - Protected with auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include payroll routes
require __DIR__ . '/payroll.php';

// Include authentication routes
require __DIR__.'/auth.php';
