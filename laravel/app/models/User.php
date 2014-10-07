<?php

use Illuminate\Support\Facades\Crypt;

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

	/**
	 * Creates a new user if not already in DB
	 *
	 * @param array $params
	 * @return User
	 * @throws Exception
	 */
	public static function make(array $params)
	{
		if (User::where('username', $params['username'])->count())
		{
			throw new Exception('User already exists');
		}

		$user = new User;

		$user->username = $params['username'];
		$user->password = Crypt::encrypt($params['password']);
		$user->pin = self::generatePin();

		if ( ! $user->save())
		{
			throw new Exception('Save failed');
		}

		return $user;
	}

	/**
	 * Generates a random 4 digit pin number
	 *
	 * @return string
	 */
	protected static function generatePin()
	{
		$pool = '0123456789';
		return substr(str_shuffle(str_repeat($pool, 5)), 0, 4);
	}

	/**
	 * Find a user by their pin number
	 *
	 * @param string $pin
	 * @return User|bool
	 */
	public static function findByPin($pin)
	{
		$user = User::where('pin', $pin)->get();

		if (count($user) <= 0)
		{
			return false;
		}

		return $user->first();
	}


	/**
	 * ***NOT SECURE*** but unfortunately necessary for Snapchat login
	 * @return mixed
	 */
	public function getDecryptedPasswordAttribute()
	{
		return Crypt::decrypt($this->password);
	}

}
