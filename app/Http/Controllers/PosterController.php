<?php

namespace App\Http\Controllers;
use Image;
use App\Poster;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PosterController extends Controller
{
    public function addNewPoster(Request $request){
        $this->validate($request,[
            'image' => 'required',
            'link' => 'required',
            'position' => 'required'
        ]);

        //new code for image upload in Vue JS
        $strpos = strpos($request->image,';');
        $sub = substr($request->image,0,$strpos);
        $ex = explode('/',$sub)[1];
        $image_name = time().str::random(5).".".$ex;
        $img = Image::make($request->image)->resize(700, 200)->save('poster_images/' . $image_name, 100);

        Poster::insert([
            'image' => $image_name,
            'link' => $request->link,
            'position' => $request->position,
            'created_at' => Carbon::now()
        ]);
    }

    public function getPostersForbackend(){
        $posters = Poster::orderBy('id','desc')->get();
        return response()->json([
            'posters' => $posters
        ],200);
    }

    public function deletePoster($id){
        $data = Poster::where('id',$id)->first();
        if($data->image != null){
            unlink('poster_images/'.$data->image);
        }
        Poster::findOrFail($id)->delete();
    }

    public function editPoster($id){
        $poster = Poster::find($id);
        return response()->json([
            'poster' => $poster
        ],200);
    }

    public function updatePoster(Request $request,$id){
        $this->validate($request,[
            'image' => 'required',
            'link' => 'required',
            'position' => 'required'
        ]);

        $poster_info = Poster::where('id',$id)->first();

        if($request->image != $poster_info->image){

            //delete previous image if uploaded new
            if(file_exists('poster_images/'.$poster_info->image)){
                unlink('poster_images/'.$poster_info->image);
            }

            //new code for image upload in Vue JS
            $strpos = strpos($request->image,';');
            $sub = substr($request->image,0,$strpos);
            $ex = explode('/',$sub)[1];
            $image_name = time().str::random(5).".".$ex;
            $img = Image::make($request->image)->resize(1920, 510)->save('poster_images/' . $image_name, 100);

            Poster::where('id',$id)->update([
                'image' => $image_name,
                'link' => $request->link,
                'position' => $request->position,
                'created_at' => Carbon::now()
            ]);

        }
        else{

            Poster::where('id',$id)->update([
                'link' => $request->link,
                'position' => $request->position,
                'created_at' => Carbon::now()
            ]);

        }
    }
}
