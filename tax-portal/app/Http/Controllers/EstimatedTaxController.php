<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
class EstimatedTaxController extends Controller
{
    public function index()
    {
        return view('tax.estimated-tax');
    }
public function editRates()
    {
        // Get all individual tax slabs
        $slabs = DB::table('individual_tax_slabs')
            ->orderBy('min_income')
            ->get();

        // Get corporate tax rate (assuming only one row for simplicity)
        $corporateRates = DB::table('corporate_tax_rates')->get();

        return view('admin.calculators.estimated_tax', compact('slabs', 'corporateRates'));
    }

    /**
     * Update individual tax slab percentage
     */
     public function updateRates(Request $request, $id)
    {
        $request->validate([
            'rate' => 'required|numeric|min:0|max:100',
        ]);

        DB::table('individual_tax_slabs')
            ->where('id', $id)
            ->update([
                'rate' => $request->rate,
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Individual tax slab updated successfully!');
    }

    // =========================
    // Update Corporate Tax Rate
    // =========================
    public function updateCorporateRates(Request $request, $id)
    {
        $request->validate([
            'rate' => 'required|numeric|min:0|max:100',
        ]);

        DB::table('corporate_tax_rates')
            ->where('id', $id)
            ->update([
                'rate' => $request->rate,
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Corporate tax rate updated successfully!');
    }
    public function calculate(Request $request)
{
    // =========================
    // 1️⃣ Calculate Annual Income
    // =========================
    $annualIncome =
        ($request->salary ?? 0) * 12 +
        ($request->business_income ?? 0) * 12 +
        ($request->rent_income ?? 0) * 12 +
        ($request->investment_income ?? 0) * 12 +
        ($request->other_income ?? 0) * 12;

    // =========================
    // 2️⃣ Relief (With Limits)
    // =========================
    $personalRelief = min($request->personal_relief ?? 0, 1800000);
    $solarRelief    = min($request->solar_relief ?? 0, 600000);
    $charity        = min($request->charity ?? 0, 75000);
    $govDonation    = $request->gov_donation ?? 0;
    $rentRelief     = $request->rent_relief ?? 0;

    $totalRelief =
        $personalRelief +
        $solarRelief +
        $charity +
        $govDonation +
        $rentRelief;

    $taxableIncome = max($annualIncome - $totalRelief, 0);

    // =========================
    // 3️⃣ Get Slabs From individual_tax_slabs
    // =========================
    $slabs = DB::table('individual_tax_slabs')
        ->orderBy('min_income')
        ->get();

    $remaining = $taxableIncome;
    $totalTax = 0;
    $breakdown = [];

    foreach ($slabs as $slab) {

        if ($remaining <= 0) {
            break;
        }

        // Correct slab width
        if (is_null($slab->max_income)) {
            $slabAmount = $remaining;
        } else {
            $slabWidth = $slab->max_income - $slab->min_income;
            $slabAmount = min($remaining, $slabWidth);
        }

        $tax = round(($slabAmount * $slab->rate) / 100, 2);

        $breakdown[] = [
            'range' => is_null($slab->max_income)
                ? 'Above ' . number_format($slab->min_income)
                : number_format($slab->min_income) . ' - ' . number_format($slab->max_income),
            'rate'     => $slab->rate,
            'taxable'  => round($slabAmount, 2),
            'tax'      => $tax,
        ];

        $totalTax += $tax;
        $remaining -= $slabAmount;
    }

    // =========================
    // 4️⃣ Store In Session (LIKE YOUR SAMPLE)
    // =========================
    session([
        'estimated_individual_tax' => [
            'annual_income'  => round($annualIncome, 2),
            'total_relief'   => round($totalRelief, 2),
            'taxable_income' => round($taxableIncome, 2),
            'total_tax'      => round($totalTax, 2),
            'breakdown'      => $breakdown,
        ]
    ]);

    return back();
}
public function calculateBusiness(Request $request)
{
    // =========================
    // 1️⃣ Calculate Annual Income
    // =========================
    $annualIncome =
        ($request->company_profit ?? 0) * 12 +
        ($request->corp_investment_income ?? 0) * 12 +
        ($request->corp_other_income ?? 0) * 12;

    // =========================
    // 2️⃣ Get Latest Corporate Tax Rate from DB
    // =========================
    $rateRecord = DB::table('corporate_tax_rates')
        ->orderByDesc('effective_from')
        ->first();

    // Default rate if none found
    $rate = $rateRecord ? $rateRecord->rate : 30;

    // =========================
    // 3️⃣ Calculate Total Tax
    // =========================
    $totalTax = round(($annualIncome * $rate) / 100, 2);

    // =========================
    // 4️⃣ Breakdown (Like Individual Tax)
    // =========================
    $breakdown = [
        [
            'range'   => 'Total Corporate Income',
            'rate'    => $rate,
            'taxable' => round($annualIncome, 2),
            'tax'     => $totalTax,
        ]
    ];

    // =========================
    // 5️⃣ Store In Session
    // =========================
    session([
        'estimated_corporate_tax' => [
            'annual_income' => round($annualIncome, 2),
            'total_tax'     => $totalTax,
            'breakdown'     => $breakdown,
        ]
    ]);

    return back();
}

// ================= INDIVIDUAL PDF =================
    public function downloadPdf()
    {
        $data = session('estimated_individual_tax');

        if (!$data) {
            return redirect()->back()->with('error', 'No individual tax data found in session.');
        }

        $pdf = Pdf::loadView('pdf.individual_tax', ['data' => $data]);

        return $pdf->download('individual_tax_report.pdf');
    }

    // ================= CORPORATE PDF =================
    public function downloadCorporatePdf()
    {
        $data = session('estimated_corporate_tax');

        if (!$data) {
            return redirect()->back()->with('error', 'No corporate tax data found in session.');
        }

        $pdf = Pdf::loadView('pdf.corporate_tax', ['data' => $data]);

        return $pdf->download('corporate_tax_report.pdf');
    }
}
