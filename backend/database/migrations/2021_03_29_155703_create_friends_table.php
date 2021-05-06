<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration
{
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_sender')->unsigned();
            $table->bigInteger('user_receiver')->unsigned();
            $table->enum(
                'status',
                Config::get('enums.FRIEND_STATUS')
            )->default(Config::get('enums.FRIEND_STATUS.PENDING'));
            $table->timestamps();
            $table->foreign('user_sender')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_receiver')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('friends');
    }
}
