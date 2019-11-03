<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'description', 'request_file', 'response_file', 
        'type', 'priority', 'technician_id', 'deadline', 'function_points','status'
    ];

    /**
     * Get the user that owns request.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Get the project user that owns request.
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    /**
     * Get the technician user that owns request.
     */
    public function technician()
    {
        return $this->belongsTo('App\User', 'technician_id', 'id');
    }

    
}
