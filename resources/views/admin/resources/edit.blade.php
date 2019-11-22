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
						<a href="/resources/all" class="btn btn-primary">View All Resources</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						Edit Resource
					</div>
					<div class="panel-body">
						<form action="" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							{{ method_field('patch') }}
						
							<div class="form-group">
								<label for="resourceTitle">Resource Title</label>
								<input type="text" name="title" id="resourceTitle" class="form-control" value="{{ $resource->title }}" />
							</div>
							<div class="form-group">
								<label for="resourceDescription">Resource Description</label>
								<textarea name="description" class="form-control" id="resourceDescription">{{ $resource->description }}</textarea>
							</div>
							<div class="form-group">
								<label for="program">Program</label>
								<select name="program_id" id="program" class="form-control">
								@foreach ($programs as $program)
									<option value="{{ $program->id }}" {{ ($resource->program_id == $program->id) ? "selected" : "" }}>{{ $program->title }}</option>
								@endforeach
									<option value="0">Event Media</option>
								</select>
							</div>
							<div class="form-group">
								<label for="videoEmbed">Video Embed</label>
								<textarea name="video_embed" class="form-control embed" id="videoEmbed">{{ $resource->video_embed }}</textarea>
							</div>
							<div class="form-group">
								<label for="resourceDescription">Resource File</label>
								<input type="file" name="file" />
								@if($resource->file_location)
									<a href="{{ $resource->file_location }}" class="btn btn-primary btn-sm" style="margin-top:10px;" target="_blank">Download File</a>
								@endif
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