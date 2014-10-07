<?php namespace CrapChat;

class NotifyPusher {

    public function ofNewCrap($data)
    {
        // fuck it, hard code the keys, revoke after the hack
        $pusher = new \Pusher('ca9d97aac5dd27d76180', '735c14b7db6ed2229ab8', '92081');
        $pusher->trigger('crap', 'new-crap', $data);
    }

} 