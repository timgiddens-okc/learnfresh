@extends("layouts.app")
	
@section("content")
<div class="container">
	
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
		<div class="col-sm-12 col-md-5">
			<div class="page-header">
				<div class="program-logo">
				@if($program->logo)
					<img src="{{ ($app == "production") ? secure_asset($program->logo) : asset($program->logo) }}" />
				@endif
				</div>
				<h1>{{ $program->title }}</h1>
			</div>
			<p>{!! $program->description !!}</p>
			
			
			
			<div class="row">
				<div class="col-sm-12">
					<a href="/program/{{ $program->id }}/edit" class="btn btn-primary">Edit Program</a>
					<a href="/program/{{ $program->id }}/delete" class="btn btn-primary delete">Delete Program</a>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-7">
			<div class="page-header">
				<h4>Weeks</h4>
			</div>
			@if (!count($program->weeks))
			<p>There are no weeks for this program!</p>
			@else
			<div class="list-group">
				@foreach ($program->weeks as $week)
					<a href="/week/{{ $week->id }}" class="list-group-item">
						{{ $week->title }}
					</a>
				@endforeach
			</div>
			@endif
			<div class="row">
				<div class="col-sm-12">
					<hr>
					@if (count($errors))
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					@endif
					<form action="/program/{{ $program->id }}/week" method="post" class="form-horizontal">
						{{ csrf_field() }}
						<div class="form-group">
							<div class="col-sm-12 col-md-6">
								<label for="weekNumber">Week Number</label>
								<input type="number" name="week_number" class="form-control" id="weekNumber" required>
							</div>
							<div class="col-sm-12 col-md-6">
								<label for="weekTitle">Week Title</label>
								<input type="text" name="title" class="form-control" id="weekTitle">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<label for="weekDescription">Week Description</label>
								<textarea name="description" class="form-control" id="weekDescription"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<label>Featured Resource</label><br>
								<select name="featured_resource" class="form-control">
									<option value="null">No Featured Resource</option>
									@foreach ($resources as $resource)
										<option value="{{ $resource->id }}">{{ $resource->title }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-success pull-right">Add New Week</button>
							</div>
						</div>
					</form>				
				</div>
			</div>
		</div>
	</div>
</div>
@endsection