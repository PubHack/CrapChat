<?php

use CrapChat\SnapchatUser;

class SignupController extends BaseController {

	public function __construct(SnapchatUser $snapchat)
	{
		$this->snapchat = $snapchat;
	}

	public function index()
	{
		return View::make('signup.index');
	}

	public function store()
	{
		if ( ! $this->snapchat->login(Input::get('username'), Input::get('password')))
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
