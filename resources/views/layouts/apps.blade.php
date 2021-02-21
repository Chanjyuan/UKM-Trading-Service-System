<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>@yield('title')</title>
	<!--
		CSS
		============================================= -->
	<link rel="stylesheet" href="{{asset('app-assets/css/linearicons.css')}}">
	<link rel="stylesheet" href="{{asset('app-assets/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('app-assets/css/themify-icons.css')}}">
	<link rel="stylesheet" href="{{asset('app-assets/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('app-assets/css/owl.carousel.css')}}">
	<link rel="stylesheet" href="{{asset('app-assets/css/nice-select.css')}}">
	<link rel="stylesheet" href="{{asset('app-assets/css/nouislider.min.css')}}">
	<link rel="stylesheet" href="{{asset('app-assets/css/ion.rangeSlider.css')}}" />
	<link rel="stylesheet" href="{{asset('app-assets/css/ion.rangeSlider.skinFlat.css')}}" />
	<link rel="stylesheet" href="{{asset('app-assets/css/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{asset('app-assets/css/main.css')}}">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	
	<style>
		div.stars {
		width: 270px;
		display: inline-block;
		}

		input.star { display: none; }

		label.star {
		float: right;
		padding: 10px;
		font-size: 36px;
		color: #444;
		transition: all .2s;
		}

		input.star:checked ~ label.star:before {
		content: '\f005';
		color: #FD4;
		transition: all .25s;
		}

		/* input.star-5:checked ~ label.star:before {
		color: #FE7;
		text-shadow: 0 0 20px #952;
		} */

		input.star-1:checked ~ label.star:before { color: #F62; }

		#dstar:hover { transform: rotate(-15deg) scale(1.3); }

		label.star:before {
		content: '\f006';
		font-family: FontAwesome;
		}
	</style>
</head>

<body>

	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="/home"><img src="{{asset('app-assets/img/logo.png')}}" size="137*50" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							@if(!Auth::guest())
		                        @if(Auth::user()->user_level == 'user')
		                         <li class="nav-item">
                            		<a href="{{ route('users.notifications') }}" class="genric-btn primary circle arrow">
                            			{{ auth()->user()->unreadNotifications->count() }}
                                    	Pending offers
                                	    <span class="lnr lnr-arrow-right"></span>
                           			</a>
                        		</li>
                        		@endif
		                    @endif
							<li class="nav-item"><a class="nav-link" href="/catalog">Catalog</a></li>
							@if(!Auth::guest())
		                        @if(Auth::user()->user_level == 'user')
		                        <li class="nav-item"><a class="nav-link" href="/cart">Wishlist</a></li>
								<li class="nav-item"><a class="nav-link" href="/posts/create">Create Post</a></li>
<!-- 								<li class="nav-item"><a class="nav-link" href="/chat">Messenger</a></li> -->
		                        @else
		                        <li class="nav-item"><a class="nav-link" href="/admin-dashboard">Dashboard</a></li>
		                        @endif
		                    @endif
							<!-- Authentication Links -->
	                        @guest
	                            @if (Route::has('login'))
	                                <li class="nav-item">
	                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
	                                </li>
	                            @endif
	                            
	                            @if (Route::has('register'))
	                                <li class="nav-item">
	                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
	                                </li>
	                            @endif
	                        @else
							<li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->fname }} {{ Auth::user()->lname }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(!Auth::guest())
                                    @if(Auth::user()->user_level == 'user')
                                    <a class="dropdown-item" href="/profile/{{ Auth::user()->id }}">My Profile</a>
                                    <a class="dropdown-item" href="/offers/{{Auth::user()->id}}">My Offer</a>
                                    <a class="dropdown-item" href="/changepassword">Change Password</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    @else
                                    <a class="dropdown-item" href="/profile/{{ Auth::user()->id }}">My Profile</a>
                                    <a class="dropdown-item" href="/changepassword">Change Password</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    @endif
                                    @endif
                                </div>
                            </li>
                        @endguest
						</ul>
<!-- 						<ul class="nav navbar-nav navbar-right">
							@if(!Auth::guest())
                        	@if(Auth::user()->user_level == 'user')
							<li class="nav-item"><a class="nav-link" href="/cart"><span class="ti-bag"></span> Wishlist</a></li>
							@endif
                        	@endif
							<li class="nav-item">
								<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
							</li>
						</ul> -->
					</div>
				</div>
			</nav>
		</div>
<!-- 		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div> -->
	</header>
	<!-- End Header Area -->

	<!-- start banner Area -->
	<div class="content">
		@yield('content')
	</div>
	<!-- End banner Area -->

	<!-- start footer Area -->
    <footer class="footer-area py-4" style="position: sticky; ,bottom: 0px;">
        <div class="container">
            <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
                <p class="footer-text m-0">
                	Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made by UKM TRADING & SERVICE SYSTEM
                </p>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->

	<script src="{{asset('app-assets/js/vendor/jquery-2.2.4.min.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="{{asset('app-assets/js/vendor/bootstrap.min.js')}}"></script>
	<script src="{{asset('app-assets/js/jquery.ajaxchimp.min.js')}}"></script>
	<script src="{{asset('app-assets/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{asset('app-assets/js/jquery.sticky.js')}}"></script>
	<script src="{{asset('app-assets/js/nouislider.min.js')}}"></script>
	<script src="{{asset('app-assets/js/countdown.js')}}"></script>
	<script src="{{asset('app-assets/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('app-assets/js/owl.carousel.min.js')}}"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="{{asset('app-assets/js/gmaps.min.js')}}"></script>
	<script src="{{asset('app-assets/js/main.js')}}"></script>
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
	@yield('scripts')
</body>

</html>