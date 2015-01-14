<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationPlayer extends Eloquent {
  protected $fillable = array('name');
  protected $table = 'players';
}

class MigrationMatch extends Eloquent {
  protected $fillable = array('throws', 'winner_id', 'turn_order');
  protected $table = 'matches';

  public function players()
  {
      return $this->belongsToMany('MigrationPlayer', 'match_player', 'match_id', 'player_id');
  }
}

class ImportFirebaseData extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    $data = File::get('app/database/datsu-production-export.json');
    $data = json_decode($data, true);
    $players = array();

    // Create players and store database assigned id with legacy id.
    // This legacy id : id map is needed so we can create the correct
    // relationships later.
    foreach ($data['players'] as $id => $player)
    {
      $new_player = MigrationPlayer::create(array('name' => $player['name']));
      $players[$id] = $new_player->id;
    }

    foreach ($data['matches'] as $id => $match)
    {
      if (array_key_exists('winner', $match))
      {
        $winner_id = $players[$match['winner']];
      }
      else
      {
        $winner_id = null;
      }

      // Replace the legacy ids in the turn order with the new ids.
      $turn_order = $match['turnOrder'];
      foreach ($players as $legacy_id => $id)
      {
        $turn_order = str_replace('"' . $legacy_id . '"', '"' . $id . '"', $turn_order);
      }

      // Replace the legacy ids in the throws with the new ids.
      $throws = $match['throws'];
      foreach ($players as $legacy_id => $id)
      {
        $throws = str_replace('"' . $legacy_id . '"', '"' . $id . '"', $throws);
      }

      $new_match = MigrationMatch::create(array('turn_order' => $turn_order, 'winner_id' => $winner_id, 'throws' => $throws));

      // Create relationships between the new match and its players.
      foreach ($match['players'] as $id => $player)
      {
        $new_match->players()->attach($players[$id]);
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
    //
  }

}
