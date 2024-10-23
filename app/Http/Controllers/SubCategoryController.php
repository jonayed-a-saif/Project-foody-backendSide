<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function viewAllSubCategory(){
        $sub_categories = DB::table('sub_categories')
                            ->join('categories','sub_categories.category_id','=','categories.id')
                            ->select('sub_categories.*','categories.name as category_name')
                            ->orderBy('id','desc')
                            ->get();

        return response()->json([
            'subcategories' => $sub_categories
        ],200);
    }

    public function addNewSubCategory(Request $request){
        $this->validate($request,[
            'name' => 'required|min:2|max:50',
            'category_id' => 'required'
        ]);

        $without_space = str_replace(" ","-",$request->name);
        $without_slashAndSpace = str_replace("/","-",$without_space);
        $without_slashAndSpaceAndDot = str_replace(".","-",$without_space);
        $slug = $without_slashAndSpaceAndDot.time().str::random(5);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'created_at' => Carbon::now()
        ]);
        return ['message' => 'ok'];

    }

    public function deleteSubCategory($id){
        SubCategory::where('id',$id)->delete();
    }

    public function editSubCategory($id){
        $subcategory = SubCategory::where('id',$id)->first();
        return response()->json([
            'subcategory' => $subcategory
        ],200);
    }

    public function updateSubCategory(Request $request,$id){
        $this->validate($request,[
            'name' => 'required|min:2|max:50',
            'category_id' => 'required'
        ]);

        $without_space = str_replace(" ","-",$request->name);
        $without_slashAndSpace = str_replace("/","-",$without_space);
        $without_slashAndSpaceAndDot = str_replace(".","-",$without_space);
        $slug = $without_slashAndSpaceAndDot.time().str::random(5);

        SubCategory::where('id',$id)->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'slug' => $slug,
            'updated_at' => Carbon::now(),
        ]);

    }
}
