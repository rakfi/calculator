<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApitBonusController extends Controller
{
    public function index()
    {
        return view('tax.apit.bonus');
    }

    public function calculate(Request $request)
    {
        $monthlySalary = (float) $request->input('monthly_salary', 0);
        $bonus = (float) $request->input('bonus', 0);

        $annualSalary = $monthlySalary * 12;

        $taxWithoutBonus = $this->calculateAnnualTax($annualSalary);
        $taxWithBonus = $this->calculateAnnualTax($annualSalary + $bonus);
        $bonusTax = max(0, $taxWithBonus - $taxWithoutBonus);

        session([
            'apit_bonus' => [
                'annual_salary' => $annualSalary,
                'bonus' => $bonus,
                'tax_without_bonus' => $taxWithoutBonus,
                'tax_with_bonus' => $taxWithBonus,
                'bonus_tax' => $bonusTax,
            ],
        ]);

        return redirect()->route('tax.apit.bonus');
    }

    public function downloadPdf()
    {
        $data = session('apit_bonus', []);
        $requiredKeys = ['annual_salary', 'bonus', 'tax_without_bonus', 'tax_with_bonus', 'bonus_tax'];

        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $data)) {
                return redirect()->route('tax.apit.bonus')->with('error', 'Please calculate first.');
            }
        }

        if (empty($data)) {
            return redirect()->route('tax.apit.bonus')->with('error', 'Please calculate first.');
        }

        $pdf = \PDF::loadView('tax.pdf.apit-bonus', $data);
        return $pdf->download('apit-bonus-tax.pdf');
    }

    private function calculateAnnualTax(float $annualIncome): float
    {
        $taxableIncome = max(0, $annualIncome - 1200000);
        $remaining = $taxableIncome;
        $annualTax = 0;

        $slabs = [
            ['width' => 500000, 'rate' => 6],
            ['width' => 500000, 'rate' => 12],
            ['width' => 1000000, 'rate' => 18],
            ['width' => null, 'rate' => 24],
        ];

        foreach ($slabs as $slab) {
            if ($remaining <= 0) {
                break;
            }

            $taxableAtRate = $slab['width'] === null
                ? $remaining
                : min($remaining, $slab['width']);

            $annualTax += $taxableAtRate * ($slab['rate'] / 100);
            $remaining -= $taxableAtRate;
        }

        return $annualTax;
    }
}
