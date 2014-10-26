@extends('backend.master')
@section('title')
	Edit Category - @parent
@stop

@section('content')
	<h1 class="page-header">Edit Category</h1>

	{{ Form::open(array('action'=>array('CategoriesController@update', $category->id), 'class'=>'form-horizontal', 'role'=>'form', 'method'=>'PUT')) }}

	<!-- Category -->
	<div class="form-group has-feedback">
		<label class="control-label col-sm-2" for="category"></label>
		<div class="col-sm-10">
			{{ Form::text('category', $category->category, array('class'=>'form-control', 'id'=>'category', 'placeholder'=>'Category', 'value'=>Input::old('category'))) }}
		@if ($errors->first('category'))
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span class="help-block"></span>
		@endif
		</div>
	</div>

	<!-- Form actions -->
	{{ Form::submit('Save change', array('class'=>'btn btn-success')) }}
	<a class="btn btn-default" href="{{ url('backend/categories')}}">&nbsp;Cancel</a>
	{{ Form::close() }}
@stop
