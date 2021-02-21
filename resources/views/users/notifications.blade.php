@extends('layouts.apps')

@section('title')
    Pending Offers | UKM Trading & Service System
@endsection

@section('content')

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Pending Offers</h1>
                </div>
            </div>
        </div>
    </section>


<section class="cart_area">
<div class="container">
  @include('inc.messages')
    <div class="billing_details">
      <div class="row justify-content-center">
        <div class="col-lg-12">
            @if (count($notifications) > 0)
            <ul class="list-group">
                @foreach ($notifications as $notification)
                <div class="list-group-item">
                    @if ($notification->type == 'App\Notifications\NewOfferAdded')
                        <a href="/profile/{{$notification->data['offerby']['id']}}" style="font-size: 16px;">{{$notification->data['offerby']['fname']}} {{$notification->data['offerby']['lname']}}</a> sends you an offer
                        <strong style="font-size: 16px;">{{ $notification->data['offer']['price'] }} <i class="fa fa-exchange" aria-hidden="true"></i> {{$notification->data['post']['title']}}</strong>
                        <small>{{ \Carbon\Carbon::parse($notification->data['offer']['created_at'])->diffForHumans() }}</small>
                        <a href="/posts/{{$notification->data['post']['id']}}/offers" class="genric-btn info radius float-right">
                            View Offer
                        </a>
                        <a href="/posts/{{$notification->data['post']['id']}}" class="genric-btn primary radius float-right">
                            View Post
                        </a>
                    @endif
                </div>
                @endforeach
            </ul>
            @else
                <p style="text-align: center">No pending offers</p>
            @endif
        </div>
    </div>
</div>
</div>
</section>

        <nav class="blog-pagination justify-content-center d-flex">
            {{$notifications->links("pagination::bootstrap-4")}}
        </nav>
@endsection
@section('scripts')
@endsection