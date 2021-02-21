@extends('layouts.apps')

@section('title')
    Edit Profile | UKM Trading & Service System
@endsection

@section('content')
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Edit Profile</h1>
            </div>
        </div>
    </div>
</section>

        <div class="container">
            @include('inc.messages')
            <div class="billing_details">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="container text-center">
                        <h3 class="pt-3 pb-1">Profile Information</h3></div>
                        <form class="row tracking_form" action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post" novalidate="novalidate">
                            @csrf
                            @method('PATCH')
                            <div class="col-md-6 form-group p_star">
                                <label for="fname" class="col-md-6 col-form-label" style="font-weight: bold;">{{ __('First Name') }}</label>
                                <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') ?? $user->fname}}" id="fname" required autocomplete="fname" autofocus>
                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <label for="lname" class="col-md-6 col-form-label" style="font-weight: bold;">{{ __('Last Name') }}</label>
                                <input type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') ?? $user->lname}}" id="lname" required autocomplete="lname" autofocus>
                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group p_star">
                            <label for="gender" class="col-md-12 col-form-label" style="font-weight: bold;">{{ __('Gender') }}</label>
                                {{Form::select('gender', ['' => 'Select Gender', 'Male' => 'Male', 'Female' => 'Female'], $user->gender, ['class' => 'form-control'])}}

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <label for="phone" class="col-md-6 col-form-label" style="font-weight: bold;">{{ __('Contact No.') }}</label>
                                <input id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $user->phone}}" id="phone" required autocomplete="phone" autofocus>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <label for="email" class="col-md-6 col-form-label" style="font-weight: bold;">{{ __('E-mail Address') }}</label>
                                <input id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email}}" id="email" required autocomplete="phone" readonly="true">
                            </div>

                            <div class="col-md-6 form-group p_star">
                                <label for="image" class="col-md-6 col-form-label" style="font-weight: bold;">{{ __('Profile Image') }}</label>
                                <input type="file" id="image" name="image">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group p_star pt-3">
                                <button type="submit" value="submit" class="primary-btn" style="float: right;">Save Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
@endsection