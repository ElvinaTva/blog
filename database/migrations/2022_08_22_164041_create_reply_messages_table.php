<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplyMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reply_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('replied_id');
            $table->foreign('replied_id')->on('users')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('message_id');
            $table->foreign('message_id')->on('messages')->references('id')->onDelete('cascade');

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
        Schema::dropIfExists('reply_messages');
    }
}
