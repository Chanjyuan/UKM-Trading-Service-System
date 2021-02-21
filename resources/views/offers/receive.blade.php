@extends('layouts.apps')

@section('title')
    List of Received Offers | UKM Trading & Service System
@endsection

@section('content')

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>List of Received Offers</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row mb-2">
                @if (count($posts) > 0)
                    @foreach ($posts as $post)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow scroll">
                                <img class="card-img-top" src="/storage/post_images/{{$post->cover_image}}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 style="padding-top: 10px; padding-left: 10px;"><strong>{{$post->title}}</strong></h5>
                                    <div class="btn-group">
                                        <a href="/posts/{{$post->id}}" class="btn btn-sm btn-outline-primary">Details</a>
                                    </div>
                                </div>
                                <div class="card-body overflow-auto" style="max-height: 150px;">
                                    @if (count($post->offers) > 0)
                                    <ul class="list-group list-group-flush">
                                        @foreach ($post->offers as $offer)
                                            <li class="list-group-item">
                                                <a href="/profile/{{$offerby->find($offer->user_id)->id}}">{{$offerby->find($offer->user_id)->fname}} {{$offerby->find($offer->user_id)->lname}}</a> offering <strong>{{$offer->price}}</strong>
                                            </li>
                                        @endforeach
                                    </ul>
                                        
                                    @else
                                        <p>No offers yet</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No posts found</p>
                @endif
            </div>
            <div class="d-flex justify-content-center">
                {{$posts->links("pagination::bootstrap-4")}}
            </div>
        </div>
    </div>
@endsection