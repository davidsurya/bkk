<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'education';

    protected $fillable = [
    	'level', 'institute', 'entrance', 'graduate'
    ];

    public function user()
    {
    	return $this->hasMany('App\User');
    }
}
