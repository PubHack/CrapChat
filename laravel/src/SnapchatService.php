<?php namespace CrapChat;

use Illuminate\Support\Collection;
use Snapchat;
use User;

class SnapchatService {

    public function login($username, $password)
    {
        $this->user = new Snapchat($username, $password);

        if ( ! $this->user->auth_token)
        {
            return false;
        }

        return $this;
    }

    public function loginWithUser(User $user)
    {
        return $this->login($user->username, $user->decryptedPassword);
    }

    public function getFriends()
    {
        return new Collection(array_slice($this->user->getFriends(), 0, 5));
    }

} 