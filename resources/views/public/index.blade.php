@extends('public.master')

@section('content')
<!--slider area start-->


<!--slider area end-->
<section class="slider_section slider_s_three mb-4 mt-2">
    <div class="container">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-9">
                <div class="slider_area slider3_carousel owl-carousel">

                    @foreach ($banners as $banner)
                    <div class="single_slider d-flex align-items-center" data-bgimg="{{ url('slider_images/' . $banner->image) }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <div class="slider_content slider_c_three color_white">
                                        {{-- <h3 style="color: {{$banner->subtitle_color}}">{{$banner->subtitle}}</h3>
                                        <h1 style="color: {{$banner->title_color}}">{{$banner->title}}</h1>
                                        <p style="color: {{$banner->text_color}}">{{$banner->text}}</p>
                                        </p>
                                        <a class="button" href="{{url($banner->link)}}" target="_blank">DISCOVER NOW</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>

</section>

    <section class="product-listing">
    <div class="container">
     <div class="row" style="background:#ef6436;">
      <div class="col-md-6 card-body">
       
			<div id="add_div" class="widget-body">
				<h4 class="text-center" style="color: #ffffff">কিনুন বিডি অ্যাপ ডাউনলোড করুন </h4>
			</div>
      
		</div>
      
        <div class="col-md-6">
         <a href="https://play.google.com/store/apps/details?id=kinunbd.com" target="_blank">
            <img src="{{ asset('frontend_assets/img/app_download.png') }}" style="text-area:center;" class="text-center" alt="">
         </a>
        </div>
      </div>
    </div>

 
</section>
<!--home section bg area start-->
<div class="home_section_bg">
    <div class="homepage_categories">
        <div class="container">
            <div class="cat-items-wrap">
                @foreach ($categories as $category)
                <div class="cat-item">
                    <a href="{{url('/category/wise/products')}}/{{$category->slug}}" class="cat-item-inner" rel="noopener noreferrer">
                        <span class="cat-icon">
                            @if($category->image !=null)
                            <img src="{{ url('category_images/'. $category->image) }}" alt="kinunbd" class="img-fluid">
                            @else
                            <img src="{{ url('logo_images/1656844369T7PjI.jpeg') }}" alt="kinunbd" class="img-fluid">
                            @endif
                        </span>
                        <p class="cat-name">{{$category->name}}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>


    <div class="homepage_offer_banner">
        <div class="container">
            <a class="d-block" href="{{url('/offer/products')}}">
                <img src="{{ url('popup_banners/banner.png') }}" alt="kinunbd" class="img-fluid">
            </a>
        </div>

    </div>

    @if (count($categories) > 0)
    @foreach ($categories as $home_category)
    @php
      $product_lists = DB::table('products')
                    ->join('categories','categories.id','=','products.category_id')
                    ->select('products.*','categories.name as category_name','categories.slug as categories_slug')
                    ->where('products.category_id',$home_category->id)
                    ->where('status', 1)
                    ->orderBy('id','desc')
                    ->take(12)
                    ->get();
                    
                    
    @endphp
    @if (count($product_lists) > 0)
    <div class="product_area">
        <div class="container">
            <div class="row m-0">
                <div class="product-section">
                    <div class="product_header" style="padding-right: 6px;">
                        <div class="section_title s_title_style3">
                            <h2>{{$home_category->name }}</h2>
                        </div>
                        <a style="float: right;" href="{{ route('categories.product', $home_category->slug) }}" class="btn btn-link btn-sm text-black"><b>View More</b></a>
                    </div>
                    <div class="tab-content" style="margin-left: -15px;">
                        <div class="container">
                            <div class="row product-item-group">
                                @foreach ($product_lists as $pro)
                                <div class="col-6 col-sm-4 col-lg-2 col-md-3 product-item">
                                    <a href="{{ url('product/details') }}/{{ $pro->slug }}">
                                        <div style="background: #f8f8f8;" class="card text-decoration-none">

                                            <img src="{{ url('product_images/' . $pro->image) }}" alt="" class="card-img-top" style="height: 150px; width: 100%; object-fit: contain;background: #fff;">
                                            <div class="card-body p-2">
                                                 <p class="product_name" style="margin-bottom: 5px;">{{ substr($pro->name, 0, 50).'...' }} </p>
                                                
                                                <div class="text-left text-danger fw-bold product-price">
                                                    @if ($pro->prev_price != null && $pro->prev_price != 0)
                                                    <span class="old_price text-decoration-line-through me-2">
                                                    ৳{{ $pro->prev_price}}
                                                    </span>
                                                    @endif
                                                    <span class="current_price">
                                                    ৳{{$pro->price }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="card-footer p-2">

                                               

                                               <div class="d-flex justify-content-between buttons flex-wrap ">

                                              <div class="buy-now-btn">
                                                <form action="{{ url('/add/product/to/buy') }}" method="POST">
                                               @csrf
                                                <input type="hidden" name="product_id" value="{{ $pro->id }}">
                                                <input type="hidden" value="1" name="qty">
                                               <button style="border-style: none;background:#ef6437; color:#fff;" class="btn btn-sm btn-secondary p-2 " type="submit" title="Buy Now">Buy Now</button>
                                               </form>
                                                   </div>

                                                   <div class="d-flex justify-content-start other-btns">
                                                       <form action="{{ url('/add/product/to/cart') }}" method="POST">
                                                           @csrf
                                                           <input type="hidden" name="product_id" value="{{ $pro->id }}">
                                                           <input type="hidden" value="1" name="qty">
                                                           <button style="border-style: none;height: 38px;" class="add-to-card" type="submit" title="Add to Cart">
                                                               <i class="fa fa-shopping-cart p-2"></i>
                                                           </button>
                                                </form>

                                                       <form action="{{ url('add/to/wish/list') }}" method="POST">
                                                           @csrf
                                               <input type="hidden" name="product_id" value="{{ $pro->id }}">
                                               <input type="hidden" value="1" name="qty">
                                               <button style="border-style: none;height: 38px;" class="add-to-wishlist" type="submit" title="Add to Wish List"><i class="fa fa-heart p-2"></i></button>
                                                 </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
    @endif
    @endforeach
    @endif
    


    <!--<h4 style="color: red; text-align: center">কিনুনবিডি ওয়েবসাইট এর নতুন ডিজাইন এর কাজ চলছে, আপনাদের সাময়িক সমস্যার জন্য আমরা দুঃখ প্রকাশ করছি। আমাদের ওয়েবসাইট এর নতুন ডিজাইন এবং মোবাইল অ্যাপ ০৬/০২/২০২২ থেকে প্রকাশ করা হবে </h4>-->
    <!--Categories product area start-->

    <!--Categories product area end-->

    <!--deals product area start-->
 

    <!-- @if (count($deals_month_products) > 0)

    <section class="product-listing">
        <div class="container overflow-hidden">
            <div class="row">
                <div class="col-12">
                    <div class="product_header" style="padding-right: 6px;">
                        <div class="section_title s_title_style3">
                            <h2>New Products</h2>
                        </div>
                        <a style="float: right;" href="{{ url('/shop')}}" class="btn btn-link btn-sm text-black"><b>View More</b></a>
                    </div>
                </div>
            </div>
            <div class="row product-item-group">
                @foreach ($deals_month_products as $pro)
                <div class="col-6 col-sm-4 col-lg-2 col-md-3 product-item">
                    <a href="{{ url('product/details')}}/{{ $pro->slug }}">
                        <div style="background: #f8f8f8;" class="card text-decoration-none">

                            <img src="{{ url('product_images/' . $pro->image) }}" alt="kinunbd" class="card-img-top" style="height: 150px; width: 100%; object-fit: contain;background: #fff;">
                            <div class="card-body p-2">
                                <p class="product_name" style="margin-bottom: 5px;">{{ substr($pro->name, 0, 20).'...' }} </p>

                                <div class="text-left text-danger fw-bold product-price">
                                    @if ($pro->prev_price != null && $pro->prev_price != 0)
                                    <span class="old_price text-decoration-line-through me-2">
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
                                        <form action="{{ url('/add/product/to/buy') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $pro->id }}">
                                            <input type="hidden" value="1" name="qty">
                                            <button style="border-style: none;background:#ef6437; color:#fff;" class="btn btn-sm btn-secondary p-2 " type="submit" title="Buy Now">Buy Now</button>
                                        </form>
                                    </div>

                                    <div class="d-flex justify-content-start other-btns">
                                        <form action="{{ url('/add/product/to/cart') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $pro->id }}">
                                            <input type="hidden" value="1" name="qty">
                                            <button style="border-style: none;height: 38px;" class="add-to-card" type="submit" title="Add to Cart">
                                                <i class="fa fa-shopping-cart p-2"></i>
                                            </button>
                                        </form>

                                        <form action="{{ url('add/to/wish/list') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $pro->id }}">
                                            <input type="hidden" value="1" name="qty">
                                            <button style="border-style: none;height: 38px;" class="add-to-wishlist" type="submit" title="Add to Wish List"><i class="fa fa-heart p-2"></i></button>
                                        </form>
                                    </div>



                                    {{-- <i class="fa-solid fa-heart"></i> --}}


                                </div>
                            </div>
                        </div>
                    </a>

                </div>
                @endforeach
            </div>
        </div>
    </section>

    @endif



    @if (count($home_categories) > 0)
    @foreach ($home_categories as $home_category)
    @if (count($home_category->limit_products) > 0)
    <div class="product_area">
        <div class="container">
            <div class="row m-0">
                <div class="product-section">
                    <div class="product_header" style="padding-right: 6px;">
                        <div class="section_title s_title_style3">
                            <h2>{{ $home_category->name }}</h2>
                        </div>
                        <a style="float: right;" href="{{ route('home.categories.product', $home_category->slug) }}" class="btn btn-link btn-sm text-black"><b>View More</b></a>
                    </div>
                    <div class="tab-content" style="margin-left: -15px;">
                        <div class="container">
                            <div class="row product-item-group">
                                @foreach ($home_category->limit_products as $pro)
                                <div class="col-6 col-sm-4 col-lg-2 col-md-3 product-item">
                                    <a href="{{ url('product/details') }}/{{ $pro->product->slug }}">
                                        <div style="background: #f8f8f8;" class="card text-decoration-none">

                                            <img src="{{ url('product_images/' . $pro->product->image) }}" alt="kinunbd" class="card-img-top" style="height: 150px; width: 100%; object-fit: contain;background: #fff;">
                                            <div class="card-body p-2">
                                                <p class="product_name" style="margin-bottom: 5px;">{{ substr($pro->product->name, 0, 20).'...' }} </p>

                                                <div class="text-left text-danger fw-bold product-price">
                                                    @if ($pro->product->prev_price != null && $pro->product->prev_price != 0)
                                                    <span class="old_price text-decoration-line-through me-2">
                                                        Tk. {{ $pro->product->prev_price }}
                                                    </span>
                                                    @endif
                                                    <span class="current_price">
                                                        Tk. {{ $pro->product->price }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="card-footer p-2">

                                                {{-- <h6 class="text-center text-danger">172,000৳</h6> --}}

                                                <div class="d-flex justify-content-between buttons flex-wrap ">

                                                    <div class="buy-now-btn">
                                                        <form action="{{ url('/add/product/to/buy') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $pro->product->id }}">
                                                            <input type="hidden" value="1" name="qty">
                                                            <button style="border-style: none;background:#ef6437; color:#fff;" class="btn btn-sm btn-secondary p-2 " type="submit" title="Buy Now">Buy Now</button>
                                                        </form>
                                                    </div>

                                                    <div class="d-flex justify-content-start other-btns">
                                                        <form action="{{ url('/add/product/to/cart') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $pro->product->id }}">
                                                            <input type="hidden" value="1" name="qty">
                                                            <button style="border-style: none;height: 38px;" class="add-to-card" type="submit" title="Add to Cart">
                                                                <i class="fa fa-shopping-cart p-2"></i>
                                                            </button>
                                                        </form>

                                                        <form action="{{ url('add/to/wish/list') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $pro->product->id }}">
                                                            <input type="hidden" value="1" name="qty">
                                                            <button style="border-style: none;height: 38px;" class="add-to-wishlist" type="submit" title="Add to Wish List"><i class="fa fa-heart p-2"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
    @endif
    @endforeach
    @endif -->




@if ($popup_banner != null && $popup_banner->status == 1)
<div class="newletter-popup" style="background-image: url({{ url('popup_banners/' . $popup_banner->image) }}); background-repeat: no-repeat; background-size: cover; background-position: center">
    <div id="boxes" class="newletter-container">
        <div id="dialog" class="window">
            <div id="popup2">
                <span class="b-close"><span>close</span></span>
            </div>
            <div class="box">
                <div class="newletter-title">
                    <h2>
                        @if ($popup_banner->title != null)
                        {{ $popup_banner->title }}
                        @endif
                    </h2>
                </div>
                <div class="box-content newleter-content">
                    <label class="newletter-label">
                        @if ($popup_banner->text != null)
                        {!! $popup_banner->text !!}
                        @endif
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!--news letter popup start-->


<!--home section bg area end-->
@endsection