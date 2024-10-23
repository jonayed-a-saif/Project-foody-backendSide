<?php

namespace App\Http\Controllers;
use App\ChildCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    public function viewAllChildCategory(){
        $child_categories = DB::table('child_categories')
                                ->join('sub_categories','child_categories.subcategory_id','=','sub_categories.id')
                                ->join('categories','child_categories.category_id','=','categories.id')
                                ->select('child_categories.*','categories.name as category_name','sub_categories.name as subcategory_name')
                                ->orderBy('id','desc')
                                ->get();

        return response()->json([
            'childcategories' => $child_categories
        ],200);
    }

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

    public function getSubCategoryByCategory($id){
        $data = SubCategory::where('category_id',$id)->get();
        return response()->json($data);
    }

    public function getSubCategoryByCategoryEditProduct($id){
        $data = SubCategory::where('category_id',$id)->get();
        return response()->json($data);
    }

    public function addNewChildCategory(Request $request){
        $this->validate($request,[
            'name' => 'required|min:2|max:50',
            'category_id' => 'required',
            'subcategory_id' => 'required'
        ]);

        $without_space = str_replace(" ","-",$request->name);
        $without_slashAndSpace = str_replace("/","-",$without_space);
        $without_slashAndSpaceAndDot = str_replace(".","-",$without_space);
        $slug = $without_slashAndSpaceAndDot.time().str::random(5);

        ChildCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'slug' => $slug,
            'created_at' => Carbon::now()
        ]);
        return ['message' => 'ok'];
    }

    public function deleteChildCategory($id){
        ChildCategory::where('id',$id)->delete();
    }

    public function editChildCategory($id){
        $childcategory = ChildCategory::where('id',$id)->first();
        return response()->json([
            'childcategory' => $childcategory
        ],200);
    }

    public function updateChildCategory(Request $request,$id){
        $this->validate($request,[
            'name' => 'required|min:2|max:50',
            'subcategory_id' => 'required'
        ]);

        $without_space = str_replace(" ","-",$request->name);
        $without_slashAndSpace = str_replace("/","-",$without_space);
        $without_slashAndSpaceAndDot = str_replace(".","-",$without_space);
        $slug = $without_slashAndSpaceAndDot.time().str::random(5);

        if($request->subcategory_id != null){
            ChildCategory::where('id',$id)->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'slug' => $slug,
                'updated_at' => Carbon::now(),
            ]);
        }
        else{
            ChildCategory::where('id',$id)->update([
                'name' => $request->name,
                'slug' => $slug,
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
