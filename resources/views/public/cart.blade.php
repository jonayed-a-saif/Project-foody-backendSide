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
                            <li>Shopping Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--shopping cart area start -->
    <div class="cart_page_bg">
        <div class="container">
            <div class="shopping_cart_area">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{url('update/cart/qty')}}" method="POST">
                                @csrf
                                <div class="table_desc">
                                    <div class="cart_page table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="product_remove">Delete</th>
                                                    <th class="product_thumb">Image</th>
                                                    <th class="product_name">Product</th>
                                                    <th class="product-price">Price</th>
                                                    <th class="product_quantity">Quantity</th>
                                                    <th class="product_total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cart as $item)
                                                <input type="hidden" name="item_id[]" value="{{$item->id}}">
                                                <tr>
                                                    <td class="product_remove"><a href="{{url('delete/cart/item')}}/{{$item->id}}"><i class="fa fa-trash"></i></a></td>
                                                    <td class="product_thumb"><a href="{{url('product/details')}}/{{$item->product_slug}}"><img src="{{url('product_images/'.$item->product_image)}}" alt=""></a></td>
                                                    <td class="product_name"><a href="{{url('product/details')}}/{{$item->product_slug}}">{{$item->product_name}}</a></td>
                                                    <td class="product-price">Tk. {{$item->price}}</td>
                                                    <td class="product_quantity"><label>Quantity</label> <input min="1" max="100" type="number" value="{{$item->qty}}" name="qty[{{$item->id}}]"></td>
                                                    <td class="product_total">Tk. {{$item->price*$item->qty}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="cart_submit">
                                        <button type="submit">update cart</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--coupon code area start-->
                    @php
                        $amount = 0;
                        foreach ($cart as $key => $value) {
                            $amount = $amount+($value->price*$value->qty);
                        }
                    @endphp
                    <div class="coupon_area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="coupon_code left">
                                    <h3>Coupon</h3>
                                    <div class="coupon_inner">
                                        <form action="{{url('apply/coupon')}}" method="POST">
                                            @csrf
                                            <p>Enter your coupon code if you have one.</p>
                                            <input type="hidden" name="amount" value="{{$amount+60}}">
                                            <input placeholder="Coupon code" type="text" name="coupon" required>
                                            <button type="submit">Apply coupon</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="coupon_code right">
                                    <h3>Cart Totals</h3>
                                    <div class="coupon_inner">
                                        <div class="cart_subtotal">
                                            <p>Subtotal</p>
                                            <p class="cart_amount">Tk. {{$amount}}</p>
                                        </div>
                                        {{-- <div class="cart_subtotal ">
                                            <p>Shipping</p>
                                            <p class="cart_amount"><span>Flat Rate:</span>Tk. 60</p>
                                        </div> --}}
                                        <div class="cart_subtotal ">
                                            <p>Discount</p>
                                            <p class="cart_amount">Tk. @if(Session::has('discount')) {{session('discount')}} @else {{$discount}} @endif</p>
                                        </div>
                                        <a href="#">Calculate Total</a>

                                        @php
                                            if(Session::has('discount')){
                                                $discount = session('discount');
                                            }
                                        @endphp

                                        <div class="cart_subtotal">
                                            <p>Total</p>
                                            <p class="cart_amount">Tk. {{$amount-$discount}}</p>
                                        </div>
                                        <div class="checkout_btn">
                                            @if(App\Cart::where('random_number',session('random_number'))->exists())
                                            <a href="{{url('checkout/page')}}">Proceed to Checkout</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--coupon code area end-->
            </div>
        </div>
    </div>
    <!--shopping cart area end -->

@endsection
