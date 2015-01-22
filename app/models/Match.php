<?php

class Match extends Eloquent {
  protected $fillable = array('throws', 'winner_id', 'turn_order');
  protected $hidden = array('created_at', 'updated_at');
  protected $appends = array('player_ids', 'throw_ids');

  public function players()
  {
      return $this->belongsToMany('Player');
  }

  public function throws()
  {
      return $this->hasMany('DatsuThrow');
  }

  public function getPlayerIdsAttribute()
  {
    return $this->players()->get()->map(function($player) {
      return $player->id;
    });
  }

  public function getThrowIdsAttribute()
  {
    return $this->throws()->get()->map(function($throw) {
      return $throw->id;
    });
  }

  public function getThrowsAttribute()
  {
    $throws = json_decode($this->attributes['throws'], true);
    $enhanced_throws = array();

    foreach ($throws as $throw) {
      $throw['playerName'] = Player::find($throw['playerId'])->name;

      $enhanced_throws[] = $throw;
    }

    return json_encode($enhanced_throws);
  }
}
