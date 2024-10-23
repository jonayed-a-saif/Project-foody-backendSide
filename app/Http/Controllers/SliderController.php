<?php

namespace App\Http\Controllers;
use Image;
use App\Banner;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function addNewSlider(Request $request){
        $this->validate($request,[
            'image' => 'required',
           
        ]);

        //new code for image upload in Vue JS
        $strpos = strpos($request->image,';');
        $sub = substr($request->image,0,$strpos);
        $ex = explode('/',$sub)[1];
        $image_name = time().str::random(5).".".$ex;
        $img = Image::make($request->image)->save('slider_images/' . $image_name, 100);

        Banner::insert([
            'image' => $image_name,
            'subtitle' => $request->subtitle,
            'subtitle_color' => $request->subtitle_color,
            'title' => $request->title,
            'title_color' => $request->title_color,
            'text' => $request->text,
            'text_color' => $request->text_color,
            'link' => $request->link,
            'created_at' => Carbon::now()
        ]);
    }

    public function getAllSlider(){
        $sliders = Banner::orderBy('id','desc')->get();
        return response()->json([
            'sliders' => $sliders
        ],200);
    }

    public function deleteSlider($id){
        $data = Banner::where('id',$id)->first();
        if($data->image != null){
            unlink('slider_images/'.$data->image);
        }
        Banner::findOrFail($id)->delete();
    }

    public function editSlider($id){
        $slider = Banner::find($id);
        return response()->json([
            'slider' => $slider
        ],200);
    }

    public function updateSlider(Request $request, $id){
        $this->validate($request,[
            'image' => 'required',
           
        ]);

        $slider_info = Banner::where('id',$id)->first();

        if($request->image != $slider_info->image){

            //delete previous image if uploaded new
            if(file_exists('slider_images/'.$slider_info->image)){
                unlink('slider_images/'.$slider_info->image);
            }

            //new code for image upload in Vue JS
            $strpos = strpos($request->image,';');
            $sub = substr($request->image,0,$strpos);
            $ex = explode('/',$sub)[1];
            $image_name = time().str::random(5).".".$ex;
            $img = Image::make($request->image)->save('slider_images/' . $image_name, 100);

            Banner::where('id',$id)->update([
                'image' => $image_name,
                'subtitle' => $request->subtitle,
                'subtitle_color' => $request->subtitle_color,
                'title' => $request->title,
                'title_color' => $request->title_color,
                'text' => $request->text,
                'text_color' => $request->text_color,
                'link' => $request->link,
                'created_at' => Carbon::now()
            ]);
        }
        else{
            Banner::where('id',$id)->update([
                'subtitle' => $request->subtitle,
                'subtitle_color' => $request->subtitle_color,
                'title' => $request->title,
                'title_color' => $request->title_color,
                'text' => $request->text,
                'text_color' => $request->text_color,
                'link' => $request->link,
                'created_at' => Carbon::now()
            ]);
        }

    }
}
