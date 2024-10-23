<?php

namespace App\Http\Controllers;
use App\User;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class StuffController extends Controller
{
    public function getStuffList(){
       $stuff = User::where('role',1)->orWhere('role',3)->get();
       return response()->json([
            'stuff' => $stuff
        ],200);
    }

    public function addNewStuff(Request $request){
        $this->validate($request,[
            'name' => 'required|min:1|max:25',
            'email' => 'required|min:5|max:50',
            'contact' => 'required|min:11|max:14',
            'password' => 'required|min:4|max:20',
            'confirm_password' => 'required|min:6|max:20',
            'role' => 'required'
        ]);

        if($request->password != $request->confirm_password){
            return response()->json([
                'Message' => "Password Confirmation Does not Match"
            ],404);
        }
        else{

            if(User::where('email',$request->email)->exists()){
                return response()->json([
                    'Message' => "Email Already Exist"
                ],404);
            }
            else{
                if($request->category == 0){
                    $request->category = null;
                }
                if($request->product == 0){
                    $request->product = null;
                }
                if($request->coupon == 0){
                    $request->coupon = null;
                }
                if($request->blog == 0){
                    $request->blog = null;
                }
                if($request->general == 0){
                    $request->general = null;
                }
                if($request->home == 0){
                    $request->home = null;
                }
                if($request->payment == 0){
                    $request->payment = null;
                }
                if($request->stuff == 0){
                    $request->stuff = null;
                }
                if($request->order_manage == 0){
                    $request->order_manage = null;
                }
                if($request->customer == 0){
                    $request->customer = null;
                }

                User::insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'contact' => $request->contact,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'created_at' => Carbon::now(),
                    'category' => $request->category,
                    'product' => $request->product,
                    'coupon' => $request->coupon,
                    'blog' => $request->blog,
                    'general' => $request->general,
                    'home' => $request->home,
                    'payment' => $request->payment,
                    'stuff' => $request->stuff,
                    'order_manage' => $request->order_manage,
                    'customer' => $request->customer,
                ]);
            }
        }
    }

    public function deleteStuff($id){
        if(Sale::where('user_id',$id)->exists()){
            return response()->json([
                'Message' => "User Have Some Order"
            ],404);
        }
        else{
            User::where('id',$id)->delete();
        }
    }

    public function editStuffDetails($id){
        $stuff = User::find($id);
        return response()->json([
            'stuff' => $stuff
        ],200);
    }

    public function updateStuff(Request $request,$id){
        $this->validate($request,[
            'name' => 'required|min:1|max:25',
            'email' => 'required|min:4|max:50',
            'contact' => 'required|min:11|max:14',
            'role' => 'required'
        ]);

        if($request->category == 0){
            $request->category = null;
        }
        if($request->product == 0){
            $request->product = null;
        }
        if($request->coupon == 0){
            $request->coupon = null;
        }
        if($request->blog == 0){
            $request->blog = null;
        }
        if($request->general == 0){
            $request->general = null;
        }
        if($request->home == 0){
            $request->home = null;
        }
        if($request->payment == 0){
            $request->payment = null;
        }
        if($request->stuff == 0){
            $request->stuff = null;
        }
        if($request->order_manage == 0){
            $request->order_manage = null;
        }
        if($request->customer == 0){
            $request->customer = null;
        }

        User::where('id',$id)->update([
            'name' => $request->name,
            'contact' => $request->contact,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'category' => $request->category,
            'product' => $request->product,
            'coupon' => $request->coupon,
            'blog' => $request->blog,
            'general' => $request->general,
            'home' => $request->home,
            'payment' => $request->payment,
            'stuff' => $request->stuff,
            'order_manage' => $request->order_manage,
            'customer' => $request->customer,
        ]);

    }

    public function checkUserRole(){
        $role = Auth::user()->role;
       return response()->json([
            'role' => $role
        ],200);
    }
}
