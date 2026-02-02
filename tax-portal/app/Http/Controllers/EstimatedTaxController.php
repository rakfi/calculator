<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstimatedTaxController extends Controller
{
    public function index()
    {
        return view('tax.estimated-tax');
    }

    public function calculate(Request $request)
    {
        $grossIncome =
            $request->employment_income +
            $request->business_income +
            $request->rent_income +
            $request->other_income;

        $reliefs =
            $request->epf +
            $request->insurance +
            $request->medical +
            $request->donations;

        $personalRelief = 1_200_000;

        $taxableIncome = max(0, $grossIncome - $reliefs - $personalRelief);

        // Progressive slabs
        $slabs = [
            [500000, 0.06],
            [500000, 0.12],
            [500000, 0.18],
            [500000, 0.24],
            [PHP_INT_MAX, 0.30],
        ];

        $remaining = $taxableIncome;
        $totalTax = 0;
        $breakdown = [];

        foreach ($slabs as [$limit, $rate]) {
            if ($remaining <= 0) break;

            $taxable = min($remaining, $limit);
            $tax = $taxable * $rate;

            $breakdown[] = [
                'rate' => $rate * 100,
                'taxable' => $taxable,
                'tax' => $tax
            ];

            $totalTax += $tax;
            $remaining -= $taxable;
        }

        return back()->with([
            'gross_income' => $grossIncome,
            'taxable_income' => $taxableIncome,
            'estimated_tax' => $totalTax,
            'breakdown' => $breakdown
        ]);
    }
}
