@extends('public.master')
@section('content')
<!--breadcrumbs area start-->

<!--breadcrumbs area end-->

<!--shop  area start-->
<div class="shop_area shop_reverse">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <!--sidebar widget start-->
                <aside class="sidebar_widget">
                    <div class="widget_list widget_categories">


                    </div>
                    {{-- <div class="widget_list widget_filter">
                        <h3>Filter by price</h3>
                        <form action="#">
                            <div id="slider-range"></div>
                            <button type="submit">Filter</button>
                            <input type="text" name="text" id="amount" />
                        </form>
                    </div> --}}
                    <div class="widget_list">
                        <h3>Most Viewed Products</h3>
                        <div class="recent_product_container">

                            @foreach ($most_viewed_products as $most_viewed_product)
                            <article class="recent_product_list">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="{{url('product/details')}}/{{$most_viewed_product->slug}}"><img src="{{url('product_images/'.$most_viewed_product->image)}}" alt=""></a>
                                    </div>
                                    <div class="product_content">
                                        <h4><a href="{{url('product/details')}}/{{$most_viewed_product->slug}}">{{$most_viewed_product->name}}</a></h4>
                                        <div class="price_box">
                                            @if($most_viewed_product->prev_price != null)<span class="old_price">Tk. {{$most_viewed_product->prev_price}}</span>@endif
                                            <span class="current_price">Tk. {{$most_viewed_product->price}}</span>
                                        </div>
                                    </div>
                                </figure>
                            </article>
                            @endforeach

                        </div>
                    </div>
                </aside>
                <!--sidebar widget end-->
            </div>
            <div class="col-lg-9 col-md-2">

                <div class="breadcrumbs_area">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="breadcrumb_content">
                                    <ul>
                                        <li><a href="{{url('/')}}">home</a></li>
                                        <li>Shop</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--shop banner area start-->
                {{-- <div class="shop_banner_area mb-30">
                    <div class="row">
                        <div class="col-12">
                            <div class="shop_banner_thumb">
                                <img src="{{url('/')}}/frontend_assets/img/bg/banner16.jpg" alt="">
            </div>
        </div>
    </div>
</div> --}}




<div class="shop_page_category_section px-2">

    <div class="section_title s_title_style3">
        <h5 class="m-0">Feature Categories</h5>
    </div>
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



<div class="row no-gutters shop_wrapper product-item-group">
    <div class="col-12 ps-3 mt-3 mobile-only">
        <div class="section_title s_title_style3">
            <h5 class="m-0">All Products</h5>
        </div>
    </div>



    @if(count($products) > 0)
    @foreach ($products as $product)
    <div class="col-6 col-sm-4 col-lg-3 col-md-4 product-item">
        <a href="{{url('product/details')}}/{{$product->slug}}">
            <div style="background: #f8f8f8;" class="card text-decoration-none">

                <img src="{{url('product_images/'.$product->image)}}" alt="kinunbd" class="card-img-top" style="height: 150px; width: 100%; object-fit: contain;background: #fff;">
                <div class="card-body p-2">
                    <p class="product_name" style="margin-bottom: 5px;">{{substr($product->name,0,50)}}</p>

                    <div class="text-left text-danger fw-bold product-price">
                        @if($product->prev_price != null && $product->prev_price != 0)
                        <span class="old_price text-decoration-line-through me-2">
                            Tk. {{$product->prev_price}}
                        </span>
                        @endif
                        <span class="current_price">
                            Tk. {{$product->price}}
                        </span>
                    </div>
                </div>
                <div class="card-footer p-2">

                    <div class="d-flex justify-content-between buttons flex-wrap ">

                        <div class="buy-now-btn">
                            <form action="{{ url('/add/product/to/buy') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="hidden" value="1" name="qty">
                                <button style="border-style: none;background:#ef6437; color:#fff;" class="btn btn-sm btn-secondary p-2 " type="submit" title="Buy Now">Buy Now</button>
                            </form>
                        </div>

                        <div class="d-flex justify-content-start other-btns">
                            <form action="{{ url('/add/product/to/cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="hidden" value="1" name="qty">
                                <button style="border-style: none;height: 38px;" class="add-to-card" type="submit" title="Add to Cart">
                                    <i class="fa fa-shopping-cart p-2"></i>
                                </button>
                            </form>

                            <form action="{{ url('add/to/wish/list') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
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
    @else
    <h3 style="padding-top: 20px;padding-bottom: 20px;padding-left: 20px">No Products Found</h3>
    @endif
</div>

<div class="shop_toolbar t_bottom">
    <div class="pagination">
        <ul>
            {{ $products->links() }}
        </ul>
    </div>
</div>
<!--shop toolbar end-->
<!--shop wrapper end-->
</div>
</div>
</div>
</div>
<!--shop  area end-->
@endsection