@extends('layouts.master')

@section('title')
    Edit Category | UKM Trading & Service System
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0">Edit Category</h4>
<!--                   <p class="card-category"> Here is a subtitle for this table</p> -->
                </div>
                <br>
                <div class="card-body">
                    {!! Form::open(['action' => ['App\Http\Controllers\CategoriesController@update', $categories->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('name', 'New category name:')}}
                    {{Form::text('name', $categories->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
                </div>
                
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
</div>
</div>
@endsection
