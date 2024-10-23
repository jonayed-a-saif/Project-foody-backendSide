<?php

namespace App\Http\Controllers;
use App\ErrorBanner;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ErrorBannerController extends Controller
{
    public function getErrorBanner(){
        $error_banner = ErrorBanner::orderBy('id','desc')->get();
        return response()->json([
            'error_banner' => $error_banner
        ],200);
    }

    public function addNewErrorBanner(Request $request){
        $this->validate($request,[
            'image' => 'required'
        ]);

        //new code for image upload in Vue JS
        $strpos = strpos($request->image,';');
        $sub = substr($request->image,0,$strpos);
        $ex = explode('/',$sub)[1];
        $image_name = time().str::random(5).".".$ex;

        $img = Image::make($request->image)->save('error_banner/' . $image_name, 100);

        ErrorBanner::insert([
            'image' => $image_name,
            'status' => 1,
            'created_at' => Carbon::now()
        ]);
    }

    public function deleteBanner($id){
        $image = ErrorBanner::where('id',$id)->first();
        if($image->image != null){
            unlink('error_banner/'.$image->image);
        }
        ErrorBanner::where('id',$id)->delete();
    }

    public function editErrorBanner($id){
        $error_banner = ErrorBanner::find($id);
        return response()->json([
            'error_banner' => $error_banner
        ],200);
    }

    public function updateErrorBanner(Request $request,$id){
        $this->validate($request,[
            'image' => 'required',
        ]);

        $error_banner = ErrorBanner::where('id',$id)->first();

        if($request->image != $error_banner->image){

            if($error_banner->image != null){
                unlink('error_banner/'.$error_banner->image);
            }
            //new code for image upload in Vue JS
            $strpos = strpos($request->image,';');
            $sub = substr($request->image,0,$strpos);
            $ex = explode('/',$sub)[1];
            $image_name = time().str::random(5).".".$ex;
            $img = Image::make($request->image)->save('error_banner/' . $image_name, 100);

            ErrorBanner::where('id',$id)->update([
                'image' => $image_name
            ]);
        }
    }

    public function errorBannerStatus($id){
        $error_banner = ErrorBanner::where('id',$id)->first();
        if($error_banner->status == 1){
            ErrorBanner::where('id',$id)->update([
                'status' => 0
            ]);
        }
        else{
            ErrorBanner::where('id',$id)->update([
                'status' => 1
            ]);
        }
    }
}
