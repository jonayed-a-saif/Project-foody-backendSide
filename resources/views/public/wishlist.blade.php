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
                            <li>Wishlist</li>
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
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="product_remove">Delete</th>
                                                    <th class="product_thumb">Image</th>
                                                    <th class="product_name">Product</th>
                                                    <th class="product-price">Price</th>
                                                    <th class="product_quantity">QTY</th>
                                                    <th class="product_total">Add To Cart</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($wish_list as $item)
                                                <tr>
                                                    <td class="product_remove"><a href="{{url('delete/wishlist')}}/{{$item->id}}">X</a></td>
                                                    <td class="product_thumb"><a href="{{url('product/details')}}/{{$item->product_slug}}"><img src="{{url('product_images/'.$item->product_image)}}" alt=""></a></td>
                                                    <td class="product_name"><a href="{{url('product/details')}}/{{$item->product_slug}}">{{$item->product_name}}</a></td>
                                                    <td class="product-price">Tk. {{$item->price}}</td>
                                                    <td class="product_quantity">{{$item->qty}}</td>
                                                    <td class="product_total">
                                                        @php
                                                            $data = App\Product::where('id',$item->product_id)->first()
                                                        @endphp
                                                        @if($data->stock > 0)
                                                            <form action="{{url('/add/product/to/cart')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{$item->product_id}}">
                                                                <input type="hidden" value="{{$item->qty}}" name="qty">
                                                                <button style="border-style: none" type="submit" title="Add to cart">Add to cart</button>
                                                            </form>
                                                        @else
                                                            <a href="#">Out of Stock</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
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
