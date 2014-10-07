<?php

class CallController extends BaseController {

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
		$pin_number = Input::get('numDigits');
		// if ( ! $user = User::findByPin($pin_number))
		// {
		// 	$response = new Services_Twilio_Twiml();
		// 	$response->say('Sorry user not found, please try again')
		// 	->redirect('call');
		// 	print $response;
		// }

		// $friends = $user->getFriends();
		// $friends->toArray();

		// $friendList = '';

		// foreach ($friends as $key => friend) {
		// 	$friendList = $friendList . ' press ' . $key . ' for ' + $friend->name + ' ';
		// }
		
		$friendList = 'Press 1 for Ali. Press 2 for Robb. Press 3 for Dan.';

		$response = new Services_Twilio_Twiml();
		$gather = $response->gather(['numDigits' => 1, 'action' => '/call/test', 'method' => 'POST']);
		$gather->say($friendList);
		print $response;
	}

	public function test()
	{
		$number = Input::get('numDigits');

		$response = new Services_Twilio_Twiml();
		$response->say('Well done, you entered the number ' . $number);
		print $response;
	}

}
