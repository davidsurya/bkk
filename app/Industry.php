<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
	protected $table = 'industry';

    protected $fillable = [
        'id', 'name', 'email', 'address', 'phone', 'website', 'email_published', 'phone_published'
    ];
    
    public function information()
    {
    	return $this->hasMany('App\Information');
    }
}
