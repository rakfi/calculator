<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonalTaxController extends Controller
{
    public function index()
    {
        return view('tax.personal');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'annual_income' => 'required|numeric|min:0'
        ]);

        $annualIncome = $request->annual_income;

        // Tax-free allowance
        $taxFree = 1200000;

        if ($annualIncome <= $taxFree) {
            return back()->with([
                'tax' => 0,
                'taxable_income' => 0,
                'annual_income' => $annualIncome
            ]);
        }

        $taxableIncome = $annualIncome - $taxFree;
        $tax = 0;

        $slabs = [
            500000 => 0.06,
            500000 => 0.12,
            500000 => 0.18,
            500000 => 0.24,
            PHP_INT_MAX => 0.30
        ];

        foreach ($slabs as $limit => $rate) {
            if ($taxableIncome <= 0) break;

            $amount = min($taxableIncome, $limit);
            $tax += $amount * $rate;
            $taxableIncome -= $amount;
        }

        return back()->with([
            'tax' => round($tax, 2),
            'taxable_income' => $annualIncome - $taxFree,
            'annual_income' => $annualIncome
        ]);
    }
}
