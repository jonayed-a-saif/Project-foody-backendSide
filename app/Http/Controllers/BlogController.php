<?php

namespace App\Http\Controllers;
use App\BlogCategory;
use App\Blog;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getBlogCategoryBackend(){
        $blogCategories = BlogCategory::all();
        return response()->json([
            'blogCategories' => $blogCategories
        ],200);
    }

    public function addNewBlogCategory(Request $request){

        $this->validate($request,[
            'name' => 'required|min:2|max:50'
        ]);

        $without_space = str_replace(" ","-",$request->name);
        $without_slashAndSpace = str_replace("/","-",$without_space);
        $without_slashAndSpaceAndDot = str_replace(".","-",$without_space);
        $slug = $without_slashAndSpaceAndDot.time().str::random(5);

        BlogCategory::insert([
            'name' => $request->name,
            'slug' => $slug,
            'created_at' => Carbon::now()
        ]);
    }

    public function deleteBlogCategory($id){
        if(Blog::where('category_id',$id)->exists()){
            return response()->json([
                'Message' => "Cant Be Deleted"
            ],404);
        }
        else{
            BlogCategory::where('id',$id)->delete();
        }
    }

    public function editBlogCategory($id){
        $blogCategory = BlogCategory::find($id);
        return response()->json([
            'blogCategory' => $blogCategory
        ],200);
    }

    public function updateBlogCategory(Request $request, $id){
        $this->validate($request,[
            'name' => 'required|min:2|max:50'
        ]);

        $without_space = str_replace(" ","-",$request->name);
        $without_slashAndSpace = str_replace("/","-",$without_space);
        $without_slashAndSpaceAndDot = str_replace(".","-",$without_space);
        $slug = $without_slashAndSpaceAndDot.time().str::random(5);

        BlogCategory::where('id',$id)->update([
            'name' => $request->name,
            'slug' => $slug,
            'created_at' => Carbon::now()
        ]);
    }

    public function addNewBlog(Request $request){

        //validation
        $this->validate($request,[
            'title' => 'required|min:2|max:150',
            'category_id' => 'required',
            'image' => 'required',
            'details' => 'required',
        ]);

        //new code for image upload in Vue JS
        $strpos = strpos($request->image,';');
        $sub = substr($request->image,0,$strpos);
        $ex = explode('/',$sub)[1];
        $image_name = time().str::random(5).".".$ex;
        $img = Image::make($request->image)->resize(1200, 700)->save('blog_images/' . $image_name, 100);

        //slug generate
        $without_space = str_replace(" ","-",$request->title);
        $without_slashAndSpace = str_replace("/","-",$without_space);
        $without_slashAndSpaceAndDot = str_replace(".","-",$without_space);
        $slug = $without_slashAndSpaceAndDot.time().str::random(5);

        Blog::insert([
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'image' => $image_name,
            'views' => 0,
            'details' => $request->details,
            'slug' => $slug,
            'tags' => $request->tags,
            'created_at' => Carbon::now()
        ]);
    }

    public function viewAllBlog(){
        $blogs = array();
        $blogs = DB::table('blogs')
                        ->join('users','blogs.user_id','=','users.id')
                        ->join('blog_categories','blogs.category_id','=','blog_categories.id')
                        ->select('blogs.*','users.name as user_name','blog_categories.name as category_name')
                        ->orderBy('id','desc')
                        ->paginate(10);

        return response()->json([
            'blogs' => $blogs
        ],200);
    }

    public function deleteBlog($id){
        $data = Blog::where('id',$id)->first();
        if($data->image != null){
            unlink('blog_images/'.$data->image);
        }
        Blog::where('id',$id)->delete();
    }

    public function editBlogData($id){
        $blog = Blog::where('id',$id)->first();
        return response()->json([
            'blog' => $blog
        ],200);
    }

    public function updateBlog(Request $request,$id){
        //validation
        $this->validate($request,[
            'title' => 'required|min:2|max:150',
            'category_id' => 'required',
            'image' => 'required',
            'details' => 'required',
        ]);

        //slug generate
        $without_space = str_replace(" ","-",$request->title);
        $without_slashAndSpace = str_replace("/","-",$without_space);
        $without_slashAndSpaceAndDot = str_replace(".","-",$without_space);
        $slug = $without_slashAndSpaceAndDot.time().str::random(5);

        $blog_info = Blog::where('id',$id)->first();

        if($request->image != $blog_info->image){
            //new code for image upload in Vue JS
            $strpos = strpos($request->image,';');
            $sub = substr($request->image,0,$strpos);
            $ex = explode('/',$sub)[1];
            $image_name = time().str::random(5).".".$ex;
            $img = Image::make($request->image)->resize(1200, 700)->save('blog_images/' . $image_name, 100);

            Blog::where('id',$id)->update([
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'image' => $image_name,
                'details' => $request->details,
                'slug' => $slug,
                'tags' => $request->tags,
                'created_at' => Carbon::now()
            ]);
        }
        else{
            Blog::where('id',$id)->update([
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'details' => $request->details,
                'slug' => $slug,
                'tags' => $request->tags,
                'created_at' => Carbon::now()
            ]);
        }


    }
}
