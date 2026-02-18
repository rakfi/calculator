<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EpfSetting extends Model
{
    use HasFactory;

    protected $table = 'epf_settings';

    protected $fillable = ['employee_rate', 'employer_rate', 'etf_rate'];
}
