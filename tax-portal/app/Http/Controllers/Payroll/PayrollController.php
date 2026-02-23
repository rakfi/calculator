<?php

namespace App\Http\Controllers\Payroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use App\Models\Payroll\SalarySlip;
use App\Models\Payroll\SalarySlipSetting;

class PayrollController extends Controller
{
    // Show generator form
    public function showForm()
    {
        return view('payroll.salary-slip');
    }

    // Calculate salary and save to session
    public function calculate(Request $request)
    {
        $data = $this->computeData($request->all());

        // Store for preview / PDF
        session(['salary_slip' => $data]);

        return redirect()->route('payroll.form');
    }

    // Preview PDF
    public function preview(Request $request)
    {
        $data = $this->computeData($request->all());
        return view('payroll.pdf.salary-slip', $data);
    }

    // Download PDF from session
    public function downloadPdfFromSession()
    {
        $data = session('salary_slip');

        if (!$data) {
            return redirect()->route('payroll.form')->with('error', 'No salary slip available.');
        }

        $pdf = PDF::loadView('payroll.pdf.salary-slip', $data)->setPaper('A4', 'portrait');
        return $pdf->download('salary_slip.pdf');
    }

    // Admin settings: show edit form
    public function settingsEdit()
    {
        $setting = SalarySlipSetting::first();
        return view('admin.calculators.salary_slip', compact('setting'));
    }

    // Admin settings: update settings
    public function settingsUpdate(Request $request)
    {
        $setting = SalarySlipSetting::first();
        if (!$setting) {
            $setting = new SalarySlipSetting();
        }

        // Convert percentage (0-100) to decimal (0-1)
        $setting->monthly_tax_threshold = floatval($request->input('monthly_tax_threshold', 50000));
        $setting->monthly_tax_rate = floatval($request->input('monthly_tax_rate', 10)) / 100;
        $setting->save();

        return redirect()->route('admin.salary_slip.settings')->with('success', 'Salary slip settings updated.');
    }

    // Compute salary data
    protected function computeData(array $input)
    {
        $basic = floatval($input['basic'] ?? 0);
        $allowances = floatval($input['allowances'] ?? 0);
        $other = floatval($input['other'] ?? 0);
        $gross = $basic + $allowances + $other;

        // Load settings
        $setting = SalarySlipSetting::first();
        $epf_rate = $setting->epf_employee_rate ?? 0.08;
        $etf_rate = $setting->etf_employer_rate ?? 0.03;
        $tax_threshold = $setting->monthly_tax_threshold ?? 50000;
        $tax_rate = $setting->monthly_tax_rate ?? 0.10;

        // Calculations
        $epf = round($gross * $epf_rate, 2);
        $etf = round($gross * $etf_rate, 2);
        $apit = $gross > $tax_threshold ? round(($gross - $tax_threshold) * $tax_rate, 2) : 0;

        $total_deductions = $epf + $apit;
        $net = $gross - $total_deductions;

        return [
            'employee_name' => $input['employee_name'] ?? '',
            'designation' => $input['designation'] ?? '',
            'nic' => $input['nic'] ?? '',
            'epf_no' => $input['epf_no'] ?? '',
            'month' => $input['month'] ?? '',
            'basic' => $basic,
            'allowances' => $allowances,
            'other' => $other,
            'gross' => $gross,
            'epf_employee' => $epf,
            'etf_employer' => $etf,
            'apit' => $apit,
            'total_deductions' => $total_deductions,
            'net' => $net,
            'issue_date' => now()->format('Y-m-d'),
        ];
    }
}