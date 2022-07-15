<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Plans;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Hash;
use DB;
use Carbon\Carbon;
use Stripe;
use Session;
class Membership extends Controller
{
    public function stripePost(Request $request)
    {
        require_once(base_path().'/vendor/stripe/stripe-php/init.php');

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $paymentData = Stripe\Charge::create ([
                "amount" => $request->amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from tutsmake.com."
        ]);
        
        Session::flash('success', 'Payment successful!');
        $plans = Plans::find($request->plan_id);
        $User = Auth::user();
        $insert['plan_id'] = $request->plan_id;
        $insert['user_id'] = Auth::id();
        $insert['price'] = $request->amount;
        $insert['payment_id'] = $paymentData->id;
        $insert['status'] = 1;
        $insert['created_at'] = date('Y-m-d');
        $run = DB::table('subscriptions')->insert($insert);
        $update['property_count'] = $plans->number_of_property;
        $update['plan_id'] = $plans->id;
        $run = User::where('id', $User->id)->update($update);
        return response()->json(["status"=>1,"data"=>$paymentData,"msg"=>"Your plan has been upgraded successfully","redirect_location"=>route("membership")]);
    }
}
