@extends('public.othermaster')

@section('header_meta')
    {{--  for facebook share  --}}
    <meta property="og:url"           content="http://kinunbd.com/product/details/{{$details->slug}}"/>
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{$details->name}}"/>
    <meta property="og:description"   content="{{$details->price}} Tk"/>
    <meta property="og:image"         content="<img src='{{url('product_images/'.$details->image)}}'>"/>
    {{--  for facebook share  --}}
@endsection

@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="{{url('/')}}">home</a></li>
                        <li>product details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<div class="product_page_bg">
    <div class="container">
        <div class="product_details_wrapper mb-55">

            <!--product details start-->
            <div class="product_details">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="product-details-tab">
                            <div id="img-1" class="zoomWrapper single-zoom">
                                <a href="#">
                                    <img id="zoom1" src="{{url('product_images/'.$details->image)}}" alt="big-1">
                                </a>
                            </div>
                            <div class="single-zoom-thumb">
                                <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                    @php
                                        if($details->photos != null){
                                        $myArray = json_decode($details->photos, true);
                                        }
                                    @endphp

                                    @if($details->photos != null)
                                    @foreach ($myArray as $item)
                                    <li>
                                        <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{url('product_images/'.$item)}}" data-zoom-image="{{url('product_images/'.$item)}}">
                                            <img src="{{url('product_images/'.$item)}}" alt="zo-th-1" />
                                        </a>
                                    </li>
                                    @endforeach
                                    @endif


                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        <div class="product_d_right">


                                <h3><a href="#">{{$details->name}}</a></h3>
                                <div class="price_box">
                                    @if($details->prev_price)<span class="old_price">Tk. {{$details->prev_price}}</span>@endif
                                    <span class="current_price">Tk. {{$details->price}}</span>
                                </div>
                                <div class="product_desc">
                                    {!! substr($details->description,0,300) !!}...
                                </div>
                                <div class="product_variant quantity">
                                    {{--  <label>quantity</label>
                                    <input min="1" max="100" value="1" type="number">
                                    <button class="button" type="submit">add to cart</button>  --}}

                                    <form action="{{url('/add/product/to/cart')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$details->id}}">
                                        <label>quantity</label>
                                        <input min="1" max="100" value="1" name="qty" type="number">
                                        @if($details->stock > 0)
                                            <button type="submit" title="Add to cart" style="color: white">Add to cart</button>
                                        @else
                                            <a href="#" title="Stock out">Stock out</a>
                                        @endif
                                    </form>

                                </div>
                                <!--<div class="product_meta">-->
                                <!--    <span>Category: <a href="#"></a></span>-->
                                <!--</div>-->

                            <div class="priduct_social">
                                <ul>
                                    <li>
                                        {{--  facebook Share Button  --}}
                                        <div class="fb-share-button" style="height: 30px;width:100px;background:#1877F2;text-align:center;font-size:18px;border-radius:5px;"
                                            data-href="http://kinunbd.com/product/details/{{$details->slug}}"
                                            data-layout="button_count">
                                        </div>
                                        {{--  facebook Share Button  --}}
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--product details end-->

            <!--product info start-->
            <div class="product_d_info">
                <div class="row">
                    <div class="col-12">
                        <div class="product_d_inner">
                            <div class="product_info_button">
                                <ul class="nav" role="tablist">
                                    @if($details->description != null)
                                    <li>
                                        <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Description</a>
                                    </li>
                                    @endif
                                    @if($details->policy != null)
                                    <li>
                                        <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">Product Policy</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="tab-content">
                                @if($details->description != null)
                                <div class="tab-pane fade show active" id="info" role="tabpanel">
                                    <div class="product_info_content">
                                        {!! $details->description !!}
                                    </div>
                                </div>
                                @endif
                                @if($details->policy != null)
                                <div class="tab-pane fade" id="sheet" role="tabpanel">
                                    <div class="product_info_content">
                                        {!! $details->policy !!}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--product info end-->
        </div>

        <!--product area start-->
        @if($products != null)
        <section class="product_area related_products">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Related Products </h2>
                    </div>
                </div>
            </div>

            <div class="row product-item-group">
                @foreach ($products as $pro)
                <div class="col-6 col-sm-4 col-lg-2 col-md-3 product-item" >
                    <a href="{{ url('product/details')}}/{{ $pro->slug }}" >
                        <div style="background: #f8f8f8;" class="card text-decoration-none">
                        
                            <img src="{{ url('product_images/' . $pro->image) }}" alt="kinunbd" class="card-img-top" style="height: 150px; width: 100%; object-fit: contain;background: #fff;">
                            <div class="card-body p-2">
                                <p class="product_name" style="margin-bottom: 5px;">{{ substr($pro->name, 0, 20).'...' }} </p>
        
                                <div class="text-left text-danger fw-bold product-price">
                                    @if ($pro->prev_price != null && $pro->prev_price != 0)
                                    <span class="old_price text-decoration-line-through me-2" >
                                        Tk. {{ $pro->prev_price }} 
                                    </span>
                                    @endif
                                    <span class="current_price">
                                        Tk. {{ $pro->price }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer p-2">
                                
                                <div class="d-flex justify-content-between buttons flex-wrap ">
                                    
                                    <div class="buy-now-btn">
                                        <form action="{{ url('/add/product/to/buy') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id"
                                                value="{{ $pro->id }}">
                                            <input type="hidden" value="1" name="qty">
                                            <button style="border-style: none;background:#ef6437; color:#fff;" class="btn btn-sm btn-secondary p-2 "
                                                type="submit" title="Buy Now">Buy Now</button>
                                        </form>
                                    </div>
                                    
                                    <div class="d-flex justify-content-start other-btns">
                                        <form action="{{ url('/add/product/to/cart') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id"
                                                value="{{ $pro->id }}">
                                            <input type="hidden" value="1" name="qty">
                                            <button style="border-style: none;height: 38px;" class="add-to-card"
                                                type="submit" title="Add to Cart">
                                                <i class="fa-solid fa-shopping-cart p-2"></i>
                                            </button>
                                        </form>
        
                                        <form action="{{ url('add/to/wish/list') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id"
                                                value="{{ $pro->id }}">
                                            <input type="hidden" value="1" name="qty">
                                            <button style="border-style: none;height: 38px;" class="add-to-wishlist"
                                                type="submit" title="Add to Wish List"><i
                                                    class="fa-solid fa-heart p-2"></i></button>
                                        </form>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </a>
                
                </div>
                @endforeach
            </div>

            {{-- <div class="product_carousel product_style product_column5 owl-carousel">

                @foreach ($products as $product)
                <article class="single_product">
                    <figure>
                        <div class="product_thumb">
                            <a href="{{url('product/details')}}/{{$product->slug}}" class="primary_img"><img src="{{url('product_images/'.$product->image)}}" alt=""></a>
                            <div class="label_product">
                                <span class="label_sale">Trend</span>
                            </div>
                        </div>
                        <div class="product_content">
                            <div class="product_content_inner">
                                <h4 class="product_name"><a href="{{url('product/details')}}/{{$product->slug}}">{{$product->name}}</a></h4>
                                <div class="price_box">
                                    @if($product->prev_price)<span class="old_price">Tk. {{$product->prev_price}}</span>@endif
                                    <span class="current_price">Tk. {{$product->price}}</span>
                                </div>
                            </div>
                            <div class="add_to_cart">
                                <span>
                                    <a href="#" title="Add To Cart">Add To  Cart</a>
                                </span>
                            </div>
                        </div>
                    </figure>
                </article>
                @endforeach

            </div> --}}

        </section>
        @endif
        <!--product area end-->

    </div>
</div>
@endsection
