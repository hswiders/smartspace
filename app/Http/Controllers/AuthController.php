<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use DB;
use Session;
use Twilio\Rest\Client;
use Mail;
use Str;
use Carbon\Carbon;
use Hash;
class AuthController extends Controller
{
    function loginView()
    {
        return view("frontend/login");
    }

    function forgotView()
    {
        return view("frontend/forgot");
    }

    function registerView()
    {
        $data['phonecode'] =  DB::table('countries')->get();
        return view("frontend/register" , $data);
    }

    function doLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',   // required and email format validation
            'password' => 'required', // required and number field validation

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(),422);  
            // validation failed return with 422 status

        } else {
            //validations are passed try login using laravel auth attemp
            if (\Auth::attempt($request->only(["email", "password"]))) {
                return response()->json(["status"=>true,"msg"=>"You are logged in successfully","redirect_location"=>route("user.dashboard")]);
                
            } else {
                return response()->json([["Invalid credentials"]],422);
                
            }
        }
    }
    function doForgot(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',   // required and email format validation

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(),422);  
            // validation failed return with 422 status

        } else {
            //validations are passed try login using laravel auth attemp
            $email = $request->email;
            $check = User::select('*')->where('email', $email)->first();
            if ($check) {

                /*Email code goes here*/
                $token = Str::random(64);
                DB::table('password_resets')->insert([
                    'email' => $request->email, 
                    'token' => $token, 
                    'created_at' => Carbon::now()
                ]);
                $data['subject']="Forgot password";
                $body = '<p style="text-align: left;color: black">Hello! '.$check->first_name.',</p>';               
                $body .= '<p style="text-align: left;color: black">This is an automatic message . If you did not start the Forgot Password process recently, please ignore this email.</p>';                
                $body .= '<p style="text-align: left;color: black">You can reset password from bellow link:
                <a href="'.route('reset.password.get', $token).' ">Reset Password</a></p>'; 

               
                $data['body'] = $body;
                $data['email'] = $email;
                try {
                    Mail::to($data['email'])->send(new \App\Mail\MyTestMail($data));

                } catch (Exception $e) {
                  dd($e);
                }
                

   
                
                // Mail::send('mail', $data, function($message) use ($data) {
                //     $message->to($data['email']);
                //     $message->subject($data['subject']);
                // });
                return response()->json(["status"=>true,"msg"=>"We have sent you a reset link to $email , please check it to change your password .It may be in your Spam/Bulk/Junk folder.","redirect_location"=>route("user.dashboard")]);
                
            } else {
                return response()->json(["email" => array('This email is not registered with us')],422);
                
            }
        }
    }
    public function showResetPasswordForm($token) 
    { 
         return view('frontend.reset_password', ['token' => $token]);
    }
    function doRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(),422);  
            // validation failed return back to form

        } else {
            //validations are passed, save new user in database
            $enteredOtp = $request->otp;
            $OTP = Session::get('OTP');
           if($OTP == $enteredOtp)
           {
                $User = new User;
                $User->first_name = $request->first_name;
                $User->last_name = $request->last_name;
                $User->phone = $request->phone;
                $User->phonecode = $request->phonecode;
                $User->phone_verified = 1;
                $User->username = '';
                $User->token = md5(mt_rand(100000,999999)) ;
                $User->email = $request->email;
                $User->password = bcrypt($request->password);
                $User->save();
                Session::forget('OTP');

                /*Send email*/
                $email = $request->email;
                $data['subject'] = "Verify Email!";    
                    $body = '<p>Hello '. $request->first_name.'</p><p> Please verify your email address.</p>';
                $body .= '<p style="margin:0;font-size:20px;padding-bottom:5px;color:#2875d7">Please verify your email address.</p>
                <p style="margin:0;padding:10px 0px">Thanks for registering with us! To finish your sign up, please verify your email address by clicking the button below.</p>
                <div style="text-align:center"><a href="'.url('').'email-verify/'.$User->id.'/'.$User->token.'" style="background-color:#66A6FF;color:#fff;padding:8px 22px;text-align:center;display:inline-block;line-height:25px;border-radius:3px;font-size:17px;text-decoration:none">Verify Email Address</a></div>';
                /*send mail function goes here*/ 
                $data['body'] = $body;
                try {
                    Mail::to($email)->send(new \App\Mail\MyTestMail($data));

                } catch (Exception $e) {
                  dd($e);
                }
            }
            else
            {
                return response()->json(["otp"=> array("Inavlid OTP")] , 422);  
            }
            if (\Auth::attempt($request->only(["email", "password"]))) {
                return response()->json(["status"=>true,"msg"=>"We have sent you a verification link to $email , please check it and verify your account.It may be in your Spam/Bulk/Junk folder.","redirect_location"=>route("user.dashboard")]);
                
            } else {
                return response()->json([["Invalid credentials"]],422);
                
            }
             
           
        }
    }
    public function submitResetPasswordForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'password' => 'required|string|min:6',
           'confirm_password' => 'required|same:password'
        ]); // create the validations
         
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(),422);  
            // validation failed return back to form

        } 
        else 
        {
          $updatePassword = DB::table('password_resets')->where([
                                'token' => $request->token
                              ])->first();
           
          if(!$updatePassword){
              return response()->json(array('Invalid Token'),422);  
          }
  
          $user = User::where('email', $updatePassword->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $updatePassword->email])->delete();
  
          return response()->json(["status"=>true,"msg"=>"Your password has been changed please login","redirect_location"=>route("login")]);
      }
    }
    function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|unique:users,phone',
            'phonecode' => 'required',
            'agree_terms' => 'required',
            // 'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',   // required and email format validation
            'password' => 'required|min:6', // required and number field validation
            'confirm_password' => 'required|same:password',

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(),422);  
            // validation failed return back to form

        } else 
        {
            $form = '<form class="signin-inner" method="post" id="handleRegisterAjax" action="'.route('do-register').'" name="postform">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <h3>Enter OTP You have received on your mobile number</h3>
                                <div name="0" id="errors-list"></div>
                            </div>
                            <div class="col-12">
                                <label class="single-input-inner style-bg-border">
                                    <input type="number" placeholder="OTP" name="otp" >
                                    '.csrf_field().'
                                </label>
                            </div>
                            <div class="col-12 mb-1">
                                <button type="submit" class="btn btn-base w-100">Submit OTP</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                    <div class="col-12 mb-1" id="resend_otp">
                                <button type="submit" onclick="resend_otp()" class="btn btn-base w-100">Resend OTP</button>
                            </div>
                    </div>';
            //$otp =   $otp = rand(100000, 999999);
            $otp =   1234;
            $phone = '+'.$request->phonecode.$request->phone;
            $msg = 'Your Smart Space OTP verification Code is '.$otp;
            if ($request->phone == '8305995193') {
                $this->sendSMS($phone , $msg);
            }
             
            Session::put('OTP', $otp);
            return response()->json(["status"=>true,"otp"=>$otp,"msg"=>"<div class='alert alert-success'>OTP has been sent to your number successfully<div>","form"=>$form]); 
        } 
           
    }
    public function sendSMS($phone , $msg)
    {
        $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $client = new Client($twilio_sid, $token);
        
            $status = true;
            
            $encoded = rawurlencode("$phone");
                
                try {
                    $run = $client->messages->create(
                        $phone,
                        array(
                            //'from' => '+14693363784',
                            'from' => getenv("TWILIO_NUMBER"),
                            'body' => $msg
                        )
                    );
                } catch (Twilio\Exceptions\RestException $e) {
                    // echo '<pre>'; print_r($phone); echo '</pre>';
                    // echo '<pre>'; print_r($e); echo '</pre>';
                    // $status = false;
                    return response()->json($e->message,422);  
                }
    }
   // show dashboard
   
}