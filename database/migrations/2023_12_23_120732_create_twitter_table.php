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
        Schema::create('twitter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('twitter_name');
            $table->string('twitter_uname')->nullable();
            $table->string('twitter_email')->nullable(); // You can use an empty string or any default value you prefer
            $table->string('twitter_id')->unique(); 
            $table->string('twitter_avatar')->nullable();
            $table->string('twitter_access_token')->nullable();
            $table->string('twitter_token_secret')->nullable();
        
            $table->rememberToken();
            $table->timestamps();
        });
    }
    
        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('twitter');
        }
};