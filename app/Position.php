<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'position';

    protected $fillable = [
    	'information_id', 'department_id', 'name', 'definition', 'skill', 'total', 'min_age', 'max_age', 'sex', 'requirement', 'location', 'height', 'weight', 'score'
    ];

    public function information()
    {
    	return $this->belongsTo('App\Information');
    }
}