<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_videos', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id');
            $table->string('user_id');
            $table->string('video_id');
            $table->double('price', 12, 2)->default(0)->nullable();
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
        Schema::dropIfExists('private_videos');
    }
}
