<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GratuitySetting extends Model
{
    use HasFactory;

    protected $table = 'gratuity_settings';

    protected $fillable = ['months_per_year', 'max_months', 'use_basic_only'];
}
