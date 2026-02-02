<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ApitSalaryController extends Controller
{
    public function index()
    {
        return view('tax.apit.salary');
    }

    public function calculate(Request $request)
    {
        $monthlyIncome = $request->monthly_income;
        $annualIncome  = $monthlyIncome * 12;

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
        $breakdown = [];

        foreach ($slabs as [$limit, $rate]) {
            if ($remaining <= 0) break;

            $taxable = min($remaining, $limit);
            $taxAmount = ($taxable * $rate) / 100;

            $breakdown[] = [
                'rate' => $rate,
                'taxable' => $taxable,
                'tax' => $taxAmount,
            ];

            $tax += $taxAmount;
            $remaining -= $taxable;
        }

        return back()->with([
            'monthly_income' => $monthlyIncome,
            'annual_income' => $annualIncome,
            'annual_tax' => $tax,
            'monthly_tax' => $tax / 12,
            'breakdown' => $breakdown,
        ]);
    }
    public function downloadPdf()
    {
        $data = session()->all();

        if (!isset($data['annual_income'])) {
            return redirect()->route('tax.apit.salary');
        }

        $pdf = Pdf::loadView('pdf.apit-salary', [
            'monthly_income' => $data['monthly_income'],
            'annual_income'  => $data['annual_income'],
            'annual_tax'     => $data['annual_tax'],
            'monthly_tax'    => $data['monthly_tax'],
            'breakdown'      => $data['breakdown'],
        ]);

        return $pdf->download('APIT_Salary_Tax_Report_2025_26.pdf');
    }

}
