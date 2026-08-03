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
        Schema::create('member_pdf_sources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('community_member_id')
                ->nullable()
                ->constrained('community_members')
                ->nullOnDelete();
            $table->string('document_title');
            $table->string('pdf_path')->nullable();
            $table->longText('extracted_text')->nullable();
            $table->integer('source_page_number')->nullable();
            $table->text('reference_info')->nullable();
            $table->json('raw_metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_pdf_sources');
    }
};
