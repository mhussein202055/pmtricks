<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponController extends Controller
{


    public function generate_5digit(){
        return rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
    }
    public function generate_coupon(){
        return 'PMTRICKS-'.$this->generate_5digit().'-'.$this->generate_5digit().'-'.$this->generate_5digit();
    }

    public function create_coupons(){
        return view('admin.coupons.create');
    }

    public function generate(Request $req){
        
        
        /**
         * calculate if its expired or not
         */
        // $c = \App\Coupon::all()->first();
        // $expires_at = Carbon::parse($c->expire_date);
        
        // if(Carbon::parse($c->expire_date)->diffInHours(Carbon::now()) > 0){
        //     return 'expire in '.$expires_at->diffInDays(Carbon::now()).'days';
        // }
        // return 'expired !';


        /**
         * check numbers
         * 
         * coupons_num
         * coupon_price
         * coupons_expire_after
         * 
         */



        if( 
            !is_numeric($req->input('coupon_price'))  ||
            !is_numeric($req->input('coupons_expire_after'))  ||
            !is_numeric($req->input('coupon_no_use')) 
        )
        {
            return back()->with('error', 'please, enter numbers !');
        }

        if( 
            ($req->input('coupon_price') <= 0) ||
            ($req->input('coupons_expire_after') <= 0) ||
            ($req->input('coupon_no_use') <= 0)
            )
        {
            return back()->with('error', 'please, enter a valid values !');
        }

        if(!\App\Packages::find($req->input('package_id')) ){
            return back()->with('error', 'please, select valid package !');
        }




        $current = Carbon::now();
        $expire = $current->addDays($req->input('coupons_expire_after'));

        $check = 1;

        if($req->input('coupon_code') != '' && $req->input('coupon_code') != null){
            $code = $req->input('coupon_code');
            $check = \App\Coupon::where('code', '=', $code)->get()->first();
            if($check){
                return back()->with('error','Please Choose another Coupon Code');
            }
        }else{
            
            while($check){
                $code = $this->generate_coupon();    
                $check = \App\Coupon::where('code', '=', $code)->get()->first();
            }
        }
        
        

        

        if(!$check){

            $coupon = new \App\Coupon;
            $coupon->code = $code;
            $coupon->expire_date = $expire;
            $coupon->price = $req->input('coupon_price');
            $coupon->no_use = $req->input('coupon_no_use');
            $coupon->package_id = $req->input('package_id');
            $coupon->save();

        }
        // else pass the loop
        

        return \Redirect::to(route('coupon.show'))->with('success', 'Process Complete !');
        

    }


    public function show(){
        return view('admin.coupons.show');
    }

    public function destroy(Request $req, $id){ 
        $coupon = \App\Coupon::find($id);
        $coupon->delete();
        return back()->with('success', 'Coupon Deleted !');
    }

}
