<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'amount' => 'required|numeric|min:0',
            'vat_rate' => 'required|numeric|min:0',
        ]);

        $amount = $request->amount;
        $vatRate = $request->vat_rate;

        // VAT calculation
        $vatAmount = $amount * ($vatRate / 100);
        $totalAmount = $amount + $vatAmount;

        return back()->with([
            'amount' => $amount,
            'vat_rate' => $vatRate,
            'vat_amount' => $vatAmount,
            'total_amount' => $totalAmount,
        ]);
    }
}
