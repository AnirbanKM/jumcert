<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();

            $table->integer('video_id');
            $table->integer('channel_id');

            $table->integer('owner_id');
            $table->integer('sender_id');
            $table->integer('receiver_id');

            $table->longText('msg');
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive');

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
        Schema::dropIfExists('chats');
    }
}
