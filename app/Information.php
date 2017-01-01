<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
  protected $table = 'information';

  protected $fillable = [
  'industry_id', 'user_id', 'title', 'definition', 'deadline', 'requirement', 'other', 'img', 'hidden', 'read'
  ];

  public function user()
  {
    return $this->belongsTo('App\User')->select(array('id', 'username', 'name'));
  }

  public function industry()
  {
    return $this->belongsTo('App\Industry');
  }

  public function position()
  {
    return $this->hasMany('App\Position');
  }

  public function applicant()
  {
    return $this->belongsToMany('App\User', 'applicant_user', 'information_id', 'user_id')
                ->select(array('users.id', 'name', 'email', 'phone'))
                ->withPivot('status')
                ->withTimestamps();
  }
}