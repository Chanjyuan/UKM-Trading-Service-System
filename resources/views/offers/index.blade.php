@extends('layouts.apps')

@section('title')
    Offers Received | UKM Trading & Service System
@endsection

@section('content')

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>List of Offers</h1>
                </div>
            </div>
        </div>
    </section>

<section class="cart_area">
<div class="container">
  @include('inc.messages')
    <div class="billing_details">
      <div class="row justify-content-center">
        <div class="col-lg-8">
        @if (count($offers) > 0)
            
            <ul class="list-group">
                @foreach ($offers as $offer)
                <div class="list-group-item align-items-center">
                    <div class="d-flex justify-content-start">
                        {{-- <h5>Original Post User: {{$offer->post->user->fname}} {{$offer->post->user->lname}}</h5> --}}
                        <h5><a href="/profile/{{ $offer->user_id }}">{{$offerby->find($offer->user_id)->fname}} {{$offerby->find($offer->user_id)->lname}}</a> offering <strong>{{$offer->price}}</strong></h5>
                    </div>
                    @if ($offer->status == null)
                        <a href="/offers/{{$offer->id}}/approve" class="genric-btn success radius">Approve</a>
                        <a href="/offers/{{$offer->id}}/reject" class="genric-btn danger radius">Reject</a>
                    @else
                        @if ($offer->status == "Approved")
                            <strong class="text-success">Approved</strong>
                        @else
                            <strong class="text-danger">Rejected</strong>
                        @endif                  
                    @endif
                    <small class="float-right">{{ \Carbon\Carbon::parse($offer->created_at)->diffForHumans() }}</small>
                </div>
                @endforeach
            </ul>

        {{-- {{$offers->links()}} --}}
    @else
        <p style="text-align: center">No offers found</p>
    @endif
    </div>
</div>
</div>
</div>
</section>

@endsection

@section('scripts')
@endsection