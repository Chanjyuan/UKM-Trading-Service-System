@extends('layouts.master')

@section('title')
    Category List | UKM Trading & Service System
@endsection

@section('content')
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">List of Categories</h4>
<!--                   <p class="card-category"> Here is a subtitle for this table</p> -->
                </div>
                <div class="card-body">
                  @if(count($categories) > 0)
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Category ID
                        </th>
                        <th>
                          Category Name
                        </th>
                        <th></th>
                        <th>
                          Actions
                        </th>
                      </thead>
                      <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>
                                <a href="/{{ $category->id }}/editcategory" class="btn btn-outline-secondary pull-right">Edit</a>
                            </td>
                            <td>
                                {!! Form::open(['action' => ['App\Http\Controllers\CategoriesController@destroy', $category->id], 'method' => 'POST']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Remove', ['class' => 'btn btn-danger'])}}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @empty
                            <li>No Category</li>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                  @endif
                </div>
                {{$categories->links("pagination::bootstrap-4")}}
            </div>
        </div>

        <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0">Create New Category</h4>
<!--                   <p class="card-category"> Here is a subtitle for this table</p> -->
                </div>
                <div class="card-body">
        <form action="{{route('categories.store')}}" method="post" role="form">
            {{csrf_field()}}
            <div class="form-group">
                <input type="text" class="form-control" name="name" id="name" placeholder="Category name">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
