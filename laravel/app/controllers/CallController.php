<?php

use CrapChat\SnapchatService;
use CrapChat\ClassyCraps;

class CallController extends BaseController {

	public function __construct(SnapchatService $snapchat, ClassyCraps $craps)
	{
		$this->snapchat = $snapchat;
		$this->craps = $craps;
	}

	public function index()
	{
		$response = new Services_Twilio_Twiml();
		$gather = $response->gather(['numDigits' => 4, 'action' => 'call/users', 'method' => 'POST']);
		$gather->say("Please enter your pin number");
		print $response;
	}

	public function listUsers()
	{
		Log::debug(print_r(Input::all(), true));
		$pin_number = Input::get('Digits');
		if ( ! $user = User::findByPin($pin_number))
		{
			$response = new Services_Twilio_Twiml();
			$response->say('Sorry user not found, please try again')
			->redirect('call');
			print $response;
		}

		$loggedIn = $this->snapchat->loginWithUser($user);

		$friends = $loggedIn->getFriends();

		$friends = $friends->toArray();

		$friendList = '';

		foreach ($friends as $key => $friend) {
			$select = $key + 1;
			$friendList .= 'press ' . $select . ' for ' . $friend->name . '. ';
		}
		
		// $friendList = 'Press 1 for Ali. Press 2 for Robb. Press 3 for Dan.';

		$response = new Services_Twilio_Twiml();
		$gather = $response->gather(['numDigits' => 1, 'action' => '/call/code/'.$pin_number, 'method' => 'POST']);
		$gather->say($friendList);
		print $response;
	}

	public function shortCode($pin)
	{
		$friendId = Input::get('Digits');

		$response = new Services_Twilio_Twiml();
		$gather = $response->gather(['numDigits' => 8, 'action' => '/call/code/'.$pin.'/'.$friendId, 'method' => 'POST']);
		$gather->say('Draw an image or enter a crap code');
		print $response;
	}

	public function send($pin, $friendId)
	{
		$crapCode = Input::get('Digits');

		$user = User::findByPin($pin);
		$loggedIn = $this->snapchat->loginWithUser($user);
		$friends = $loggedIn->getFriends();
		$friends = $friends->toArray();

		$username = $friends[$friendId-1];

		$image = $this->craps->make($crapCode);

		$this->snapchat->send($image->getImageBlob(), $username->name, 10);

		SentCrap::create([
			'key' => $crapCode,
			'from' => $user->username,
			'to' => $username->name,
		]);

		$response = new Services_Twilio_Twiml();
		$response->say('Thank you, your crapchat has been sent. Goodbye');
		print $response;
	}

}
