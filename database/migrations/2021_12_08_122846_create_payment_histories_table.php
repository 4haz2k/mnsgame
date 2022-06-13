<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("server_id")->nullable(true)->comment("ID сервера");
            $table->double("balance_change")->comment("Сумма изменения баланса");
            $table->string("type")->comment("Тип услуги");
            $table->timestamp("end_date")->comment("Дата окончания услуги");
            $table->boolean("is_active")->comment("Выполнен ли заказ");
            $table->timestamps();

            $table->foreign("server_id")->references("id")->on("servers")->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_histories');
    }
}
