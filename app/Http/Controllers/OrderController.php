<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Shipping;
use App\Meal;
use App\Sale;
use PDF;
use App\Product;
use App\User;
use App\About;
use App\Billing;
use App\Icon;

class OrderController extends Controller
{
    public function pendingOrders(){
        $pendingOrders = DB::table('sales')
                            ->leftJoin('users','sales.user_id','=','users.id')
                            ->leftJoin('shippings','sales.shipping_id','=','shippings.id')
                            ->where('sales.status',1)
                            ->select('sales.*','shippings.name as user_name')
                            ->orderBy('sales.id', 'desc')
                            ->paginate(30);

        return response()->json([
            'pendingOrders' => $pendingOrders
        ],200);
    }

    public function processingOrder(){
        $processingOrders = DB::table('sales')
                                ->leftJoin('users','sales.user_id','=','users.id')
                                ->leftJoin('shippings','sales.shipping_id','=','shippings.id')
                                ->where('sales.status',2)
                                ->select('sales.*','shippings.name as user_name')
                                 ->orderBy('sales.id', 'desc')
                                ->get();

        return response()->json([
            'processingOrders' => $processingOrders
        ],200);
    }

    public function completeOrders(){
        $completeOrders = DB::table('sales')
                                ->leftJoin('users','sales.user_id','=','users.id')
                                ->leftJoin('shippings','sales.shipping_id','=','shippings.id')
                                ->where('sales.status',3)
                                ->select('sales.*','shippings.name as user_name')
                                ->orderBy('sales.id', 'desc')
                                ->get();

        return response()->json([
            'completeOrders' => $completeOrders
        ],200);
    }

    public function declindedOrders(){
        $declinedOrders = DB::table('sales')
                                ->leftJoin('users','sales.user_id','=','users.id')
                                ->leftJoin('shippings','sales.shipping_id','=','shippings.id')
                                ->where('sales.status',0)
                                ->select('sales.*','shippings.name as user_name')
                                ->orderBy('sales.id', 'desc')
                                ->get();

        return response()->json([
            'declinedOrders' => $declinedOrders
        ],200);
    }

    public function viewOrderDetails($id){
        $orderDetails = DB::table('billings')
                            ->join('products','billings.product_id','products.id')
                            ->select('billings.*','products.name as product_name','products.image as product_image')
                            ->where('billings.sale_id',$id)
                            ->get();

        return response()->json([
            'orderDetails' => $orderDetails,
        ],200);
    }

    public function viewShippingDetails($id){
        $shipping = Sale::where('id',$id)->first();
        $shipping_details = Shipping::where('id',$shipping->shipping_id)->first();
        return response()->json([
            'shippingDetails' => $shipping_details,
        ],200);
    }

    public function Orderprocess($id){
        Sale::where('id',$id)->update([
            'status' => 2
        ]);
    }

    public function orderDeclined($id){
        Sale::where('id',$id)->update([
            'status' => 0
        ]);
    }

    public function orderComplete($id){
        Sale::where('id',$id)->update([
            'status' => 3
        ]);
    }

    public function deleteOrder($id){
        $sale = Sale::where('id',$id)->first();
        Billing::where('id',$sale->id)->delete();
        Shipping::where('id',$sale->shipping_id)->delete();
        Sale::where('id',$id)->delete();
    }

    public function calculateOrder($id){
        $sales = Sale::where('id',$id)->first();
        return response()->json([
            'sale' => $sales,
        ],200);
    }

    public function printOrder($id){

        $orderDetails = DB::table('billings')
                            ->join('products','billings.product_id','products.id')
                            ->select('billings.*','products.name as product_name')
                            ->where('billings.sale_id',$id)
                            ->get();

        $shipping = Sale::where('id',$id)->first();
        $shipping_details = Shipping::where('id',$shipping->shipping_id)->first();


        $pdf = PDF::loadView('public.invoice_pdf', compact('orderDetails','shipping_details'));
        return $pdf->stream('invoice.pdf');
    }

    public function getCustomersList(){
        $customers = User::orderBy('id','desc')->get();
        return response()->json([
            'customers' => $customers,
        ],200);
    }

    public function deleteCustomer($id){
        User::where('id',$id)->delete();
        Shipping::where('user_id',$id)->delete();
        Billing::where('user_id',$id)->delete();
        Sale::where('user_id',$id)->delete();
    }

    public function getTotalOrdersForDashboard(){
        $totalOrders = Sale::count();
        return response()->json([
            'totalOrders' => $totalOrders,
        ],200);
    }

    public function getTotalAmountForDashboard(){
        $sales = Sale::all();
        $totalAmount = 0;
        foreach($sales as $sale){
            $totalAmount = $totalAmount+$sale->total;
        }
        $totalAmount = round($totalAmount, 2);
        return response()->json([
            'totalAmount' => $totalAmount,
        ],200);
    }

    public function getTotalCustomerForDashboard(){
        $totalCustomers = User::count();
        return response()->json([
            'totalCustomers' => $totalCustomers,
        ],200);
    }

    public function getTotalProductsForDashboard(){
        $totalProducts = Product::count();
        return response()->json([
            'totalProducts' => $totalProducts,
        ],200);
    }

    public function getPendingMeal(){
        $pending_meals = Meal::where('status',0)->get();
        return response()->json([
            'pending_meals' => $pending_meals,
        ],200);
    }

    public function deleteMeal($id){
        Meal::where('id',$id)->delete();
    }

    public function approveMeal($id){
        Meal::where('id',$id)->update([
            'status' => 1,
        ]);
    }

    public function getApprovemeals(){
        $approve_meals = Meal::where('status',1)->get();
        return response()->json([
            'approve_meals' => $approve_meals,
        ],200);
    }

    public function shopInfo(){
        $shop_info = Icon::orderBy('id','desc')->first();
        $about_info = About::orderBy('id','desc')->first();
        return response()->json([
            'shop_info' => $shop_info,
            'about_info' => $about_info
        ],200);
    }
}
