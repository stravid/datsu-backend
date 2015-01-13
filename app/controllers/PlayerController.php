<?php

class PlayerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(array('players' => array(
			array('id' => 1, 'name' => 'David'),
			array('id' => 2, 'name' => 'Thomas'),
			array('id' => 3, 'name' => 'Hannah'),
			array('id' => 4, 'name' => 'Kleiner Bär')
		)));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


}
