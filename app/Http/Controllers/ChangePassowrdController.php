<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChangePassowrdController extends Controller
{
    public function changePasswordPage(){
        return view('admin.change_password');
    }

    public function changeYourPassword(Request $request){

        $this->validate($request,[
            'new' => 'required|min:6|max:20',
            'confirm' => 'required|min:6|max:20'
        ]);

        if($request->new != $request->confirm){
            return response()->json([
                'Message' => "Password Confirmation Does not Match"
            ],404);
        }
        else{
            User::where('id',Auth::user()->id)->update([
                'password' => Hash::make($request->new),
            ]);
        }

    }
}
