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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained('clients')->onDelete('cascade');
            $table->string('name', 100)->nullable();
            $table->string('alias', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->addressFields();
            $table->string('cnpj', 14)->nullable();
            $table->phoneField();
            $table->string('logo')->nullable();
            $table->string('site')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('grade_flow')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
