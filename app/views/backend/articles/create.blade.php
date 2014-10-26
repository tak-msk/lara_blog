@extends('backend.master')
@section('title')
	Create aarticle - @parent
@stop
@section('content')
	<h1 class="page-header">Create an article</h1>
	{{ Form::open(array('action'=>'ArticlesController@store','class'=>'form-horizontal', 'role'=>'form'))}}
	<!--Title-->
	<div class="form-group has-feedback {{ $errors->has('title')?'has-error':''}}">
		<label class="control-label col-sm-2" for="title">Title</label>
		<div class="col-sm-10">
			{{ Form::text('title', null, array('class'=>'form-control','id'=>'title','placeholder'=>'Title'))}}
		@if($errors->first('title'))
			<span class="help-block">{{ $errors->first('title') }}</span>
		@endif
		</div>
	</div>
	<!-- Published -->
	<div class="form-group">
		<label class="control-label col-sm-2">Published</label>
		<div class="col-sm-10">
		{{ Form::checkbox('is_published', 'is_published', null, array('id'=>'is_published'))}}
		</div>
	</div>
	<!-- Category -->
	<div class="form-group has-feedback {{ $errors->has('category_id')?'has-error':''}}">
		<label class="control-label col-sm-2" for="category_id">Category</label>
		<div class="col-sm-10">
			{{ Form::select('category_id', array('default'=>'Please Select')+$categories, null, array('class'=>'form-control')) }}
		</div>
	</div>
	<!-- Content -->
	<div class="form-group has-feedback {{ $errors->has('content')?'has-error':''}}">
		<label class="control-label col-sm-2" for="content"></label>
		<div class="col-sm-10">
		{{ Form::textarea('content',null,array('class'=>'ckeditor form-control','id'=>'content','placeholder'=>'Content')) }}
		@if($errors->first('content'))
			<span class="help-block">{{ $errors->first('content') }}</span>
		@endif
		</div>
	</div>
	<!-- Form actions -->
	{{ Form::submit('Save Changes', array('class'=>'btn btn-success')) }}
	<a class="btn btn-default" href="{{ url('backend/articles') }}">&nbsp;Cancel</a>
	{{ Form::close() }}
@stop
@section('script')
@parent
{{ HTML::script('ckeditor/ckeditor.js') }}
@stop
