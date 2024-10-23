<?php

namespace App\Http\Controllers;
use App\PopupBanner;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PopupBannerController extends Controller
{
    public function getPopupBannerForBackend(){
        $popup_banner = PopupBanner::orderBy('id','desc')->get();
        return response()->json([
            'popup_banner' => $popup_banner
        ],200);
    }

    public function addNewPopupBanner(Request $request){
        $this->validate($request,[
            'title' => 'required|min:1|max:100',
            'text' => 'required|min:1|max:500',
            'image' => 'required',
        ]);

        //new code for image upload in Vue JS
        $strpos = strpos($request->image,';');
        $sub = substr($request->image,0,$strpos);
        $ex = explode('/',$sub)[1];
        $image_name = time().str::random(5).".".$ex;

        $img = Image::make($request->image)->save('popup_banners/' . $image_name, 100);

        PopupBanner::insert([
            'image' => $image_name,
            'title' => $request->title,
            'text' => $request->text,
            'status' => 1,
            'created_at' => Carbon::now()
        ]);
    }

    public function deletePopupBanner($id){
        $image = PopupBanner::where('id',$id)->first();
        if($image->image != null){
            unlink('popup_banners/'.$image->image);
        }
        PopupBanner::where('id',$id)->delete();
    }

    public function statusChange($id){
        $loader = PopupBanner::where('id',$id)->first();
        if($loader->status == 1){
            PopupBanner::where('id',$id)->update([
                'status' => 0
            ]);
        }
        else{
            PopupBanner::where('id',$id)->update([
                'status' => 1
            ]);
        }
    }

    public function editPopupBannerData($id){
        $popup_banner = PopupBanner::find($id);
        return response()->json([
            'popup_banner' => $popup_banner
        ],200);
    }

    public function updatePopupBanner(Request $request,$id){
        $this->validate($request,[
            'title' => 'required|min:1|max:100',
            'text' => 'required|min:1|max:500',
            'image' => 'required',
        ]);

        $banner = PopupBanner::where('id',$id)->first();

        if($request->image != $banner->image){
            //new code for image upload in Vue JS
            $strpos = strpos($request->image,';');
            $sub = substr($request->image,0,$strpos);
            $ex = explode('/',$sub)[1];
            $image_name = time().str::random(5).".".$ex;
            $img = Image::make($request->image)->save('popup_banners/' . $image_name, 100);

            PopupBanner::where('id',$id)->update([
                'image' => $image_name,
                'title' => $request->title,
                'text' => $request->text,
                'created_at' => Carbon::now()
            ]);
        }
        else{
            PopupBanner::where('id',$id)->update([
                'title' => $request->title,
                'text' => $request->text,
                'created_at' => Carbon::now()
            ]);
        }


    }
}
