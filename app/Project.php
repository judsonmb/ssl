<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'institution_id', 
    ];
    
    /**
     * Get the institution that owns project.
     */
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
}
