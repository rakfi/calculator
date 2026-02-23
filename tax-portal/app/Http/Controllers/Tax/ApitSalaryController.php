<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApitSalaryController extends Controller
{
    public function index()
    {
        return view('tax.apit.salary');
    }

    public function calculate(Request $request)
    {
        $monthlyIncome = (float) $request->input('monthly_income', 0);
        $annualIncome = $monthlyIncome * 12;
        $taxableIncome = max(0, $annualIncome - 1200000); // Annual exemption threshold

        $remaining = $taxableIncome;
        $annualTax = 0;
        $breakdown = [];

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

            $taxAtRate = $taxableAtRate * ($slab['rate'] / 100);
            $annualTax += $taxAtRate;

            $breakdown[] = [
                'rate' => $slab['rate'],
                'taxable' => $taxableAtRate,
                'tax' => $taxAtRate,
            ];

            $remaining -= $taxableAtRate;
        }

        session([
            'apit_salary' => [
                'monthly_income' => $monthlyIncome,
                'annual_income' => $annualIncome,
                'annual_tax' => $annualTax,
                'monthly_tax' => $annualTax / 12,
                'breakdown' => $breakdown,
            ],
        ]);

        return redirect()->route('tax.apit.salary');
    }

    public function downloadPdf()
    {
        $data = session('apit_salary', []);
        if (empty($data)) {
            return redirect()->route('tax.apit.salary')->with('error', 'Please calculate first.');
        }

        $pdf = \PDF::loadView('tax.pdf.apit-salary', $data);
        return $pdf->download('apit-salary-tax.pdf');
    }

    public function editRates()
    {
        // Placeholder for settings edit
        $slabs = [
            (object)['id' => 1, 'limit' => 500000, 'percentage' => 6],
            (object)['id' => 2, 'limit' => 1000000, 'percentage' => 12],
            (object)['id' => 3, 'limit' => 2000000, 'percentage' => 18],
            (object)['id' => 4, 'limit' => null, 'percentage' => 24],
        ];
        return view('admin.calculators.regular_salary', ['slabs' => $slabs]);
    }

    public function updateRates(Request $request, $id)
    {
        // Placeholder for settings update
        return redirect()->back()->with('success', 'Rates updated');
    }
}
