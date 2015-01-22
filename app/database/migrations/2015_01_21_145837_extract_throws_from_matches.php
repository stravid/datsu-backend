<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtractMigrationThrow extends Eloquent {
  protected $fillable = array('player_id', 'match_id', 'is_bust', 'darts', 'order');
  protected $table = 'throws';
}

class ExtractMigrationMatch extends Eloquent {
  protected $fillable = array('throws', 'winner_id', 'turn_order');
  protected $table = 'matches';

  public function throws()
  {
      return $this->hasMany('ExtractMigrationThrow', 'match_id');
  }
}

class ExtractThrowsFromMatches extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    $matches = ExtractMigrationMatch::all();

    foreach ($matches as $match)
    {
      $throws = json_decode($match->throws, true);

      foreach ($throws as $index => $throw)
      {
        ExtractMigrationThrow::create(array(
          'match_id' => $match->id,
          'player_id' => $throw['playerId'],
          'is_bust' => $throw['isBust'],
          'darts' => json_encode($throw['darts']),
          'order' => $index
        ));
      }
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    $matches = ExtractMigrationMatch::all();

    foreach ($matches as $match)
    {
      $throws = $match->throws()->orderBy('order', 'asc')->get();

      $serialized_throws = json_encode($throws->map(function($throw) {
        return array(
          'isBust' => $throw->is_bust,
          'darts' => $throw->darts,
          'playerId' => $throw->player_id
        );
      }));

      $match->update(array('throws' => $serialized_throws));
    }
  }

}
