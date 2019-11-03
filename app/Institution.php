<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'initials', 'name', 
    ];

    /**
     * Get the users for the institution.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Get the projects for the institution.
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }

}
