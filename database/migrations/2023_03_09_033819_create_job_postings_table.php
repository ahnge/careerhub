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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('job_function_id')->nullable();
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->string('title');
            $table->text('description');
            $table->text('requirements');
            $table->enum('type', ['remote', 'on_site']);
            $table->enum('time', ['full_time', 'part_time']);
            $table->integer('salary', false, true)->nullable();
            $table->integer('post', false, true);
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('employer_id')->references('id')->on('employers')->cascadeOnDelete();
            $table->foreign('location_id')->references('id')->on('locations')->nullOnDelete();
            $table->foreign('job_function_id')->references('id')->on('job_functions')->nullOnDelete();
            $table->foreign('industry_id')->references('id')->on('industries')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
