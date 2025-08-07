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
        Schema::create('leads', function (Blueprint $table) {
        $table->id();
        $table->string('customer');
        $table->string('product')->nullable();
        $table->unsignedBigInteger('status_id')->nullable();
        $table->string('source')->nullable();
        $table->string('number')->nullable();
        $table->date('followup_date')->nullable();
        $table->string('call_status')->nullable();
        $table->timestamps();

        // Optional: Foreign key constraint
        $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
