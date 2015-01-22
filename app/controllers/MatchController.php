<?php

class MatchController extends \BaseController {

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $match = Match::find($id);
    $players = $match->players()->get();
    $throws = $match->throws()->get();

    return Response::json(array('match' => $match, 'players' => $players, 'throws' => $throws));
  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $match = Match::create(Input::get('match'));
    $match->players()->attach(Input::get('match.player_ids'));

    return Response::json(array('match' => $match));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $match = Match::find($id);
    $match->update(Input::get('match'));

    return Response::json(array('match' => $match));
  }


}
