<?php

namespace App\Http\Controllers;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function addNewPayment(Request $request){
        //validation
        $this->validate($request,[
            'title' => 'required|min:1|max:100',
            'details' => 'required',
        ]);

        Payment::insert([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'details' => $request->details,
            'created_at' => Carbon::now()
        ]);
    }

    public function getPaymentBackend(){
        $payments = Payment::all();

        return response()->json([
            'payments' => $payments
        ],200);
    }

    public function deletePayment($id){
        Payment::where('id',$id)->delete();
    }

    public function statusChange($id){
        $data = Payment::where('id',$id)->first();
        if($data->status == 1){
            Payment::where('id',$id)->update([
                'status' => 0
            ]);
        }
        else{
            Payment::where('id',$id)->update([
                'status' => 1
            ]);
        }
    }

    public function editPayment($id){
        $payment = Payment::find($id);
        return response()->json([
            'payment' => $payment
        ],200);
    }

    public function updatePayment(Request $request, $id){
         //validation
         $this->validate($request,[
            'title' => 'required|min:1|max:100',
            'details' => 'required',
        ]);

        Payment::where('id',$id)->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'details' => $request->details,
            'created_at' => Carbon::now()
        ]);
    }
}
