<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ServiceExportController extends Controller
{
    /**
     * Show Individual Service Exporter calculator page
     */
    public function index()
    {
        return view('tax.service-exporter');
    }

    /**
     * Calculate Individual Service Exporter tax
     */
    public function calculate(Request $request)
    {
        $request->validate([
            'export_income' => 'required|numeric|min:0',
            'expenses' => 'nullable|numeric|min:0',
        ]);

        $gross = $request->export_income;
        $expenses = $request->expenses ?? 0;

        $netIncome = max(0, $gross - $expenses);

        // Preferential tax rate for Service Exporters (example: 15%)
        $taxRate = 0.15;
        $tax = $netIncome * $taxRate;
        session([
            'service_export' => [
                'gross_income' => $gross,
                'expenses' => $expenses,
                'net_income' => $netIncome,
                'tax' => $tax,
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
