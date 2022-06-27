<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_streams', function (Blueprint $table) {
            $table->id();
            $table->dateTime('streamDateTime');
            $table->string('topic', 100);
            $table->string('role', 100);
            $table->integer('channel_id');
            $table->integer('playlist_id');
            $table->integer('stream_token')->nullable();
            $table->integer('user_id');
            $table->text('description');
            $table->enum('stream_type', ['Public', 'Private'])->default('Public');
            $table->double('price', 12, 2)->default(0)->nullable();
            $table->enum('status', ['Completed', 'Pending', 'Streaming', 'Cancelled'])->default('Pending');
            $table->integer('total_views')->default(0);
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
        Schema::dropIfExists('live_streams');
    }
}
