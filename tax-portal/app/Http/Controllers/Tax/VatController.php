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
        $amount = $request->input('amount');
        $vatRate = 0.15; // 15% VAT in Sri Lanka

        $vat = $amount * $vatRate;
        $total = $amount + $vat;

        session([
            'vat' => [
                'amount' => $amount,
                'vatRate' => $vatRate * 100,
                'vat' => $vat,
                'total' => $total,
            ],
        ]);

        return redirect()->route('tax.vat');
    }

    public function downloadPdf()
    {
        $data = session('vat', []);
        if (empty($data)) {
            return redirect()->route('tax.vat')->with('error', 'Please calculate first.');
        }

        $pdf = \PDF::loadView('tax.pdf.vat', $data);
        return $pdf->download('vat-calculation.pdf');
    }
}
