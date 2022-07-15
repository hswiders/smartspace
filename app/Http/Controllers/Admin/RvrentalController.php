<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Models\ParkingTypes;
use Session;
use Carbon\Carbon;
class RvrentalController extends Controller
{
    public function index(Request $request)
    {
       $rv_rental =  DB::table('front_menus')->where('id', 1)->take(1)->first();
        return view('admin.rv-rental-list', compact('rv_rental'));
    }

    
 public function updateRVrental(Request $request)
    {
        $this->validate($request,[
             'menu_link'=>'required|min:5',
        ]);
        
         $insert['menu_link'] =  $request->menu_link;
         $insert['updated_at'] = date('Y-m-d H:i:s');

        $rv_rental = DB::table('front_menus')->where('id', 1)->update($insert);

        if($rv_rental){
            $json['status']=1;
            $json['message']='The title has already been taken.';
            Session::flash('success', 'RV Rental updated successfully!!...');
            
        }else{
            $json['status']=0;
            $json['message']='The title has already been taken.';
            Session::flash('success', 'Something Went Wrong.');
            
        }
        echo json_encode($json);

    }

    
}
