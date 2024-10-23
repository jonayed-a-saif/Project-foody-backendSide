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
                            <li>Customer Dashboard</li>
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

                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12 mb-5">
                                    <style>
                                        .nav-pills .nav-link.active, .nav-pills .show > .nav-link{
                                            background: #333333 !important
                                        }
                                    </style>
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">My Pending Orders</a>
                                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Orders In Process</a>
                                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Delivered Orders</a>
                                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Cancelled Orders</a>
                                        <a class="nav-link" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">Change Password</a>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-12">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                                            <div class="table_desc wishlist">
                                                <div class="cart_page table-responsive">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th class="product_remove">SL</th>
                                                                <th class="product_thumb">Order Date</th>
                                                                <th class="product_name">Shipping Info</th>
                                                                <th class="product-price">Amount</th>
                                                                <th class="product_quantity">Payment Type</th>
                                                                <th class="product_total">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($pendingOrders as $index => $order)
                                                            <tr>
                                                                <td class="product_remove">{{ $index+$pendingOrders->firstItem() }}</td>
                                                                @php
                                                                    $newDate = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('d M Y');
                                                                @endphp
                                                                <td class="product_thumb">{{$newDate}}</td>
                                                                <td class="product_name">{{$order->shipping}}</td>
                                                                <td class="product-price">Tk. {{$order->total}}</td>
                                                                <td class="product_quantity">{{$order->payment_type}}</td>
                                                                <td class="product_total"><a href="{{url('order/details')}}/{{$order->slug}}">Details</a></td>
                                                            </tr>
                                                            @endforeach

                                                            <!--{{ $pendingOrders->links() }}-->

                                                        </tbody>

                                                    </table>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                                            <div class="table_desc wishlist">
                                                <div class="cart_page table-responsive">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th class="product_remove">SL</th>
                                                                <th class="product_thumb">Order Date</th>
                                                                <th class="product_name">Shipping Info</th>
                                                                <th class="product-price">Amount</th>
                                                                <th class="product_quantity">Payment Type</th>
                                                                <th class="product_total">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($processingOrders as $index => $order)
                                                            <tr>
                                                                <td class="product_remove">{{ $index+$pendingOrders->firstItem() }}</td>
                                                                @php
                                                                    $newDate = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('d M Y');
                                                                @endphp
                                                                <td class="product_thumb">{{$newDate}}</td>
                                                                <td class="product_name">{{$order->shipping}}</td>
                                                                <td class="product-price">Tk. {{$order->total}}</td>
                                                                <td class="product_quantity">{{$order->payment_type}}</td>
                                                                <td class="product_total"><a href="{{url('order/details')}}/{{$order->slug}}">Details</a></td>
                                                            </tr>
                                                            @endforeach

                                                            <!--{{ $processingOrders->links() }}-->

                                                        </tbody>

                                                    </table>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                                            <div class="table_desc wishlist">
                                                <div class="cart_page table-responsive">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th class="product_remove">SL</th>
                                                                <th class="product_thumb">Order Date</th>
                                                                <th class="product_name">Shipping Info</th>
                                                                <th class="product-price">Amount</th>
                                                                <th class="product_quantity">Payment Type</th>
                                                                <th class="product_total">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($completeOrders as $index => $order)
                                                            <tr>
                                                                <td class="product_remove">{{ $index+$pendingOrders->firstItem() }}</td>
                                                                @php
                                                                    $newDate = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('d M Y');
                                                                @endphp
                                                                <td class="product_thumb">{{$newDate}}</td>
                                                                <td class="product_name">{{$order->shipping}}</td>
                                                                <td class="product-price">Tk. {{$order->total}}</td>
                                                                <td class="product_quantity">{{$order->payment_type}}</td>
                                                                <td class="product_total"><a href="{{url('order/details')}}/{{$order->slug}}">Details</a></td>
                                                            </tr>
                                                            @endforeach

                                                            <!--{{ $completeOrders->links() }}-->

                                                        </tbody>

                                                    </table>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">

                                            <div class="table_desc wishlist">
                                                <div class="cart_page table-responsive">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th class="product_remove">SL</th>
                                                                <th class="product_thumb">Order Date</th>
                                                                <th class="product_name">Shipping Info</th>
                                                                <th class="product-price">Amount</th>
                                                                <th class="product_quantity">Payment Type</th>
                                                                <th class="product_total">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($cancelledOrders as $index => $order)
                                                            <tr>
                                                                <td class="product_remove">{{ $index+$pendingOrders->firstItem() }}</td>
                                                                @php
                                                                    $newDate = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('d M Y');
                                                                @endphp
                                                                <td class="product_thumb">{{$newDate}}</td>
                                                                <td class="product_name">{{$order->shipping}}</td>
                                                                <td class="product-price">Tk. {{$order->total}}</td>
                                                                <td class="product_quantity">{{$order->payment_type}}</td>
                                                                <td class="product_total"><a href="{{url('order/details')}}/{{$order->slug}}">Details</a></td>
                                                            </tr>
                                                            @endforeach

                                                            <!--{{ $cancelledOrders->links() }}-->

                                                        </tbody>

                                                    </table>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="card">
                                                        <div class="card-header bg-dark text-white">
                                                            <b>Change Password</b>
                                                        </div>
                                                        <div class="card-body">
                                                            <form action="{{url('/change/your/password/customer')}}" method="POST">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="new">New Password</label>
                                                                    <input type="password" class="form-control" id="new" placeholder="New Password" name="new" :class="{ 'is-invalid': form.errors.has('new') }" required>
                                                                    <has-error :form="form" field="new"></has-error>
                                                                </div>

                                                                 <div class="form-group">
                                                                    <label for="confirm">Confirm Password</label>
                                                                    <input type="password" class="form-control" id="confirm" placeholder="Confirm Password"  name="confirm" :class="{ 'is-invalid': form.errors.has('confirm') }" required>
                                                                    <has-error :form="form" field="confirm"></has-error>
                                                                </div>

                                                                <button type="submit" class="btn btn-sm btn-dark rounded">Change</button>
                                                            </form>
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
                </div>
            </div>
        </div>
    </div> 
@endsection
