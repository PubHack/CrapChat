<?php

use CrapChat\NotifyPusher;
use Illuminate\Database\Eloquent\Model;

class SentCrap extends Model {

    protected $table = 'sent_craps';

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        SentCrap::created(function($model) {
            App::make(NotifyPusher::class)->ofNewCrap([
            	'key' => $model->key,
            	'from' => $model->from,
            	'to' => $model->to,
            	'date' => $model->created_at->format('jS F, Y'),
        	]);
        });
    }

} 