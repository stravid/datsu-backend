<?php

class DatsuThrow extends Eloquent {
  protected $fillable = array('darts', 'is_bust', 'player_id', 'match_id', 'order');
  protected $hidden = array('created_at', 'updated_at');
  protected $table = 'throws';

  public function player()
  {
      return $this->belongsTo('Player');
  }

  public function match()
  {
      return $this->belongsTo('Match');
  }
}
