<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedTable extends Migration
{
    public function up()
    {
        Schema::create('purchased', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('music_id');
            // Other columns...
            $table->timestamps();

            $table->foreign('music_id')->references('id')->on('music')->onDelete('cascade');
            // Other foreign keys...
        });
    }


    public function down()
    {
        Schema::dropIfExists('purchased');
    }
}
