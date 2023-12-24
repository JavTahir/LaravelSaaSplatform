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
        Schema::create('twitter_followers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('twitter_id');
            $table->foreign('twitter_id')->references('id')->on('twitter')->onDelete('cascade');
            $table->integer('followers_count');
            $table->integer('friends_count');
            $table->integer('statuses_count');
            $table->date('record_date');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('twitter_followers');
    }
};
