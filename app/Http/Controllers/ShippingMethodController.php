<?php

namespace App\Http\Controllers;
use App\ShippingMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    public function getShippingMethodsForBackend(){
        $shipping_methods = ShippingMethod::orderBy('id','desc')->get();
        return response()->json([
            'shipping_methods' => $shipping_methods
        ],200);
    }

    public function addNewShippingMethod(Request $request){
        $this->validate($request,[
            'title' => 'required|min:1|max:100',
            'duration' => 'required|min:1|max:100',
            'price' => 'required|numeric',
        ]);

        ShippingMethod::insert([
            'title' => $request->title,
            'duration' => $request->duration,
            'price' => $request->price,
            'created_at' => Carbon::now()
        ]);
    }

    public function deleteShippingMethod($id){
        ShippingMethod::where('id',$id)->delete();
    }

    public function editShippingMethod($id){
        $shipping_method = ShippingMethod::find($id);
        return response()->json([
            'shipping_method' => $shipping_method
        ],200);
    }

    public function updateShippingMethod(Request $request,$id){
        $this->validate($request,[
            'title' => 'required|min:1|max:100',
            'duration' => 'required|min:1|max:100',
            'price' => 'required|numeric',
        ]);

        ShippingMethod::where('id',$id)->update([
            'title' => $request->title,
            'duration' => $request->duration,
            'price' => $request->price,
            'created_at' => Carbon::now()
        ]);
    }
}
