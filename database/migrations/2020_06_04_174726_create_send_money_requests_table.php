<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendMoneyRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_money_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('send_email', 255);
            $table->integer('amount');
            $table->string('purpose', 255)->nullable();
            $table->string('status', 1)->default('0');
            $table->string('transaction_key', 30);
            $table->string('user_id', 10);
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
        Schema::dropIfExists('send_money_requests');
    }
}
