@extends('layouts.apps')

@section('title')
    {{$user->fname}}'s Profile | UKM Trading & Service System
@endsection

@section('content')
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>{{$user->fname}}'s Profile</h1>
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
        <br>
        <div class="row">
        <div class="col-lg-3">
            <div class="blog_right_sidebar">
                <aside class="single_sidebar_widget author_widget">
                            <img class="rounded-circle w-100" src="/storage/uploads/{{ $user->image }}" alt="">
                            <h4>{{$user->fname}} {{$user->lname}}</h4>
                             @if ($user->gender == "Male")
                                <p>{{$user->gender}}  <i class="fa fa-mars" style="font-weight:bold; color:blue"></i>
                            @elseif ($user->gender == "Female")
                                {{$user->gender}}  <i class="fa fa-venus" style="font-weight:bold; color:deeppink"></i></p>
                            @endif
                            <h6>{{$user->phone}}  <i class="lnr lnr-phone-handset" style="font-weight:bold; color:green"></i></h6>
                            @if ($rating > 0)
                                <h5>{{number_format(DB::table('ratings')->join('comments','comments.id','=','ratings.id')->where('commentable_id','=',$user->id)->avg('rating'),2)}} <span class="fa fa-star checked" style="color: gold"></span></h5>
                            @else
                                <h5>No ratings yet.</h5>
                            @endif
                            <p>Joined {{ $user->created_at->diffForHumans() }}</p>
<!--                             <h5 class="widget_title">Contact No.</h5>
                            <ul class="list cat-list">
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>{{$user->phone}}</p>
                                    </a>
                                </li>
                            </ul> -->
                            <div class="br"></div>
                            @can('update', $user->profile)
                            <a href="/profile/{{ $user->id }}/edit" class="primary-btn">Edit Profile</a>
                            @endcan
                            <a href="/review/{{$user->id}}" class="primary-btn">View Review</a>
                        </aside>
            </div>
        </div>
<!--         <div class="container text-center">
            <h3>Listings</h3>
        </div> -->

            <div class="album col-lg-9" style="background-color: #fafaff">
                <div class="container">
                    <div class="container text-center">
                        <h3 class="pt-3 pb-1">Listings</h3> <!-- padding top & bottom -->
                    </div>
                    <div class="row">
                    @forelse($user->posts as $post)
                            <div class="col-md-4 d-flex align-items-stretch">
                                <div class="card mb-4 shadow-sm">
                                    <img class="card-img-top" alt="Card image cap" style="width:243px; height:232px; object-fit:cover" src="/storage/post_images/{{$post->cover_image}}">
                                    <div class="card-body">
                                        @if ($post->status == "Available") <h6 class="text-success float-right pt-1">{{$post->status}}</h6>
                                        @elseif ($post->status == "Pending") <h6 class="text-warning float-right pt-1">{{$post->status}}</h6>
                                        @else <h6 class="text-danger float-right pt-1">{{$post->status}}</h6>
                                        @endif
                                        <span>{{ Str::limit($post->title, 20) }}</span>
                                        <br>
                                        <span class="pt-4 font-weight-bold">{{$post->type}}</span>
                                        <br>
                                        <span>RM {{number_format($post->price, 2)}}</span>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="/posts/{{$post->id}}" class="btn btn-sm btn-outline-warning">View Post</a>
                                                @if(!Auth::guest())
                                                @if(Auth::user()->id == $post->user_id || Auth::user()->user_level == 'admin')
                                                    <a href="/posts/{{$post->id}}/offers" class="btn btn-sm btn-outline-primary">View Offer</a>
                                                @endif
                                                @endif
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
                                                        <button type="submit" class="btn btn-sm btn-outline-light"><i class="fa fa-heart" style="color: deeppink"></i></button></h1></div>
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
                </div>
            </div>
        </div>
    </div><br>
@endsection
@section('scripts')
@endsection