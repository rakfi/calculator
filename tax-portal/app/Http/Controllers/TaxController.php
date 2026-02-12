<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TaxController extends Controller
{
    public function annualTax()
{
    return view('tax.annual-tax');
}
 // Show admin edit screen
    public function editRates()
    {
        $slabs = DB::table('annual_income_tax')
            ->orderBy('min_income')
            ->get();

        return view('admin.calculators.annual_income', compact('slabs'));
    }

    // Update ONLY percentage & deduction
    public function updateRates(Request $request, $id)
    {
        $request->validate([
            'percentage' => 'required|numeric|min:0|max:100',
            'deduction'  => 'required|numeric|min:0',
        ]);

        DB::table('annual_income_tax')
            ->where('id', $id)
            ->update([
                'percentage' => $request->percentage,
                'deduction'  => $request->deduction,
            ]);

        return back()->with('success', 'Tax rate updated successfully');
    }
public function annualTaxCalculate(Request $request)
{
    $annualIncome = (float) $request->annual_income;

    $slabs = DB::table('annual_income_tax')
        ->orderBy('min_income')
        ->get();

    $remaining = $annualIncome;
    $totalTax = 0;
    $breakdown = [];

    foreach ($slabs as $slab) {

        if ($remaining <= 0) {
            break;
        }

        // ✅ Correct slab width (NO +1)
        if (is_null($slab->max_income)) {
            $slabAmount = $remaining;
        } else {
            $slabAmount = min(
                $remaining,
                $slab->max_income - $slab->min_income
            );
        }

        // ✅ Calculate & round slab tax
        $tax = round(($slabAmount * $slab->percentage) / 100, 2);

        $breakdown[] = [
            'range' => is_null($slab->max_income)
                ? 'Above ' . number_format($slab->min_income)
                : number_format($slab->min_income) . ' - ' . number_format($slab->max_income),
            'rate'    => $slab->percentage,
            'taxable'=> round($slabAmount, 2),
            'tax'     => $tax,
        ];

        $totalTax += $tax;
        $remaining -= $slabAmount;
    }

    session([
        'annual_tax' => [
            'annual_income' => round($annualIncome, 2),
            'total_tax'     => round($totalTax, 2),
            'breakdown'     => $breakdown,
        ]
    ]);

    return back();
}

}
