@extends('backend.master')
@section('title')
	Category list - @parent
@stop

@section('content')

	<h1 class="page-header">Category list</h1>
	{{ Notification::showAll() }}
	<div class="pull-left">
		<div class="btn-toolbar">
			<a class="btn btn-primary" href="{{URL::route('backend.categories.create')}}"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add category</a>
		</div>
	</div>
	<div style="clear:both"></div>
	@if($categories->count())
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Category</th>
						<th>Ceated at</th>
						<th>Updated at</th>
						<th>ID</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
			@foreach($categories as $category)
					<tr>
						<td><a href="{{URL::route('backend.categories.edit', array($category->id))}}">{{$category->category}}</a></td>
						<td>{{$category->created_at}}</td>
						<td>{{$category->updated_at}}</td>
						<td>{{$category->id}}</td>
						<td>
							<a data-toggle="modal" href="#myModal{{$category->id}}"><span class="glyphicon glyphicon-remove-circle" Title="Delete category"></span></a>
							<div id="myModal{{$category->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" area-hidden="true">&times;</button>
										</div>
										<div class="modal-body">
											<p><span class="text-danger lead">{{$category->category}}</span><br>Delete this category?</p>
										</div>
										<div class="modal-footer">
											{{Form::open(array('url'=>'backend/categories/'.$category->id, 'class'=>'pull-right'))}}
											{{Form::hidden('_method','DELETE')}}
											{{Form::button('Cancel', array('class'=>'btn btn-default', 'data-dismiss'=>'modal'))}}
											{{Form::submit('Delete', array('class'=>'btn btn-danger'))}}
											{{Form::close()}}
										</div>
									</div><!--/.modal-content-->
								</div><!--/.modal-dialog-->
							</div><!--/#myModal-->
						</td>
					</tr>
			@endforeach
				</tbody>
			</table>
		</div>
	@else
		<div class="alert alert-danger">Category is not found.</div>
	@endif
@stop
