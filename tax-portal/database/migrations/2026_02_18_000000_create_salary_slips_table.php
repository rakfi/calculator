<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('salary_slips', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();

            $table->decimal('basic', 15, 2)->default(0);
            $table->decimal('allowances', 15, 2)->default(0);
            $table->decimal('other', 15, 2)->default(0);
            $table->decimal('gross', 15, 2)->default(0);

            $table->decimal('epf_employee', 15, 2)->default(0);
            $table->decimal('epf_employer', 15, 2)->default(0);
            $table->decimal('etf', 15, 2)->default(0);
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('total_deductions', 15, 2)->default(0);
            $table->decimal('net', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('salary_slips');
    }
};
