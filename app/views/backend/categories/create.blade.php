@extends('backend.master')
@section('title')
	{{ Lang::get('backend.add_category') }} - @parent
@stop

@section('content')
	<h1 class="page-header">Add category</h1>

	{{ Form::open(array('action' => 'CategoriesController@store', 'class' => 'form-horizontal', 'role' => 'form'))}}

	<!-- Category -->
	<div class="form-group has-feedback {{ $errors->has('category')?'has-error':''}}">
		<label class="cotrol-label col-sm-2" for="category">Category</label>
		<div class="col-sm-10">
			{{ Form::text('category', null, array('class'=>'form-control', 'id'=>'category', 'placeholder'=>'Category', 'value'=>Input::old('category'))) }}
		@if ($errors->first('category'))
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span class="help-block"></span>
		@endif
		</div>
	</div>

	<!-- Form actions -->
	{{ Form::submit('Save', array('class'=>'btn btn-success'))}}
	<a href="{{ url('backend/categories') }}" class="btn btn-default">&nbsp;Cancel</a>
	{{ Form::close() }}
@stop
