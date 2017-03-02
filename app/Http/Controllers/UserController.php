<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;
use App\Information;

use App\Http\Traits\UserTrait;

use Jenssegers\Date\Date;

class UserController extends Controller
{
    use UserTrait;

    protected $requests;

    public function __construct(Request $request)
    {
        $this->requests = $request;
    }

    public function getProfil()
    {
        $user = \Auth::user();
        
        $education = $user->education()->get();

        $job = $user->job()->get();

        $departments = \App\Department::all();

        $score = $user->score()->first();

        return view('user.edit', [
            'user' => $user,
            'educations' => $education,
            'jobs' => $job,
            'departments' => $departments,
            'score' => $score,
            'url' => $this->requests->path(),
        ]);
    }

    public function putProfil(Request $request)
    {           
        $this->validate($request, [
            'image' => 'image|max:1024',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'graduation' => 'required',
            'birthday' => 'required|date',
            'sex' => 'required',
            'address' => 'required',
            'height' => 'numeric',
            'weight' => 'numeric'
        ]); 

        $this->updateProfil($request);

        return redirect()->back();
    }    

    public function getIndex()
    {
        return $this->getInformasi();
        // return $this->RekomendasiInformasi();
    }

    public function getInformasi($id = null)
    {        
        $recommend = $this->RekomendasiInformasi();

        if($id != null)
        {
            $info = Information::findOrFail($id);

            $read = $info->read;

            $info->update([
                'read' => $read + 1
            ]);

            $industry = Information::find($id)->industry()->first();            

            $view = 'information.user.detail';            
        }else{
            $info = Information::where('hidden', 0)
                ->latest('created_at')                
                ->paginate(15);
            $view = 'information.user.index';
            $industry = null;
        }        
        
        return view($view, [
            'informations' => $info,
            'recommends' => $recommend,
            $industry == null? :'industry' => $industry,
            'url' => $this->requests->path(),
            'id' => $id
        ]);         
    }

    public function getDownloadPdf($id = null)
    {      
        $informasi = Information::find($id);

        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadView('information.pdf', [
            'information' => $informasi
            ]);

        return $pdf->download($informasi->title.'.pdf');        
        // return view('information.pdf', ['information' => $informasi]);
    }

    public function RekomendasiInformasi()
    {
        $sex = Auth::user()->sex;

        $height = Auth::user()->height;

        $weight = Auth::user()->weight;

        $birthday = Auth::user()->birthday;

        $age = \Carbon\Carbon::createFromFormat('Y-m-d', $birthday)->age;
        
        $position = \App\Position::query();        

        $delimiters = [",", " "];

        /* lokasi peminatan siswa */
        $user_location = Auth::user()->location;        

        $ready = str_replace($delimiters, $delimiters[0], $user_location);
        
        $locations = explode($delimiters[0], $ready);


        /* keahlian pengguna */
        $user_skill = Auth::user()->skill;

        $ready = str_replace($delimiters, $delimiters[0], $user_skill);
        
        $skills = explode($delimiters[0], $ready);

        $position->join('information', 'position.information_id', '=', 'information.id');                

        $position->where('min_age', '<=', $age)
                    ->where('max_age', '>=', $age)
                    ->where('sex','LIKE', '%'.$sex.'%')
                    ->where('position.height', '<=', $height)
                    ->where('position.weight', '>=', $weight)
                    ->where('information.deadline', '>=', date('Y-m-d'))
                    ->where('hidden', 0)
                    ->where(function ($query) use ($locations) {
                        foreach ($locations as $location) {
                            if($location !=null) $query->orWhere('location', 'LIKE', '%'.$location.'%');                        
                        }
                        return $query;
                    })->where(function ($query) use ($skills){
                        foreach ($skills as $skill) {
                            if($skill !=null) $query->where('skill', 'LIKE', '%'.$skill.'%');
                        }
                        return $query;
                    });

        return $position->groupBy('position.information_id')
                    ->take(5)                    
                    ->get();
    }

    public function putPasswordReset(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);        
        
        $old_password = Auth::user()->password;

        if(\Hash::check($request->get('old_password'), $old_password))
        {            
            Auth::user()->update([
                'password' => bcrypt($request->get('password'))
            ]);

            session()->flash('msgInfo', 'Password telah diganti');

        }else{
            session()->flash('msgError', 'Password lama salah');
        }

        return redirect()->back();
    }

    public function postLamar($id)
    {        
        $information = Information::find($id);
     
        $user = Auth::user();

        $information->applicant()->attach([$user->id => ['status' => 'Menunggu']]);

        return redirect()->back();
    }

    public function getLamar()
    {
        $recommend = $this->RekomendasiInformasi();

        $user = Auth::user();

        return view('information.user.proposal', [
            'proposals' => $user->applicant,
            'recommends' => $recommend,
            'url' => 'Alumni/Lamar'
        ]);        
    }

    public function getDownloadCv()
    {
        $user = \Auth::user();
        
        return $this->usercv($user);
    } 

    public function usercv($user)
    {
        $education = $user->education()->get();
        $job = $user->job()->get();
        $score = $user->score()->first();

        $pdf = \App::make('dompdf.wrapper');
        

        $pdf->loadView('user.cv', [
            'user' => $user,
            'educations' => $education,
            'jobs' => $job,
            'scores' => $score
        ]);

        return $pdf->download($user->name.'.pdf');
        /*return view('user.cv', [
            'user' => $user,
            'educations' => $education,
            'jobs' => $job,
            'scores' => $score
        ]);*/
    }

    public function putUpdatescore(Request $request)
    {
        $this->validate($request, [
            'raport' => 'numeric',
            'un' => 'numeric',
            'un_mtk' => 'numeric',
            'kejuruan' => 'numeric',
            'sem1' => 'numeric',
            'sem2' => 'numeric',
            'sem3' => 'numeric',
            'sem4' => 'numeric',
            'sem5' => 'numeric',
            'sem6' => 'numeric'
        ]);

        $user_score = Auth::user()->score()->get();

        if($user_score->isEmpty())
            Auth::user()->score()->create($request->all());
        else
            Auth::user()->score()->update($request->except(['_method','_token']));

        return redirect()->back();
    }

    public function postUpdatesekolah(Request $request)
    {
        $this->validate($request,[
            'level' => 'required',
            'institute' => 'required',
            'entrance' => 'required|numeric',
            'graduate' => 'required|numeric'
        ]);

        $sekolah = Auth::user()->education()->create($request->all());

        return $sekolah->id;
    }

    public function postHapussekolah(Request $request)
    {
        Auth::user()->education()->findOrFail($request->id)->delete();

        return;
    }

    public function postTambahkerja(Request $request)
    {
        $this->validate($request,[        
            'institute' => 'required',
            'entrance' => 'required|numeric',
            'out' => 'required|numeric'
        ]);

        $job = Auth::user()->job()->create($request->all());

        return $job->id;
    }

    public function postHapuskerja(Request $request)
    {
        Auth::user()->job()->findOrFail($request->id)->delete();

        return;
    }

    public function postUbahsekolah(Request $request)
    {
        Auth::user()->education()->findOrFail($request->id)->update($request->all());

        return;
    }

    public function postUbahkerja(Request $request)
    {
        Auth::user()->job()->findOrFail($request->id)->update($request->all());

        return;
    }

    public function getPemberitahuan($param = null)
    {        
        if($param == 'semua'){
            $notif = Auth::user()->applicant()
                            ->where('status', '!=', 'Menunggu')
                            ->with(['industry'=>function($query){
                                $query->select('id','name');
                            }])->get();
        }else{
            $notif = Auth::user()->applicant()
                            ->where('status', '!=', 'Menunggu')
                            ->wherePivot('read', 0)
                            ->with(['industry'=>function($query){
                                $query->select('id','name');
                            }])->get();
        }

        $applicants = Auth::user()->applicant()->wherePivot('read', 0)->get();

        foreach ($applicants as $applicant) {
            $applicant->pivot->timestamps = false;
            $applicant->pivot->update(['read' => 1]);
        }

        return view('user.notification', ['notifs'=>$notif,'param'=>$param,'url' => $this->requests->path()]);
    }

    public static function notifCount()
    {
        $notif = Auth::user()->applicant()
                            ->where('status', '!=', 'Menunggu')
                            ->wherePivot('read', 0)
                            ->get(['id']);

        return count($notif);
    }

    public function getKonfirmasi($id)
    {
        $information = Information::findOrFail($id);
        Auth::user()->applicant()->updateExistingPivot($information->id, ['confirm' => 1]);

        return redirect()->back();
    }

    public function getTolak($id)
    {
        $information = Information::findOrFail($id);
        Auth::user()->applicant()->updateExistingPivot($information->id, ['confirm' => 2]);   
        return redirect()->back();
    }
}