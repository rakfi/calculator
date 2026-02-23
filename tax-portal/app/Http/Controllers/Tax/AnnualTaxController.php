<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnualTaxController extends Controller
{
    public function annualTax()
    {
        return view('tax.annual-tax');
    }

    public function annualTaxCalculate(Request $request)
    {
        $annualIncome = (float) $request->input('annual_income', 0);
        $deductions = (float) $request->input('deductions', 0);

        $taxableIncome = max(0, $annualIncome - $deductions - 1500000); // Tax exemption
        $remaining = $taxableIncome;
        $totalTax = 0;
        $breakdown = [];

        $slabs = [
            ['width' => 1000000, 'rate' => 8],
            ['width' => 1000000, 'rate' => 14],
            ['width' => null, 'rate' => 20],
        ];

        foreach ($slabs as $slab) {
            if ($remaining <= 0) {
                break;
            }

            $taxableAtRate = $slab['width'] === null
                ? $remaining
                : min($remaining, $slab['width']);

            $taxAtRate = $taxableAtRate * ($slab['rate'] / 100);
            $totalTax += $taxAtRate;

            $breakdown[] = [
                'rate' => $slab['rate'],
                'taxable' => $taxableAtRate,
                'tax' => $taxAtRate,
            ];

            $remaining -= $taxableAtRate;
        }

        session([
            'annual_tax' => [
                'annual_income' => $annualIncome,
                'total_tax' => $totalTax,
                'breakdown' => $breakdown,
            ],
        ]);

        return redirect()->route('tax.annual');
    }

    public function downloadPdf()
    {
        $data = session('annual_tax', []);

        $requiredKeys = ['annual_income', 'total_tax', 'breakdown'];
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $data)) {
                return redirect()->route('tax.annual')->with('error', 'Please calculate first.');
            }
        }

        if (empty($data)) {
            return redirect()->route('tax.annual')->with('error', 'Please calculate first.');
        }

        $pdf = \PDF::loadView('tax.pdf.annual-tax', $data);
        return $pdf->download('annual-tax.pdf');
    }

    public function editRates()
    {
        $slabs = [
            (object)['id' => 1, 'min_income' => 0, 'max_income' => 1000000, 'percentage' => 8, 'deduction' => 0],
            (object)['id' => 2, 'min_income' => 1000001, 'max_income' => 2000000, 'percentage' => 14, 'deduction' => 80000],
            (object)['id' => 3, 'min_income' => 2000001, 'max_income' => null, 'percentage' => 20, 'deduction' => 240000],
        ];
        return view('admin.calculators.annual_income', ['slabs' => $slabs]);
    }

    public function updateRates(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Rates updated');
    }
}
