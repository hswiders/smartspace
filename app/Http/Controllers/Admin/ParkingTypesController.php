<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Models\ParkingTypes;
use Session;
use Carbon\Carbon;
class ParkingTypesController extends Controller
{
    public function index(Request $request)
    {
       $parking_types =  ParkingTypes::get();
        return view('admin.parking-types-list', compact('parking_types'));
    }

    public function addParkingTypes(Request $request)
    {
       
       $this->validate($request,[
             'title'=>'required|min:5|unique:parking_types,title,',
        ]);
       $insert['title'] =  $request->title;
       $insert['created_at'] =  Carbon::now();
       $insert['updated_at'] =  Carbon::now();
       
       $run = ParkingTypes::insert($insert);
        Session::flash('success', 'Parking Types added successfully!!...');
        echo json_encode(['status'=>1]);
    }
    

    public function delParkingTypes(Request $request)
    {
       $run = ParkingTypes::where('id', $request->id)->delete();
        Session::flash('success', 'ParkingTypes deleted successfully!!...');
        echo json_encode(['status'=>1]);
    }

    public function updateParkingTypes(Request $request)
    {
        $this->validate($request,[
             'title'=>'required|min:5',
        ]);
        
       $check = ParkingTypes::where('title', $request->title)->where('id', '!=', $request->id)->take(1)->first();
        if($check){
            $json['status']=0;
            $json['message']='The title has already been taken.';
                echo json_encode($json);
            exit;
        }else{
            $update['title'] = $request->title;
            
            Session::flash('success', 'ParkingTypes updated successfully!!...');
            $run = ParkingTypes::where('id', $request->id)->update($update);
        }
        echo json_encode(['status'=>1]);

    }

    
}
