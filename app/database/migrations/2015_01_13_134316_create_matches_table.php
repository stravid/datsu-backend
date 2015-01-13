<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('matches', function(Blueprint $table)
    {
      $table->increments('id');
      $table->timestamps();
      $table->text('throws');
      $table->text('turn_order');
      $table->integer('winner_id')->unsigned()->nullable();
      $table->foreign('winner_id')->references('id')->on('players');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('matches');
  }

}
