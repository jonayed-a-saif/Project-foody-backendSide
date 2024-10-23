<?php

namespace App\Http\Controllers;
use App\Loader;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LoaderController extends Controller
{
    public function getLoaderForBackend(){
        $loader = Loader::orderBy('id','desc')->get();
        return response()->json([
            'loader' => $loader
        ],200);
    }

    public function addNewLoader(Request $request){

        $this->validate($request,[
            'image' => 'required'
        ]);

        //new code for image upload in Vue JS
        $strpos = strpos($request->image,';');
        $sub = substr($request->image,0,$strpos);
        $ex = explode('/',$sub)[1];
        $image_name = time().str::random(5).".".$ex;

        $img = Image::make($request->image)->save('loader_images/' . $image_name, 100);

        Loader::insert([
            'image' => $image_name,
            'status' => 1,
            'created_at' => Carbon::now()
        ]);

    }

    public function deleteLoader($id){
        $image = Loader::where('id',$id)->first();
        if($image->image != null){
            unlink('loader_images/'.$image->image);
        }
        Loader::where('id',$id)->delete();
    }

    public function loderStatusChange($id){
        $loader = Loader::where('id',$id)->first();
        if($loader->status == 1){
            Loader::where('id',$id)->update([
                'status' => 0
            ]);
        }
        else{
            Loader::where('id',$id)->update([
                'status' => 1
            ]);
        }
    }

    public function editLoader($id){
        $loader = Loader::find($id);
        return response()->json([
            'loader' => $loader
        ],200);
    }

    public function updateLoader(Request $request,$id){
        $this->validate($request,[
            'image' => 'required',
        ]);

        $loader = Loader::where('id',$id)->first();

        if($request->image != $loader->image){

            if($loader->image != null){
                unlink('loader_images/'.$loader->image);
            }
            //new code for image upload in Vue JS
            $strpos = strpos($request->image,';');
            $sub = substr($request->image,0,$strpos);
            $ex = explode('/',$sub)[1];
            $image_name = time().str::random(5).".".$ex;
            $img = Image::make($request->image)->save('loader_images/' . $image_name, 100);

            Loader::where('id',$id)->update([
                'image' => $image_name
            ]);
        }
    }
}
