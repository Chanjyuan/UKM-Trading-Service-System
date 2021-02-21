@extends('layouts.master')

@section('title')
    Posts List | UKM Trading & Service System
@endsection

@section('content')
   <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">List of Product/Services</h4>
<!--                   <p class="card-category"> Here is a subtitle for this table</p> -->
                </div>
                <div class="card-body">
                  @if(count($posts) > 0)
                  <div class="container">
                    <ul class="list-group">
                    @foreach ($posts as $post)
                    <div class="row">
                      <div class="col-sm-4" align="center">
                        <br>
                        <img width="70%" class="rounded mx-auto d-block" src="/storage/post_images/{{$post->cover_image}}">
                        <br>
                      </div>
                      <div class="col-sm-8">
                        <ul class="list-group">
                          <br>
                          <li class="list-group-item">
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a> 
                              @if ($post->status == "Available")<h6 class="text-success">{{$post->status}}</h6>
                              @elseif ($post->status == "Pending") <h6 class="text-warning">{{$post->status}}</h6>
                              @else <h6 class="text-danger">{{$post->status}}</h6>
                              @endif
                            </h3>
                          </li>
                          <li class="list-group-item">
                            <p>{{$post->description}}</p>
                          </li>
                        </ul>
                        <br>
                      </div>
                    <hr>
                  </div>
                  @endforeach
                </ul>
                </div>
              </div>
              {{$posts->links("pagination::bootstrap-4")}}
              @else
                <p>No posts found</p>
              @endif
            </div>
          </div>
        </div>
      </div>
@endsection
@section('scripts')
@endsection