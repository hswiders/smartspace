<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\ProperyCategory;
use App\Models\ProperyImages;
use App\Models\Property;
use App\Models\Reviews;
use App\Models\Favourites;
use App\Models\ParkingTypes;
use App\Models\User;
use App\Models\Animities;
use Validator;
use Carbon\Carbon;
use Str;
use Auth;
class SearchProperty extends Controller
{
    public function index($slug='' , $category_id='')
    {
        $data['sel_category'] = ProperyCategory::where('id' , $category_id)->first();
        $data['categories'] = ProperyCategory::get();
        $data['amenities'] = Animities::get();
        return view('frontend.search-property' , $data);
       
    }
    public function single($slug='' , $property_id=0)
    {
        $property = Property::where('id' , $property_id)->first();
        if (empty($slug) || empty($property)) 
        {
            return view('frontend.404');
        }
        $property->property_views = $property->property_views+1;
        $property->save();
        $property->images = ProperyImages::where('property_id' , $property->id)->get();
        $property->owner = User::where('id' , $property->user_id)->first();
        $amenities  = explode(',' , $property->animities);

        $property->animities = Animities::whereIn('id' , $amenities)->get();

        $property->category = ProperyCategory::where('id' , $property->property_category)->first();
        $parking  = explode(',' , $property->parking_type);
        $property->parking_type = ParkingTypes::whereIn('id' , $parking)->get();
        //dd($parking);
        $data['is_reviewed'] = false;
        if (Auth::id()) {
            $data['is_reviewed'] = Reviews::where(['user_id' => Auth::id() , 'property_id' =>$property->id ])->count();
        }
        $data['reviews'] = Reviews::where(['property_id' =>$property->id ])->get();
        $data['categories'] = ProperyCategory::get();
        $data['property'] = $property;
        return view('frontend.single-property' , $data);
       
    }
    public function do_search(Request $request)
    {
        $select = '*';
        if ($request->lat) {
            $lat = $request->lat;
            $lng = $request->lng;
          $select = "*, 111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS(".$lat.")) * COS(RADIANS(propertis_list.lat)) * COS(RADIANS(".$lng." - propertis_list.lng)) + SIN(RADIANS(".$lat.")) * SIN(RADIANS(propertis_list.lat))))) AS distance"; 
        }
          $data['properties'] = Property::selectRaw($select)->when($request->lat, function ($q) use ($request) {
                $q->having('distance', '<' , 100);
            })
        ->where(function ($q) use ($request) {
            $q
            ->when($request->keyword, function ($q) use ($request) {
                $q->Orwhere('property_heading', 'LIKE', '%' . $request->keyword . '%');
                $q->Orwhere('address', 'LIKE', '%' . $request->keyword . '%');
                $q->Orwhere('description', 'LIKE', '%' . $request->keyword . '%');
                $q->Orwhere('city', 'LIKE', '%' . $request->keyword . '%');
                $q->Orwhere('state', 'LIKE', '%' . $request->keyword . '%');
            })
            
            ->when($request->category, function ($q) use ($request) {
                $q->where('property_category',  $request->category);
            }) 
            ->when($request->property_type, function ($q) use ($request) {
                $q->where('property_type',  $request->property_type);
            })
            ->when($request->bedrooms, function ($q) use ($request) {
                $q->where('bedrooms',  $request->bedrooms);
            }) 
            ->when($request->bathrooms, function ($q) use ($request) {
                $q->where('bathrooms',  $request->bathrooms);
            }) 
            ->when($request->amenities, function ($q) use ($request) {
                foreach ($request->amenities as $key => $value) {
                    $q->whereRaw(" find_in_set(".$value." , animities) ");
                }
                
            });
        })->where('status', 1)
        ->when($request->has('sort_by'), function ($q) use ($request) {
                if($request->sort_by == 'h_to_l')
                {
                    $q->orderBy('monthly_rent', 'DESC');
                }
                else if ($request->sort_by == 'l_to_h') {

                    $q->orderBy('monthly_rent', 'ASC');
                }
                else if ($request->sort_by == 'is_featured') {

                    $q->orderBy('is_featured', 'DESC');
                }
                else {

                    $q->orderBy('id', 'ASC');
                }
            }) 
        
        ->Paginate(8);
        $data['sort_by'] = $request->sort_by;
        if($request->ajax()){
            return view('frontend.ajax.filter_properties', $data);; 
        } 
       
    }
    public function add_to_fav(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'property_id' => 'required', 
        ]); 
        if ($validator->fails())
        {
            return response()->json($validator->errors(),422);  

        }
        if (!Auth::id()) {
            return response()->json(["msg"=>"Please login to add favourite"],422); 
        }
        $check = Favourites::where(['user_id' => Auth::id() , 'property_id'=>$request->property_id])->first();
        if ($check) {
            $check->delete();
            return response()->json(["status"=>false,"msg"=>"Property removed from favourites","redirect_location"=>route("user.myproperties")]);
        }
        $Favourites = new Favourites;
        $Favourites->user_id = Auth::id();
        $Favourites->property_id = $request->property_id;
        $Favourites->created_at = Carbon::now();
        $Favourites->updated_at = Carbon::now();
        $Favourites->save();
        return response()->json(["status"=>true,"msg"=>"Property Added to favourites","redirect_location"=>route("user.myproperties")]);
    }
}
