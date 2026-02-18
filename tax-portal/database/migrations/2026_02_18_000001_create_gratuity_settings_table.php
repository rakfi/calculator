<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gratuity_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('months_per_year', 5, 2)->default(1.00); // months paid per service year
            $table->integer('max_months')->default(36); // cap on months payable
            $table->boolean('use_basic_only')->default(true);
            $table->timestamps();
        });

        // create a default settings row
        DB::table('gratuity_settings')->insert([
            'months_per_year' => 1.00,
            'max_months' => 36,
            'use_basic_only' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('gratuity_settings');
    }
};
