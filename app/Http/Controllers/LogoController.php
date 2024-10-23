<?php

namespace App\Http\Controllers;
use Image;
use App\Icon;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\About;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function addNewLogo(Request $request){
        $this->validate($request,[
            'icon' => 'required',
            'logo' => 'required',
            'title' => 'required'
        ]);

        //new code for image upload in Vue JS
        $strpos1 = strpos($request->icon,';');
        $sub1 = substr($request->icon,0,$strpos1);
        $ex1 = explode('/',$sub1)[1];
        $image_name1 = time().str::random(5).".".$ex1;
        $img1 = Image::make($request->icon)->save('logo_images/' . $image_name1, 100);

        //new code for image upload in Vue JS
        $strpos2 = strpos($request->logo,';');
        $sub2 = substr($request->logo,0,$strpos2);
        $ex2 = explode('/',$sub2)[1];
        $image_name2 = time().str::random(5).".".$ex2;
        $img2 = Image::make($request->logo)->save('logo_images/' . $image_name2, 100);

        Icon::insert([
            'icon' => $image_name1,
            'logo' => $image_name2,
            'title' => $request->title,
            'created_at' => Carbon::now()
        ]);
    }

    public function getLogoForBackend(){
        $logos = Icon::orderBy('id','desc')->get();
        return response()->json([
            'logos' => $logos
        ],200);
    }

    public function deleteLogo($id){
        $icon = Icon::where('id',$id)->first();

        if($icon->logo != null){
            unlink('logo_images/'.$icon->logo);
        }
        if($icon->icon != null){
            unlink('logo_images/'.$icon->icon);
        }
        Icon::where('id',$id)->delete();
    }

    public function editLogoData($id){
        $logo = Icon::find($id);
        return response()->json([
            'logo' => $logo
        ],200);
    }

    public function updateLogo(Request $request,$id){
        $this->validate($request,[
            'icon' => 'required',
            'logo' => 'required',
            'title' => 'required'
        ]);

        $icon = Icon::where('id',$id)->first();

        if($request->icon != $icon->icon){

          
            //new code for image upload in Vue JS
            $strpos1 = strpos($request->icon,';');
            $sub1 = substr($request->icon,0,$strpos1);
            $ex1 = explode('/',$sub1)[1];
            $image_name1 = time().str::random(5).".".$ex1;
            $img1 = Image::make($request->icon)->save('logo_images/' . $image_name1, 100);

            Icon::where('id',$id)->update([
                'icon' => $image_name1
            ]);
        }

        if($request->logo != $icon->logo){

           
            //new code for image upload in Vue JS
            $strpos1 = strpos($request->logo,';');
            $sub1 = substr($request->logo,0,$strpos1);
            $ex1 = explode('/',$sub1)[1];
            $image_name1 = time().str::random(5).".".$ex1;
            $img1 = Image::make($request->logo)->save('logo_images/' . $image_name1, 100);

            Icon::where('id',$id)->update([
                'logo' => $image_name1
            ]);
        }

        Icon::where('id',$id)->update([
            'title' => $request->title
        ]);

    }

    public function getAboutForBackend(){
        $about = About::orderBy('id','desc')->get();
        return response()->json([
            'about' => $about
        ],200);
    }

    public function addNewAbout(Request $request){
        $this->validate($request,[
            'image' => 'required',
            'details' => 'required',
            'tag_line' => 'required',
            'location' => 'required',
            'contact' => 'required',
        ]);

        //new code for image upload in Vue JS
        $strpos = strpos($request->image,';');
        $sub = substr($request->image,0,$strpos);
        $ex = explode('/',$sub)[1];
        $image_name = time().str::random(5).".".$ex;
        $img = Image::make($request->image)->save('about_images/' . $image_name, 100);

        About::insert([
            'image' => $image_name,
            'details' => $request->details,
            'tag_line' => $request->tag_line,
            'location' => $request->location,
            'contact' => $request->contact,
            'created_at' => Carbon::now()
        ]);
    }

    public function deleteAbout($id){
        $image = About::where('id',$id)->first();

        if($image->image != null){
            unlink('about_images/'.$image->image);
        }
        About::where('id',$id)->delete();
    }

    public function editAboutData($id){
        $about = About::find($id);
        return response()->json([
            'about' => $about
        ],200);
    }

    public function updateAbout(Request $request,$id){
        $this->validate($request,[
            'image' => 'required',
            'details' => 'required',
            'tag_line' => 'required',
            'location' => 'required',
            'contact' => 'required',
        ]);

        $icon = About::where('id',$id)->first();

        if($request->image != $icon->image){

            if($icon->image != null){
                unlink('about_images/'.$icon->image);
            }

            //new code for image upload in Vue JS
            $strpos = strpos($request->image,';');
            $sub = substr($request->image,0,$strpos);
            $ex = explode('/',$sub)[1];
            $image_name = time().str::random(5).".".$ex;
            $img = Image::make($request->image)->save('about_images/' . $image_name, 100);

            About::where('id',$id)->update([
                'image' => $image_name
            ]);
        }

        About::where('id',$id)->update([
            'details' => $request->details,
            'tag_line' => $request->tag_line,
            'location' => $request->location,
            'contact' => $request->contact,
            'created_at' => Carbon::now()
        ]);
    }
}
