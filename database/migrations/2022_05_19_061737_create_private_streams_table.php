<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivateStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_streams', function (Blueprint $table) {
            $table->id();

            $table->string('stream_id');
            $table->string('stream_token')->nullable();

            $table->string('channel_id');
            $table->string('playlist_id');
            $table->string('buyer_id');

            $table->double('price', 12, 2)->default(0)->nullable();
            $table->string('payment_id');
            $table->string('client_secret');
            $table->string('payment_method');

            $table->enum('status', ['Pending', 'Failed', 'Success'])->default('Pending');
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
        Schema::dropIfExists('private_streams');
    }
}
