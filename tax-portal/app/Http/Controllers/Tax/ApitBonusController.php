<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApitBonusController extends Controller
{
    public function index()
    {
        return view('tax.apit.bonus');
    }

    public function calculate(Request $request)
    {
        $bonusAmount = $request->input('bonus_amount');

        // Fixed tax rate for bonus in Sri Lanka
        $taxRate = 0.10; // 10% standard bonus tax
        $tax = $bonusAmount * $taxRate;
        $netBonus = $bonusAmount - $tax;

        session([
            'apit_bonus' => [
                'bonusAmount' => $bonusAmount,
                'taxRate' => $taxRate * 100,
                'tax' => $tax,
                'netBonus' => $netBonus,
            ],
        ]);

        return redirect()->route('tax.apit.bonus');
    }

    public function downloadPdf()
    {
        $data = session('apit_bonus', []);
        if (empty($data)) {
            return redirect()->route('tax.apit.bonus')->with('error', 'Please calculate first.');
        }

        $pdf = \PDF::loadView('tax.pdf.apit-bonus', $data);
        return $pdf->download('apit-bonus-tax.pdf');
    }
}
