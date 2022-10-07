<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_name','40')->comment('アーティスト名');
            $table->string('mail','100')->comment('メールアドレス');
            $table->string('tell','16')->comment('連絡先');
            $table->string('password')->comment('パスワード');;
            $table->text('artist_detail')->nullable()->comment('アーティストの詳細');
            $table->binary('artist_image')->comment('アーティスト写真');
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
        Schema::dropIfExists('artists');
    }
}
