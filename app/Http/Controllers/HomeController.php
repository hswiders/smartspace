<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\ContactUs;
use Validator;
use App\Models\User;
use App\Models\Plans;
use App\Models\Addons;
use App\Models\ProperyCategory;
use App\Models\Property;
use Auth;
use Mail;

class HomeController extends Controller
{
    public function index()
    {

        $data['popular_property'] =  Property::where('is_featured' , 1)->get();
        $data['res_property'] =  Property::where('property_type' , 1)->get();
        $data['office_property'] =  Property::where('property_type' , 2)->get();
        $data['plots_property'] =  Property::where('property_type' , 3)->get();
        $data['properyCategory'] =  ProperyCategory::get();
        return view('frontend.home', $data);
    }

    public function terms()
    {
        $data['ads_banners'] = DB::table('ads_banners')->whereRaw("find_in_set('terms-and-conditions' , pages)")->inRandomOrder()->limit(1)->first();
        
        return view('frontend.terms' , $data);
    }
    public function membership()
    {
        $plans = Plans::get();
        $plansData = [];
        $data['user'] = [];
        $data['current_plan'] = [];
        foreach ($plans as $key => $value) 
        {
            $addonIds = explode(',', $value['addonId']);
            $value['addonId'] = $addonIds;
            array_push($plansData, $value);
        }
        $data['plans'] = $plansData;
        $data['addons'] = Addons::get();
        if (Auth::id()) {
           $data['user'] = Auth::user();
           $data['current_plan'] = Plans::find($data['user']->plan_id);
        }
        return view('frontend.membership' , $data);
    }
    public function privacy()
    {
        $data['ads_banners'] = DB::table('ads_banners')->whereRaw("find_in_set('privacy-policy' , pages)")->inRandomOrder()->limit(1)->first();;
        return view('frontend.privacy', $data);
    }
    public function about()
    {
        $data['ads_banners'] = DB::table('ads_banners')->whereRaw("find_in_set('about' , pages)")->inRandomOrder()->limit(1)->first();;
        return view('frontend.about', $data);
    }
    public function contact()
    {
        $data['ads_banners'] = DB::table('ads_banners')->whereRaw("find_in_set('contact' , pages)")->inRandomOrder()->limit(1)->first();;
        $data['contact_type'] =  DB::table('contact_type')->get();
        return view('frontend.contact' , $data);
    }
    function do_contact_us(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact_type_id' => 'required',
            'subject' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required',
        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(),422);  
            // validation failed return back to form

        } else {
            //validations are passed, save new user in database
            $contact_type = DB::table('contact_type')->where('id' , $request->contact_type_id)->first();
            $data['subject']="Contact Inquiry";
            $body = '<p style="text-align: left;color: black">Hello! Admin ,</p>';               
            $body .= '<p style="text-align: left;color: black">this email is to inform you that someone has made an contact request through your website</p>';                
            $body .= '<p style="text-align: left;color: black">Details are :</p>'; 

            $body .= '<table>';
            $body .= '<tr><th>Name: </th><td>'.$request->name.'</td></tr>';
            $body .= '<tr><th>Contact Type: </th><td>'.$contact_type->contact_type.'</td></tr>';
            $body .= '<tr><th>email: </th><td>'.$request->email.'</td></tr>';
            $body .= '<tr><th>phone: </th><td>'.$request->phone.'</td></tr>';
            $body .= '<tr><th>message: </th><td>'.$request->message.'</td></tr></table>';
            //$body .= '<p style="text-align: left;color: black">Login to admin panel for more details </p><bt><br>';
            $data['body'] = $body;
            $data['email'] = env('MAIL_USERNAME');
            //$data['email'] = 'Hakim.webwiders@gmail.com';
            try {
                    Mail::to($data['email'])->send(new \App\Mail\MyTestMail($data));

                } catch (Exception $e) {
                  dd($e);
                }
            return response()->json(["status"=>true,"msg"=>"Your Contact request has been sent successfuuly we will get back to you soon","redirect_location"=>route("contact")]);
             
           
        }
    }
  public function verify_email($id,$token)
   {
    $true = false;
    if($id && $token){

        $data = User::select('*')->where(array('id'=>$id))->first();
        $redirect = route('login');
        if (Auth::id()) {
            $redirect = route('user.dashboard');
        }
      if($data){
        $data = $data->toArray();
         //print_r($data); die;
        if($data['email_verified'] == 0){
          if($data['token'] == $token){
            
            $user = User::find($id);
            $user['email_verified'] = 1;
            $user['email_verified_at'] = date('Y-m-d');
            $run = $user->save();
            if($run){
              
              return redirect($redirect)->with('msg', '<div class="alert alert-success">Your email has been verified successfully.</div>');
              
            
            }else
            {
              
              return redirect($redirect)->with('msg', '<div class="alert alert-danger">Server not responding, please try again later.</div>');
              
            }
          } else {
            
            return redirect($redirect)->with('msg', '<div class="alert alert-danger">User not authorized or link is expired.</div>');
          }
        } else {
          
          return redirect($redirect)->with('msg', '<div class="alert alert-success">Your account is already verified, You can access your account.</div>');
          
        }
      } else {
        
        return redirect($redirect)->with('msg', '<div class="alert alert-danger">User not authorized or link is expired.</div>');
        
      }
    } else {
      
       return redirect($redirect)->with('msg', '<div class="alert alert-danger">User not authorized or invalid token code.</div>');
      
    }
    
  }
  public function UpdateInactivity()
     {
        $current_date = date('Y-m-d H:i:s');
        $onUser = User::where('active_status',1)->get();
        if ($onUser) 
        {
            foreach ($onUser as $key => $value) 
            {
                $active_time = $value->active_time;
                $seconds = strtotime($current_date) - strtotime($active_time);
                $minutes = $seconds / 60 ;
                echo $minutes.'<br>';
                if ($minutes > 2) 
                {
                    $user = User::where('id',$value->id)->first();
                    $user->active_status = 0;
                    $user->save();
                }
            }
        }
        
     }
     
}
