<?php

namespace App\Http\Controllers;
use App\Footer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function getFooterForBackend(){
        $footer = Footer::orderBy('id','desc')->get();
        return response()->json([
            'footer' => $footer
        ],200);
    }

    public function addNewFooter(Request $request){
        $this->validate($request,[
            'footer_text' => 'required|min:1|max:500',
            'copyright_text' => 'required|min:1|max:200'
        ]);

        Footer::insert([
            'footer_text' => $request->footer_text,
            'copyright_text' => $request->copyright_text,
            'created_at' => Carbon::now()
        ]);
    }

    public function deleteFooter($id){
        Footer::where('id',$id)->delete();
    }

    public function editFooterDetails($id){
        $footer = Footer::find($id);
        return response()->json([
            'footer' => $footer
        ],200);
    }

    public function updateFooter(Request $request,$id){
        $this->validate($request,[
            'footer_text' => 'required|min:1|max:500',
            'copyright_text' => 'required|min:1|max:200'
        ]);
        Footer::where('id',$id)->update([
            'footer_text' => $request->footer_text,
            'copyright_text' => $request->copyright_text,
            'created_at' => Carbon::now()
        ]);
    }
}
