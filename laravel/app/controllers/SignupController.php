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

		try {
			$user = User::make([
				'username' => Input::get('username'),
				'password' => Input::get('password'),
			]);
		}
		catch (Exception $e) {
			return Redirect::back();
		}

		return View::make('signup.success', compact('user'));
	}

}
