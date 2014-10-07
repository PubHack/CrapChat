<?php

class SignupController extends BaseController {

	public function index()
	{
		return View::make('signup.index');
	}

	public function store()
	{
		$snapchat = new Snapchat(Input::get('username'), Input::get('password'));

		if ( ! $snapchat->auth_token)
		{
			return Redirect::back();
		}

		$user = User::make([
			'username' => Input::get('username'),
			'password' => Input::get('password'),
		]);

		return View::make('signup.success', compact('user'));
	}

}
