<?php
namespace App\Http\Traits;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Information;
use App\Department;
use App\Industry;

trait UserTrait {    

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function updateProfil(Request $request)
    {
        $user = \Auth::user();

        if($request->file('image') != null)
        {
            \File::delete($user->img);

            $request['img'] = $this->updatePhoto($request);            
        }
        $request['birthday'] = date('Y-m-d', strtotime($request->get('birthday')));
        $user->update($request->all());                

        // return $request->file('image');
        return redirect()->back();
    }

    public function updatePhoto(Request $request)
    {
        // $destinationPath = storage_path().'/image';

        $destinationPath = 'image';

        $extension = $request->file('image')->getClientOriginalExtension();

        $fileName = rand(11111,99999).'.'.$extension;        

        $request['image']->move($destinationPath, $fileName);

        $full_url = $destinationPath.'/'.$fileName;

        if($extension == 'jpg' || $extension == 'jpeg')
            $im = imagecreatefromjpeg($full_url);
        else
            $im = imagecreatefrompng($full_url);

        $int_x_size = getimagesize($full_url)[0];

        $int_y_size = getimagesize($full_url)[1];

        $crop_measure = min($int_x_size, $int_y_size);

        $x = $request['offsetX'] * $crop_measure / 200 * -1;

        $y = $request['offsetY'] * $crop_measure / 200 * -1;

        $to_crop_array = [
            'x' => $x,
            'y' => $y,
            'width' => $crop_measure,
            'height' => $crop_measure
        ];
 
        $thumb = imagecrop($im, $to_crop_array);

        imagejpeg($thumb, $full_url, 90);

        return $full_url;
    }

    public function informationCheck(Request $request)
    {
        $this->validate($request, [
                'title' => 'required',
                'industry_id' => 'required',
                'study_id' => 'required',
                'min_age' => 'numeric',
                'max_age' => 'numeric',
                'sex' => 'required',
                'total' => 'numeric',
                'hidden' => 'required'
            ]);

        if(isset($request['min_age']) || isset($request['max_age'])){

            if($request['min_age'] > $request['max_age']){

                session()->flash('msgError', 'Umur minimal harus lebih kecil dari umur maksimal.');

                return redirect()->back();
            }
        }
            
       $request['user_id'] = \Auth::user()->id;
    }

    public function industryCheck($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'unique:industry,email,'.$id.'|email',
            'phone' => 'unique:industry,phone,'.$id.'|numeric',
            'address' => 'required'            
        ]);
    }
}