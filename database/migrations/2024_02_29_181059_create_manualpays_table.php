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
        Schema::create('manualpays', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->string('MSISDN');
            $table->string('transact_id');
            $table->decimal('received_amount', 10, 2);
            $table->string('from_number');
            $table->string('otp');
            $table->boolean('used')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manualpays');
    }
};
