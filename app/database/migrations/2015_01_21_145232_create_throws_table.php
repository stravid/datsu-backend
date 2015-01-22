<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThrowsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('throws', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('match_id')->unsigned();
      $table->foreign('match_id')->references('id')->on('matches');
      $table->integer('player_id')->unsigned();
      $table->foreign('player_id')->references('id')->on('players');
      $table->boolean('is_bust');
      $table->text('darts');
      $table->integer('order');
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
    Schema::drop('throws');
  }

}
