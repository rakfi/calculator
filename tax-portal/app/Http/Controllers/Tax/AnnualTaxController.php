<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnualTaxController extends Controller
{
    public function annualTax()
    {
        return view('tax.annual');
    }

    public function annualTaxCalculate(Request $request)
    {
        $annualIncome = $request->input('annual_income');
        $deductions = $request->input('deductions', 0);

        $taxableIncome = $annualIncome - $deductions - 1500000; // Tax exemption

        if ($taxableIncome <= 0) {
            $tax = 0;
        } else {
            // Progressive rates for annual tax
            if ($taxableIncome <= 1000000) {
                $tax = $taxableIncome * 0.08;
            } elseif ($taxableIncome <= 2000000) {
                $tax = (1000000 * 0.08) + (($taxableIncome - 1000000) * 0.14);
            } else {
                $tax = (1000000 * 0.08) + (1000000 * 0.14) + (($taxableIncome - 2000000) * 0.20);
            }
        }

        $netIncome = $annualIncome - $deductions - $tax;

        session([
            'annual_tax' => [
                'annualIncome' => $annualIncome,
                'deductions' => $deductions,
                'taxableIncome' => max(0, $taxableIncome),
                'tax' => $tax,
                'netIncome' => $netIncome,
            ],
        ]);

        return redirect()->route('tax.annual');
    }

    public function downloadPdf()
    {
        $data = session('annual_tax', []);
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
