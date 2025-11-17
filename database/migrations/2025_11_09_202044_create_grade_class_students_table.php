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
        Schema::create('grade_class_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_class_id')->nullable()->constrained('grade_classes')->onDelete('cascade');
            $table->foreignId('student_id')->nullable()->constrained('students')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['grade_class_id', 'student_id'], 'unique_grade_class_student');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_class_students');
    }
};
