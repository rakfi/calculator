<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('salary_slip_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('monthly_tax_threshold', 15, 2)->default(50000);
            $table->decimal('monthly_tax_rate', 5, 4)->default(0.10);
            $table->timestamps();
        });

        DB::table('salary_slip_settings')->insert([
            'monthly_tax_threshold' => 50000,
            'monthly_tax_rate' => 0.10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('salary_slip_settings');
    }
};
