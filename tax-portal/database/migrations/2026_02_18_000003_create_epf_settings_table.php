<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('epf_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('employee_rate', 5, 4)->default(0.08); // 8%
            $table->decimal('employer_rate', 5, 4)->default(0.12); // 12%
            $table->decimal('etf_rate', 5, 4)->default(0.03); // 3%
            $table->timestamps();
        });

        DB::table('epf_settings')->insert([
            'employee_rate' => 0.08,
            'employer_rate' => 0.12,
            'etf_rate' => 0.03,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('epf_settings');
    }
};
