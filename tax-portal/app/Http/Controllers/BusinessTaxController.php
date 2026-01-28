<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessTaxController extends Controller
{
    public function index()
    {
        return view('tax.business');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'annual_profit' => 'required|numeric|min:0',
        ]);

        $profit = $request->annual_profit;
        $rate = 30; // Standard Sri Lanka business tax rate

        $tax = $profit * ($rate / 100);

        return back()->with([
            'annual_profit' => $profit,
            'tax_rate'      => $rate,
            'tax'           => round($tax, 2),
        ]);
    }
}
