<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public $timestamps = false;
	
	protected $fillable = [
        'name', 'request_id',
    ];
	
	/**
     * Get the request that owns user.
     */
    public function request()
    {
        return $this->belongsTo('App\Request');
    }
}
