<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySlip extends Model
{
    use HasFactory;

    protected $table = 'salary_slips';

    protected $fillable = [
        'month', 'year',
        'basic', 'allowances', 'other', 'gross',
        'epf_employee', 'epf_employer', 'etf', 'tax', 'total_deductions', 'net'
    ];
}
