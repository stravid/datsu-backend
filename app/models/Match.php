<?php

class Match extends Eloquent {
  protected $fillable = array('throws', 'winner_id', 'turn_order');
  protected $hidden = array('created_at', 'updated_at');
  protected $appends = array('player_ids');

  public function players()
  {
      return $this->belongsToMany('Player');
  }

  public function getPlayerIdsAttribute()
  {
    return $this->players()->get()->map(function($player) {
      return $player->id;
    });
  }
}
