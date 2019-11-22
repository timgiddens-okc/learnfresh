@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-3">
			
			 @if ($resource)
      	<div class="featured-resource">
      	<h5><strong>Featured Resource</strong></h5>
      	@if ($resource->video_embed)
      		<div class="embed-responsive embed-responsive-16by9">
						{!! $resource->video_embed !!}
					</div>
					<p>{{ $resource->title }}</p>
      	@else
      		<div class="list-group">
      		<a href="/resources/{{ $resource->id }}" class="list-group-item">
						<h5>{{ $resource->title }}</h5>
					</a>
      		</div>
      	@endif
      	</div>
      @endif
			
			<div class="row">
				<div class="col-sm-12">
					<a href="/week/{{ $week->id }}/edit" class="btn btn-primary expanded" style="margin-bottom: 10px;">Edit Week</a>
					<a href="/week/{{ $week->id }}/delete" class="btn btn-primary delete expanded" style="margin-bottom: 10px;">Delete Week</a>
					<a href="/program/{{ $week->program->id }}" class="btn btn-primary expanded">View Program</a>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-9">
			<div class="week-container">
	      <div class="panel panel-default weeks" id="program{{$week->id}}" style="background: url({{ ($app == "production") ? secure_asset($week->program->logo) : asset($week->program->logo) }}) right -20px bottom -40px no-repeat;">
	      	<div class="row">
	      		<div class="col-sm-12">
	      			<h4 class="text-center">Welcome to Week {{ $week->week_number }} of the NBA Math Hoops Season! Here is the tip of the week:</h4>
	          	<h2 class="text-center">{{ $week->title }}</h2>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-sm-12 col-md-5">
		          {!! $week->description !!}				          
	      		</div>
	      		<div class="col-sm-12 col-md-7">
	          	<div class="action-items">
	          		<div class="list-group">
	          		@foreach ($week->items as $item)
	          			<div class="list-group-item">
	          				{!! $item->text !!}<br>
	          				<a href="/week/{{ $week->id }}/item/{{ $item->id }}"><i class="fa fa-pencil"></i></a>
	          				<a href="/week/{{ $week->id }}/item/{{ $item->id }}/delete" class="delete"><i class="fa fa-minus-circle"></i></a>
	          			</div>
	          		@endforeach
	          		</div>
	          	</div>
	      		</div>
	      	</div>
	      </div>
			</div>
			
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
					<form action="/week/{{ $week->id }}/items" method="post">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="actionItem">Action Item Text</label>
							<textarea name="text" class="form-control"  id="actionItem" required></textarea>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success pull-right">Add Action Item</button>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection