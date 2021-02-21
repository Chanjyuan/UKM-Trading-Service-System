@extends('layouts.apps')

@section('title')
    Change Password | UKM Trading & Service System
@endsection

@section('content')
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Change Password</h1>
            </div>
        </div>
    </div>
</section>    

<section class="login_box_area section_gap">
        <div class="container">
          @include('inc.messages')
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="{{asset('app-assets/img/password.jpg')}}" alt="">
                        <div class="hover">
                            <h4>Change your password</h4>
                            <p>frequently for better security!</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <form class="row login_form" action="{!! route('changepassword') !!}" method="POST" id="contactForm" novalidate="novalidate">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Current Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'New Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm New Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm New Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="primary-btn">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection