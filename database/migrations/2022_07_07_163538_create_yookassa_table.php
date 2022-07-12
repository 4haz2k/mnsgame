<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYookassaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yookassa', function (Blueprint $table) {
            $table->id();
            # UserID from Users table
            $table->unsignedBigInteger("server_id")->nullable();

            # PaymentID from YooKassa
            $table->string('payment_id');
            # Status Payment
            $table->enum('status', ['pending', 'waiting_for_capture', 'succeeded', 'canceled']);
            # Is Paid?
            $table->boolean('paid')->default(false);
            # Amount Invoice
            $table->double('sum');
            # Currency Invoice
            $table->string('currency')->default('RUB');
            # Payment Link
            $table->string('payment_link');
            # Description Invoice
            $table->string('description')->nullable();
            # Paid At
            $table->dateTime('paid_at')->nullable();
            # Uniq ID
            $table->string('uniq_id')->nullable();

            # Foreign Key
            $table->foreign("server_id")->references("id")->on("servers")->onDelete("set null");
            # Fields: created_at And updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yookassa');
    }
}
