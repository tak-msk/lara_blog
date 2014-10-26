@extends('backend.master')
@section('title')
	article - @parent
@stop
@section('content')
	<h1 class="page-header">Articles</h1>
	{{Notification::showAll()}}
	<div class="pull-left">
		<div class="btn-toolbar">
			<a class="btn btn-primary" href="{{URL::route('backend.articles.create')}}"><span class="glyphicon glyphicon-plus"></span>&nbsp;New Post</a>
		</div>
	</div><!-- /.page-header -->
	<div style="clear:both"></div>
@if($articles->count())
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Title</th>
					<th>Open</th>
					<th>Category</th>
					<th>Created</th>
					<th>Updated</th>
					<th>ID</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
@foreach($articles as $article)
			<div id="myModal{{$article->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3 class="modal-title">Delete post</h3>
						</div><!-- /.modal-header -->
						<div class="modal-body">
							<p><span class="text-danger lead">{{$article->title}}</span>
							 will be deleted, and not be able to return.<br>Are you sure?</p>
						</div><!-- /.modal-body -->
						<div class="modal-footer">
							{{Form::open(array('url'=>'backend/articles/' . $article->id, 'class'=>'pull-right'))}}
							{{Form::hidden('_method','DELETE')}}
							{{Form::button('Cancel', array('class'=>'btn btn-default', 'data-dismiss'=>'modal'))}}
							{{Form::submit('Delete', array('class'=>'btn btn-danger'))}}
							{{Form::close()}}
						</div><!-- /.modal-footer -->
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /#myModal.modal fade -->
			<tr>
				<td><a href="{{URL::route('backend.articles.edit', array($article->id))}}">{{$article->title}}</a></td>
				<td>{{($article->is_published)?'Open':'Closed'}}</td>
				<td><!-- Category --></td>
				<td>{{$article->created_at}}</td>
				<td>{{$article->updated_at}}</td>
				<td>{{$article->id}}</td>
				<td><a data-toggle="modal" href="#myModal{{$article->id}}"><span class="glyphicon glyphicon-remove-circle" Title="Delete Article"></span></a></td>
			</tr>
@endforeach
			</tbody>
		</table>
	</div>
	{{$articles->links()}}
@else
	<div class="alert alert-danger">No results found</div>
@endif
@stop
@section('script')
@parent
	<script type="text/javascript">
		$(document).ready(function() {
			setTimeout(function() {
				$('.alert').slideUp();
			}, 3000);
		});
	</script>
@stop
