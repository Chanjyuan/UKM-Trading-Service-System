@extends('layouts.master')

@section('title')
    Edit Account | UKM Trading & Service System
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Edit Account</h4>
<!--                   <p class="card-category">Complete your profile</p> -->
                </div>
                <div class="card-body">
                    <form action="/accounts/{{ $profiles->id }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="fname" class="bmd-label-floating">First Name</label>
                            <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') ?? $profiles->fname}}" required autocomplete="fname" autofocus>

                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="lname" class="bmd-label-floating">Last Name</label>
                            <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') ?? $profiles->lname}}" required autocomplete="lname" autofocus>

                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender" class="bmd-label-floating">Gender</label>
                                {{Form::select('gender', ['' => 'Select Gender', 'Male' => 'Male', 'Female' => 'Female'], $profiles->gender, ['class' => 'form-control'])}}

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
 

                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone" class="bmd-label-floating">Contact No.</label>
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $profiles->phone}}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                    <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="/profile/{{$profiles->id}}">
                    <img class="img" src="/storage/uploads/{{ $profiles->image }}" />
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category text-gray">{{__('Joined ') }}{{ $profiles->created_at->diffForHumans() }}</h6>
                  <h4 class="card-title">{{$profiles->fname}} {{$profiles->lname}}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
