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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('slug')->unique();
            $table->string('company_logo')->nullable();
            $table->text('about')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('location_id')->references('id')->on('locations')->nullOnDelete();
            $table->foreign('industry_id')->references('id')->on('industries')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers');
    }
};
