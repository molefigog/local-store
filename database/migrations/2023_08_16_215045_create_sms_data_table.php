<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsDataTable extends Migration
{
    public function up()
    {
        Schema::create('sms_data', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->string('from');
            $table->string('sim');
            $table->timestamp('timestamp');
            $table->string('to');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sms_data');
    }
}

