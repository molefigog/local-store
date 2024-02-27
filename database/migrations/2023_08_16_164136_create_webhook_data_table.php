<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebhookDataTable extends Migration
{
    public function up()
    {
        Schema::create('webhook_data', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->timestamp('timestamp');
            $table->string('MSISDN');
            $table->string('transact_id')->nullable();
            $table->decimal('received_amount', 10, 2)->nullable();
            $table->string('from_number')->nullable();
            $table->boolean('used')->default(false); // Add the 'used' column
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('webhook_data');
    }
}
