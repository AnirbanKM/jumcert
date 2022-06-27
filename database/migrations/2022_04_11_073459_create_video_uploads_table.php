<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_uploads', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150)->nullable();
            $table->integer('category_id');
            $table->string('subcategory')->nullable();
            $table->text('desc', 1000)->nullable();
            $table->double('price', 12, 2)->default(0)->nullable();
            $table->integer('user_id');
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
            $table->enum('video_type', ['Public', 'Private'])->default('Public');
            $table->string('videoname');
            $table->string('thumbnail');
            $table->string('video_id');
            $table->string('playlist_id');
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
        Schema::dropIfExists('video_uploads');
    }
}
