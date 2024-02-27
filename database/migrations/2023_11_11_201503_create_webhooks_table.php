<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebhooksTable extends Migration
{
    public function up()
    {
        Schema::create('webhooks', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->string('MSISDN'); // Define the payload field
            $table->timestamps(); // Optional: adds 'created_at' and 'updated_at' fields
        });
    }

    public function down()
    {
        Schema::dropIfExists('webhooks');
    }
}
