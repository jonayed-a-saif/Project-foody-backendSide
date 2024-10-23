@extends('public.othermaster')

@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{url('/')}}">home</a></li>
                            <li>View Order Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--wishlist area start -->
    <div class="wishlist_page_bg">
        <div class="container">
            <div class="wishlist_area">
                <div class="wishlist_inner">
                    <div class="row">
                        <div class="col-12">
                            <div class="table_desc wishlist">
                                <div class="cart_page table-responsive">
                                    
                                    <div class="row mt-3 mb-4">
                                        <div class="col-lg-12 text-center">
                                            @if($icon != null)
                                                @if($icon->logo != null)<img src="{{url('logo_images/'.$icon->logo)}}" class="img-fluid" height="50" width="50">@endif
                                                <h3><b>@if($icon->title != null){{$icon->title}}@endif</b></h3>
                                                <b>Shop Address : @if($about->location != null){{$about->location}}@endif</b><br>
                                                <b>Hotline Number : @if($about->contact != null){{$about->contact}}@endif</b><br>
                                            @endif
                                        </div>
                                    </div>


                                    <table class="w-100 mt-5 mb-4">
                                        <tr>
                                            <td class="text-left">
                                                <h5><b>Shipping Info :</b></h5>
                                                <b>Name : </b>{{$shipping_data->name}}<br>
                                                <b>Country : </b>{{$shipping_data->country}}<br>
                                                <b>City : </b>{{$shipping_data->city}}<br>
                                                <b>Address : </b>{{$shipping_data->address}}<br>
                                                <b>Phone : </b>{{$shipping_data->phone}}<br>
                                                <b>Email : </b>{{$shipping_data->email}}<br>
                                            </td>
                                            <td class="text-right">
                                                <h5><b>Invoice Info :</b></h5>
                                                <b>Invoice No. </b>{{$sales_data->slug}}<br>
                                                <b>Order Placed : </b>{{$sales_data->created_at}}<br>
                                                <b>Special Note : </b>{{$shipping_data->order_notes}}<br>
                                                <b>Payment Type : </b>{{$sales_data->payment_type}}<br>
                                                <b>Amount to be Paid : </b>{{$sales_data->total}} Taka Only<br>
                                            </td>
                                        </tr>
                                    </table>

                                    <div class="card mt-3 mb-5">
                                        <div class="card-header">
                                            <h5 class="card-title"><b>Purchased items</b></h5>
                                            <div class="card-tools">

                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example2" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Product Name</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $sl = 1;   
                                                    @endphp
                                                    @foreach ($billing_data as $item)
                                                    <tr>
                                                        <td>{{$sl}}</td>
                                                        <td>{{$item->product_name}}</td>
                                                        <td>Tk. {{$item->price}}</td>
                                                        <td>{{$item->qty}}</td>
                                                        <td>Tk.{{$item->qty*$item->price}}</td>
                                                    </tr>
                                                    @php $sl++ @endphp
                                                    @endforeach
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer text-right">
                                            <b>Discount</b> = @if($sales_data->discount != 0){{$sales_data->discount}} @else 0 @endif Taka<br>
                                            <b>Shipping & Packaging</b> = {{$sales_data->shipping}}<br>
                                            <b>SubTotal</b> = {{$sales_data->total - $sales_data->discount}} Taka Only <br>
                                            <b>Grand Total</b> = {{$sales_data->total}} Taka Only
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--wishlist area end -->
@endsection
