<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('family_code', 50)->nullable()->index();
            $table->string('main_member_name_guj', 150)->index();
            $table->string('main_member_name_eng', 150)->nullable()->index();
            $table->string('surname_guj', 100)->index();
            $table->string('surname_eng', 100)->nullable()->index();
            $table->string('village', 150)->nullable()->index();
            $table->string('city', 100)->default('રાજકોટ')->index();
            $table->text('address')->nullable();
            $table->string('mobile', 100)->nullable();
            $table->text('search_keywords')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};
