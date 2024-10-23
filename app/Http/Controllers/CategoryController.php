<?php

namespace App\Http\Controllers;
use App\Category;
use Carbon\Carbon;
use App\Product;
use App\SubCategory;
use Image;
use App\ChildCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function viewAllCategory(){
        $categories = Category::orderBy('id','desc')->paginate(10);
        //sending in json format to the resouce/js/store/index.js
        return response()->json([
            'categories' => $categories
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
            'category_name' => 'required|min:2|max:50',
		    'image' => 'required'
        ]);

        //new code for image upload in Vue JS
        $strpos = strpos($request->image,';');
        $sub = substr($request->image,0,$strpos);
        $ex = explode('/',$sub)[1];
        $image_name = time().str::random(5).".".$ex;
        $img = Image::make($request->image)->save('category_images/' . $image_name, 100);


        $without_space = str_replace(" ","-",$request->category_name);
        $without_slashAndSpace = str_replace("/","-",$without_space);
        $without_slashAndSpaceAndDot = str_replace(".","-",$without_space);
        $slug = $without_slashAndSpaceAndDot.time().str::random(5);
        Category::insert([
            'name' => $request->category_name,
            'image' => $image_name,
            'slug' => $slug,
            'created_at' => Carbon::now()
        ]);
        return ['message' => 'ok'];
    }

    public function deleteCategory($id){
        if(Product::where('category_id',$id)->exists() || SubCategory::where('category_id',$id)->exists() || ChildCategory::where('category_id',$id)->exists()){
            return response()->json([
                'Message' => "Cant Be Deleted"
            ],404);
        }
        else{
            $data = Category::where('id',$id)->first();
            if($data->image != null){
                unlink('category_images/'.$data->image);
            }
            Category::findOrFail($id)->delete();
        }
    }

    public function editCategory($id){
        $category = Category::find($id);
        return response()->json([
            'category' => $category
        ],200);
    }

    public function updateCategory(Request $request,$id){
        $this->validate($request,[
            'name' => 'required|min:2|max:50',
            'image' => 'required'
        ]);

        $without_space = str_replace(" ","-",$request->category_name);
        $without_slashAndSpace = str_replace("/","-",$without_space);
        $without_slashAndSpaceAndDot = str_replace(".","-",$without_space);
        $slug = $without_slashAndSpaceAndDot.time().str::random(5);

        $category_info = Category::where('id',$id)->first();

        if($request->image != $category_info->image){

            //delete previous image if uploaded new
            if(file_exists('category_images/'.$category_info->image)){
                unlink('category_images/'.$category_info->image);
            }

            //new code for image upload in Vue JS
            $strpos = strpos($request->image,';');
            $sub = substr($request->image,0,$strpos);
            $ex = explode('/',$sub)[1];
            $image_name = time().str::random(5).".".$ex;
            $img = Image::make($request->image)->save('category_images/' . $image_name, 100);

            Category::where('id',$id)->update([
                'name' => $request->name,
                'image' => $image_name,
                'slug' => $slug,
                'updated_at' => Carbon::now(),
            ]);
        }
        else{
            Category::where('id',$id)->update([
                'name' => $request->name,
                'slug' => $slug,
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
