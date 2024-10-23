<?php

namespace App\Http\Controllers;
use App\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function addNewCoupon(Request $request){

        //validation
        $this->validate($request,[
            'code' => 'required|min:1|max:100',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if($request->type == "percentage"){
            Coupon::insert([
                'code' => $request->code,
                'type' => $request->type,
                'percentage' => $request->percentage,
                'amount' => null,
                'min_qty' => $request->min_qty,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'updated_at' => Carbon::now()
            ]);
        }
        else{
            Coupon::insert([
                'code' => $request->code,
                'type' => $request->type,
                'percentage' => null,
                'amount' => $request->amount,
                'min_qty' => $request->min_qty,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'updated_at' => Carbon::now()
            ]);
        }
    }

    public function getCoupon(){

        $coupons = Coupon::all();

        return response()->json([
            'coupons' => $coupons
        ],200);
    }

    public function deleteCoupon($id){
        Coupon::where('id',$id)->delete();
    }

    public function editCoupon($id){
        $coupon = Coupon::find($id);
        return response()->json([
            'coupon' => $coupon
        ],200);
    }

    public function updateCoupon(Request $request, $id){

        $this->validate($request,[
            'code' => 'required|min:1|max:100',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if($request->type == "percentage"){
            Coupon::where('id',$id)->update([
                'code' => $request->code,
                'type' => $request->type,
                'percentage' => $request->percentage,
                'amount' => null,
                'min_qty' => $request->min_qty,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'updated_at' => Carbon::now()
            ]);
        }
        else{
            Coupon::where('id',$id)->update([
                'code' => $request->code,
                'type' => $request->type,
                'percentage' => null,
                'amount' => $request->amount,
                'min_qty' => $request->min_qty,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'updated_at' => Carbon::now()
            ]);
        }

    }
}
