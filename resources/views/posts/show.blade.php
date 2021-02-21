@extends('layouts.apps')

@section('title')
    Post Details | UKM Trading & Service System
@endsection

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first" style="text-align: right;">
                    <h1 style="overflow-wrap: break-word; max-width: 20ch;">Post Details</h1>
                </div>
            </div>
        </div>
    </section>  
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

        <div class="row s_product_inner">
                <div class="col-lg-6">
                    <br><br>
                    <img class="img-fluid" src="/storage/post_images/{{$post->cover_image}}" >
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                      <div class="row">
                        <h3>{{$post->title}}</h3>
                        <form action="{{ url('add-to-cart') }}" method="post" class="form-horizontal qtyFrm" >
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $post['id'] }}">

                                        @guest
                                        <div class="pl-1">
                                            <button type="submit" class="btn btn-sm btn-outline-light"><i class="fa fa-heart" style="color: deeppink"></i></button></div>
                                        @endguest

                                        @if(!Auth::guest())
                                         @if(Auth::user()->user_level == 'user')
                                         <div class="pl-1">
                                            <button type="submit" class="btn btn-sm btn-outline-light"><i class="fa fa-heart" style="color: deeppink"></i></button></div>
                                         @endif
                                        @endif
                                        
                                    </form>
                      </div>
                        <h2>RM {{number_format($post->price, 2)}} </h2>
                        <div class="media">
                            <div class="d-flex">
                                <img src="/storage/uploads/{{ $post->user->image }}" style="width:40px; height:40px; position:center; border-radius:50%">
                            </div>
                            <div class="media-body pt-2 pl-1">
                                <h4 ><a href="/profile/{{ $post->user->id }}">  {{$post->user->fname}} {{$post->user->lname}}</a></h4>
                                <!-- <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> -->
                            </div>
                        </div>
                        <br>
                        <ul class="list">
                            <li><a class="active" href="#"><span>Deal Method</span> : {{$post->type}}</a></li>
                            <li><a href="#"><span>Status</span> : 
                                @if ($post->status == "Available") <a class="text-success">{{$post->status}}</a>
                                @elseif ($post->status == "Pending") <a class="text-warning">{{$post->status}}</a>
                                @else <a class="text-danger">{{$post->status}}</a>
                                @endif
                            </a></li>
                            <li><small style="padding-right:40px">Posted on {{$post->created_at->format('d M Y')}}</small></li>
                        </ul>
                        <p>{!!$post->description!!}</p>
                    
                        <div class="card_area d-flex align-items-center">
<!--                             <form action="{{ url('add-to-cart') }}" method="post" class="form-horizontal qtyFrm" >
                                     @csrf
                                <input type="hidden" name="product_id" value="{{ $post['id'] }}">
                               
                                @guest
                                    <button type="submit" class="btn primary-btn">Add to Cart</button>
                                @endguest

                                @if(!Auth::guest())
                                    @if(Auth::user()->user_level == 'user') 
                                        <button type="submit" class="btn primary-btn">Add to Cart</button>
                                    @endif
                                @endif   
                            </form> -->
                           
                            @if(!Auth::guest())
                                @if(Auth::user()->user_level != 'admin' && Auth::user()->id != $post->user_id)
                                    <a href="/posts/{{$post->id}}/offers/create" class="btn primary-btn">Make Offer</a>
                                @endif
                                @if(Auth::user()->id == $post->user_id || Auth::user()->user_level == 'admin')
                                    <a href="/posts/{{$post->id}}/offers" class="btn primary-btn">View Offer</a>
                                    <a href="/chat" class="btn primary-btn">Chat with</a>
                                @endif
                            @endif
                            @if(!Auth::guest())
                                @if(Auth::user()->user_level != 'admin' && Auth::user()->id != $post->user_id)
                                    @if (count($offers) > 0)
                                        <a href="/chat" class="btn primary-btn">Chat with</a>
                                    @endif
                                @endif
                            @endif
                        </div>
                        <div class="card_area d-flex align-items-center pt-2">
                            @if(!Auth::guest()) 
                                @if(Auth::user()->id == $post->user_id || Auth::user()->user_level == 'admin')
                                    <a href="/posts/{{$post->id}}/edit" class="genric-btn info radius">Edit</a>
                                   
                                    {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                    <div class="pl-2">
                                        {{Form::submit('Delete', ['class' => 'genric-btn danger radius'])}}
                                    </div>
                                    {!! Form::close() !!}
                                @endif
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>
            <br><br>
        </div>
    </div>
@endsection
@section('scripts')
@endsection