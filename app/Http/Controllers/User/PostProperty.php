<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Animities;
use App\Models\ProperyCategory;
use App\Models\ProperyImages;
use App\Models\Reviews;
use App\Models\PropertyFee;
use App\Models\ParkingTypes;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Session;
use Validator;
class PostProperty extends Controller
{
    public function index()
    {
        $data['user'] = Auth::user();
        $amenities = Animities::where('parent' , 0)->get();
        $amenitiesData = [];
        foreach ($amenities as $key => $value) {
            $value->childs = Animities::where('parent' , $value->id)->get();
            
            array_push($amenitiesData, $value);
        }
        $data['amenities'] = $amenitiesData;
        $data['parking_types'] = ParkingTypes::get();
        $data['categories'] = ProperyCategory::get();
        $data['fees'] = PropertyFee::get();
        
        return view('frontend.property.add-property' , $data);
    }
    public function editProperty($id)
    {
        $data['user'] = Auth::user();
        $data['amenities'] = Animities::get();
        $data['categories'] = ProperyCategory::get();
        $data['fees'] = PropertyFee::get();
        $data['parking_types'] = ParkingTypes::get();
        $data['property'] = Property::where('id' , $id)->first();
        $data['property_images'] = ProperyImages::where('property_id' , $id)->get();
        
        return view('frontend.property.edit-property' , $data);
    }
    public function myProperties()
    {
        $pData = Property::OrderBy('id' , 'desc')->get();
        $property = [];
        //dd($pData);
        foreach ($pData as $key => $value) {
            $value->image = ProperyImages::where('property_id' , $value->id)->first();
            $value->property_category = ProperyCategory::where('id' , $value->property_category)->first();
            if ($value->fee_1) {
                $value->fee_1 = PropertyFee::where('id' , $value->fee_1)->first();
            }
            if ($value->fee_2) {
                $value->fee_2 = PropertyFee::where('id' , $value->fee_2)->first();
            }
            if ($value->fee_3) {
                $value->fee_3 = PropertyFee::where('id' , $value->fee_3)->first();
            }
            array_push($property, $value);
        }
        $data['property'] = $property;
        return view('frontend.property.my-properties' , $data);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            
            'property_images' => 'required', 
            'property_heading' => 'required',
            'property_category' => 'required',
            'property_type' => 'required',
            'bedrooms' => 'required',
            'bathrooms' => 'required',
            'furnished' => 'required',
            'utilities' => 'required',
            'unit_type' => 'required',
            'bath_type' => 'required',
            'entrance_type' => 'required',
            'washer_and_dryer' => 'required',
            'pets_allowed' => 'required',
            'monthly_rent' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'animities' => 'required',
            'description' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'parking_type' => 'required'

        ]); 
        if ($validator->fails())
        {
            return response()->json($validator->errors(),422);  

        }
        $Property = new Property;
        $Property->user_id = Auth::id();
        $Property->property_heading = $request->property_heading;
        $Property->property_type = $request->property_type;
        $Property->property_category = $request->property_category;
        $Property->bedrooms = $request->bedrooms;
        $Property->bathrooms = $request->bathrooms;
        $Property->furnished = $request->furnished;
        $Property->utilities = $request->utilities;
        $Property->unit_type = $request->unit_type;
        $Property->bath_type = $request->bath_type;
        $Property->entrance_type = $request->entrance_type;
        $Property->washer_and_dryer = $request->washer_and_dryer;
        $Property->pets_allowed = $request->pets_allowed;
        $Property->monthly_rent = $request->monthly_rent;
        $Property->address = $request->address;
        $Property->city = $request->city;
        $Property->state = $request->state;
        $Property->zip = $request->zip;
        $Property->lat = $request->lat;
        $Property->lng = $request->lng;
        $Property->fee_1 = $request->fee_1;
        $Property->fee_1_amount = $request->fee_1_amount;
        $Property->fee_2 = $request->fee_2;
        $Property->fee_2_amount = $request->fee_2_amount;
        $Property->fee_3 = $request->fee_3;
        $Property->fee_3_amount = $request->fee_3_amount;
        $Property->animities = implode(',', $request->animities);
        $Property->description = $request->description;
        $Property->name = $request->name;
        $Property->email = $request->email;
        $Property->phone = $request->phone;
 
        $Property->is_featured = 0;
        
        $Property->parking_type = implode(',', $request->parking_type);
        $Property->created_at = Carbon::now();
        $Property->updated_at = Carbon::now();
        $Property->save();

        $User = Auth::user();
        $User->property_count = $User->property_count - 1;
        $User->save();

        foreach ($request->property_images as $key => $value) {
            $PropertyImg = new ProperyImages;
            $PropertyImg->image = $value;
            $PropertyImg->property_id = $Property->id;
            $PropertyImg->created_at = Carbon::now();
            $PropertyImg->save();
        }
        return response()->json(["status"=>true,"msg"=>"Congratulation ! Your Property has been listed Successfully","redirect_location"=>route("user.myproperties")]);
    } 
    public function do_review(Request $request)
    {

        $validator = Validator::make($request->all(), [
            
            'rating' => 'required', 
            'review' => 'required', 
            'property_id' => 'required', 

        ]); 
        if ($validator->fails())
        {
            return response()->json($validator->errors(),422);  

        }
        $Reviews = new Reviews;
        $Reviews->user_id = Auth::id();
        $Reviews->rating = $request->rating;
        $Reviews->property_id = $request->property_id;
        $Reviews->review = $request->review;
        $Reviews->created_at = Carbon::now();
        $Reviews->updated_at = Carbon::now();
        $Reviews->save();
        return response()->json(["status"=>true,"msg"=>"Congratulation ! Your Review  has been Submitted Successfully","redirect_location"=>route("user.myproperties")]);
    }
    public function storeImages(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'images.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',

        ]); 
        
        if ($validator->fails())
        {
            return response()->json($validator->errors(),422);  

        }
        $allFiles = [];
        if($request->hasfile('images'))
         {
            foreach($request->file('images') as $key => $file)
            {
                $getFileExt   = $file->getClientOriginalExtension();
                $time =   rand(10 , 100).time();
                $filename =   rand(10 , 100).time().'.'.$getFileExt;
                $file->move(public_path().'/assets/properties', $filename);  
                
                $filename = '<div class="col-md-3" id="img_'.$time.'"><span class="remove_img" data-id="img_'.$time.'">X</span><img src="'.asset('').'assets/properties/'.$filename.'" class="w-100" ><input type="hidden" name="property_images[]" value="/assets/properties/'.$filename.'"></div>';
                
                $allFiles[$key]['name'] = $filename;
                
            }
         }
        else
        {
            return response()->json(["property_images[]"=>array("image field is required to be image")] ,422);
        }
            

        return response()->json(["status"=>true,"msg"=>"Your  Images has been updated successfully!","allFiles"=>$allFiles]); 
    }
    public function deleteImage(Request $request)
    {
        $propertyImage = ProperyImages::find( $request->id );
        $propertyImage->delete();
       
        return response()->json(["status"=>true,"msg"=>"Your  Images has been Deleted successfully!"]); 
    }
    public function deleteProperty(Request $request)
    {
        $Property = Property::find( $request->id );
        $Property->delete();
       
        return response()->json(["status"=>true,"msg"=>"Your  Property has been Deleted successfully!"]); 
    }
    public function changeStatus(Request $request)
    {
        $Property = Property::find( $request->id );
        $Property->status = $request->status;
        $Property->save();
       
        return response()->json(["status"=>true,"msg"=>"Your  Property has been Deleted successfully!"]); 
    }
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'property_heading' => 'required',
            'property_category' => 'required',
            //'property_type' => 'required',
            'bedrooms' => 'required',
            'bathrooms' => 'required',
            'furnished' => 'required',
            'utilities' => 'required',
            'unit_type' => 'required',
            'bath_type' => 'required',
            'entrance_type' => 'required',
            'washer_and_dryer' => 'required',
            'pets_allowed' => 'required',
            'monthly_rent' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'animities' => 'required',
            'description' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            
            
            'parking_type' => 'required'

        ]); 
        if ($validator->fails())
        {
            return response()->json($validator->errors(),422);  

        }
        $Property = Property::find( $request->id );
        if ($Property->user_id !== Auth::id()) {
            return response()->json(['error' => 'You are not allowed to edit this property'],422);
        };
        $Property->property_heading = $request->property_heading;
        //$Property->property_type = $request->property_type;
        $Property->property_category = $request->property_category;
        $Property->bedrooms = $request->bedrooms;
        $Property->bathrooms = $request->bathrooms;
        $Property->furnished = $request->furnished;
        $Property->utilities = $request->utilities;
        $Property->unit_type = $request->unit_type;
        $Property->bath_type = $request->bath_type;
        $Property->entrance_type = $request->entrance_type;
        $Property->washer_and_dryer = $request->washer_and_dryer;
        $Property->pets_allowed = $request->pets_allowed;
        $Property->monthly_rent = $request->monthly_rent;
        $Property->address = $request->address;
        $Property->city = $request->city;
        $Property->state = $request->state;
        $Property->zip = $request->zip;
        $Property->lat = $request->lat;
        $Property->lng = $request->lng;
        $Property->fee_1 = $request->fee_1;
        $Property->fee_1_amount = $request->fee_1_amount;
        $Property->fee_2 = $request->fee_2;
        $Property->fee_2_amount = $request->fee_2_amount;
        $Property->fee_3 = $request->fee_3;
        $Property->fee_3_amount = $request->fee_3_amount;
        $Property->animities = implode(',', $request->animities);
        $Property->description = $request->description;
        $Property->name = $request->name;
        $Property->email = $request->email;
        $Property->phone = $request->phone;
        $Property->is_featured = 0;
        $Property->parking_type = implode(',', $request->parking_type);
        $Property->created_at = Carbon::now();
        $Property->updated_at = Carbon::now();
        
        $Property->save();
        if (isset($request->property_images)) 
        {
            foreach ($request->property_images as $key => $value) 
            {
                $PropertyImg = new ProperyImages;
                $PropertyImg->image = $value;
                $PropertyImg->property_id = $Property->id;
                $PropertyImg->created_at = Carbon::now();
                $PropertyImg->save();
            }
        }
        
        return response()->json(["status"=>true,"msg"=>"Congratulation ! Your Property has been Updated Successfully","redirect_location"=>route("user.myproperties")]);
    }
}
