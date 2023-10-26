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
        Schema::create('student_attendance_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attendance_date_id');
            $table->unsignedBigInteger('student_id');
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('attendance_date_id')->references('id')->on('student_attendances')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attendance_statuses');
    }
};
