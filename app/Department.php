<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';

    protected $fillable = [
    	'name'
    ];

    public function user()
    {
    	return $this->hasMany('App\User');
    }
}
