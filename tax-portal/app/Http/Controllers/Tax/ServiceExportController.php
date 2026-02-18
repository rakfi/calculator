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
        $serviceValue = $request->input('service_value');
        $withholdingRate = $request->input('withholding_rate', 0.05); // Default 5%

        $withholding = $serviceValue * $withholding_rate;
        $netAmount = $serviceValue - $withholding;

        session([
            'service_export' => [
                'serviceValue' => $serviceValue,
                'withholdingRate' => $withholdingRate * 100,
                'withholding' => $withholding,
                'netAmount' => $netAmount,
            ],
        ]);

        return redirect()->route('tax.service.exporter');
    }

    public function downloadPdf()
    {
        $data = session('service_export', []);
        if (empty($data)) {
            return redirect()->route('tax.service.exporter')->with('error', 'Please calculate first.');
        }

        $pdf = \PDF::loadView('tax.pdf.service-exporter', $data);
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
