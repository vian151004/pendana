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
            $table->unsignedBigInteger('role_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')
                  ->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')
                  ->nullable();
            $table->string('phone')
                  ->nullable();
            $table->enum('gender', ['laki-laki', 'perempuan'])
                  ->nullable();
            $table->date('birth_date')
                  ->nullable();
            $table->string('job')
                  ->nullable();
            $table->text('address')
                  ->nullable();
            $table->text('about')
                  ->nullable();
            $table->text('path_image')
                  ->nullable();
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
