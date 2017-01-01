<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'score';

    protected $fillable = ['user_id', 'raport', 'un', 'un_mtk', 'kejuruan', 'sem1', 'sem2', 'sem3', 'sem4', 'sem5', 'sem6'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
