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
        Schema::dropIfExists('member_pdf_sources');
        Schema::dropIfExists('community_members');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-create schemas if rolled back
        Schema::create('community_members', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->nullable();
            $table->string('gujarati_name');
            $table->string('english_name')->nullable();
            $table->string('father_husband_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('native_village')->nullable();
            $table->string('current_city')->default('રાજકોટ');
            $table->text('full_address')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email')->nullable();
            $table->string('occupation')->nullable();
            $table->string('blood_group')->nullable();
            $table->boolean('is_committee_member')->default(false);
            $table->string('designation')->nullable();
            $table->string('photo_path')->nullable();
            $table->timestamps();
        });

        Schema::create('member_pdf_sources', function (Blueprint $table) {
            $table->id();
            $table->string('original_filename');
            $table->string('storage_path');
            $table->string('status')->default('pending');
            $table->integer('extracted_count')->default(0);
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }
};
