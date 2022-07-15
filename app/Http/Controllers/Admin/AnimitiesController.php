<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Animities;
use Session;
use DB;
class AnimitiesController extends Controller
{
    public function index($parent=0)
    {
        $data['animities'] = Animities::orderBy('id', 'DESC')->where('parent',$parent)->get();
        $data['is_parent'] = $parent; 
        $data['title'] = 'Amenities list'; 
        if ($parent) {

             $data['title'] = Animities::where('id' , $parent)->take(1)->first()->name; 
        }
        //sdd($data);
        return view('admin.animities-list', $data);
    }

    public function addAnimities(Request $request)
    {
       $this->validate($request,[
             'name'=>'required|min:5',
        ]);

        $is_parent = $request->is_parent;
        $insert['name'] = $request->name;
           if($is_parent)
           {
             $insert['parent'] = 0;
           }else
           {
            $insert['parent'] = $request->aminities;
           }

            $run = Animities::insert($insert);
            Session::flash('success', 'Amenities added successfully!!...');
            echo json_encode(['status'=>1]);
    }

    public function updateAnimities(Request $request)
    {
       $this->validate($request,[
             'name'=>'required|min:5',
        ]);
       $run = Animities::where('id', $request->id)->update(['name'=> $request->name]);
        Session::flash('success', 'Amenities updated successfully!!...');
        echo json_encode(['status'=>1]);
    }

    public function delAnimities(Request $request)
    {
       $run = Animities::where('id', $request->id)->delete();
       $run = Animities::where('parent', $request->id)->delete();
        Session::flash('success', 'Amenities deleted successfully!!...');
        echo json_encode(['status'=>1]);
    }

}
