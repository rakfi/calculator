<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class VatController extends Controller
{
    /**
     * Show VAT Calculator page
     */
    public function index()
    {
        return view('tax.vat');
    }

    /**
     * Calculate VAT for a transaction
     */
    public function calculate(Request $request)
{
    $request->validate([
        'amount'   => 'required|numeric|min:0',
        'vat_rate' => 'required|numeric|min:0',
    ]);

    $amount   = $request->amount;
    $vatRate  = $request->vat_rate;

    // VAT calculation
    $vatAmount   = $amount * ($vatRate / 100);
    $totalAmount = $amount + $vatAmount;

    // Store in session as one structured array
    session([
        'vat_calculation' => [
            'amount'       => $amount,
            'vat_rate'     => $vatRate,
            'vat_amount'   => $vatAmount,
            'total_amount' => $totalAmount,
        ]
    ]);

    return back();
}
public function downloadPdf()
{
    $vat = session('vat_calculation');

    if (!$vat) {
        return redirect()->route('tax.vat');
    }

    $pdf = Pdf::loadView('pdf.vat-report', [
        'amount'       => $vat['amount'],
        'vat_rate'     => $vat['vat_rate'],
        'vat_amount'   => $vat['vat_amount'],
        'total_amount' => $vat['total_amount'],
    ]);

    return $pdf->download('VAT_Calculation_Report.pdf');
}
}
