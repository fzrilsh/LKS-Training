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
        Schema::create('module_markings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('modules', 'id')->cascadeOnDelete();
            $table->json('json');
            $table->float('max_point');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_markings');
    }
};
