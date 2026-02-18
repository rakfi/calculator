<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
class ApitBonusController extends Controller
{
    public function index()
    {
        return view('tax.apit.bonus');
    }

    private function annualTax($annualIncome)
    {
         $slabs = DB::table('apit_salary')
        ->orderBy('id')
        ->get();
       

        $remaining = $annualIncome;
        $tax = 0;

        foreach ($slabs as $slab) {
            if ($remaining <= 0) break;
    // NULL = unlimited slab
        $taxable = is_null($slab->limit)
            ? $remaining
            : min($remaining, (float) $slab->limit
        );
            $tax += ($taxable * $slab->percentage) / 100;
            $remaining -= $taxable;
            $taxable = min($remaining, $slab->limit);
        }

        return $tax;
    }

    public function calculate(Request $request)
    {
        $monthlySalary = $request->monthly_salary;
        $bonus = $request->bonus;

        $annualSalary = $monthlySalary * 12;

        $taxWithoutBonus = $this->annualTax($annualSalary);
        $taxWithBonus    = $this->annualTax($annualSalary + $bonus);

        $bonusTax = $taxWithBonus - $taxWithoutBonus;

        session([
            'apit_bonus' => [
                'annual_salary'     => $annualSalary,
                'bonus'             => $bonus,
                'tax_without_bonus' => $taxWithoutBonus,
                'tax_with_bonus'    => $taxWithBonus,
                'bonus_tax'         => $bonusTax,
            ]
        ]);
        return back();
    }
    public function downloadPdf()
{
    $apitBonus = session('apit_bonus');

    if (!$apitBonus) {
        return redirect()->route('tax.apit.bonus');
    }

    $pdf = Pdf::loadView('pdf.apit-bonus', [
        'annual_salary'     => $apitBonus['annual_salary'],
        'bonus'             => $apitBonus['bonus'],
        'tax_without_bonus' => $apitBonus['tax_without_bonus'],
        'tax_with_bonus'    => $apitBonus['tax_with_bonus'],
        'bonus_tax'         => $apitBonus['bonus_tax'],
    ]);

    return $pdf->download('APIT_Bonus_Tax_Report_2025_26.pdf');
}

}
