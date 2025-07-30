<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('variables');

        Schema::create('variables', function (Blueprint $table) {
            $table->id();
            $table->integer('model_id')->nullable(); // keep if needed
            $table->string('name')->nullable();
            $table->text('value')->nullable();
            $table->string('level')->nullable();
            $table->string('unit')->nullable();
            $table->integer('key_variable')->default(0); // 0 for no, 1 for yes
            $table->integer('is_editable')->default(0);
            $table->timestamps(); // handles created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('variables');
    }
};
