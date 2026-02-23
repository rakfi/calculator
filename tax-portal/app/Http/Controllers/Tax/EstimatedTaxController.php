<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstimatedTaxController extends Controller
{
    public function index()
    {
        return view('tax.estimated-tax');
    }

    public function calculate(Request $request)
    {
        $salary = (float) $request->input('salary', 0);
        $businessIncome = (float) $request->input('business_income', 0);
        $rentIncome = (float) $request->input('rent_income', 0);
        $investmentIncome = (float) $request->input('investment_income', 0);
        $otherIncome = (float) $request->input('other_income', 0);

        $annualIncome = ($salary + $businessIncome + $rentIncome + $investmentIncome + $otherIncome) * 12;

        $personalRelief = min((float) $request->input('personal_relief', 0), 1800000);
        $solarRelief = min((float) $request->input('solar_relief', 0), 600000);
        $charityRelief = min((float) $request->input('charity', 0), 75000);
        $govDonation = (float) $request->input('gov_donation', 0);
        $rentRelief = (float) $request->input('rent_relief', 0);

        $totalRelief = $personalRelief + $solarRelief + $charityRelief + $govDonation + $rentRelief;
        $taxableIncome = max(0, $annualIncome - $totalRelief);

        $remaining = $taxableIncome;
        $totalTax = 0;
        $breakdown = [];

        $slabs = [
            ['range' => '0 - 500,000', 'width' => 500000, 'rate' => 6],
            ['range' => '500,001 - 1,000,000', 'width' => 500000, 'rate' => 12],
            ['range' => '1,000,001 - 2,000,000', 'width' => 1000000, 'rate' => 18],
            ['range' => 'Above 2,000,000', 'width' => null, 'rate' => 24],
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
                'range' => $slab['range'],
                'rate' => $slab['rate'],
                'taxable' => $taxableAtRate,
                'tax' => $taxAtRate,
            ];

            $remaining -= $taxableAtRate;
        }

        session([
            'estimated_individual_tax' => [
                'annual_income' => $annualIncome,
                'total_relief' => $totalRelief,
                'taxable_income' => $taxableIncome,
                'total_tax' => $totalTax,
                'breakdown' => $breakdown,
            ],
        ]);

        return redirect()->route('tax.estimated');
    }

    public function calculateBusiness(Request $request)
    {
        $companyProfit = (float) $request->input('company_profit', 0);
        $corpInvestmentIncome = (float) $request->input('corp_investment_income', 0);
        $corpOtherIncome = (float) $request->input('corp_other_income', 0);

        $annualIncome = ($companyProfit + $corpInvestmentIncome + $corpOtherIncome) * 12;
        $totalTax = $annualIncome * 0.30;

        $breakdown = [
            [
                'range' => 'All Taxable Corporate Income',
                'rate' => 30,
                'taxable' => $annualIncome,
                'tax' => $totalTax,
            ],
        ];

        session([
            'estimated_corporate_tax' => [
                'annual_income' => $annualIncome,
                'total_tax' => $totalTax,
                'breakdown' => $breakdown,
            ],
        ]);

        return redirect()->route('tax.estimated');
    }

    public function downloadPdf()
    {
        $data = session('estimated_individual_tax', []);

        $requiredKeys = ['annual_income', 'total_relief', 'taxable_income', 'total_tax'];
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $data)) {
                return redirect()->route('tax.estimated')->with('error', 'Please calculate first.');
            }
        }

        if (empty($data)) {
            return redirect()->route('tax.estimated')->with('error', 'Please calculate first.');
        }

        $pdf = \PDF::loadView('tax.pdf.individual_tax', ['data' => $data]);
        return $pdf->download('estimated-tax-individual.pdf');
    }

    public function downloadCorporatePdf()
    {
        $data = session('estimated_corporate_tax', []);

        $requiredKeys = ['annual_income', 'total_tax'];
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $data)) {
                return redirect()->route('tax.estimated')->with('error', 'Please calculate first.');
            }
        }

        if (empty($data)) {
            return redirect()->route('tax.estimated')->with('error', 'Please calculate first.');
        }

        $pdf = \PDF::loadView('tax.pdf.corporate_tax', ['data' => $data]);
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
