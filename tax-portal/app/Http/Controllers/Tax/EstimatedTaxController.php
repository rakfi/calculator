<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstimatedTaxController extends Controller
{
    public function index()
    {
        return view('tax.estimated');
    }

    public function calculate(Request $request)
    {
        $income = $request->input('income');

        $tax = $income > 1000000 ? ($income - 1000000) * 0.15 : 0;
        $netIncome = $income - $tax;

        session([
            'estimated_individual' => [
                'income' => $income,
                'tax' => $tax,
                'netIncome' => $netIncome,
            ],
        ]);

        return redirect()->route('tax.estimated');
    }

    public function calculateBusiness(Request $request)
    {
        $revenue = $request->input('revenue');
        $expenses = $request->input('expenses', 0);

        $profit = $revenue - $expenses;
        $tax = $profit > 1000000 ? ($profit - 1000000) * 0.22 : 0;
        $netProfit = $profit - $tax;

        session([
            'estimated_corporate' => [
                'revenue' => $revenue,
                'expenses' => $expenses,
                'profit' => $profit,
                'tax' => $tax,
                'netProfit' => $netProfit,
            ],
        ]);

        return redirect()->route('tax.estimated');
    }

    public function downloadPdf()
    {
        $data = session('estimated_individual', []);
        if (empty($data)) {
            return redirect()->route('tax.estimated')->with('error', 'Please calculate first.');
        }

        $pdf = \PDF::loadView('tax.pdf.estimated-individual', $data);
        return $pdf->download('estimated-tax-individual.pdf');
    }

    public function downloadCorporatePdf()
    {
        $data = session('estimated_corporate', []);
        if (empty($data)) {
            return redirect()->route('tax.estimated')->with('error', 'Please calculate first.');
        }

        $pdf = \PDF::loadView('tax.pdf.estimated-corporate', $data);
        return $pdf->download('estimated-tax-corporate.pdf');
    }

    public function editRates()
    {
        $slabs = [
            (object)['id' => 1, 'min_income' => 0, 'max_income' => 1000000, 'rate' => 0],
            (object)['id' => 2, 'min_income' => 1000001, 'max_income' => null, 'rate' => 15],
        ];
        $corporateRates = [
            (object)['id' => 1, 'rate' => 22],
        ];
        return view('admin.calculators.estimated_tax', ['slabs' => $slabs, 'corporateRates' => $corporateRates]);
    }

    public function updateRates(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Rates updated');
    }

    public function updateCorporateRates(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Corporate rates updated');
    }
}
