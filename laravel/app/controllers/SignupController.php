<?php

class SignupController extends BaseController {

	public function index()
	{
		return View::make('signup');
	}

	public function store()
	{
		$snapchat = new Snapchat(Input::get('username'), Input::get('password'));

		if ( ! $snapchat->auth_token)
		{
			return Redirect::back();
		}

		User::make([
			'username' => Input::get('username'),
			'password' => Input::get('password'),
		]);
	}

}
