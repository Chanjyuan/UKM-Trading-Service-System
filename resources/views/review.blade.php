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
                    <div class="br"></div>
                    @can('update', $user->profile)
                    <a href="/profile/{{ $user->id }}/edit" class="primary-btn">Edit Profile</a>
                    @endcan
                    <a href="/profile/{{$user->id}}" class="primary-btn">View Listings</a>
                </aside>
            </div>
        </div>

        <div class="album col-lg-9" style="background-color: #fafaff">
            <div class="container">
                <div class="container text-center">
                    <h3 class="pt-3 pb-1">Average Ratings</h3>
                    <h4>{{number_format(DB::table('ratings')->join('comments','comments.id','=','ratings.id')->where('commentable_id','=',$user->id)->avg('rating'),2)}} <span class="fa fa-star checked" style="color: gold"></span> based on {{DB::table('comments')->where('commentable_id','=',$user->id)->count('commentable_id')}} reviews.</h4><hr>
                    <h3 class="pt-1 pb-1">Reviews</h3> <!-- padding top & bottom -->
                </div>
                <div class="container">
                    @comments([
                        'model' => $user->profile,
                        'maxIndentationLevel' => 1,
                        'perPage' => 10
                    ])
                </div>
            </div>
        </div>
    </div><br>
@endsection
@section('scripts')
@endsection