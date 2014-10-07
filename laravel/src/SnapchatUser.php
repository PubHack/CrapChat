<?php namespace CrapChat;

use Snapchat;
use User;

class SnapchatUser {

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

} 