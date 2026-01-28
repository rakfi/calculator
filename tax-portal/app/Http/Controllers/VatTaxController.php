<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VatTaxController extends Controller
{
    public function index()
    {
        return view('tax.vat');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'vat_type' => 'required|in:exclusive,inclusive',
        ]);

        $rate = 18;
        $amount = $request->amount;

        if ($request->vat_type === 'exclusive') {
            // Add VAT
            $vat = $amount * ($rate / 100);
            $net = $amount;
            $total = $amount + $vat;
        } else {
            // Extract VAT
            $vat = $amount * ($rate / (100 + $rate));
            $total = $amount;
            $net = $amount - $vat;
        }

        return back()->with([
            'amount' => $amount,
            'net'    => round($net, 2),
            'vat'    => round($vat, 2),
            'total'  => round($total, 2),
            'rate'   => $rate,
            'vat_type' => $request->vat_type
        ]);
    }
}
