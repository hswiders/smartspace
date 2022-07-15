<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\ProperyCategory;
use App\Models\ProperyImages;
use DB;
use Validator;
use Session;
use Hash;
class PropertyController extends Controller
{
    public function propertyList(Request $request)
    {
        $property = Property::orderBy('id', 'DESC')->get();
        return view('admin.property-list', compact('property'));
    }

    public function addProperty(Request $request)
    {
        return view('admin.add-property');
    }

    public function makeFeatured(Request $request)
    {
        $property = Property::where('id', $request->id)->take(1)->first();
        //dd($property->is_featured);
        if($property->is_featured==0){
            $property->is_featured = 1;
        }else{
            $property->is_featured=0;
       }
        $run = $property->save();
        Session::flash('success','Update property featured successfully');
        echo json_encode(['status'=>$property->is_featured]);

    }

    public function viewProperty(Request $request)
    {
    	$data['property_image'] = ProperyImages::orderBy('property_id', 'DESC')->where('property_id',$request->id)->get();
    	$data['property'] = Property::orderBy('id', 'DESC')->where('id',$request->id)->first();
        return view('admin.view-property',$data);
    }

     public function editProperty(Request $request)
    {

    	$data['property'] = Property::orderBy('id', 'DESC')->where('id',$request->id)->first();
    	$data['property_category'] =	ProperyCategory::orderBy('id', 'DESC')->get();
        return view('admin.edit-property',$data);
    }

   public function updateProperty(Request $request)
    {
    	//echo "add";die;
    $rules = [
			'property_name' => 'required|string',
			'property_type' => 'required',
			'address' => 'required',
			'state' => 'required',
			'city' => 'required',
			'zip' => 'required',
			'bedrooms' => 'required',
			'bathrooms' => 'required',
			'furnished' => 'required',
			'utilities' => 'required',
			'unit_type' => 'required',
			'bath_type' => 'required',
			'entrance_type' => 'required',
			'washer_type' => 'required',
			'pets_allowed' => 'required'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('admin/property-list')->withInput()->with('error','Validation Error');
		}
		else{
             $insert['property_heading'] =   $request->property_name;
			 $insert['property_type'] =  $request->property_type;
			 $insert['bedrooms'] =  $request->bedrooms;
			 $insert['bathrooms'] =   $request->bathrooms;
			 $insert['furnished'] =   $request->furnished;
			 $insert['utilities'] =   $request->utilities;
			 $insert['unit_type'] =   $request->unit_type;
			 $insert['bath_type'] =   $request->bath_type;
			 $insert['entrance_type'] =   $request->entrance_type;
			 $insert['washer_and_dryer'] =   $request->washer_type;
			 $insert['pets_allowed'] =   $request->pets_allowed;
			 $insert['monthly_rent'] =   $request->monthly_rent;
			 $insert['address'] =   $request->address;
			 $insert['city'] =   $request->city;
			 $insert['state'] =   $request->state;
			 $insert['zip'] =   $request->zip;
			 $insert['updated_at'] = date('Y-m-d H:i:s');

			 $property = Property::where('id', $request->id)->update($insert);

			 if($property)
			 {
			 	Session::flash('success', 'Property Updated successfully.');
                //$output['status'] = 1;
			 }else
			 {
			 	Session::flash('failed', 'Something went wrong.');
                //$output['status'] = 0;
			 }
            return redirect('admin/property-list');
	   //echo json_encode($output);
    }
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
    }

    public function blockStatus(Request $request)
    {
    	//echo "hello";die;
    	$insert['status'] =   $request->status;
    	$property = Property::where('id', $request->id)->update($insert);

    	if($property)
			 {
			 	Session::flash('success', 'Property status Changed successfully.');
                $output['status'] = 1;
                
			 }else
			 {
			 	Session::flash('failed', 'Something went wrong.');
                $output['status'] = 0;
             }
            //return redirect('admin/property-list');
             echo json_encode($output);

    }
}
