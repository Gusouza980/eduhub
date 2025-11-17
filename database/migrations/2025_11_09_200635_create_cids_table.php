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
        Schema::create('cids', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->index();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['code', 'name'], 'unique_cid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cids');
    }
};
