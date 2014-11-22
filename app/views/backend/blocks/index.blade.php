@extends('backend.master')
@section('title')
	Blocks - @parent
@stop

@section('content')
	<h1 class="page-header">Blocks</h1>
	{{ Notification::showAll() }}
	<div class="pull-left">
		<div class="btn-toolbar">
			<a class="btn btn-primary" href="{{ URL::route('backend.blocks.create') }}"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add block</a>
		</div>
	</div>
	<div style="clear:both"></div>
@if($blocks->count())
	<div class="table-responsive">
		<table id="sortable-table" class="table table-striped">
			<thead>
				<tr>
					<th>
						<a href="#myModalSort" data-toggle="modal"><span class="glyphicon glyphicon-save" Title='Save changes'></span></a>
						<div id="myModalSort" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h3 class="modal-title">Save order</h3>
									</div>
									<div class="modal-body">
										<p>Save order prompt</p>
									</div>
									<div class="modal-footer">
										{{ Form::open(array('url' => 'backend/blocks/sort', 'id' => 'formSort', 'class' => 'pull-right')) }}
										{{ Form::hidden('result', '', array('id' => 'result')) }}
										{{ Form::button('Cancel', array('class' => 'btn btn-default', 'data-dismiss' => 'modal'))}}
										{{ Form::submit('Save Changes', array('id' => 'submit', 'class' => 'btn btn-success'))}}
										{{ Form::close() }}
									</div>
								</div>
							</div>
						</div>
					</th>
					<th>Title</th>
					<th>Published</th>
					<th>Type</th>
					<th>Created at</th>
					<th>Updated at</th>
					<th>ID</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
@foreach($blocks as $block)
				<tr id="{{ $block->id }}">
					<td><span class="glyphicon glyphicon-sort" Title='Sort tips'></span></td>
					<td><a href="{{ URL::route('backend.blocks.edit', array($block->id)) }}">{{ $block->title }}</a></td>
					<td>{{ ($block->is_published)? 'yes' : 'no' }}</td>
					<td>{{ ($block->type)? 'module' : 'content' }}</td>
					<td>{{ ($block->created_at) }}</td>
					<td>{{ ($block->updateed_at) }}</td>
					<td>{{ ($block->id) }}</td>
					<td>
						<a href="#myModal{{$block->id}}" data-toggle="modal"><span class="glyphicon glyphicon-remove-circle" Title="Delete block"></span></a>
						<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModallabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<p><span class="text-danger lead">{{ $block->title }}</span><br>Delete Promt</p>
									</div>
									<div class="modal-footer">
										{{ Form::open(array('url' => 'backend/blocks'.$block->id, 'class' => 'pull-right')) }}
										{{ Form::hidden('_method', 'DELETE') }}
										{{ Form::button('Cancel', array('class' => 'btn btn-default', 'data-dismiss' => 'modal'))}}
										{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
										{{ Form::close() }}
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
@endforeach
			</tbody>
		</table>
	</div>
@else
	<div class="alert alert-danger">A block was not found</div>
@endif
@stop

@section('script')
@parent
	{{ HTML::script('asset/js/jquery-ui.min.js') }}
	<script type="text/javascript">
		$('span.glyphicon').tooltip();
		$(function(){
			// notification slide-up out
			setTimeout(function(){
				$('.alert').slideUp();
			},3000);
			// sort order of block
			$('#sortable-table tbody').sortable();
			$('#submit').click(function(){
				var result = $('#sortable-table tbody').sortable('toArray');
				$('#result').val(result);
				$('#formSort').submit();
			});
		});
	</script>
@stop
