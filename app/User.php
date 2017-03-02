<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'department_id', 'username', 'name', 'email', 'phone', 'password',
        'birthday', 'sex', 'graduation', 'address', 'img', 'skill', 'location', 'height', 'weight'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function is($role)
    {
        $role = $this->role()
                ->where('role', $role)
                ->first();

        return $role == null? false : true;
    }

    public function information()
    {
        return $this->hasMany('App\Information');
    }

    public function applicant()
    {
        return $this->belongsToMany('App\Information', 'applicant_user', 'user_id', 'information_id')
                    ->select(array('industry_id','title'))
                    ->withPivot('status','confirm')                    
                    ->withTimestamps();                    
    }

    public function education()
    {
        return $this->hasMany('App\Education');
    }

    public function job()
    {
        return $this->hasMany('App\Job');
    }

    public function score()
    {
        return $this->hasMany('App\Score');
    }
}
