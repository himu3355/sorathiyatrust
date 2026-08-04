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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_id')->constrained('families')->onDelete('cascade');
            $table->string('member_name_guj', 150)->index();
            $table->string('member_name_eng', 150)->nullable()->index();
            $table->string('relation', 100)->nullable();
            $table->string('age', 20)->nullable();
            $table->string('birth_place', 150)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('marital_status', 50)->nullable();
            $table->string('maternal_surname', 100)->nullable()->comment('Mosal Atak');
            $table->string('education', 150)->nullable();
            $table->string('occupation', 150)->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('mobile', 100)->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
