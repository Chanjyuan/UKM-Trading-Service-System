@extends('layouts.apps')

@section('title')
    My Offers | UKM Trading & Service System
@endsection

@section('content')

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>My Offers</h1>
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
    @if(!Auth::guest() && Auth::user()->id == $user_id)
        @if (count($offers) > 0)
                <ul class="list-group">
                    @foreach ($offers as $offer)
                    <div class="list-group-item">
                        @if(Auth::user()->id == $offer->user_id)
                            {!! Form::open(['action' => ['App\Http\Controllers\OffersController@destroy', $offer->post->id, $offer->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Remove', ['class' => 'genric-btn danger radius'])}}
                            {!! Form::close() !!}
                        @endif
                        <h5>You are offering <strong>{{$offer->price}}</strong> for <a href="/posts/{{$offer->post->id}}">{{$offer->post->title}}</a> <small>{{ \Carbon\Carbon::parse($offer->created_at)->diffForHumans() }}</small></h5>
                        @if ($offer->status == "Approved")
                            <strong class="text-success">Approved</strong>
                        @elseif ($offer->status == "Rejected")
                            <strong class="text-danger">Rejected</strong>
                        @endif
                    </div>
                    @endforeach
                </ul>
            {{-- {{$offers->links()}} --}}
        @else
            <p style="text-align: center">No offers found</p>
        @endif
    @else 
    You are not authorized to this
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
@section('scripts')
@endsection