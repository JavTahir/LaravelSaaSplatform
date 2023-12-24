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
        Schema::create('linkedin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('linkedin_name');
            $table->string('linkedin_uname')->nullable();
            $table->string('linkedin_email')->nullable(); // You can use an empty string or any default value you prefer
            $table->string('linkedin_id')->unique(); 
            $table->string('linkedin_avatar')->nullable();
            $table->string('linkedin_access_token')->nullable();
        
            $table->rememberToken();
            $table->timestamps();
        });
    }
    
        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('linkedin');
        }
};