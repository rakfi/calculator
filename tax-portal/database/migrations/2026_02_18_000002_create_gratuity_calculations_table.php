<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gratuity_calculations', function (Blueprint $table) {
            $table->id();
            $table->string('employee_identifier')->nullable(); // optional reference if needed
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->decimal('last_month_salary', 15, 2)->default(0);
            $table->decimal('basic', 15, 2)->default(0);
            $table->decimal('service_years', 8, 2)->default(0);
            $table->decimal('months_payable', 8, 2)->default(0);
            $table->decimal('gratuity_amount', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gratuity_calculations');
    }
};
