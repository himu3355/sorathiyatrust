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
        Schema::create('community_members', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('gujarati_name')->nullable()->index();
            $table->string('designation')->nullable()->index();
            $table->string('mobile_number')->nullable()->index();
            $table->string('photo_path')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('membership_number')->nullable()->index();
            $table->integer('sort_order')->default(0)->index();
            $table->boolean('is_committee_member')->default(false)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_members');
    }
};
