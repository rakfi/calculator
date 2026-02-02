<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function annualTax()
{
    return view('tax.annual-tax');
}

public function annualTaxCalculate(Request $request)
{
    $annualIncome = $request->annual_income;

    $remaining = $annualIncome - 1200000;
    $tax = 0;
    $breakdown = [];

    $slabs = [
        [500000, 6],
        [500000, 12],
        [500000, 18],
        [500000, 24],
        [500000, 30],
        [PHP_INT_MAX, 36],
    ];

    foreach ($slabs as [$limit, $rate]) {
        if ($remaining <= 0) break;

        $taxable = min($remaining, $limit);
        $taxAmount = $taxable * ($rate / 100);

        $breakdown[] = [
            'rate' => $rate,
            'taxable' => $taxable,
            'tax' => $taxAmount,
        ];

        $tax += $taxAmount;
        $remaining -= $taxable;
    }

    return back()->with([
        'annual_income' => $annualIncome,
        'annual_tax' => $tax,
        'breakdown' => $breakdown,
    ]);
}

}
