@extends('public.othermaster')

@section('content')
<!--about bg area start-->
<div class="about_bg_area">
    <div class="container">
        <!--about section area -->
        <section class="about_section mb-60">
            <div class="row align-items-center">
                <div class="col-12">
                    <figure>
                        <div class="about_thumb" style="text-align: center">
                            @if($about != null)<img src="{{url('about_images/'.$about->image)}}" alt="" style="width: 60%;margin:auto">@endif
                        </div>
                        <figcaption class="about_content">
                            @if($about != null){!! $about->details !!}@endif
                        </figcaption>
                    </figure>
                </div>
            </div>
        </section>
        <!--about section end-->
    </div>
</div>
<!--about bg area end-->
@endsection
