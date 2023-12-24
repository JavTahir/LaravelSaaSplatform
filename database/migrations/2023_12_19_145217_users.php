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
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('first_name')->nullable();
        $table->string('last_name')->nullable();
        $table->string('email')->unique()->default(''); // You can use an empty string or any default value you prefer


        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->string('phone')->nullable();
        $table->string('city')->nullable();
        $table->date('dob')->nullable();
        $table->string('country')->nullable();
        $table->string('image_path')->nullable(); // Changed from 'image-path'
        $table->boolean('profile_completed')->default(false); // Changed from 'profile-completed'
        $table->integer('is_verified')->default(0);
        $table->integer('social_accounts')->default(0);
        $table->rememberToken();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
