@extends('backend.master')
@section('title')
	Edit article - @parent
@stop
@section('content')
	<h1 class="page-header">Edit an article</h1>
	{{ Form::open(array('action'=>array('ArticlesController@update',$article->id),'class'=>'form-horizontal','role'=>'form','method'=>'PUT')) }}
	<!-- Title -->
	<div class="form-group has-feedback">
		<label class="control-label col-sm-2" for="title">Title</label>
		<div class="col-sm-10">
			{{ Form::text('title',$article->title, array('class'=>'form-control','id'=>'title','placeholder'=>'Title'))}}
		@if ($errors->first('title'))
			<span class="help-block">{{ $errors->first('title') }}</span>
		@endif
		</div>
	</div>
	<!--Published-->
	<div class="form-group">
		<label class="control-label col-sm-2" for="is_published">Published</label>
		<div class="col-sm-10">
		{{ Form::checkbox('is_published','is_published',$article->is_published, array('id'=>'is_published')) }}
		</div>
	</div>
	<!--Category-->
	<div class="form-group has-feedback {{ $errors->has('category_id')?'has-error':'' }}">
		<label class="control col-sm-2" for="category_id">Category</label>
		<div class="col-sm-10">
			{{ Form::select('category_id',array('default'=>'Please Select')+$categories, $article->category_id, array('class'=>'form-control')) }}
		</div>
	</div>
	<!--Content-->
	<div class="form-group has-feedback {{ $errors->has('content')?'has-error':''}}">
		<label class="control-label col-sm-2" for="content">Content</label>
		<div class="col-sm-10">
			{{ Form::textarea('content',$article->content, array('class'=>'ckeditor form-control','id'=>'content','placeholder'=>'記事内容')) }}
		@if($errors->first('content'))
			<span class="help-block">{{ $errors->first('content') }}</span>
		@endif
		</div>
	</div>
	<!--Form actions--!>
	{{ Form::submit('Save Changes', array('class'=>'btn btn-success')) }}
	<a class="btn btn-default" href="{{ url('backend/articles') }}">&nbsp;Cancel</a>
	{{ Form::close() }}
@stop
@section('script')
@parent
{{HTML::script('ckeditor/ckeditor.js')}}
@stop
