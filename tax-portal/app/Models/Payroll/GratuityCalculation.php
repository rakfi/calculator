<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GratuityCalculation extends Model
{
    use HasFactory;

    protected $table = 'gratuity_calculations';

    protected $fillable = [
        'employee_identifier', 'month', 'year', 'last_month_salary', 'basic', 'service_years', 'months_payable', 'gratuity_amount'
    ];
}
