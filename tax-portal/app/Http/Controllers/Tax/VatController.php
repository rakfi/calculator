<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VatController extends Controller
{
    public function index()
    {
        return view('tax.vat');
    }

    public function calculate(Request $request)
    {
        $amount = (float) $request->input('amount', 0);
        $vatRate = (float) $request->input('vat_rate', 15);

        $vatAmount = $amount * ($vatRate / 100);
        $totalAmount = $amount + $vatAmount;

        session([
            'vat_calculation' => [
                'amount' => $amount,
                'vat_rate' => $vatRate,
                'vat_amount' => $vatAmount,
                'total_amount' => $totalAmount,
            ],
        ]);

        return redirect()->route('tax.vat');
    }

    public function downloadPdf()
    {
        $data = session('vat_calculation', []);

        $requiredKeys = ['amount', 'vat_rate', 'vat_amount', 'total_amount'];
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $data)) {
                return redirect()->route('tax.vat')->with('error', 'Please calculate first.');
            }
        }

        if (empty($data)) {
            return redirect()->route('tax.vat')->with('error', 'Please calculate first.');
        }

        $pdf = \PDF::loadView('tax.pdf.vat-report', $data);
        return $pdf->download('vat-calculation.pdf');
    }
}
