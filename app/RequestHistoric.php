<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestHistoric extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_id', 'user_id', 'message', 'action', 'action_datetime',
    ];

    /**
     * Get the request that owns request historic.
     */
    public function request()
    {
        return $this->belongsTo('App\Request');
    }

     /**
     * Get the request that owns request user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
