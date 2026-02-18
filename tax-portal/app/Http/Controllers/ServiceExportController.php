<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\DB;

class ServiceExportController extends Controller
{
    /**
     * Show Individual Service Exporter calculator page
     */
    public function index()
    {
        return view('tax.service-exporter');
    }
public function editRates()
{
    $slabs = DB::table('export_income_tax_slabs')
        ->orderByRaw('income_limit IS NULL, income_limit ASC')
        ->get();

    return view('admin.calculators.service_export', compact('slabs'));
}

public function updateRates(Request $request, $id)
{
    
    $request->validate([
        'percentage' => 'required|numeric|min:0|max:100',
    ]);

    DB::table('export_income_tax_slabs')
        ->where('id', $id)
        ->update([
            'percentage' => $request->percentage,
        ]);

    return back()->with('success', 'Service export tax rate updated successfully');
}
    /**
     * Calculate Individual Service Exporter tax
     */
    public function calculate(Request $request)
    {
        $request->validate([
        'monthly_usd'     => 'required|numeric|min:0',
        'conversion_rate' => 'required|numeric|min:0'
    ]);

    $monthlyUsd = (float) $request->monthly_usd;
    $rate       = (float) $request->conversion_rate;

    // 🔹 Convert USD → LKR
    $monthlyLkr  = $monthlyUsd * $rate;
    $annualGross = $monthlyLkr * 12;

    $remaining = $annualGross;
    $previousLimit = 0;
    $totalTax = 0;
    $breakdown = [];

    $slabs = DB::table('export_income_tax_slabs')
            ->orderByRaw('income_limit IS NULL, income_limit ASC')
            ->get();


    foreach ($slabs as $slab) {

        if ($remaining <= 0) break;

        if (is_null($slab->income_limit)) {
            $taxable = $remaining;
            $rangeText = "Above LKR " . number_format($previousLimit);
        } else {
            $rangeAmount = $slab->income_limit - $previousLimit;
            $taxable = min($remaining, $rangeAmount);

            $rangeText = "Up to LKR " . number_format($slab->income_limit);
        }

        $tax = round($taxable * ($slab->percentage / 100), 2);

        $breakdown[] = [
            'range'    => $rangeText,
            'rate'     => $slab->percentage,
            'taxable'  => $taxable,
            'tax'      => $tax,
        ];

        $totalTax += $tax;
        $remaining -= $taxable;
        $previousLimit = $slab->income_limit ?? $previousLimit;
    }

    session([
        'service_export' => [
            'monthly_usd'  => round($monthlyUsd, 2),
            'rate'         => round($rate, 2),
            'monthly_lkr'  => round($monthlyLkr, 2),
            'annual_lkr'   => round($annualGross, 2),
            'tax'          => round($totalTax, 2),
            'breakdown'    => $breakdown
        ]
    ]);

    return back();
    }

    public function downloadPdf()
    {

         $data = session('service_export');
  
        $pdf = Pdf::loadView(
            'pdf.service_exporter',
            compact('data')
        );

        return $pdf->download(
            'Individual_Service_Exporter_Tax_Calculation.pdf'
        );
    }
}
