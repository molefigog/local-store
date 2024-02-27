<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('music_id'); // Change 'music_id' to match your actual column name
            $table->string('item_number');
            $table->string('txn_id');
            $table->decimal('payment_gross', 10, 2);
            $table->string('currency_code');
            $table->string('payment_status');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
