<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('document_request', function (Blueprint $table) {
            $table->id('dr_id');
            $table->integer('admin_id');
            $table->date('request_date');
            $table->string('request_type');
            $table->string('student_id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('course')->nullable();
            $table->string('year_graduated')->nullable();
            $table->string('status')->default('Processing');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });

        Schema::create('history', function (Blueprint $table) {
            $table->id('history_id');
            $table->string('history_name');
            $table->string('history_action');
            $table->text('history_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_request');
        Schema::dropIfExists('history');
    }
};