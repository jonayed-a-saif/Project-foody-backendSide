<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
	<!-- Site wrapper -->
	<div class="wrapper" id="app">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <router-link to="/home" class="nav-link">Home</router-link>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3 d-none">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                </div>
            </div>
            </form>

            <ul class="navbar-nav ml-auto">
                <!-- Log out-->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <router-link to="change-password" class="dropdown-item">
                            Change Password
                        </router-link>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<router-link to="/home" class="brand-link">
				<img src="{{url('/')}}/assets/admin/default/admin.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">{{Auth::user()->name}}</span>
			</router-link>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        @if(Auth::user()->role == 1 || Auth::user()->role == 3)

                            <li class="nav-item">
                                <router-link to="/home" href="" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                                </router-link>
                            </li>

                            @if(Auth::user()->category == 1)
                            {{--  Category  --}}
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-sitemap"></i>
                                    <p>
                                        Manage Categories
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/category-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Main Category
                                            </p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/subcategory-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Sub-Category
                                            </p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/childcategory-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Child Category
                                            </p>
                                        </router-link>
                                    </li>
                                 
                                </ul>
                            </li>
                            @endif

                            @if(false)
                            {{--  Category  --}}
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-sitemap"></i>
                                    <p>
                                        Manage Categories
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/category-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Main Category
                                            </p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/subcategory-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Sub-Category
                                            </p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/childcategory-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Child Category
                                            </p>
                                        </router-link>
                                    </li>
                                  
                                </ul>
                            </li>
                            @endif

                            

                            @if(Auth::user()->product == 1)
                            {{--  product  --}}
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cart-arrow-down"></i>
                                    <p>
                                        Products
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/add-product" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Add New Product
                                            </p>
                                        </router-link>
                                    </li>
                                  
                                    <li class="nav-item">
                                        <router-link to="/product-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                All Products
                                            </p>
                                        </router-link>
                                    </li>

                                </ul>
                            </li>
                            @endif

                          


                           

                            @if(Auth::user()->general == 1)
                            {{--  General Settings  --}}
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        General Settings
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/logo-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Logo/Favicon/Title
                                            </p>
                                        </router-link>
                                    </li>
                                  
                                    <li class="nav-item">
                                        <router-link to="/shippingMethod-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Shipping Method
                                            </p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/packaging-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Packaging
                                            </p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/pickup-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Pickup Location
                                            </p>
                                        </router-link>
                                    </li>
                                   
                                    <li class="nav-item">
                                        <router-link to="/footer-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Footer
                                            </p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/popup-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Popup Banner
                                            </p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/error-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Error Banner
                                            </p>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                            @endif

                            @if(Auth::user()->home == 1)
                            {{--  Home Page Seetings  --}}
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-laptop-house"></i>
                                    <p>
                                        Home Page Settings
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/slider-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Sliders
                                            </p>
                                        </router-link>
                                    </li>
                                   
                                    <li class="nav-item">
                                        <router-link to="/about-list" href="" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                About Us
                                            </p>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                            @endif

                          

                            @if(Auth::user()->stuff == 1)
                            {{--  Role Management  --}}
                            <li class="nav-item">
                                <router-link to="/stuff-list" href="" class="nav-link">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>Manage Stuff</p>
                                </router-link>
                            </li>
                            @endif

                            @if(Auth::user()->customer == 1)
                            <li class="nav-item">
                                <router-link to="/customer-list" href="" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Customers</p>
                                </router-link>
                            </li>
                            @endif

                           
                          

                        @endif

					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

			<!-- Main content -->
			<section class="content">

                <admin-main></admin-main>

			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer text-right">
			<strong>Develop by <a href="http://decode-lab.com" target="_blank">Decode-Lab</a></strong>
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
        <!-- /.control-sidebar -->

	</div>
    <!-- ./wrapper -->
    <!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    
    {{-- <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/pages/dashboard2.js') }}"></script> --}}

    <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" />
    
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js" defer></script>

</body>

</html>
