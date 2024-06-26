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
    Schema::create('music_purchase', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('music_id');
        $table->foreign('music_id')->references('id')->on('music')->onDelete('cascade');
        $table->unsignedBigInteger('month');
        $table->unsignedBigInteger('year');
        $table->unsignedBigInteger('total_purchases')->default(0);
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_purchase');
    }
};
