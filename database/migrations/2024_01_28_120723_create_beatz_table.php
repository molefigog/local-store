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
        Schema::create('beatz', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('beat_id');
            $table->unsignedBigInteger('uploader_id');
            $table->string('artist');
            $table->string('title');
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->text('description');
            $table->string('duration')->default('0:00');
            $table->string('size')->default('0');
            $table->integer('used')->default(0);
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
