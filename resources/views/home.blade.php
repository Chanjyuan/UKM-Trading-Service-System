@extends('layouts.apps')

@section('title')
    Home | UKM Trading & Service System
@endsection

@section('content')

    <section class="banner-area">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-start">
                <div class="col-lg-12">
                  @include('inc.messages')
                    <div class="active-banner-slider owl-carousel">
                        <!-- single-slide -->
                        <div class="row single-slide align-items-center d-flex">
                            <div class="col-lg-5 col-md-6">
                                <div class="banner-content">
                                    <h1>Welcome!<br>Looking for something?</h1>
<!--                                     <p>...</p> -->
                                    <div class="add-bag d-flex align-items-center">
                                        <div id="search" class="input-group">
                                          <form class="form-inline my-2 my-lg-0" type="get" action="{{ url('/search') }}">
                                            <input type="search" name="search" value="" placeholder="Search for item/service..." class="form-control input-lg" />
                                            <span class="input-group-btn pl-2">
                                                <button id="bt" type="submit" class="genric-btn primary circle"><i class="fa fa-search"></i></button>
                                            </span>
                                          </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                    <a href=/catalog><img class="img-fluid" src="storage/slide/1.jpg" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <!-- single-slide -->
                        <div class="row single-slide">
                            <div class="col-lg-5">
                                <div class="banner-content">
                                    <br><br>
                                    <h1>What we do?</h1>
                                    <h4>UKM Trading & Service System is here to provide a simple and intuitive marketplace for the users to sell or exchange their new, used, or pre-owned item and offer quick services without any hassle!</h4>
                                    <div class="add-bag d-flex align-items-center">
                                        @guest
                                        <a href="/register" class="genric-btn primary circle arrow">Join Now!<span class="lnr lnr-arrow-right"></span></a>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                    <img class="img-fluid" src="storage/slide/6.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br>
    <!-- End banner Area -->

    <!-- start features Area -->

        <div class="container">
            <h3 style="text-align: center;"><a>Our Features</a></h3><hr>
            <div class="row features-inner">
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="{{asset('app-assets/img/features/f-icon1.png')}}" alt="">
                        </div>
                        <h6>Easy to Browse</h6>
                        <p>Any kind of products/services</p>
                    </div>
                </div>
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="{{asset('app-assets/img/features/f-icon2.png')}}" alt="">
                        </div>
                        <h6>Simple to Upload</h6>
                        <p>Used/new items are welcomed</p>
                    </div>
                </div>
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="{{asset('app-assets/img/features/f-icon3.png')}}" alt="">
                        </div>
                        <h6>Sell or Exchange</h6>
                        <p>Many deal options available</p>
                    </div>
                </div>
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="{{asset('app-assets/img/features/f-icon4.png')}}" alt="">
                        </div>
                        <h6>Leave a Review</h6>
                        <p>To help one another</p>
                    </div>
                </div>
            </div><hr>
        </div><br>
    
     <!-- Swiper -->
<!--     <div class="swiper-container">
        <div class="swiper-wrapper">
          <div class="swiper-slide" style="background-image:url(storage/slide/2.png)"></div>
          <a href=/catalog><div class="swiper-slide" style="background-image:url(storage/slide/1.jpg)"></div></a>
          <div class="swiper-slide" style="background-image:url(storage/slide/3.png)"></div>
          <a href=/catalog><div class="swiper-slide" style="background-image:url(storage/slide/4.jpg)"></div></a>
          <div class="swiper-slide" style="background-image:url(storage/slide/5.jpg)"></div>
          <div class="swiper-slide" style="background-image:url(storage/slide/1.jpg)"></div>
          <div class="swiper-slide" style="background-image:url(storage/slide/2.png"></div>
          <div class="swiper-slide" style="background-image:url(storage/slide/3.png)"></div>
          <div class="swiper-slide" style="background-image:url(storage/slide/4.jpg)"></div>
          <div class="swiper-slide" style="background-image:url(storage/slide/5.jpg)"></div>
          <div class="swiper-slide" style="background-image:url(storage/slide/1.jpg)"></div>
          <div class="swiper-slide" style="background-image:url(storage/slide/2.png)"></div>
        </div> -->
        <!-- Add Pagination -->
<!--         <div class="swiper-pagination"></div> -->
<!--     </div> -->
     
    <div class="col-first">  
        <h3 style="text-align: center;"><a>Latest Posts</a></h3> 
    </div>
    <div class="container">
        @if (Session::has('success_message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                <span arial-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (Session::has('error_message'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error_message') }}
                <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                    <span arial-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            @forelse($products as $product)
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="card mb-4 shadow-sm">
                        <img class="card-img-top" alt="Card image cap" style="width:348px; height:232px; object-fit:cover" src="/storage/post_images/{{$product->cover_image}}">
                        <div class="card-body">
                            @if ($product->status == "Available") <h6 class="text-success float-right pt-1">{{$product->status}}</h6>
                            @elseif ($product->status == "Pending") <h6 class="text-warning float-right pt-1">{{$product->status}}</h6>
                            @else <h6 class="text-danger float-right pt-1">{{$product->status}}</h6>
                            @endif
                            <span>{{ Str::limit($product->title, 30) }}</span>
                            <br>
                            <span class="pt-4 font-weight-bold">{{$product->type}}</span>
                            <br>
                            <span>RM {{number_format($product->price, 2)}}</span>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{url('posts',$product->id)}}" class="genric-btn primary small pt-1">View Post</a>
                                    <form action="{{ url('add-to-cart') }}" method="post" class="form-horizontal qtyFrm" >
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">

                                        @guest
                                        <div class="pt-1 pl-1">
                                            <button type="submit" class="btn btn-sm btn-outline-light"><i class="fa fa-heart" style="color: deeppink"></i></button></div>
                                        @endguest

                                        @if(!Auth::guest())
                                         @if(Auth::user()->user_level == 'user')
                                         <div class="pt-1 pl-1">
                                            <button type="submit" class="btn btn-sm btn-outline-light"><i class="fa fa-heart" style="color: deeppink"></i></button></div>
                                         @endif
                                        @endif
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="container"><p style="text-align: center">No product/service posted.</p></div>
            @endforelse
        </div>
        <nav class="blog-pagination justify-content-center d-flex">
            {!! $products->links() !!}
        </nav>
    </div>   
@endsection
@section('scripts')
@endsection