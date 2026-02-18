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
        $grossSalary = $request->input('gross_salary');
        $allowance = $request->input('allowance', 0);

        $totalIncome = $grossSalary + $allowance;
        $taxableIncome = $totalIncome - 1000000; // Tax exemption threshold

        if ($taxableIncome <= 0) {
            $tax = 0;
        } else {
            // Sri Lankan APIT (for salary): Progressive tax rates
            if ($taxableIncome <= 500000) {
                $tax = $taxableIncome * 0.06;
            } elseif ($taxableIncome <= 1000000) {
                $tax = (500000 * 0.06) + (($taxableIncome - 500000) * 0.12);
            } elseif ($taxableIncome <= 2000000) {
                $tax = (500000 * 0.06) + (500000 * 0.12) + (($taxableIncome - 1000000) * 0.18);
            } else {
                $tax = (500000 * 0.06) + (500000 * 0.12) + (1000000 * 0.18) + (($taxableIncome - 2000000) * 0.24);
            }
        }

        $netIncome = $totalIncome - $tax;

        session([
            'apit_salary' => [
                'grossSalary' => $grossSalary,
                'allowance' => $allowance,
                'totalIncome' => $totalIncome,
                'tax' => $tax,
                'netIncome' => $netIncome,
                'taxableIncome' => max(0, $taxableIncome),
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
