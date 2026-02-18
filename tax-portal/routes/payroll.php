<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payroll\PayrollController;
use App\Http\Controllers\Payroll\GratuityController;
use App\Http\Controllers\Payroll\EpfEtfController;

// Payroll Calculators page
Route::get('/payroll-calculators', fn() => view('payroll.calculators'))->name('payroll.calculators');

// Payroll / Salary Slip Generator
Route::get('/payroll/salary-slip', [PayrollController::class, 'showForm'])->name('payroll.form');
Route::post('/payroll/salary-slip/calculate', [PayrollController::class, 'calculate'])->name('payroll.calculate');
Route::get('/payroll/salary-slip/pdf', [PayrollController::class, 'downloadPdfFromSession'])->name('payroll.pdf');
Route::post('/payroll/salary-slip/download', [PayrollController::class, 'download'])->name('payroll.download');
Route::post('/payroll/salary-slip/preview', [PayrollController::class, 'preview'])->name('payroll.preview');
Route::get('/payroll/salary-slips', [PayrollController::class, 'index'])->name('payroll.index');
Route::get('/payroll/salary-slip/{id}', [PayrollController::class, 'show'])->name('payroll.show');
Route::get('/payroll/salary-slip/{id}/pdf', [PayrollController::class, 'downloadSaved'])->name('payroll.saved.download');

// Gratuity Calculator
Route::get('/gratuity', [GratuityController::class, 'form'])->name('gratuity.form');
Route::post('/gratuity/calculate', [GratuityController::class, 'calculate'])->name('gratuity.calculate');
Route::get('/gratuity/pdf', [GratuityController::class, 'downloadPdfFromSession'])->name('gratuity.pdf');
Route::post('/gratuity/download', [GratuityController::class, 'download'])->name('gratuity.download');
Route::get('/gratuity/calculations', [GratuityController::class, 'index'])->name('gratuity.index');
Route::get('/gratuity/calculation/{id}', [GratuityController::class, 'show'])->name('gratuity.show');
Route::get('/gratuity/calculation/{id}/pdf', [GratuityController::class, 'downloadSaved'])->name('gratuity.saved.download');

// EPF / ETF Calculator
Route::get('/tax/epf-etf', [EpfEtfController::class, 'form'])->name('tax.epf');
Route::post('/tax/epf-etf/calculate', [EpfEtfController::class, 'calculate'])->name('tax.epf.calculate');
Route::get('/tax/epf-etf/pdf', [EpfEtfController::class, 'downloadPdfFromSession'])->name('tax.epf.pdf');

// Admin settings for salary slip
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/calculators/salary_slip', [PayrollController::class, 'settingsEdit'])->name('admin.salary_slip.settings');
    Route::post('/admin/calculators/salary_slip', [PayrollController::class, 'settingsUpdate'])->name('admin.salary_slip.settings.update');

    // Admin settings for EPF/ETF
    Route::get('/admin/calculators/epf_etf', [EpfEtfController::class, 'settingsEdit'])->name('admin.epf.settings');
    Route::post('/admin/calculators/epf_etf', [EpfEtfController::class, 'settingsUpdate'])->name('admin.epf.settings.update');

    // Admin settings for Gratuity
    Route::get('/admin/calculators/gratuity', [GratuityController::class, 'settingsEdit'])->name('admin.gratuity.settings');
    Route::post('/admin/calculators/gratuity', [GratuityController::class, 'settingsUpdate'])->name('admin.gratuity.settings.update');
});
