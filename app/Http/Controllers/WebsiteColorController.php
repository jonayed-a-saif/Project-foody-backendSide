<?php

namespace App\Http\Controllers;
use App\WebsiteColor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebsiteColorController extends Controller
{
    public function getWebsiteColorforBackend(){
        $website_color = WebsiteColor::orderBy('id','desc')->get();
        return response()->json([
            'website_color' => $website_color
        ],200);
    }

    public function addNewWesbiteColor(Request $request){
        $this->validate($request,[
            'theme_color' => 'required',
            'menu_color' => 'required',
            'footer_color' => 'required',
            'copyright_color' => 'required',
        ]);

        WebsiteColor::insert([
            'theme_color' => $request->theme_color,
            'menu_color' => $request->menu_color,
            'footer_color' => $request->footer_color,
            'copyright_color' => $request->copyright_color,
            'created_at' => Carbon::now(),
        ]);
    }

    public function deleteWebsiteColor($id){
        WebsiteColor::where('id',$id)->delete();
    }

    public function editWebsiteColorData($id){
        $website_color = WebsiteColor::find($id);
        return response()->json([
            'website_color' => $website_color
        ],200);
    }

    public function updateWebsiteColor(Request $request,$id){
        $this->validate($request,[
            'theme_color' => 'required',
            'menu_color' => 'required',
            'footer_color' => 'required',
            'copyright_color' => 'required',
        ]);

        WebsiteColor::where('id',$id)->update([
            'theme_color' => $request->theme_color,
            'menu_color' => $request->menu_color,
            'footer_color' => $request->footer_color,
            'copyright_color' => $request->copyright_color,
            'created_at' => Carbon::now(),
        ]);
    }
}
