<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceExportController extends Controller
{
    public function index()
    {
        return view('tax.service-exporter');
    }

    public function calculate(Request $request)
    {
        $monthlyUsd = (float) $request->input('monthly_usd', 0);
        $rate = (float) $request->input('conversion_rate', 0);

        $monthlyLkr = $monthlyUsd * $rate;
        $annualLkr = $monthlyLkr * 12;

        $remaining = $annualLkr;
        $tax = 0;
        $breakdown = [];

        $slabs = [
            ['range' => '0 - 500,000', 'width' => 500000, 'rate' => 5],
            ['range' => '500,001 - 1,000,000', 'width' => 500000, 'rate' => 10],
            ['range' => 'Above 1,000,000', 'width' => null, 'rate' => 5],
        ];

        foreach ($slabs as $slab) {
            if ($remaining <= 0) {
                break;
            }

            $taxableAtRate = $slab['width'] === null
                ? $remaining
                : min($remaining, $slab['width']);

            $taxAtRate = $taxableAtRate * ($slab['rate'] / 100);
            $tax += $taxAtRate;

            $breakdown[] = [
                'range' => $slab['range'],
                'rate' => $slab['rate'],
                'taxable' => $taxableAtRate,
                'tax' => $taxAtRate,
            ];

            $remaining -= $taxableAtRate;
        }

        session([
            'service_export' => [
                'monthly_usd' => $monthlyUsd,
                'rate' => $rate,
                'monthly_lkr' => $monthlyLkr,
                'annual_lkr' => $annualLkr,
                'tax' => $tax,
                'breakdown' => $breakdown,
            ],
        ]);

        return redirect()->route('tax.service.exporter');
    }

    public function downloadPdf()
    {
        $data = session('service_export', []);

        $requiredKeys = ['monthly_usd', 'rate', 'monthly_lkr', 'annual_lkr', 'tax', 'breakdown'];
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $data)) {
                return redirect()->route('tax.service.exporter')->with('error', 'Please calculate first.');
            }
        }

        if (empty($data)) {
            return redirect()->route('tax.service.exporter')->with('error', 'Please calculate first.');
        }

        $pdf = \PDF::loadView('tax.pdf.service_exporter', ['data' => $data]);
        return $pdf->download('service-exporter.pdf');
    }

    public function editRates()
    {
        $slabs = [
            (object)['id' => 1, 'income_limit' => 500000, 'percentage' => 5],
            (object)['id' => 2, 'income_limit' => 1000000, 'percentage' => 10],
            (object)['id' => 3, 'income_limit' => null, 'percentage' => 5],
        ];
        return view('admin.calculators.service_export', ['slabs' => $slabs]);
    }

    public function updateRates(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Rates updated');
    }
}
