<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>UKM Trading & Service System</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
     

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    


    <style>
        body {
          background: #fff;
          font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
          font-size: 14px;
          color: #000;
          margin: 0;
          padding: 0;
        }
    
        .swiper-container {
          width: 100%;
          padding-top: 50px;
          padding-bottom: 50px;
        }
    
        .swiper-slide {
          background-position: center;
          background-size: cover;
          width: 500px;
          height: 300px;
    
        }

        #footer{
                background: #252426;
            }
            #ftext{
                color: white;
            }
        
        .card-img-top {
            width: 100%;
            height: 10vw;
            object-fit: cover;
            }

        #bt{
            height: 100%;
            width: 50px;
            background-color:rgb(68, 70, 70);
        }

        #bt1{
            border-color: #000;
            color:#fff;
            background-color:rgb(31, 30, 30) ;

            body {
                margin: 0;
                font-family: Arial, Helvetica, sans-serif;
        }       

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   UKM Trading & Service System
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link" href="/catalog">Catalog</a></li>
<!--                         <li class="nav-item"><a class="nav-link" href="/category">Category</a></li> -->
                        <li class="nav-item dropdown">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @if(!Auth::guest())
                        @if(Auth::user()->user_level == 'user')
                        <li class="nav-item">
                            <a href="{{ route('users.notifications') }}" class="nav-link">
                                <span class="badge badge-info" style="color: #fff;">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                    Pending offers
                                </span>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/cart">Wishlist</a></li>
                        <li class="nav-item"><a class="nav-link" href="/posts/create">Create Post</a></li>
                        @else
                        <li class="nav-item"><a class="nav-link" href="/admin-dashboard">Dashboard</a></li>
<!--                         <li class="nav-item"><a class="nav-link" href="/categories">Categories</a></li> -->
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
                                    {{-- <a class="dropdown-item" href="/offers/{{Auth::user()->id}}/receive">Post Offer</a> --}}
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
                </div>
            </div>
        </nav>   
    </div>
    
    <main role="main" class="container py-4">
            @include('inc.messages')
            @yield('content')
    </main>

    <!-- Footer-->
    <footer class="footer py-4" id="footer" >
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-left" id="ftext">Copyright © Your Website 2020</div>
                <div class="col-lg-8 text-lg-right">
                    <a class="mr-3" href="#!">Privacy Policy</a>
                    <a href="#!">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.swiper-container', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
        },
        pagination: {
        el: '.swiper-pagination',
        },
      });

      swiper.slideTo(1,false,false);
    </script>
    <script>
        function myFunction() {
          var x = document.getElementById("myTopnav");
          if (x.className === "topnav") {
            x.className += " responsive";
          } else {
            x.className = "topnav";
          }
        }
    </script>
        
</body>
</html>
