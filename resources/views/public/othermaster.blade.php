<!doctype html>
<html class="no-js" lang="en">

<head>
    
    <!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '956248698410070');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=956248698410070&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$icon->title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('header_meta')

    <link rel="shortcut icon" type="image/x-icon" href="{{url('logo_images/'.$icon->icon)}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend_assets/css/plugins.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend_assets/css/style.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
     <style type="text/css">
      .ui-autocomplete-row
      {
        padding:8px;
        background-color: #f4f4f4;
        border-bottom:1px solid #ccc;
        font-weight:bold;
      }
      .ui-autocomplete-row:hover
      {
        background-color: #ddd;
      }
    </style>

    @yield('header_css')
</head>

<body>

    <!-- Load Facebook SDK for JavaScript -->
       <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v8.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
      </script>
      
      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat d-none"
        attribution=setup_tool
        page_id="258964844905554"
        theme_color="#333333"
        logged_in_greeting="Hello Welcome to KinunBD. How can i help you..??"
        logged_out_greeting="Hello Welcome to KinunBD. How can i help you..??">
      </div>

    {{--  facebook Share  --}}
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0&appId=294390568234824&autoLogAppEvents=1"></script>
    {{--  facebook Share  --}}

    {{--  Whats app button  --}}
    @if($about != null && $about->contact!= null)
    <div class="whatsapp">
        <a href="https://api.whatsapp.com/send?phone={{$about->contact}}" target="_blank">
            <h5><i class="fa fa-whatsapp fa-3x"></i></h5>
        </a>
    </div>
    @endif
    {{--  Whats app button  --}}


    <!--Offcanvas menu area start-->
    <div class="off_canvars_overlay"></div>
    <div class="Offcanvas_menu">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="canvas_open">
                        <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
    <!--Offcanvas menu area end-->

    <!--header area start-->
    <header>
        <div class="main_header">
            <div>
            

                
                <div class="header_middle sticky-header">
                    <div class="container">
                        <div class="row align-items-center">
                        <div class="col-lg-2 col-md-3 col-3">
                            <div class="logo">
                                <a href="{{url('/')}}"><img class="logo_image" src="{{url('logo_images/'.$icon->logo)}}" alt="" style="padding-left:20px"></a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-6">
                            <div class="main_menu menu_position text-center">
                               
                            </div>
                        </div>

                    
                    </div>
                    </div>
                </div>
             
            </div>
        </div>
    </header>
    <!--header area end-->



    @yield('content')


    <footer class="footer_widgets" style="background-color: #000; color: #fff">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-5 col-sm-12">
                        <div class="widgets_container contact_us">
                            <h3>About @if($icon->title != null){{$icon->title}}@endif</h3>
                            <div class="aff_content">
                                @if($footer != null && $footer->footer_text != null){!! $footer->footer_text !!}@endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <div class="widgets_container widget_menu">
                          
                        </div>
                    </div>
                 
                    <div class="col-lg-2 col-md-5 col-sm-6">
                        <div class="widgets_container widget_menu">
                          
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-7 col-sm-12">
                        <div class="widgets_container">
                           
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="copyright_area">
                            @if($footer != null && $footer->copyright_text != null){!! $footer->copyright_text !!}@endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="footer_payment text-right">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--footer area end-->


<script src="{{url('/')}}/frontend_assets/js/plugins.js"></script>
<script src="{{url('/')}}/frontend_assets/js/main.js"></script>

@yield('footer_js')

<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

{!! Toastr::message() !!}

<script>
  $(document).ready(function(){
      
    $('#search_data').autocomplete({

     source: "/api/product/search",
      minLength: 1,
      select: function(event, ui)
      { 
        console.log(ui)
        $('#search_data').val(ui.item.value);
        $('#slug').val(ui.item.slug);
        $('#searchForm').submit();
      }
      
    }).data('ui-autocomplete')._renderItem = function(ul, item){
      return $("<li class='ui-autocomplete-row'></li>")
        .data("item.autocomplete", item)
        .append(item.label)
        .appendTo(ul);
    };
  });
</script>

</body>
</html>