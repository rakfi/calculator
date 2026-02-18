<?php

namespace App\Http\Controllers\Payroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use App\Models\Payroll\SalarySlip;
use App\Models\Payroll\SalarySlipSetting;

class PayrollController extends Controller
{
    public function showForm()
    {
        return view('payroll.salary-slip');
    }

    public function preview(Request $request)
    {
        $data = $this->computeData($request->all());
        // show preview (do not save yet)
        return view('payroll.pdf.salary-slip', $data);
    }

    public function download(Request $request)
    {
        $data = $this->computeData($request->all());
        // Save slip to database
        $saved = SalarySlip::create([
            'month' => $request->input('month'),
            'year' => $request->input('year'),
            'basic' => $data['basic'],
            'allowances' => $data['allowances'],
            'other' => $data['other'],
            'gross' => $data['gross'],
            'tax' => $data['tax'],
            'total_deductions' => $data['total_deductions'],
            'net' => $data['net'],
        ]);
        $pdf = PDF::loadView('payroll.pdf.salary-slip', $data)->setPaper('A4', 'portrait');
        $filename = 'salary_slip_' . ($saved->id ?? now()->format('Ymd_His')) . '.pdf';
        return $pdf->download($filename);
    }

    public function index()
    {
        $slips = SalarySlip::orderBy('created_at', 'desc')->paginate(25);
        return view('payroll.salary-slips', compact('slips'));
    }

    public function show($id)
    {
        $slip = SalarySlip::findOrFail($id);
        // pass values expected by PDF view
        $data = [
            'input' => [
                'month' => $slip->month,
                'year' => $slip->year,
            ],
            'basic' => $slip->basic,
            'allowances' => $slip->allowances,
            'other' => $slip->other,
            'gross' => $slip->gross,
            'tax' => $slip->tax,
            'total_deductions' => $slip->total_deductions,
            'net' => $slip->net,
        ];

        return view('payroll.salary-slip-show', $data + compact('slip'));
    }

    public function downloadSaved($id)
    {
        $slip = SalarySlip::findOrFail($id);
        $data = [
            'input' => [
                'month' => $slip->month,
                'year' => $slip->year,
            ],
            'basic' => $slip->basic,
            'allowances' => $slip->allowances,
            'other' => $slip->other,
            'gross' => $slip->gross,
            'tax' => $slip->tax,
            'total_deductions' => $slip->total_deductions,
            'net' => $slip->net,
        ];
        $pdf = PDF::loadView('payroll.pdf.salary-slip', $data)->setPaper('A4', 'portrait');
        $filename = 'salary_slip_' . $slip->id . '.pdf';
        return $pdf->download($filename);
    }

    // Called by controllers to compute internal fields
    protected function computeData(array $input)
    {
        $basic = floatval($input['basic'] ?? 0);
        $allowances = floatval($input['allowances'] ?? 0);
        $other = floatval($input['other'] ?? 0);

        $gross = $basic + $allowances + $other;

        // Simple placeholder tax calculation (monthly). Replace with accurate rules as needed.
        $tax = round($this->calculateTax($gross), 2);

        $total_deductions = $tax;
        $net = $gross - $total_deductions;

        return compact('input', 'basic', 'allowances', 'other', 'gross', 'tax', 'total_deductions', 'net');
    }

    // POST calculate: store results in session and return the form view
    public function calculate(Request $request)
    {
        $data = $this->computeData($request->all());
        session(['salary_slip' => $data]);
        return redirect()->route('payroll.form');
    }

    // GET PDF from session (like other calculators)
    public function downloadPdfFromSession()
    {
        $data = session('salary_slip');
        if (! $data) {
            return redirect()->route('payroll.form')->with('error', 'No calculation available.');
        }
        $pdf = PDF::loadView('payroll.pdf.salary-slip', $data)->setPaper('A4', 'portrait');
        return $pdf->download('salary_slip.pdf');
    }

    protected function calculateTax(float $gross): float
    {
        $setting = SalarySlipSetting::first();
        $threshold = $setting ? floatval($setting->monthly_tax_threshold) : 50000;
        $rate = $setting ? floatval($setting->monthly_tax_rate) : 0.10;

        if ($gross <= $threshold) {
            return 0;
        }

        return ($gross - $threshold) * $rate;
    }

    public function settingsEdit()
    {
        $setting = SalarySlipSetting::first();
        return view('admin.calculators.salary_slip', compact('setting'));
    }

    public function settingsUpdate(Request $request)
    {
        $setting = SalarySlipSetting::first();
        if (! $setting) {
            $setting = new SalarySlipSetting();
        }

        $setting->monthly_tax_threshold = floatval($request->input('monthly_tax_threshold', 50000));
        $setting->monthly_tax_rate = floatval($request->input('monthly_tax_rate', 0.10));
        $setting->save();

        return redirect()->route('admin.salary_slip.settings')->with('success', 'Salary slip settings updated.');
    }
}
