<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ApitSalaryController extends Controller
{
    public function index()
    {
        return view('tax.apit.salary');
    }
public function editRates()
{
    $slabs = DB::table('apit_salary')
        ->orderBy('id')
        ->get();

    return view('admin.calculators.regular_salary', compact('slabs'));
}

public function updateRates(Request $request, $id)
{
    $request->validate([
        'percentage' => 'required|numeric|min:0|max:100',
    ]);

    DB::table('apit_salary')
        ->where('id', $id)
        ->update([
            'percentage' => $request->percentage,
        ]);

    return back()->with('success', 'Tax rate updated successfully');
}
    public function calculate(Request $request)
{
    $monthlyIncome = (float) $request->monthly_income;
    $annualIncome  = $monthlyIncome * 12;

    $slabs = DB::table('apit_salary')
        ->orderBy('id')
        ->get();

    $remaining = $annualIncome;
    $tax = 0;
    $breakdown = [];

    foreach ($slabs as $slab) {

        if ($remaining <= 0) {
            break;
        }

        // NULL = unlimited slab
        $taxable = is_null($slab->limit)
            ? $remaining
            : min($remaining, (float) $slab->limit
        );

        $taxAmount = ($taxable * $slab->percentage) / 100;

        $breakdown[] = [
            'rate'    => $slab->percentage,
            'taxable'=> $taxable,
            'tax'     => $taxAmount,
        ];

        $tax += $taxAmount;
        $remaining -= $taxable;
    }

    session([
        'apit_salary' => [
            'monthly_income' => $monthlyIncome,
            'annual_income'  => $annualIncome,
            'annual_tax'     => round($tax, 2),
            'monthly_tax'    => round($tax / 12, 2),
            'breakdown'      => $breakdown,
        ]
    ]);

    return back();
}

    public function downloadPdf()
{
    $apitSalary = session('apit_salary');

    if (!$apitSalary) {
        return redirect()->route('tax.apit.salary');
    }

    $pdf = Pdf::loadView('pdf.apit-salary', [
        'monthly_income' => $apitSalary['monthly_income'],
        'annual_income'  => $apitSalary['annual_income'],
        'annual_tax'     => $apitSalary['annual_tax'],
        'monthly_tax'    => $apitSalary['monthly_tax'],
        'breakdown'      => $apitSalary['breakdown'],
    ]);

    return $pdf->download('APIT_Salary_Tax_Report_2025_26.pdf');
}


}
