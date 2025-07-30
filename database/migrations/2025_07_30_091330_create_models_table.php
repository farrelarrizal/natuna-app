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
        Schema::dropIfExists('models');

        Schema::create('models', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('desc')->nullable();
            $table->string('image')->nullable(); // keep only once
            $table->text('pathfile')->nullable();
            $table->integer('is_active')->default(1);
            $table->integer('final_step')->nullable();
            $table->timestamps(); // adds created_at and updated_at
            $table->string('sfd')->nullable(); // keep if needed
            $table->integer('is_run')->default(0); // keep if needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('models');
    }
};
