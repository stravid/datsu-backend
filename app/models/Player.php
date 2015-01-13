<?php

class Player extends Eloquent {
  protected $fillable = array('name');
  protected $hidden = array('created_at', 'updated_at', 'pivot');
}
