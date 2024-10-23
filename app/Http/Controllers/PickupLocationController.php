<?php

namespace App\Http\Controllers;
use App\PickupLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PickupLocationController extends Controller
{
    public function getPickupLocation(){
        $pickup_location = PickupLocation::orderBy('id','desc')->paginate(3);
        return response()->json([
            'pickup_location' => $pickup_location
        ],200);
    }

    public function addNewPickupLocation(Request $request){
        $this->validate($request,[
            'title' => 'required|min:1|max:100'
        ]);

        PickupLocation::insert([
            'title' => $request->title,
            'created_at' => Carbon::now()
        ]);
    }

    public function deletePickupLocation($id){
        PickupLocation::where('id',$id)->delete();
    }

    public function editPickupLocation($id){
        $pickup_location = PickupLocation::find($id);
        return response()->json([
            'pickup_location' => $pickup_location
        ],200);
    }

    public function updateLocation(Request $request,$id){
        //validation
        $this->validate($request,[
            'title' => 'required|min:1|max:100'
        ]);

        PickupLocation::where('id',$id)->update([
            'title' => $request->title,
            'created_at' => Carbon::now()
        ]);
    }
}
