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
                        <li>Shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--shop  area start-->
<div class="shop_area shop_reverse">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <!--sidebar widget start-->
                <aside class="sidebar_widget">
                    <div class="widget_list widget_categories">
                        <h3>Product categories</h3>
                        <ul>
                            @foreach ($categories as $category)
                                @php
                                    $subcategories = null;
                                    if(DB::table('sub_categories')->where('category_id',$category->id)->exists()){
                                        $subcategories = DB::table('sub_categories')->where('category_id',$category->id)->get();
                                    }
                                @endphp
                                <li @if($subcategories != null) class="widget_sub_categories" @endif><a href="{{url('/category/wise/products')}}/{{$category->slug}}">{{$category->name}}</a>
                                    @if($subcategories != null)
                                    <ul class="widget_dropdown_categories">
                                        @foreach ($subcategories as $subcategory)
                                            <li><a href="{{url('subcategory/wise/products')}}/{{$subcategory->slug}}">{{$subcategory->name}}</a></li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
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
            <div class="col-lg-9 col-md-12">

                <!--shop banner area start-->
                {{--  <div class="shop_banner_area mb-30">
                    <div class="row">
                        <div class="col-12">
                            <div class="shop_banner_thumb">
                                <img src="{{url('/')}}/frontend_assets/img/bg/banner16.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>  --}}
                <!--shop banner area end-->

                <!--shop toolbar start-->
                <div class="shop_toolbar_wrapper">
                    <div class="shop_toolbar_btn">
                        <button data-role="grid_4" type="button" class=" active btn-grid-4" data-toggle="tooltip" title="4"></button>
                        {{--  <button data-role="grid_list" type="button" class="btn-list" data-toggle="tooltip" title="List"></button>  --}}
                    </div>
                    <div class="page_amount">
                        @php
                            $products_count = App\Product::count();
                        @endphp
                        <p>Showing 16 of {{count($home_categories_products)}} results</p>
                    </div>
                </div>
                <!--shop toolbar end-->

                <!--shop wrapper start-->
                <div class="row no-gutters shop_wrapper">

                    @if(count($home_categories_products) > 0)
                    @foreach ($home_categories_products as $pro)
                    <div class="col-lg-3 col-md-4 col-12">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="{{url('product/details')}}/{{$pro->product->slug}}"><img src="{{url('product_images/'.$pro->product->image)}}" alt="" style="height: 250px; width: 100%"></a>
                                    <div class="label_product">
                                        <span class="label_sale">Shop</span>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <li class="wishlist">
                                                <form action="{{url('add/to/wish/list')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{$pro->product->id}}">
                                                    <input type="hidden" value="1" name="qty">
                                                    <button style="border-style: none" type="submit" title="Add to cart"><i class="ion-android-favorite-outline"></i></button>
                                                </form>
                                                {{-- <a href="{{url('add/to/wish/list')}}" title="Add to Wishlist"><i class="ion-android-favorite-outline"></i></a> --}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="product_content grid_content">
                                    <div class="product_content_inner">
                                        <h4 class="product_name"><a href="{{url('product/details')}}/{{$pro->product->slug}}">{{substr($pro->product->name,0,50)}}</a></h4>
                                        <div class="price_box">
                                            @if($pro->product->prev_price != null && $pro->product->prev_price != 0)<span class="old_price">Tk. {{$pro->product->prev_price}}</span>@endif
                                            <span class="current_price">Tk. {{$pro->product->price}}</span>
                                        </div>
                                    </div>
                                    <div class="add_to_cart">
                                        @if($pro->product->stock > 0)
                                            <form action="{{url('/add/product/to/cart')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$pro->product->id}}">
                                                <input type="hidden" value="1" name="qty">
                                                <button type="submit" title="Add to cart">Add to cart</button>
                                            </form>
                                            @else
                                            <a href="#" title="Stock out">Stock out</a>
                                        @endif
                                    </div>
                                </div>

                                <div class="product_content list_content">
                                    <h4 class="product_name"><a href="{{url('product/details')}}/{{$pro->product->slug}}">{{substr($pro->product->name,0,50)}}</a></h4>
                                    <div class="price_box">
                                        @if($pro->product->prev_price != null && $pro->product->prev_price != 0)<span class="old_price">Tk. {{$pro->product->prev_price}}</span>@endif
                                        <span class="current_price">Tk. {{$pro->product->price}}</span>
                                    </div>
                                    <div class="product_desc">
                                        <p></p>
                                    </div>
                                    <div class="add_to_cart">
                                        @if($pro->product->stock > 0)
                                            <form action="{{url('/add/product/to/cart')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$pro->product->id}}">
                                                <input type="hidden" value="1" name="qty">
                                                <button type="submit" title="Add to cart">Add to cart</button>
                                            </form>
                                            @else
                                            <a href="#" title="Stock out">Stock out</a>
                                        @endif
                                    </div>
                                </div>
                            </figure>
                        </article>
                    </div>
                    @endforeach
                    @else
                        <h3 style="padding-top: 20px;padding-bottom: 20px;padding-left: 20px">No Products Found</h3>
                    @endif
                </div>

                <div class="shop_toolbar t_bottom">
                    <div class="pagination">
                        <ul>
                            {{ $home_categories_products->links() }}
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
