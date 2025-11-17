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
        Schema::create('grade_subject_plans', function (Blueprint $table) {
            $table->id();

            // Relacionamento com a matéria da grade
            $table->foreignId('grade_subject_id')->constrained('grade_subjects')->onDelete('cascade');

            // Dados do plano
            $table->tinyInteger('bimester'); // 1, 2, 3 ou 4
            $table->text('observations')->nullable();
            $table->string('file_path');

            // Controle
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            // Um plano de aula único por matéria e bimestre
            $table->unique(['grade_subject_id', 'bimester'], 'unique_subject_bimester_plan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_subject_plans');
    }
};
