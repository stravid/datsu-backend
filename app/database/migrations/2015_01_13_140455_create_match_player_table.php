<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchPlayerTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('match_player', function(Blueprint $table)
    {
      $table->integer('match_id')->unsigned()->nullable();
      $table->foreign('match_id')->references('id')->on('matches');
      $table->integer('player_id')->unsigned()->nullable();
      $table->foreign('player_id')->references('id')->on('players');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('match_player');
  }

}
