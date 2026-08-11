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
        Schema::create('baithaks', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unique(); // 1 to 84
            $table->string('city_village_guj'); // ગામનું નામ (ગુજરાતી)
            $table->string('city_village_eng')->nullable();
            $table->text('address_guj'); // બેઠકજીના સરનામા
            $table->text('address_eng')->nullable();
            $table->string('contact_person_guj')->nullable(); // મુખ્યજી / સંપર્ક નામ
            $table->string('contact_numbers')->nullable(); // ટેલિફોન - મોબાઇલ નં.
            $table->string('state')->nullable(); // સ્ટેટ / પ્રદેશ (e.g. ઉત્તર પ્રદેશ, ગુજરાત, તામિલનાડુ, વગેરે)
            $table->boolean('is_apragat')->default(false); // અપ્રગટ બેઠક છે કે કેમ
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
        Schema::dropIfExists('baithaks');
    }
};
