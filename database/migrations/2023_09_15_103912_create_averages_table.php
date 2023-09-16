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
        Schema::create('averages', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('mid_mark');
            $table->string('final_mark');
            $table->string('activity_marks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('averages');
    }
};
