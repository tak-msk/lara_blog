@extends('backend.master')
@section('title')
	Edit - @parent
@stop
@section('content')
	<h1 class="page-header">Edit block</h1>
	
	{{ Form::open(array('action' => array('BlocksController@update', $block->id), 'class'=>'form-horizontal', 'role'=>'form', 'method'=>'PUT')) }}

	<!-- Title -->
	<div class="form-group has-feedback {{ $errors->has('title')?'has-error':''}}">
		<label class="control-label col-sm-2" for="title">title</label>
		<div class="col-sm-10">
			{{ Form::text('title', $block->title, array('class'=>'form-control', 'id'=>'title', 'placeholder'=>'Title')) }}
		@if($errors->first('title'))
			<span class="help-block">{{ $errors->first('title') }}</span>
		@endif
		</div>
	</div>

	<!-- Published -->
	<div class="form-group">
		<label class="control-label col-sm-2" for="is_published">published</label>
		<div class="col-sm-10">
			{{ Form::checkbox('is_published', 'is_published', $block->is_published, array('id'=>'is_published')) }}
		</div>
	</div>

	<!-- Type -->
	<div class="form-group">
		<label class="control-label col-sm-2" for="type">type</label>
		<div class="col-sm-10">
			{{ Form::radio('type', '0', $block->type ? false : true, array('id'=>'static', 'title'=>'Static tips')) }}
			{{ Form::label('static', 'static', array('title'=>'Static tips')) }}
			{{ Form::radio('type', '1', $block->type ? true : false, array('id'=>'dynamic', 'title'=>'Dynamic tips')) }}
			{{ Form::label('dynamic', 'dynamic', array('title'=>'Dynamic tips'))}}
		</div>
	</div>

	<!-- Dynamic -->
	<div id="divDynamic" class="form-group">
		<label class="control-label col-sm-2" for="module">Module</label>
		<div class="col-sm-10">
			{{-- */$module = $block->type ? preg_replace('/<("[^"]*"|\'[^\']*\'|[^\'">])*>/', '', $block->contents) : ''/* --}}
			{{ Form::select('module', $modules, $module, array('class' => 'form-control')) }}
		</div>
	</div>

	<!-- Static  -->
	<div id="divStatic" class="form-group has-feedback {{ $errors->has('value') ? 'has-error' : '' }}">
		<label class="control-label col-sm-2" for="contents">Value</label>
		<div class="col-sm-10">
			{{ Form::textarea('value', $block->value, array('class'=>'ckeditor form-control', 'id'=>'value', 'placeholder'=>'Value')) }}
		@if($errors->first('value'))
			<span class="help-block">{{ $errors->first('value') }}</span>
		@endif
		</div>
	</div>
	
	<!-- Form action-->
	{{ Form::submit('Save changes', array('class'=>'btn btn-success')) }}
	<a class="btn btn-default" href="{{ url('backend/blocks') }}">&nbsp;Cancel</a>
	{{ Form::close() }}
@stop

@section('script')
@parent
	{{ HTML::script('ckeditor/ckeditor.js') }}
	<script>
	$(function() {
		$('#title').focus();
		$('.form-group input, .form-group label').tooltip();
		if($('input[name=type]:checked').val() == '0') {
			$('#divDynamic').css('display', 'none');
		} else if($('input[name=type]:checked').val() == '1') {
			$('#divStatic').css('display', 'none');
		}
		$('input[name=type]').change(function() {
			if($('input[name=type]:checked').val() == '0') {
				$('#divDynamic').slideUp();
				$('#divStatic').slideDown();
			} else {
				$('#divDynamic').slideDown();
				$('#divStatic').slideUp();
			}
		});
		$('form').submit(function() {
			if($('input[name=type]:checked').val() == '1') {
				CKEDITOR.instances.contents.setData($('select[name=module]').val());
			}
		});
	});
	</script>
@stop
