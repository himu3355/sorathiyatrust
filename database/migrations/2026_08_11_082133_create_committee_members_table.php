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
        Schema::create('committee_members', function (Blueprint $table) {
            $table->id();
            $table->string('name_guj');
            $table->string('name_eng')->nullable();
            $table->string('designation_guj');
            $table->string('designation_eng')->nullable();
            $table->string('category')->default('office_bearer'); // 'office_bearer' or 'executive_member'
            $table->string('photo_path')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('term')->default('૨૦૨૫-૨૭');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committee_members');
    }
};
