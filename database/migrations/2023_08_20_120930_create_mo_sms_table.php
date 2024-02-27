<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoSmsTable extends Migration
{
    public function up()
    {
        Schema::create('mo_sms', function (Blueprint $table) {
            $table->id();
            $table->string('To');
            $table->text('Message');
            $table->string('Msisdn');
            $table->timestamp('Received');
            $table->string('UserReference', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mo_sms');
    }
}
