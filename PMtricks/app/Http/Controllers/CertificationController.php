<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;



class CertificationController extends Controller
{
    
    
    public $error_msg = '';
    
    public function generate(Request $req){
        $this->validate($req, [
            'pacakge_id' => 'numeric|required',
            'name'       => 'required'
        ]);
        

        $cert = \App\Certification::where('user_id', Auth::user()->id)->where('package_id', $req->input('pacakge_id'))->get()->first();
        if($cert){
            return $this->sendCertification($cert->id);
        }
        
        if(!$this->secure($req->input('pacakge_id'))){
            return back()->with('error', $this->error_msg);
        }
        
        
        // get image path
        $img_path = 'public/certifications/cert1.jpg';

        // pass it to certification1 function
        $cert_id = $this->certification1($req->input('name'), $req->input('pacakge_id'), $img_path);
        
        return $this->sendCertification($cert_id);
    }


    public function certification1($name, $package_id, $img_path){
        // __DIR__ => /home/pmtricks/PMtricks/app/Http/Controllers
        
        $save_path = 'storage/userCertifications/'; /** save folder */
        $package = \App\Packages::find($package_id);
        
        
        if(!Storage::exists($img_path)){
            return 'Certification file not exist !';
        }
        
        $c_num = $this->generate_5digit();
        while(\App\Certification::where('c_num', $c_num)->get()->first()){
            $c_num = $this->generate_5digit();
        }
        
        $time = \Carbon\Carbon::now()->format('jS F Y');
        
        $img_file = Storage::get($img_path);
        $img = Image::make($img_file);
        
        /** Add User Name */
        $img->text($name, 430,340, function($font) {
            // local $font->file('E:\xampp\htdocs\PM-trick\public\fonts\o.ttf');
            $font->file('/home/pmtricks/public_html/fonts/o.ttf');    
            $font->size(30);
            $font->align('left');
            $font->color('#333');
        });
        
        /** Add Certification Number */
        $img->text($c_num, 270,635, function($font) {
            // local $font->file('E:\xampp\htdocs\PM-trick\public\fonts\o.ttf');
            $font->file('/home/pmtricks/public_html/fonts/o.ttf');    
            $font->size(30);
            $font->align('left');
            $font->color('#333');
        });
        
        /** Add Time */
        $img->text($time, 530,600, function($font) {
            // local $font->file('E:\xampp\htdocs\PM-trick\public\fonts\o.ttf');
            $font->file('/home/pmtricks/public_html/fonts/o.ttf');    
            $font->size(30);
            $font->align('left');
            $font->color('#333');
        });
        
        $img->text($package->certification_title, 280,490, function($font) {
            // local $font->file('E:\xampp\htdocs\PM-trick\public\fonts\o.ttf');
            $font->file('/home/pmtricks/public_html/fonts/o.ttf');    
            $font->size(32);
            $font->align('left');
            $font->color('#333');
        });
        
        $save_path .= Auth::user()->id.$c_num.'.jpg';
        
        $img->save($save_path);
        
        $cert = new \App\Certification;
        $cert->user_id = Auth::user()->id;
        $cert->package_id = $package_id;
        $cert->c_num = $c_num;
        $cert->c_url = $save_path;
        $cert->save();
        
        
        return $cert->id;
    }
    
    
    public function sendCertification($id){
        
        
        $path = 'public/userCertifications/';
        
        $c = \App\Certification::find($id);
        
        if(!$c){
            return 'Error: 404';    
        }
        
        $path .= Auth::user()->id.$c->c_num.'.jpg';
        
        if(!Storage::exists($path)){
            return 'Error: not found!';
        }
        
        
        return \Redirect::to(url('/storage/userCertifications/'.Auth::user()->id.$c->c_num.'.jpg'));
        
    }
    
    public function secure($package_id){
        $package = \App\Packages::find($package_id);
        
        
        
        if(!$package){
            $this->error_msg = 'package not exist !';
            return 0;
        }
        
        
        if($package->certification == 0){
            $this->error_msg = 'Erro 500 Bad Request !';
            return 0;
        }
        $user_package = \App\UserPackages::where('user_id', Auth::user()->id)->where('package_id', $package_id)->get()->first();
        if(!$user_package){
            $this->error_msg = 'Please Enroll the Course !';
            return 0;
        }
        
        $chapters_inc = [];
        $total_videos_no = 0;
        $completed_videos_no = count(\App\VideoProgress::where('package_id', $package_id)->where('user_id', Auth::user()->id)->where('complete', 1)->get());
        // calculate the chapters included within the package 
        if($package->chapter_included != '' || $package->chapter_included != null){
            $arr_chapters_id = explode(',',$package->chapter_included);
            if( !empty($arr_chapters_id)){
                foreach($arr_chapters_id as $id){
                    $ch = \App\Chapters::where('id', '=', $id)->get()->first();
                    array_push($chapters_inc, $ch->id);
                }
            }
        }
        
        foreach($chapters_inc as $chapter){
            $n = count(\App\Video::where('chapter', $chapter)->get());
            $total_videos_no += $n;
        }
    
        $percentage = round($completed_videos_no/$total_videos_no * 100);
        
        if($percentage != 100){
            $this->error_msg = 'Please Complete Course !';
            return 0;
        }
        
        return 1;
        
    }
    
    public function generate_5digit(){
        return rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
    }
    
}
