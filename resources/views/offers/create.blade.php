@extends('layouts.apps')

@section('title')
    Create Offer | UKM Trading & Service System
@endsection

@section('content')

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Create Offer</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="tracking_box_area section_gap">
        <div class="container">
            <div class="tracking_box_inner">

    {!! Form::open(['action' => ['App\Http\Controllers\OffersController@store', $post_id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('offer', 'Please enter your Price or Product that you want to trade with')}}
            {{Form::text('offer', '', ['class' => 'form-control', 'placeholder' => 'RM 0.00/T-shirt'])}}
        </div>
        <div class="form-group">
         	<button type="submit" value="submit" class="btn primary-btn">Submit</button>
        </div>
    {!! Form::close() !!}
</div>
</div>
</section>
@endsection

@section('scripts')
@endsection