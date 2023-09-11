<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('test_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hosp_id'); // Foreign key to hospitals table
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->string('status');
            $table->string('vaccination');
            $table->string('pdf_path')->nullable();
            $table->timestamps();
        });

        Schema::table('test_reports', function (Blueprint $table) {
            $table->foreign('hosp_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_reports');
    }
};
