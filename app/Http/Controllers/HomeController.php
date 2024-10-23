<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('admin.adminmaster');
    }
    
    public function AllCustomers()
    {
        
        $all_customers = User::where('customer', 1)->get();

        return response()->json($all_customers);
    }

    public function sms()
    {
        $user = \Auth::user();
        $all_customers = User::where('customer', 1);

        return view('admin.sms.sms', compact('user', 'all_customers'));
    }

    public function sendsms(Request $request)
    {
        
        if($request->all_customers) {
            $all_customers = User::where('customer', 1);

            $userIds = [];
            foreach($all_customers as $row) {
                $userIds[] = $row->id;
            }
            // dd($userIds);
        } else {

            if(!empty($request->user_ids)) {
                $userIds = [];
                $userIds = $request->user_ids;
                $userIds = (array)$userIds;
            } else if(!empty($request->mobile_number)) {
                $mobileNumber = '0'.$request->mobile_number;
                // dd($mobileNumber);
            }
            
        }
        
        $message = $request->message;

        if(!empty($message) && !empty($userIds)) {

            $allMobilenumbers = "";

            foreach($userIds as $cusId) {

            $customer = User::where(['id' => $cusId, 'customer' => 1])->first();   
            $customersMobile = '88'.$customer->contact; 
            $allMobilenumbers .= $customer->contact.',';

            // dd($customersMobile, $message);

            $endpoint = "https://login.esms.com.bd/api/v3/sms/send";
            $curl = curl_init($endpoint);
              
            $headers = array(
                    'Content-Type: application/json',
                    'Authorization: Bearer 93|A2aS2ka0V9xdt93Sk4Jqypvwh0mOMnpmEYgBIztM'
                    );

			$post_data = array(
                'recipient' => $customersMobile,
                'sender_id' => '8809601003704',
                'type' => 'plain',
                'message' => $message,
                    
            );
            //   dd($transactionMsg);
            curl_setopt($curl, CURLOPT_URL, $endpoint);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($post_data) );
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
            $post_response = curl_exec($curl); 
            // dd($post_response);
        } 
            if($request->all_customers) {
                $recipient = 'All Customer';
            } else {
                $recipient = $allMobilenumbers;
            }

            $dataInsert = array(
                'message' => $message,
                'recipients' => $recipient
            );
            DB::table('messages')->insert($dataInsert);

            return redirect()->back()->with('success', 'Your message have been sent successfully.');
        }
        else if(!empty($message) && !empty($mobileNumber)) {
 
            $customersMobile = '88'.$mobileNumber;  

            // dd($customersMobile, $message);

            $endpoint = "https://login.esms.com.bd/api/v3/sms/send";
            $curl = curl_init($endpoint);
              
            $headers = array(
                    'Content-Type: application/json',
                    'Authorization: Bearer 93|A2aS2ka0V9xdt93Sk4Jqypvwh0mOMnpmEYgBIztM'
                    );

            $post_data = array(
                'recipient' => $customersMobile,
                'sender_id' => '8809601003704',
                'type' => 'plain',
                'message' => $message,
                    
            );
            //   dd($transactionMsg);
            curl_setopt($curl, CURLOPT_URL, $endpoint);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($post_data) );
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
            $post_response = curl_exec($curl);  
            // dd($post_response);

            $dataInsert = array(
                'message' => $message,
                'recipients' => $mobileNumber
            );
            DB::table('messages')->insert($dataInsert);

        }

        else {
           
        }

    }

    public function AllSms()
    {
        $user = \Auth::user();
        $messages = DB::table('messages')->orderByDesc('id')->paginate(10);

        // $categories = Category::orderBy('id','desc')->paginate(10);
        //sending in json format to the resouce/js/store/index.js
        return response()->json([
            'messages' => $messages
        ],200);
    }

    public function getTotalSmsForDashboard(){
        $totalSmsCount = DB::table('messages')->count();

        return response()->json([
            'totalSms' => $totalSmsCount,
        ],200);
    }

    public function getTotalRemainSmsForDashboard(){
        
        $totalSMS = DB::table('messages')->get()->count();

        $endpoint = "https://login.esms.com.bd/api/v3/balance";
        $curl = curl_init($endpoint);
        
        $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer 93|A2aS2ka0V9xdt93Sk4Jqypvwh0mOMnpmEYgBIztM'
                );

        //   dd($transactionMsg);
        curl_setopt($curl, CURLOPT_URL, $endpoint);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
        $post_response = curl_exec($curl);
        
        $post_response_decode = json_decode($post_response);
        $sms_balance = $post_response_decode->data->remaining_unit;
        $sms_balanceNumber = str_replace(',', '', $sms_balance);
        $remainingSms = (float)$sms_balanceNumber / 0.25;
        // dd($remainingSms);

        return response()->json([
            'totalRemainSms' => $remainingSms,
        ],200);
    }
}
