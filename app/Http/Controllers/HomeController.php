<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

use App\Http\Requests\UserRequest;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{    
    
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function getIndex()
    {
        $user = Auth::user();

        if($user->is('admin'))
            return redirect('/admin');            

        return redirect('/alumni');        
    }

    public function postRegister(UserRequest $request)
    {        
        $request['password'] = bcrypt($request['password']);

        $request['role_id'] = 2;
        $request['birthday'] = date('Y-m-d', strtotime($request->get('birthday')));
        \App\User::create($request->all());

        return redirect('/');
        // return $request->get('birthday');
    }

    public function getRegister()
    {
        $department = \App\Department::all();

        return view('auth.register', ['departments' => $department]);
    }

    public function getSubdepartment($id, Request $request)
    {        
        $subdepartment = \App\Department::where('id', '=', $id)->get(['subdepartment'])->first();

        return $subdepartment;
    }
}