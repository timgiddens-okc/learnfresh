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
			<div class="col-sm-12 col-md-4">
				<div class="panel panel-default">
					<div class="panel-body">
					@if (Auth::user()->isAdmin())
						<a href="/admin/resources/{{ $resource->id }}/edit" class="btn btn-success expanded">Edit This Resource</a>
						<a href="/admin/resources/{{ $resource->id }}/delete" class="btn btn-success delete expanded download-list">Delete This Resource</a>
					@endif
						<a href="/resources/all" class="btn btn-primary expanded download-list">View All Resources</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>{{ $resource->title }}</h3>
					</div>
					<div class="panel-body">
						@if ($resource->video_embed)
							<div class="embed-responsive embed-responsive-16by9">
								{!! $resource->video_embed !!}
							</div>
						@endif
						<p>{!! $resource->description !!}</p>						
						@if ($resource->file_location)
						<a href="{{ $resource->file_location }}" target="_blank" class="btn btn-primary">Download Resource</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection