<?php

namespace App\Http\Controllers\Payroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payroll\EpfSetting;
use PDF;

class EpfEtfController extends Controller
{
    public function form()
    {
        $setting = EpfSetting::first();
        return view('payroll.epf-etf', compact('setting'));
    }

    public function calculate(Request $request)
    {
        $setting = EpfSetting::first();
        $monthly_income = floatval($request->input('monthly_income', 0));

        $employee_rate = $setting->employee_rate ?? 0.08;
        $employer_rate = $setting->employer_rate ?? 0.12;
        $etf_rate = $setting->etf_rate ?? 0.03;

        $epf_employee = round($monthly_income * $employee_rate, 2);
        $epf_employer = round($monthly_income * $employer_rate, 2);
        $etf = round($monthly_income * $etf_rate, 2);
        $net_salary = round($monthly_income - $epf_employee, 2);

        $data = compact('monthly_income', 'employee_rate', 'employer_rate', 'etf_rate', 'epf_employee', 'epf_employer', 'etf', 'net_salary');

        session(['epf_etf' => $data]);
        return redirect()->route('tax.epf');
    }

    public function downloadPdfFromSession()
    {
        $data = session('epf_etf');
        if (! $data) {
            return redirect()->route('tax.epf')->with('error', 'No calculation available.');
        }
        $pdf = PDF::loadView('payroll.pdf.epf-etf', $data)->setPaper('A4', 'portrait');
        return $pdf->download('epf_etf.pdf');
    }

    public function settingsEdit()
    {
        $setting = EpfSetting::first();
        return view('admin.calculators.epf_etf', compact('setting'));
    }

    public function settingsUpdate(Request $request)
    {
        $setting = EpfSetting::first();
        if (! $setting) { $setting = new EpfSetting(); }
        $setting->employee_rate = floatval($request->input('employee_rate', 0.08));
        $setting->employer_rate = floatval($request->input('employer_rate', 0.12));
        $setting->etf_rate = floatval($request->input('etf_rate', 0.03));
        $setting->save();
        return redirect()->route('admin.epf.settings')->with('success', 'EPF/ETF settings saved.');
    }
}
