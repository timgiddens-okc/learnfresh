@extends("layouts.app")
	
@section("content")
	
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-header">
					<h1>Resources</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Resources
					</div>
					<div class="panel-body">
						@if (count($resources))
						<div class="list-group resource-list">
							@foreach ($resources as $resource)
								<a href="/resources/{{ $resource->id }}" class="list-group-item">
									<h5>{{ $resource->title }}</h5>
									
									<small>{!! nl2br($resource->description) !!}</small>
								</a>
							@endforeach
						</div>
						<a href="/admin/resources/sort" class="btn btn-primary expanded" style="margin-bottom: 10px;">Sort Resources</a>
						<a href="/resources/all" class="btn btn-primary expanded">View All Resources</a>
						@else
							<p>No resources!</p>
						@endif
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="row">
					<div class="col-sm-12">
						@foreach (['danger', 'warning', 'success', 'info'] as $msg)
				      @if(Session::has('alert-' . $msg))
				      <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
				      @endif
				    @endforeach
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						Add New Resource
					</div>
					<div class="panel-body">
						<form action="/admin/resources/new" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
						
							<div class="form-group">
								<label for="resourceTitle">Resource Title</label>
								<input type="text" name="title" id="resourceTitle" class="form-control" value="{{ old('title') }}" />
							</div>
							<div class="form-group">
								<label for="resourceDescription">Resource Description</label>
								<textarea name="description" class="form-control" id="resourceDescription">{{ old('description') }}</textarea>
							</div>
							<div class="form-group">
								<label for="program">Program</label>
								<select name="program" id="program" class="form-control">
								@foreach ($programs as $program)
									<option value="{{ $program->id }}">{{ $program->title }}</option>
								@endforeach
									<option value="0">Event Media</option>
								</select>
							</div>
							<div class="form-group">
								<label for="videoEmbed">Video Embed</label>
								<textarea name="video_embed" class="form-control embed" id="videoEmbed">{{ old('video_embed') }}</textarea>
							</div>
							
							<div class="form-group">
								<label for="resourceDescription">Resource File</label>
								<input type="file" name="file" />
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-success pull-right" value="Add Resource" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection