<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ads_banner;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
class Ads_bannerController extends Controller
{
    public function index(Request $request)
    {
       $Ads_banner =  Ads_banner::get();
        return view('admin.ads_banner-list', compact('Ads_banner'));
    }

    public function addAds_banner(Request $request)
    {

       $validator = Validator::make($request->all(), [
             'banner_img'=>'required|image|mimes:jpg,png,jpeg,gif,svg',
             'banner_type'=>'required',
             'pages'=>'required',
             'banner_action'=>'required',
        ]);
       if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(),422);  
            // validation failed return with 422 status

        }
       $insert['banner_type'] =  $request->banner_type;
       $insert['pages'] =  implode(',', $request->pages);
       $insert['banner_action'] =  $request->banner_action;
       $insert['created_at'] =  Carbon::now();
       $insert['updated_at'] =  Carbon::now();

       if(isset($request->banner_img)){
            $imageName = time().'.'.$request->banner_img->extension();  
            $request->banner_img->move(public_path('assets/images/banners'), $imageName);
            $insert['banner_img'] = 'assets/images/banners/'.$imageName;
       }else{
            $insert['banner_img'] = 'assets/images/logo-full.png';
       }
       
       $run = Ads_banner::insert($insert);
        Session::flash('success', 'Ads_banner added successfully!!...');
        echo json_encode(['status'=>1]);
    }
    

    public function delAds_banner(Request $request)
    {
       $run = Ads_banner::where('id', $request->id)->delete();
        Session::flash('success', 'Ads_banner deleted successfully!!...');
        echo json_encode(['status'=>1]);
    }

    public function updateAds_banner(Request $request)
    {
        $validator = Validator::make($request->all(), [
             
             'banner_type'=>'required',
             'pages'=>'required',
             'banner_action'=>'required',
        ]);
       if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(),422);  
            // validation failed return with 422 status

        }
       
       $update['banner_type'] =  $request->banner_type;
       $update['pages'] =  implode(',', $request->pages);
       $update['banner_action'] =  $request->banner_action;

        if(isset($request->banner_img)){
            $imageName = time().'.'.$request->banner_img->extension();  
            $request->banner_img->move(public_path('assets/images/banners'), $imageName);
            $update['banner_img'] = 'assets/images/banners/'.$imageName;
        }
        Session::flash('success', 'Ads_banner updated successfully!!...');
        $run = Ads_banner::where('id', $request->id)->update($update);
        
        echo json_encode(['status'=>1]);

    }
}
