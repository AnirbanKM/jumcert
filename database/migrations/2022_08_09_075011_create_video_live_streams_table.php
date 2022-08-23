<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoLiveStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_live_streams', function (Blueprint $table) {
            $table->id();
            $table->string('creater_id');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('roomName');
            $table->text('roomUrl');
            $table->text('meetingId');
            $table->text('hostRoomUrl');
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
        Schema::dropIfExists('video_live_streams');
    }
}
