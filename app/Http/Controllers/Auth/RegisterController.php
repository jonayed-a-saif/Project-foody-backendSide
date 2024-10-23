<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Icon;
use App\Category;
use App\Cart;
use App\About;
use App\WishList;
use Illuminate\Support\Facades\DB;
use App\Footer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/checkout/page';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'contact' => ['required', 'min:11' , 'max:14'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'contact' => $data['contact'],
        ]);
    }

    public function showRegistrationForm()
    {
        $icon = Icon::orderBy('id','desc')->first();
        $categories = Category::all();
        $cart = DB::table('carts')
                ->join('products','carts.product_id','=','products.id')
                ->select('carts.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                ->where('carts.random_number',session('random_number'))
                ->orderBy('id','desc')
                ->get();

        $cart_number = Cart::where('random_number',session('random_number'))->count();
        $about = About::orderBy('id','desc')->first();
        $footer = Footer::orderBy('id','desc')->first();

        $wish_list = DB::table('wish_lists')
                    ->join('products','wish_lists.product_id','=','products.id')
                    ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                    ->where('wish_lists.random_number',session('random_number'))
                    ->orderBy('id','desc')
                    ->get();

        $wish_list_number = WishList::where('random_number',session('random_number'))->count();
        return view('auth.register',compact('wish_list','wish_list_number','icon','categories','cart','cart_number','about','footer'));
    }
}
