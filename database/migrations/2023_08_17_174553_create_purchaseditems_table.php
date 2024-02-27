<?php

// database/migrations/2023_08_17_150000_create_purchaseditems_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseditemsTable extends Migration
{
    public function up()
    {
        Schema::create('purchaseditems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('music_id');
            $table->string('artist');
            $table->string('title');
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->text('description');
            $table->string('duration')->default('0:00');
            $table->string('size')->default('0');
            $table->integer('downloads')->default(0);
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchaseditems');
    }
}
