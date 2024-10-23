<?php

namespace App\Http\Controllers;
use App\Packaging;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PackagingController extends Controller
{
    public function getPackagingData(){
        $packaging = Packaging::orderBy('id','desc')->get();
        return response()->json([
            'packaging' => $packaging
        ],200);
    }

    public function addNewPackaging(Request $request){
        $this->validate($request,[
            'title' => 'required|min:1|max:100',
            'subtitle' => 'required|min:1|max:100',
            'price' => 'required|numeric',
        ]);

        Packaging::insert([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'price' => $request->price,
            'created_at' => Carbon::now()
        ]);
    }

    public function deletePackaging($id){
        Packaging::where('id',$id)->delete();
    }

    public function editPackaging($id){
        $packaging = Packaging::find($id);
        return response()->json([
            'packaging' => $packaging
        ],200);
    }

    public function updatePackaging(Request $request,$id){
        //validation
        $this->validate($request,[
            'title' => 'required|min:1|max:100',
            'subtitle' => 'required|min:1|max:100',
            'price' => 'required|numeric',
        ]);

        Packaging::where('id',$id)->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'price' => $request->price,
            'created_at' => Carbon::now()
        ]);
    }
}
