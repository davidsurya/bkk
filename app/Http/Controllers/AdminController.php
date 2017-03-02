<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests;

use App\Department;
use App\User;
use App\Information;
use App\Industry;
use App\Role;

use App\Http\Traits\UserTrait;
use App\Http\Requests\InformationRequest;
use App\Http\Requests\PositionRequest;
use App\Http\Requests\IndustryRequest;

use App\Http\Controllers\UserController;

class AdminController extends Controller
{
    use UserTrait;

    protected $requests;    

    public function __construct(Request $request)
    {
        $this->requests = $request;
    }  

    public function getIndex()
    {
        $student = count(User::where('role_id', 2)->get());

        $information = count(Information::all());

        $department = count(Department::all());

        $industry = count(Industry::all());

        return view('admin',[
            'student' => $student,
            'information' => $information,
            'department' => $department,
            'industry' => $industry,
            'url' => $this->requests->path()
        ]);
    }

    /*
     * Awal Manajemen Alumni
     */

    public function getAlumni()
    {
    	$user = User::where('role_id', 2)->get();

        $role = Role::all();

        $study = Department::all();

    	return view('user.index', [
            'users' => $user,
            'roles' => $role,
            'studies' => $study,
            'url' => $this->requests->path(),
        ]);
    }

    public function deleteAlumni($id)
    {
        $user = User::find($id);

        $user->delete();

        session()->flash('msgError', 'Data telah terhapus');

        return redirect()->back();
    }

    public function putAlumniReset($id)
    {
        $user = User::find($id);

        $password = bcrypt($user->username);

        $user->update([
            'password' => $password
        ]);

        session()->flash('msgInfo', 'Password berhasil direset');

        return redirect()->back();
    }

    public function putAlumni($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required'
        ]);
        
        $request['birthday'] = date('Y-m-d', strtotime($request->get('birthday')));
        
        $user = User::find($id);

        $user->update($request->all());

        session()->flash('msgInfo', 'Data alumni telah diperbaharui');

        return redirect()->back();
    }

    /*
     * Awal Manajemen Informasi
     */

    public function getInformasi($id = null)
    {
        if(isset($id)){
            $informasi = Information::find($id);

            return view('information.index',[
                'information' => $informasi,
                'url' => 'Admin/Informasi'
            ]);
        }else{
            $info = Information::paginate(15);

            $prodi = Department::get(['id', 'name']);

            $industry = Industry::get(['id', 'name']);            

            return view('information.new', [
                'infos' => $info,
                'prodis' => $prodi,
                'industries' => $industry,
                'url' => 'Admin/Informasi',
            ]);
        }
    }

    public function getTambahInformasi($id = null)
    {       
        $industries = Industry::all();

        return view('information.create', [
           'industries' => $industries,
           'url' => 'Admin/Tambah Informasi',
        ]);
    }

    public function getTambahPosisi($id = null)
    {
        return view('information.position', [
            'url' => 'Admin/Tambah Posisi',
            'id' => $id
        ]);
    }

    public function postTambahPosisi(PositionRequest $request, $id = null)
    {
        $requirement = implode(',', $request->get('requirement'));

        $request['requirement'] = $requirement;

        Information::find($id)->position()->create($request->all());

        if($request->get('done')){
            return redirect('/admin/informasi');
        }

        return $this->getTambahPosisi($id);        
    }

    public function postTambahInformasi(InformationRequest $request, $id = null)
    {   
        $industry = Industry::select('id')->where('name', $request->get('industry_id'))->first();
        
        if(is_null($industry)){

            session()->flash('msgError', 'Perusahaan belum terdaftar');

            return redirect()->back();
        }

        $request['industry_id'] = $industry->id;
        
        $requirement = implode(',', $request->get('requirement'));

        $request['requirement'] = $requirement;

        $request['deadline'] = date('Y-m-d', strtotime($request->get('deadline')));

        $information = \Auth::user()->information()->create($request->all());

        $id = $information->id;
            
        return $this->getTambahPosisi($id);
    }

    public function getEditInformasi($id, $param='info')
    {
        $informasi = Information::find($id);

        $industri = Industry::all();

        return view('information.editinfo', [
            'information' => $informasi,
            'industries' => $industri,
            'url' => 'Admin/Informasi/Edit',
            'show_view' => $param
        ]);     
    }

    public function deleteInformasi($id)
    {
        Information::find($id)->position()->delete();

        Information::find($id)->delete();

        session()->flash('msgError', 'Informasi telah dihapus.');

        return redirect()->back();
    }

    public function putEditInformasi(InformationRequest $request, $id)
    {
        if($request->get('save')){
        
            $industry = Industry::select('id')->where('name', $request->get('industry_id'))->first();
        
            if(is_null($industry)){

                session()->flash('msgError', 'Perusahaan belum terdaftar');

                return redirect()->back();
            }

            $request['industry_id'] = $industry->id;
        
            $requirement = implode(',', $request->get('requirement'));

            $request['requirement'] = $requirement;

            $request['deadline'] = date('Y-m-d', strtotime($request->get('deadline')));

            Information::find($id)->update($request->all());
            
        }

        return $this->getEditInformasi($id,'box-information');
    }

    public function getInformasiSembunyi($id)
    {
        $info = Information::find($id);

        $info->update([
            'hidden' => 1
        ]);

        if($info->save())
            session()->flash('msgInfo', 'Berita telah disembunyikan');

        return redirect()->back();
    }

    public function getInformasiTampil($id)
    {
        $info = Information::find($id);

        $info->update([
            'hidden' => 0
        ]);

        if($info->save())
            session()->flash('msgInfo', 'Berita telah ditampilkan');

        return redirect()->back();
    }    

    public function getEditPosisi($id)
    {
        $posisi = \App\Position::find($id);

        return view('information.position',[
            'status' => 'edit',
            'url' => 'Admin/Edit Informasi',
            'position' => $posisi
        ]);
    }

    public function putEditPosisi(Request $request, $id)
    {
        $information_id = \App\Position::find($id)->information->id;        

        $requirement = implode(',', $request->get('requirement'));

        $request['requirement'] = $requirement;

        \App\Position::find($id)->update($request->all());

        if($request->get('save')){
            return $this->getTambahInformasi('step-2', $information_id);
        }else{
            return redirect('/admin/informasi');
        }            
    }

    public function deleteHapusPosisi($id)
    {        
        $information_id = \App\Position::find($id)->information()->first()->id;

        \App\Position::find($id)->delete();        

        return $this->getEditInformasi($information_id, 'box-information');
        
    }

    /*
     * Awal Manajemen Prodi
     */

    public function getProdi()
    {        
        $prodi = Department::all();

        return view('program.index', [
            'prodis' => $prodi,
            'url' => $this->requests->path(),
        ]);
    }

    public function postProdi(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',            
        ]);

        $prodi = Department::create($request->all());

        if($prodi->save())
            session()->flash('msgInfo', 'Data jurusan telah ditambahkan.');

        return redirect()->back();
    }

    public function deleteProdi($id)
    {
        $prodi = Department::find($id);        

        $prodi->delete();

        session()->flash('msgError', 'Data jurusan telah dihapus.');

        return redirect()->back();
    }

    public function putProdi($id, Request $request)
    {
        $prodi = Department::find($id);

        $prodi->update($request->all());

        if($prodi->save())
            session()->flash('msgInfo', 'Data jurusan telah diubah.');

        return redirect()->back();
    }

    /*
     * Pengaturan Sistem
     */

    public function getPengaturan()
    {
        $maintenance = false;

        if(file_exists(storage_path().'/framework/down'))
        {
            $maintenance = true;
        }
        
        return view('setting.maintenance', [
            'maintenance' => $maintenance,
            'url' => $this->requests->path(),
        ]);
    }

    /*
     * Awal Manajemen Industri
     */

    public function getIndustri()
    {
        $industries = Industry::all();

        return view('industry.index', [
            'industries' => $industries,
            'no' => 1,
            'url' => $this->requests->path(),
        ]);
    }

    public function postIndustri(IndustryRequest $request, $id = null)
    {
        Industry::create($request->all());

        session()->flash('msgInfo', 'Data industri telah ditambahkan');

        return redirect()->back();        
    }

    public function putIndustri($id, Request $request)
    {
        $this->industryCheck($id, $request);

        Industry::find($id)->update($request->all());        

        session()->flash('msgInfo', 'Data industri telah diupdate');

        return redirect()->back();
    }

    public function deleteIndustri($id)
    {
        Industry::find($id)->delete();

        session()->flash('msgError', 'Data industri telah dihapus');

        return redirect()->back();
    }

   /*
    * Awal Pengaturan Profil
    */

    public function getProfil()
    {
        $user = \Auth::user();

        return view('user.edit', [
            'user' => $user,
            'url' => $this->requests->path()
        ]);
    }

    public function putProfil(Request $request)
    {
        $this->validate($request, [
            'image' => 'image|max:1024',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'birthday' => 'required|date',
            'sex' => 'required',
            'address' => 'required'
        ]); 

        $this->updateProfil($request);

        return redirect()->back();
    }        
 
    /* Melihat peta */
    public function getPeta()
    {
        return view('map.index');
    }

    /* Download Informasi dalam PDF*/
    public function getDownloadPdf($id)
    {
        $user = new UserController($this->requests);

        return $user->getDownloadPdf($id);
    }

    /* Password Reset */
    public function putPasswordReset(Request $request)
    {
        $user = new UserController($this->requests);

        return $user->putPasswordReset($request);
    }

    public function getPelamar($id)
    {
        $information = Information::find($id);

        return view('information.applicant', [
            'information' => $information,
            'url' => 'Admin/Pelamar'
        ]);
    }

    public function deletePelamar($info_id, $user_id)
    {
        $information = Information::find($info_id);

        $user = User::find($user_id);

        $information->applicant()->detach($user);

        return redirect()->back();  
    }

    public function getTenagaKerja(Request $request)
    {
        
        $month = $request->get('month');
        
        $year = $request->get('year');

        $date_start_str = $year.'-'.$month.'-01';

        $date_start = date('Y-m-d', strtotime($date_start_str));

        $date_end_str = $year.'-'.$month.'-31';

        $date_end = date('Y-m-d', strtotime($date_end_str));

        if($month != null && $year != null){
            $user = User::join('applicant_user', 'users.id', '=', 'applicant_user.user_id')
                    ->whereBetween('applicant_user.updated_at', [$date_start, $date_end])
                    ->where('applicant_user.status', 'Diterima')
                    ->get(['users.id','users.name', 'users.email', 'users.phone', 'applicant_user.status', 'applicant_user.updated_at as accepted']);
        }else{
            $user = User::join('applicant_user', 'users.id', '=', 'applicant_user.user_id')                    
                    ->where('applicant_user.status', 'Diterima')
                    ->get(['users.id','users.name', 'users.email', 'users.phone', 'applicant_user.status', 'applicant_user.updated_at as accepted']);
        }

        return view('employer.index',[
            'users' => $user,
            'url' => 'Admin/Tenaga Kerja'
        ]);
    }

    public function postUbahstatus(Request $request, $id)
    {
        $user = User::find($request->get('pk'));        

        $status = $request->get('value');

        $user->applicant()->updateExistingPivot($id, ['status' => $status,'read' => 0]);

        return redirect()->back();        
    }

    public function getSendMail()
    {
        $user_to = User::where('role_id', 2)->get();

        foreach ($user_to as $user) {
            Mail::send('emails.mail', ['user' => $user], function ($message) use ($user){ 
        
                $message->to($user->email, $user->name);
                
                $message->subject('Peringatan update profil');        
            });
        }        

        return redirect()->back();
    }

    public function getCv($id)
    {
        $user = User::findOrFail($id);

        $usercontroller = new UserController($this->requests);

        return $usercontroller->usercv($user);
    }

    public function getTambahalumni()
    {
        $department = \App\Department::all();        

        return view('user.tambah', [
            'departments' => $department,
            'url' => 'Admin/Tambah alumni'
        ]);
    }
}