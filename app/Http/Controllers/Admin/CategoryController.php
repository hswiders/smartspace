<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Models\ProperyCategory;
use Session;
class CategoryController extends Controller
{
    public function index(Request $request)
    {
       $properyCategory =  ProperyCategory::get();
        return view('admin.category-list', compact('properyCategory'));
    }

    public function addCategory(Request $request)
    {
       
       $this->validate($request,[
             'title'=>'required|min:5|unique:property_category,title,',
        ]);
       $insert['title'] =  $request->title;
       $premium = $request->premium_status;
            if($premium == 1)
            {
                $insert['premium_status'] = 1;
            } else {
                $insert['premium_status'] = 0;
            }

       if(isset($request->image)){
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('assets/images/catImage'), $imageName);
            $insert['image'] = 'assets/images/catImage/'.$imageName;
       }else{
            $insert['image'] = 'assets/images/logo-full.png';
       }
       
       $run = ProperyCategory::insert($insert);
        Session::flash('success', 'Category added successfully!!...');
        echo json_encode(['status'=>1]);
    }
    

    public function delCategory(Request $request)
    {
       $run = ProperyCategory::where('id', $request->id)->delete();
        Session::flash('success', 'Category deleted successfully!!...');
        echo json_encode(['status'=>1]);
    }

    public function updateCategory(Request $request)
    {
        $this->validate($request,[
             'title'=>'required|min:5',
        ]);
        
       $check = ProperyCategory::where('title', $request->title)->where('id', '!=', $request->id)->take(1)->first();
        if($check){
            $json['status']=0;
            $json['message']='The title has already been taken.';
                echo json_encode($json);
            exit;
        }else{
            $update['title'] = $request->title;
            $premium = $request->premium_status;
            if($premium == 1)
            {
                $update['premium_status'] = 0;
            } else {
                $update['premium_status'] = 1;
            }

            if(isset($request->image)){
                $imageName = time().'.'.$request->image->extension();  
                $request->image->move(public_path('assets/images/catImage'), $imageName);
                $update['image'] = 'assets/images/catImage/'.$imageName;
            }
            Session::flash('success', 'Category updated successfully!!...');
            $run = ProperyCategory::where('id', $request->id)->update($update);
        }
        echo json_encode(['status'=>1]);

    }

    public function Subscription(Request $request)
    {
       $subs = DB::table('subscriptions')->orderBy('id', 'DESC')->get();
       $subscriber=[];
       foreach($subs as $s)
       {
            $data['price'] = $s->price; 
            $data['payment_id'] = $s->payment_id;
            $data['created_at'] = $s->created_at;
            $user_id = $s->user_id;
            $user = DB::table('users')->where('id',$user_id)->first();
            $data['firstname'] = $user->first_name;
            $data['lastname'] = $user->last_name;
            $plan_id = $s->plan_id;
            $plan = DB::table('plans')->where('id',$plan_id)->first();
            $data['planname'] = $plan->name;
            array_push($subscriber, $data);
       }
       $data1['subscribers'] = $subscriber;
        return view('admin.subscription-list', $data1);
    }
}
