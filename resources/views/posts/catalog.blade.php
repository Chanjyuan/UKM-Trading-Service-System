@extends('layouts.apps')

@section('title')
    Catalog | UKM Trading & Service System
@endsection

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Product/Service Listings</h1>
                </div>
            </div>
        </div>
    </section><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
              <div class="dropdown show">
                <a class="primary-btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Categories
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="/catalog">All</a>
                    <?php $cats=DB::table('categories')->get(); ?>
                    @foreach($cats as $cat)
                    <a class="dropdown-item" href="{{url('category',$cat->id)}}">{{ucwords($cat->name)}}</a>
                    @endforeach
                </div>
              </div>
            </div>
              <div class="col-sm-5">
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
        <br>
        <div class="col-first">  
            <h1><a>Featured</a></h1> 
        </div>
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