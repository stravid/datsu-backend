<?php

class ThrowController extends \BaseController {

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $throw = DatsuThrow::create(Input::get('throw'));

    return Response::json(array('throw' => $throw));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $throw = DatsuThrow::find($id);
    $throw->update(Input::get('throw'));

    return Response::json(array('throw' => $throw));
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $throw = DatsuThrow::find($id);
    $throw->delete();

    return Response::json(new stdClass);
  }


}
