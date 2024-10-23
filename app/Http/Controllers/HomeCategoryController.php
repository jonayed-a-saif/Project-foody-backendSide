<?php

namespace App\Http\Controllers;

use App\HomeCategory;
use App\HomeCategoryProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeCategoryController extends Controller
{
    public function viewAllCategory(){
        $homecategories = HomeCategory::orderBy('id','desc')->paginate(10);
        //sending in json format to the resouce/js/store/index.js
        return response()->json([
            'homecategories' => $homecategories
        ],200);
    }

    public function getCategoryForProduct(){
        $categories = Category::orderBy('id','desc')->get();
        //sending in json format to the resouce/js/store/index.js
        return response()->json([
            'categories' => $categories
        ],200);
    }

    public function addNewCategory(Request $request){

        $this->validate($request,[
            'category_name' => 'required|min:2|max:100',
        ]);


        $without_space = str_replace(" ","-",$request->category_name);
        $without_slashAndSpace = str_replace("/","-",$without_space);
        $without_slashAndSpaceAndDot = str_replace(".","-",$without_space);
        $slug = $without_slashAndSpaceAndDot.time().str::random(5);
        HomeCategory::insert([
            'name' => $request->category_name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'slug' => $slug,
            'created_at' => Carbon::now()
        ]);
        return ['message' => 'ok'];
    }

    public function deleteCategory($id){

    	 HomeCategory::findOrFail($id)->delete();
         HomeCategoryProduct::where('home_category_id',$id)->delete();

       
    }

    public function editCategory($id){
        $homecategory = HomeCategory::find($id);
        return response()->json([
            'homecategory' => $homecategory
        ],200);
    }

    public function updateCategory(Request $request,$id){
        $this->validate($request,[
            'name' => 'required|min:2|max:100',
        ]);

        $without_space = str_replace(" ","-",$request->name);
        $without_slashAndSpace = str_replace("/","-",$without_space);
        $without_slashAndSpaceAndDot = str_replace(".","-",$without_space);
        $slug = $without_slashAndSpaceAndDot.time().str::random(5);

        HomeCategory::where('id',$id)->update([
            'name' => $request->name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'slug' => $slug,
            'updated_at' => Carbon::now(),
        ]);
        
    }

    public function productSearch($term){


        $products = DB::table('products')
                        ->where('status',1)
                        ->where('products.name','LIKE',''.$term.'%')
                        ->orderBy('id','desc')
                        ->get();
        return response()->json($products);


    }

    public function addHomeCategoryProduct(Request $request){

        $home_category_id = HomeCategory::where('slug',$request->slug)->first()->id;

        $productAlreadyAdded = HomeCategoryProduct::where('home_category_id',$home_category_id)->where('product_id',$request->product_id)->first();
        if (!isset($productAlreadyAdded)) {
            $home_cat_pro = new HomeCategoryProduct();

            $home_cat_pro->product_id = $request->product_id;
            $home_cat_pro->home_category_id = $home_category_id;
            $home_cat_pro->save();

            return response()->json('success');
        }else{
            return response()->json('error');
        }

        


        

    }

    public function getHomeCategoryProduct($slug){

        $home_category_id = HomeCategory::where('slug',$slug)->first()->id;

        $homecategoriesProducts = HomeCategoryProduct::where('home_category_id',$home_category_id)->orderBy('id','desc')->paginate(10);
        //sending in json format to the resouce/js/store/index.js
        return response()->json([
            'homecategoriesProducts' => $homecategoriesProducts
        ],200);

    }

    public function homeCategoryDetail($slug){

        $home_category = HomeCategory::where('slug',$slug)->first();
        return response()->json($home_category);

    }

    public function deleteHomeCategoryProduct($id){

        HomeCategoryProduct::findOrFail($id)->delete();

    }
}
