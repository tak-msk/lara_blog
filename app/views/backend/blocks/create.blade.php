@extends('backend.master')
@section('title')
	Add block - @parent
@stop
@section('content')
	<h1 class="page-header">Add block</h1>

	{{ Form::open(array('action' => 'BlocksController@store', 'class' => 'form-horizontal', 'role' => 'form')) }}

	<!-- Title -->
	<div class="form-group has-feedback {{ $errors->has('title')?'has-error':'' }}">
		<label class="control-label col-sm-2" for="">Title</label>
		<div class="col-sm-10">
			{{ Form::text('title', null, array('class'=>'form-control', 'id'=>'title', 'placeholder'=>'Title')) }}
@if($errors->first('title'))
			<span class="help-block">{{ $errors->first('title') }}</span>
@endif
		</div>
	</div>

	<!-- Published -->
	<div class="form-group">
		<label class="control-label col-sm-2" for="">Published</label>
		<div class="col-sm-10">
			{{ Form::checkbox('is_published', 'is_published', null, array('id'=>'is_published')) }}
		</div>
	</div>

	<!-- Type -->
	<div class="form-group">
		<label class="control-label col-sm-2" for="type">Type</label>
		<div class="col-sm-10" id="sample">
			{{ Form::radio('type', '0', false, array('id'=>'static','title'=>'Static Tips')) }}
			{{ Form::label('static', 'static', array('title'=>'Static Tips')) }}
			{{ Form::radio('type', '1', false, array('id'=>'dynamic', 'title'=>'Dynamic Tips'))}}
			{{ Form::label('dynamic', 'dynamic', array('title'=>'Dynamic Tips')) }}
		</div>
	</div>

	<!-- Dynamic-->
	<div id="divDynamic" class="form-group">
		<label class="control-label col-sm-2" for="module">Module</label>
		<div class="col-sm-10">
			{{ Form::select('module', $modules, null, array('class'=>'form-control')) }}
		</div>
	</div>
	<!-- Static -->
	<div id="divStatic" class="form-group has-feedback">
		<label class="control-label col-sm-2" for="contents"></label>
		<div class="col-sm-10">
			{{ Form::textarea('contents', null, array('class'=>'ckeditor form-control', 'id'=>'contents', 'placeholder'=>'Contents')) }}
@if($errors->first('contents'))
			<span class="help-block">{{ $errors->first('contents') }}</span>
@endif
		</div>
	</div>

	<!-- Form actions -->
	{{ Form::submit('Save Changes', array('class'=>'btn btn-success')) }}
	<a href="{{ url('backend/blocks') }}" class="btn btn-default">&nbsp;Cancel</a>
	{{ Form::close() }}
@stop

@section('script')
@parent
	{{ HTML::script('ckeditor/ckeditor.js') }}
	<script>
		$(function() {
			$('.form-group input .form-group label').tooltip();
			if($('input[name=type]:checkd').val() == '0'){
				$('#divDynamic').css('display', 'none');
			} else if($('input[name=type]:checked').val() == '1') {
				$('#divStatic').css('display', 'none');
			} else {
				$('#divDynamic').css('display', 'none');
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
				if($('input[name=type]:checked').val() = '1') {
					CKEDITOR.instances.contents.setData($('select[name=module]').val());
				}
			});
		});
	</script>
@stop
