<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyFee;
use DB;
use Session;
use Validator;
use Hash;
class FeesController extends Controller
{
    public function feesList(Request $request)
    {

        $fees = PropertyFee::orderBy('id', 'DESC')->get();
        return view('admin.fees-list', compact('fees'));
    }


 public function deleteFees(Request $request)
    {
        $fees = PropertyFee::where('id', $request->id)->delete();
        
        if($fees)
             {
                Session::flash('success', 'Fees Deleted successfully.');
                
             }else
             {
                Session::flash('failed', 'Something went wrong.');
             }
            return redirect('admin/fees-list');
    }

    public function addFees(Request $request)
    {
        //echo "add";die;
        $rules = [
            'name' => 'required|string'
    ];
    
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            
             return redirect('admin/fees-list')->withInput()->with('error','validation error');
        }
        else{

             $insert['name'] =  $request->name;
             
             $insert['created_at'] = date('Y-m-d H:i:s');

             $fees = PropertyFee::insert($insert);

             if($fees)
             {
               
                Session::flash('success', 'Fees Added successfully.');
               
             }else
             {
                Session::flash('failed', 'Something went wrong.');
               
             }
            return redirect('admin/fees-list');
       //echo json_encode($output);
    }
 }

   public function editFees(Request $request)
    {
        //echo "add";die;
        $rules = [
            'name' => 'required|string'
    ];
    
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            
             return redirect('admin/fees-list')->withInput()->with('error','validation error');
        }
        else{

             $insert['name'] =  $request->name;
             $insert['updated_at'] = date('Y-m-d H:i:s');
             $fees = PropertyFee::where('id', $request->id)->update($insert);
             if($fees)
             {
               
                Session::flash('success', 'Fees Updated successfully.');
               
             }else
             {
                Session::flash('failed', 'Something went wrong.');
               
             }
            return redirect('admin/fees-list');
       //echo json_encode($output);
    }
 }
    /*public function addProperty(Request $request)
    {
        return view('admin.add-property');
    }

    public function makeFeatured(Request $request)
    {
        $property = Property::where('id', $request->id)->take(1)->first();
        if($property->is_featured==0){
            $up['is_featured']=1;
        }else{
            $up['is_featured']=0;
       }
        $run = Property::where('id', $request->id)->update($up);
        Session::flash('success','Update property featured successfully');
        echo json_encode(['status'=>1]);

    }

    public function viewProperty(Request $request)
    {
    	$property = Property::orderBy('id', 'DESC')->where('id',$request->id)->first();
        return view('admin.view-property',compact('property'));
    }

     public function editProperty(Request $request)
    {
    	
    	$property = Property::orderBy('id', 'DESC')->where('id',$request->id)->first();
        return view('admin.edit-property',compact('property'));
    }

    public function deleteProperty(Request $request)
    {
    	$property = Property::where('id', $request->id)->delete();
        
		if($property)
			 {
			 	Session::flash('success', 'Property Deleted successfully.');
                
			 }else
			 {
			 	Session::flash('failed', 'Something went wrong.');
             }
            return redirect('admin/property-list');
    }*/
}
