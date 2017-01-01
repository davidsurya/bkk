<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job';

    protected $fillable = [
    	'institute', 'entrance', 'out'
    ];

    public function user()
    {
    	return $this->hasMany('App\User');
    }
}
