
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
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--Checkout page section-->
    <div class="checkout_page_bg">
        <div class="container">
            <div class="Checkout_section">
                <div class="checkout_form">
                    <form action="{{url('checkout')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="checkout_form_left">
                                    <h3>Billing Details</h3>
                                    <div class="row">

                                        <div class="col-lg-12 mb-20">
                                            <label>Full Name <span>*</span></label>
                                            <input type="text" name="name" required value="" required>
                                        </div>
                                      

                                        <div class="col-12 mb-20">
                                            <label>Street address <span>*</span></label>
                                            <input placeholder="House number and street name" type="text" name="address" required>
                                        </div>
                                      
                                        <div class="col-12 mb-20">
                                            <label>Phone<span>*</span></label>
                                            <input type="text" name="phone" required>
                                        </div>
             
                                        <div class="col-12">
                                            <div class="order-notes">
                                                <label for="order_note">Order Notes</label>
                                                <textarea name="order_notes" id="order_note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7">

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="checkout_form_right">
                                        <h3>Your order</h3>
                                        <div class="order_table table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($cart as $item)
                                                    <tr>
                                                        <td class="p-2">
                                                            <div class="card border-0 rounded-0">
                                                                <div class="row g-0">
                                                                  <div class="col-md-3 col-lg-2 d-flex align-items-center">
                                                                    <img src="{{url('product_images/'.$item->product_image)}}" class="img-fluid" alt="..." width="100">
                                                                  </div>
                                                                  <div class="col-md-9 col-lg-10">
                                                                    <div class="card-body p-0 text-left">
                                                                      <h5 class="card-title">{{$item->product_name}}</h5>
                                                                      <p class="card-text">Qty: {{$item->qty}}</p>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                              </div>

                                                            {{-- <img src="{{url('product_images/'.$item->product_image)}}" alt=""> --}}
                                                             {{-- {{$item->product_name}} <strong> × {{$item->qty}}</strong> --}}
                                                        </td>
                                                        <td style="vertical-align: middle;"> Tk. {{$item->price*$item->qty}}</td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    @php
                                                        $amount = 0;
                                                        foreach ($cart as $key => $value) {
                                                            $amount = $amount+($value->price*$value->qty);
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <th>Cart Subtotal</th>
                                                        <td>Tk. {{$amount}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount</th>
                                                        <td><strong>Tk. @if(Session::has('discount')) {{session('discount')}} @else 0.00 @endif</strong></td>
                                                    </tr>
                                                    <tr class="order_total">
                                                        <th>Order Total</th>
                                                        <td><strong>Tk. {{$amount-session('discount')}}</strong></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="checkout_form_right">
                                        <h3>Shipping & Packaging</h3>
                                        <div class="order_table table-responsive">
                                            <table>
                                                <tfoot>
                                                    <tr>
                                                        <th>Shipping</th>
                                                        <td style="text-align: left;padding-left:20px">

                                                            @foreach ($shipping_methods as $shipping_method)
                                                            <strong><label for="{{$shipping_method->title}}" style="position: relative"> <input type="radio" name="shipping_method" id="{{$shipping_method->title}}" value="{{$shipping_method->title}}" style="heigt: 20px;width: 20px;position: absolute;top:-8px;left:-25px;" required> {{$shipping_method->title}} ({{$shipping_method->duration}}) Tk. {{$shipping_method->price}}</label></strong>
                                                            <br>
                                                            @endforeach

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Packaging</th>
                                                        <td style="text-align: left;padding-left:20px">

                                                            @foreach ($packagings as $packaging)
                                                            <strong><label for="{{$packaging->title}}" style="position: relative"> <input type="radio" name="packaging" id="{{$packaging->title}}" value="{{$packaging->title}}" style="heigt: 20px;width: 20px;position: absolute;top:-8px;left:-25px;" required> {{$packaging->title}} Tk.{{$packaging->price}}</label></strong>
                                                            <br>
                                                            @endforeach

                                                        </td>
                                                    </tr>
                                                    <tr class="order_total">
                                                        <th>Total Amount</th>
                                                        <td style="text-align: left;padding-left:20px">
                                                            <strong>Tk. {{$amount-session('discount')}}</strong>
                                                        </td>
                                                    </tr>
                                                    <tr class="order_total">
                                                        <th>Payment Type</th>
                                                        <td style="text-align: left;padding-left:20px">
                                                            <div class="panel-default">
                                                                <input id="payment_defult" name="check_method" type="radio" data-target="createp_account" required>
                                                                <label for="payment_defult" data-toggle="collapse" data-target="#collapsedefult" aria-controls="collapsedefult">Cash on Delivery</label>
                                                                <div id="collapsedefult" class="collapse one" data-parent="#accordion">
                                                                    <div class="card-body1">
                                                                        <p>Pay via Cash on Delivery</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="payment_method" style="text-align: center">
                                            <div class="order_button">
                                                <button type="submit">Confirm the Order</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Checkout page section end-->
@endsection
