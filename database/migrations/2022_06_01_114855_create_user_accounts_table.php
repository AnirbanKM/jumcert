<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->id();

            $table->string('user_id');
            $table->string('resp_id');
            $table->string('resp_object');
            $table->string('bank_account_id');
            $table->string('bank_account_object');
            $table->string('account_holder_name');
            $table->string('account_holder_type');
            $table->string('account_type');
            $table->string('bank_name');
            $table->string('country');
            $table->string('currency');
            $table->string('fingerprint');
            $table->string('last4');
            $table->string('routing_number');
            $table->string('status');
            $table->string('client_ip');
            $table->string('created');
            $table->string('livemode');
            $table->string('type');
            $table->string('used');
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
        Schema::dropIfExists('user_accounts');
    }
}
