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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Dados básicos do estudante
            $table->string('full_name');
            $table->date('birth_date');
            
            // Relacionamentos
            $table->foreignId('client_id')->nullable()->constrained('clients')->onDelete('cascade');
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->foreignId('grade_id')->constrained()->cascadeOnDelete();

            // Dados escolares
            $table->string('shift'); // morning, afternoon

            // Avaliação psicológica e motora
            $table->string('support_level'); // low, moderate, high
            $table->string('literacy_stage'); // pre_syllabic, syllabic, syllabic_alphabetic, alphabetic

            // Avaliação social
            $table->string('socialization'); // normal, few_conflicts, many_conflicts, aggressiveness
            $table->string('verbal_communication'); // verbal, uses_coherent_words, disconnected_speech, averbal
            $table->string('autonomy'); // does_alone, does_if_directed, only_with_support, does_not

            // Avaliação de aprendizagem
            $table->unsignedInteger('concentration_time'); // Tempo em minutos
            $table->string('learning_profile'); // visual, auditory, kinesthetic, logical_mathematical

            // Informações adicionais
            $table->text('other_relevant_info')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
