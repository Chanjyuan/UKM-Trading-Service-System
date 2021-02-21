@extends('layouts.master')

@section('title')
    Account List | UKM Trading & Service System
@endsection

@section('content')
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">List of Accounts</h4>
<!--                   <p class="card-category"> Here is a subtitle for this table</p> -->
                </div>
                <div class="card-body">
                  @if(count($profiles) > 0)
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Account ID
                        </th>
                        <th>
                          First Name
                        </th>
                        <th>
                          Last Name
                        </th>
                        <th>
                          Gender
                        </th>
                        <th>
                          Phone
                        </th>
                        <th>
                          E-mail
                        </th>
                        <th></th>
                        <th>
                          Actions
                        </th>
                      </thead>
                      <tbody>
                        @forelse($profiles as $profile)
                        <tr>
                            <td>{{$profile->id}}</td>
                            <td>{{$profile->fname}}</td>
                            <td>{{$profile->lname}}</td>
                            <td>{{$profile->gender}}</td>
                            <td>{{$profile->phone}}</td>
                            <td>{{$profile->email}}</td>
                            <td>  
                                <a href="/profile/{{ $profile->id }}" class="btn btn-outline-secondary pull-right">View</a>    
                            </td>
                            <td>
                                {!! Form::open(['action' => ['App\Http\Controllers\ProfilesController@destroy', $profile->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @empty
                            <li>No Account</li>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                  @endif
                </div>
                {{$profiles->links("pagination::bootstrap-4")}}
              </div>
            </div>
          </div>
        </div>
@endsection
