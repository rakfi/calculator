<?php

namespace App\Http\Controllers\Payroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payroll\GratuitySetting;
use App\Models\Payroll\GratuityCalculation;
use PDF;

class GratuityController extends Controller
{
    public function form()
    {
        $setting = GratuitySetting::first();
        return view('payroll.gratuity', compact('setting'));
    }

    public function preview(Request $request)
    {
        $data = $this->compute($request->all());
        // return PDF preview view
        return view('payroll.pdf.gratuity', $data);
    }

    public function download(Request $request)
    {
        $data = $this->compute($request->all());

        // Save calculation
        $saved = GratuityCalculation::create([
            'employee_identifier' => $request->input('employee_identifier'),
            'month' => $request->input('month'),
            'year' => $request->input('year'),
            'last_month_salary' => $data['last_month_salary'] ?? 0,
            'basic' => $data['basic'] ?? 0,
            'service_years' => $data['service_years'],
            'months_payable' => $data['months_payable'],
            'gratuity_amount' => $data['gratuity_amount'],
        ]);

        $pdf = PDF::loadView('payroll.pdf.gratuity', $data)->setPaper('A4', 'portrait');
        $filename = 'gratuity_' . ($saved->id ?? now()->format('Ymd_His')) . '.pdf';
        return $pdf->download($filename);
    }

    public function index()
    {
        $items = GratuityCalculation::orderBy('created_at', 'desc')->paginate(25);
        return view('payroll.gratuity-calculations', compact('items'));
    }

    public function show($id)
    {
        $item = GratuityCalculation::findOrFail($id);
        $data = [
            'last_month_salary' => $item->last_month_salary,
            'basic' => $item->basic,
            'service_years' => $item->service_years,
            'months_payable' => $item->months_payable,
            'gratuity_amount' => $item->gratuity_amount,
            'input' => ['month' => $item->month, 'year' => $item->year],
            'item' => $item,
        ];
        return view('payroll.gratuity-show', $data);
    }

    public function downloadSaved($id)
    {
        $item = GratuityCalculation::findOrFail($id);
        $data = [
            'last_month_salary' => $item->last_month_salary,
            'basic' => $item->basic,
            'service_years' => $item->service_years,
            'months_payable' => $item->months_payable,
            'gratuity_amount' => $item->gratuity_amount,
            'input' => ['month' => $item->month, 'year' => $item->year],
        ];
        $pdf = PDF::loadView('payroll.pdf.gratuity', $data)->setPaper('A4', 'portrait');
        return $pdf->download('gratuity_' . $item->id . '.pdf');
    }

    // POST calculate: store results in session and return to form
    public function calculate(Request $request)
    {
        $data = $this->compute($request->all());
        session(['gratuity' => $data]);
        return redirect()->route('gratuity.form');
    }

    // GET PDF from session
    public function downloadPdfFromSession()
    {
        $data = session('gratuity');
        if (! $data) {
            return redirect()->route('gratuity.form')->with('error', 'No calculation available.');
        }
        $pdf = PDF::loadView('payroll.pdf.gratuity', $data)->setPaper('A4', 'portrait');
        return $pdf->download('gratuity.pdf');
    }

    public function settingsEdit()
    {
        $setting = GratuitySetting::first();
        return view('admin.calculators.gratuity', compact('setting'));
    }

    public function settingsUpdate(Request $request)
    {
        $setting = GratuitySetting::first();
        if (! $setting) {
            $setting = new GratuitySetting();
        }

        $setting->months_per_year = floatval($request->input('months_per_year', 1.0));
        $setting->max_months = intval($request->input('max_months', 36));
        $setting->use_basic_only = intval($request->input('use_basic_only', 1));
        $setting->save();

        return redirect()->route('admin.gratuity.settings')->with('success', 'Gratuity settings updated.');
    }

    protected function compute(array $input)
    {
        $setting = GratuitySetting::first();
        if (! $setting) {
            $setting = new GratuitySetting(['months_per_year' => 1.0, 'max_months' => 36, 'use_basic_only' => true]);
        }

        $last_month_salary = floatval($input['last_month_salary'] ?? 0);
        $basic = floatval($input['basic'] ?? 0);
        $service_years = floatval($input['service_years'] ?? 0);

        $months_payable = $service_years * floatval($setting->months_per_year);
        if ($setting->max_months > 0) {
            $months_payable = min($months_payable, $setting->max_months);
        }

        $base = $setting->use_basic_only ? $basic : $last_month_salary;
        $gratuity_amount = round($base * $months_payable, 2);

        return compact('last_month_salary', 'basic', 'service_years', 'months_payable', 'gratuity_amount', 'setting', 'input');
    }
}
