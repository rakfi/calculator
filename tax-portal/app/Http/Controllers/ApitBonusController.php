<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApitBonusController extends Controller
{
    public function index()
    {
        return view('tax.apit.bonus');
    }

    private function annualTax($annualIncome)
    {
        $slabs = [
            [1200000, 0],
            [500000, 6],
            [500000, 12],
            [500000, 18],
            [500000, 24],
            [INF, 30],
        ];

        $remaining = $annualIncome;
        $tax = 0;

        foreach ($slabs as [$limit, $rate]) {
            if ($remaining <= 0) break;

            $taxable = min($remaining, $limit);
            $tax += ($taxable * $rate) / 100;
            $remaining -= $taxable;
        }

        return $tax;
    }

    public function calculate(Request $request)
    {
        $monthlySalary = $request->monthly_salary;
        $bonus = $request->bonus;

        $annualSalary = $monthlySalary * 12;

        $taxWithoutBonus = $this->annualTax($annualSalary);
        $taxWithBonus    = $this->annualTax($annualSalary + $bonus);

        $bonusTax = $taxWithBonus - $taxWithoutBonus;

        return back()->with([
            'annual_salary' => $annualSalary,
            'bonus' => $bonus,
            'tax_without_bonus' => $taxWithoutBonus,
            'tax_with_bonus' => $taxWithBonus,
            'bonus_tax' => max($bonusTax, 0),
        ]);
    }
}
