<?php

namespace App\Http\Controllers;
use App\Product;
use App\ChildCategory;
use App\Category;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function viewAllProduct(){

        $products = array();
        $products = DB::table('products')
                        ->leftJoin('users','products.user_id','=','users.id')
                        ->leftJoin('categories','products.category_id','=','categories.id')
                        ->select('products.*','users.name as user_name','categories.name as category_name')
                        ->orderBy('id','desc')
                        ->paginate(10);

        $info = Product::count();
// dd($products);
        return response()->json([
            'products' => $products,
            'numberofproducts' => $info
        ],200);

    }

    public function xgetAllProducts()
    {
        $records = DB::table('products')
                        ->leftJoin('users','products.user_id','=','users.id')
                        ->leftJoin('categories','products.category_id','=','categories.id')
                        ->select('products.id', 'users.name as user_name','categories.name as category_name', 'products.name', 'products.stock', 'products.image', 'products.price', 'products.slug', 'products.created_at', 'products.status')
                        ->orderBy('id','desc')
                        ->get()
                        ;

                        if (isset($records) && count($records) > 0) {
                            foreach ($records as $key => $value) {
                                
                                $nestedData = array();
                                $nestedData[] = $value->id;
                                $nestedData[] = $value->user_name;
                                $nestedData[] = $value->category_name;
                                $nestedData[] = $value->name;
                                $nestedData[] = $value->stock;
                                $nestedData[] = $value->image;
                                $nestedData[] = $value->price;
                                $nestedData[] = $value->slug;
                                $nestedData[] = $value->created_at;
                                $nestedData[] = $value->status;
                                // $nestedData[] = '';
                
                                $data[] = $nestedData;
                            }
                        }
                        $totalData = sizeof($records);
                        $json_data = array(
                        "recordsTotal" => intval($totalData),
                        "recordsFiltered" => intval($totalData),
                        "data" => $data
                        );
                        // echo json_encode($json_data);                
        return response()->json($json_data);
    }

    public function getAllProducts()
    {
        $products = DB::table('products')
                        ->leftJoin('users','products.user_id','=','users.id')
                        ->leftJoin('categories','products.category_id','=','categories.id')
                        ->select('products.id', 'users.name as user_name','categories.name as category_name', 'products.name', 'products.stock', 'products.image', 'products.price', 'products.slug', 'products.created_at', 'products.status')
                        ->orderBy('id','desc')
                        // ->get()
                        ;

        // return datatables($products)
    //     return Datatables::of($products)
    //     ->addColumn('action', function($row){

    //         // Update Button
    //         $updateButton = "<button class='btn btn-sm btn-info updateUser' data-id='".$row->id."'><i class='fa-solid fa-pen-to-square'></i></button>";

    //         // Delete Button
    //         $deleteButton = "<button class='btn btn-sm btn-danger deleteUser' data-id='".$row->id."'><i class='fa-solid fa-trash'></i></button>";

    //         return $updateButton." ".$deleteButton;

    //    }) 
                // ->make(true);

                return datatables($products)
                // return Datatables::of($products)
                    ->addIndexColumn()
                    // ->addColumn('action', function($row){
                    //     $btn = '';
                    //     //    $btn = $btn.'<a href="/edit-product/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                    //        $btn = $btn.'<router-link :to="/edit-product/'.$row->id.'" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>';
                    //        $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>';
         
                    //         return $btn;
                    // })
                    // ->rawColumns(['action'])
                    ->make(true);
    }

    public function searchProductBackend(){
        $search = \Request::get('s');
        $products = array();
        $products = DB::table('products')
                        ->leftJoin('users','products.user_id','=','users.id')
                        ->leftJoin('categories','products.category_id','=','categories.id')
                        ->select('products.*','users.name as user_name','categories.name as category_name')
                        ->where('products.name','LIKE',"%$search%")
                        ->orderBy('id','desc')
                        ->paginate(50);

        $info = Product::where('products.name','LIKE',"%$search%")->count();

        return response()->json([
            'products' => $products,
            'numberofproducts' => $info
        ],200);
    }

    public function productsForDashboard(){
        $products = array();
        $products = DB::table('products')
                        ->leftJoin('users','products.user_id','=','users.id')
                        ->leftJoin('categories','products.category_id','=','categories.id')
                        ->select('products.*','users.name as user_name','categories.name as category_name')
                        ->where('products.stock','<=',10)
                        ->orderBy('id','desc')
                        ->paginate(10);

        $info = Product::where('products.stock','<=',10)->count();

        return response()->json([
            'products' => $products,
            'numberofproducts' => $info
        ],200);
    }

    public function getChildBySubCategory($id){
        $data = ChildCategory::where('subcategory_id',$id)->get();
        return response()->json($data);
    }

    public function getChildBySubCategoryEditProduct($id){
        $data = ChildCategory::where('subcategory_id',$id)->get();
        return response()->json($data);
    }

    public function addNewProduct(Request $request){

        //validation
        $this->validate($request,[
            'product_name' => 'required|min:1',
            'category_id' => 'required',
            'image' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            
        ]);

        //new code for image upload in Vue JS
        $strpos = strpos($request->image,';');
        $sub = substr($request->image,0,$strpos);
        $ex = explode('/',$sub)[1];
        $image_name = time().str::random(5).".".$ex;
        $img = Image::make($request->image)->save('product_images/' . $image_name, 100);

        //slug generate
        $without_space = str_replace(" ","-",$request->product_name);
        $without_slashAndSpace = str_replace("/","-",$without_space);
        $without_slashAndSpaceAndDot = str_replace(".","-",$without_space);
        $slug = $without_slashAndSpaceAndDot.time().str::random(5);


        $product_id = Product::insertGetId([
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'childcategory_id' => $request->childcategory_id,
            'name' => $request->product_name,
            'image' => $image_name,
            'price' => $request->price,
            'prev_price' => $request->prev_price,
            'policy' => $request->policy,
            'views' => 0,
            'stock' => $request->stock,
            'status' => 1,
            'description' => $request->description,
            'slug' => $slug,
            'condition' => $request->condition,
            'created_at' => Carbon::now(),
            'deals' => $request->deals,
            'featured' => $request->featured,
            'trending' => $request->trending,
            'new' => $request->new,
            'top' => $request->top,
            'flash' => $request->flash,
            'photos' => session('multiple_images')
        ]);

        $data = Product::where('id',$product_id)->first();
        $my_array = json_decode($data->photos, true);
        $pics = '';
        if(!empty($my_array)) {
            $pics = implode(', ', $my_array);
        }
        
        Product::where('id',$product_id)->update([
            'pictures' => $pics
        ]);

        session()->forget('multiple_images');

    }

    public function deleteProduct($id){
        
        $data = Product::where('id',$id)->first();
        // dd($data);
        if($data->image != null){
            if(file_exists('product_images/'.$data->image)) {
                unlink('product_images/'.$data->image);
            }
        }
        if($data->photos != null){
            $data = json_decode($data->photos,true);
            foreach ($data as $item) {
                // dd($item);
                if(file_exists('product_images/'.$item)) {
                    unlink('product_images/'.$item);
                }
            }
            Product::where('id',$id)->update([
                'photos' => null
            ]);
        }
        Product::where('id',$id)->delete();
    }

    public function statusChange($id){
        $data = Product::where('id',$id)->first();
        if($data->status == 1){
            Product::where('id',$id)->update([
                'status' => 0
            ]);
        }
        else{
            Product::where('id',$id)->update([
                'status' => 1
            ]);
        }
    }

    public function editProduct($id){
        $product = Product::where('id',$id)->first();
        return response()->json([
            'product' => $product
        ],200);
    }

    public function updateproduct(Request $request,$id){

        //validation
        $this->validate($request,[
            'name' => 'required|min:1|max:100',
            'category_id' => 'required',
            'image' => 'required',
            'price' => 'required|numeric',
            // 'stock' => 'required|numeric'
        ]);

        //slug generate
        $without_space = str_replace(" ","-",$request->product_name);
        $without_slashAndSpace = str_replace("/","-",$without_space);
        $without_slashAndSpaceAndDot = str_replace(".","-",$without_space);
        $slug = $without_slashAndSpaceAndDot.time().str::random(5);

        $product_info = Product::where('id',$id)->first();


        // updating multiple image data start
        if(session('multiple_images') != null){
            if($product_info->photos != null){
                $data = json_decode($product_info->photos,true);
                foreach ($data as $item) {
                    unlink('product_images/'.$item);
                }
                Product::where('id',$id)->update([
                    'photos' => session('multiple_images')
                ]);

                $data = Product::where('id',$id)->first();
                $my_array = json_decode($data->photos, true);
                $pics = implode(', ', $my_array);
                Product::where('id',$id)->update([
                    'pictures' => $pics
                ]);

            }
            else{
                Product::where('id',$id)->update([
                    'photos' => session('multiple_images')
                ]);

                $data = Product::where('id',$id)->first();
                $my_array = json_decode($data->photos, true);
                $pics = implode(', ', $my_array);
                Product::where('id',$id)->update([
                    'pictures' => $pics
                ]);

            }
            session()->forget('multiple_images');
        }
        // updating multiple image data end

    


        if($request->image != $product_info->image){

            //delete previous image if uploaded new
            if(file_exists('product_images/'.$product_info->image)){
                unlink('product_images/'.$product_info->image);
            }

            //new code for image upload in Vue JS
            $strpos = strpos($request->image,';');
            $sub = substr($request->image,0,$strpos);
            $ex = explode('/',$sub)[1];
            $image_name = time().str::random(5).".".$ex;
            $img = Image::make($request->image)->save('product_images/' . $image_name, 100);

            Product::where('id',$id)->update([
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'childcategory_id' => $request->childcategory_id,
                'name' => $request->name,
                'image' => $image_name,
                'price' => $request->price,
                'prev_price' => $request->prev_price,
                'policy' => $request->policy,
                'stock' => $request->stock,
                'description' => $request->description,
                'slug' => $slug,
                'condition' => $request->condition,
                'deals' => $request->deals,
                'featured' => $request->featured,
                'trending' => $request->trending,
                'new' => $request->new,
                'top' => $request->top,
                'flash' => $request->flash,
                'updated_at' => Carbon::now()
            ]);
        }
        else{
            Product::where('id',$id)->update([
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'childcategory_id' => $request->childcategory_id,
                'name' => $request->name,
                'price' => $request->price,
                'prev_price' => $request->prev_price,
                'policy' => $request->policy,
                'stock' => $request->stock,
                'description' => $request->description,
                'slug' => $slug,
                'condition' => $request->condition,
                'deals' => $request->deals,
                'featured' => $request->featured,
                'trending' => $request->trending,
                'new' => $request->new,
                'top' => $request->top,
                'flash' => $request->flash,
                'updated_at' => Carbon::now()
            ]);
        }
    }

    public function multipleImageUpload(Request $request){
        if($request->hasFile('files')){
            $pictures = [];
            foreach($request->file('files') as $file){
                $filename = time().$file->getClientOriginalName();
                $file->move(public_path('product_images'), $filename);
                $pictures[] = $filename;
             }

             $pitures = json_encode($pictures);

             session(['multiple_images' => $pitures]);
        }
    }
}
