<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	protected $fillable = ['username', 'password'];

	public static function make(array $params)
	{
		$user = new User;

		$user->username = $params['username'];
		$user->password = crypt($params['password']);

		if ( ! $user->save())
		{
			throw new Exception('Save failed');
		}

		return $user;
	}

}
