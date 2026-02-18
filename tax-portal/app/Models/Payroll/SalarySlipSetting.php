<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySlipSetting extends Model
{
    use HasFactory;

    protected $table = 'salary_slip_settings';

    protected $fillable = ['monthly_tax_threshold', 'monthly_tax_rate'];
}
