@extends('layouts.app')
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>Community</h2>
			<a href="/community" class="btn btn-primary btn-sm"><i class="fa fa-long-arrow-left"></i> View All Posts</a>
			@if($topic->category)
			<a href="/community/category/{{ $topic->category }}" class="btn btn-primary btn-sm">View More Posts In This Category</a>
			@endif
		</div>
		<div class="row">
			<div class="col-sm-12">
				@foreach (['danger', 'warning', 'success', 'info'] as $msg)
		      @if(Session::has('alert-' . $msg))
		      <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
		      @endif
		    @endforeach
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-8">
				<div class="panel panel-default">
					<div class="panel-body">
						<?php
							$postUser = \App\User::find($topic->user_id);
						?>
						<h4>{{ $topic->title }}</h4>
						
						<h6>Posted {{ $topic->created_at->setTimezone('America/Chicago')->diffForHumans() }} by {{ $postUser['name'] }} <span style="margin: 0px 5px;">|</span> 
						@if (\Auth::user()->isAdmin())
							<a href="/admin/{{ $postUser['id'] }}/email">{{ $postUser['email'] }}</a> 
						@else
							{{ $postUser['email'] }}
						@endif
							
						<span style="margin: 0px 5px;">|</span> <a href="/community/category/{{ $topic->category }}">{{ ucwords(str_replace("-"," ", $topic->category)) }}</a></h6>
					</div>
				</div>
				@if (!count($topic->comments))
					<div class="panel panel-default">
						<div class="panel-body">
							<p>No comments!</p>
						</div>
					</div>
				@else
					@foreach ($comments as $comment)
						<div class="panel panel-default">
							<div class="panel-heading">
								{{ App\User::find($comment->user_id)['name'] }} posted {{ $comment->created_at->setTimezone('America/Chicago')->diffForHumans() }}:
								<div class="pull-right">
									@if ($comment->user_id == Auth::user()->id)
										<a href="/community/{{ $topic->slug }}/comment/{{ $comment->id }}/edit" class="edit"><i class="fa fa-pencil-square-o"></i></a>
									@endif
									@if ($comment->user_id == Auth::user()->id || Auth::user()->isAdmin())
										<a href="/community/{{ $topic->slug }}/comment/{{ $comment->id }}/delete" class="delete"><i class="fa fa-minus-circle"></i></a>
									@endif
								</div>
							</div>
							<div class="panel-body">
								<p>{!! $comment->comment !!}</p>
								@if(count($comment->files) > 0)								
								<div class="files">
								<h5>Files</h5>
									<div class="row">
									@foreach($comment->files as $file)
									<div class="col-xs-6 col-sm-3 col-md-2">
										@if($file->file_extension == "jpg" || $file->file_extension == "jpeg" || $file->file_extension == "png" || $file->file_extension == "gif")
										<a href="{{ ($app == "production") ? secure_asset($file->url) : asset($file->url) }}" rel="shadowbox" class="file-preview file-background"></a>
										@else
										<a href="{{ ($app == "production") ? secure_asset($file->url) : asset($file->url) }}" target="_blank" class="file-preview file-background"></a>
										@endif
										@if($comment->user_id == \Auth::user()->id)
										<a href="/comment-file/{{ $file->id }}/delete" class="delete"><i class="fa fa-minus-circle"></i></a>
										@endif
									</div>
									@endforeach
									</div>
								</div>
								@endif
							</div>
						</div>
					@endforeach
					<div class="row">
  					<div class="col-sm-12">
    					{{ $comments->links() }}
  					</div>
					</div>
				@endif
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						Post New Comment
					</div>
					<div class="panel-body">
						@if (count($errors))
							<div class="alert alert-danger">
							<strong>Uh oh!</strong>
							@foreach ($errors->all() as $error)
								<br>{{ $error }}
							@endforeach
							</div>
						@endif
						<form action="/community/{{ $topic->slug }}/comment" method="post" accept-charset="utf-8" enctype="multipart/form-data">
							{{ csrf_field() }}
						
							<div class="form-group">
								<label for="topicTitle">Comment</label>
								<textarea name="comment" class="form-control">{{ old('comment') }}</textarea>
							</div>
							<div class="form-group">
								<label for="files">Upload File(s)</label><br>
								<input type="file" name="files[]" multiple />
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success pull-right show-spinner">Add Comment</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection