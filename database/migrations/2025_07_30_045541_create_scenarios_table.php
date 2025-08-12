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
        Schema::create('scenarios', function (Blueprint $table) {
            $table->id();
            $table->integer('sfd_id')->nullable();
            $table->string('name');
            $table->string('desc')->nullable();
            $table->integer('timestep')->nullable();
            $table->string('model_id')->nullable(); // keep if needed
            $table->string('export_path')->nullable(); // keep if needed
            $table->timestamps();
            $table->integer('final_time')->nullable(); // keep if needed
        });

        Schema::create('scenario_data', function (Blueprint $table) {
            $table->id();
            $table->string('scenario_id')->nullable();
            $table->string('variable_id')->nullable();
            $table->string('node_point');
            $table->string('value');
            $table->timestamps(); // adds both created_at and updated_at
        });

        Schema::create('ancaman', function (Blueprint $table) {
            $table->id();
            $table->string('level_ancaman')->nullable();
            $table->integer('is_active')->nullable();
            $table->string('severity')->nullable();
            $table->text('text')->nullable();
            $table->string('flag')->default('1');
        });

        Schema::create('recommendation', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('defence_severity')->nullable();
            $table->string('infra_defence_severity')->nullable();
            $table->string('marine_resource')->nullable();
            $table->string('threat_severity')->nullable();
            $table->string('klasifikasi')->nullable();
            $table->string('flag')->nullable();
            $table->text('analisa_kondisi')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('scenario_alternative', function (Blueprint $table) {
            $table->id();
            $table->string('variable')->nullable();
            $table->string('severity')->nullable();
            $table->text('solusi')->nullable();
            $table->timestamps(); // adds both created_at and updated_at
        });

        Schema::create('sfd', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('desc')->nullable();
            $table->string('model_id')->nullable(); // keep only once
        });

        Schema::create('sfd_variable', function (Blueprint $table) {
            $table->id();
            $table->integer('sfd_id')->nullable();
            $table->integer('variable_id')->nullable();
            $table->timestamps(); // adds both created_at and updated_at
        });

        Schema::create('scenario_variables', function (Blueprint $table) {
            $table->id();
            $table->integer('scenario_id')->nullable();
            $table->integer('sfd_id')->nullable();
            $table->integer('variable_id');
            $table->string('value');
            $table->string('level');
            $table->string('unit');
            $table->timestamps(); // adds both created_at and updated_at
        });

        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('sfd_name')->nullable();
            $table->text('description')->nullable(); // keep only once
            $table->integer('is_active')->default(1);
        });

        Schema::create('question', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable();
            $table->string('question')->nullable();
            $table->integer('max_value')->nullable();
            $table->integer('has_relational_to_variable');
            $table->string('min_label')->nullable();
            $table->string('max_label')->nullable();
            $table->timestamps(); // adds both created_at and updated_at
        });

        Schema::create('recommendation_variable_rel', function (Blueprint $table) {
            $table->id();
            $table->integer('recommendation_id')->nullable();
            $table->integer('variable_id')->nullable();
            $table->timestamps(); // adds both created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scenario_data');
        Schema::dropIfExists('scenarios');
    }
};
