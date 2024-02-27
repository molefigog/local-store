<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('beats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('genre_id');
            $table->string('artist');
            $table->string('title');
            $table->string('amount');
            $table->string('image')->nullable();
            $table->string('demo');
            $table->string('file')->nullable();
            $table->text('description');
            $table->string('duration')->default('0:00');
            $table->string('size')->default('0');
            $table->boolean('used')->default(false); 
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music');
    }
};
