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
        Schema::create('linkedin_connections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('linkedin_id');
            $table->foreign('linkedin_id')->references('id')->on('linkedin')->onDelete('cascade');
            $table->integer('connections_count');
            $table->date('record_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linkedin_connections');
    }
};
