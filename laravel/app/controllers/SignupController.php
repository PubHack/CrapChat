<?php

use CrapChat\SnapchatService;

class SignupController extends BaseController {

	public function __construct(SnapchatService $service)
	{
		$this->snapchatService = $service;
	}

	public function index()
	{
		return View::make('home');
	}

	public function store()
	{
		if ( ! $this->snapchatService->login(Input::get('username'), Input::get('password')))
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
