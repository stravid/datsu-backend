<?php

class PlayerController extends \BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return Response::json(array('players' => Player::all()));
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function store()
  {
    $player = Player::create(Input::get('player'));

    return Response::json(array('player' => $player));
  }


}
