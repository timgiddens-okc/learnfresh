@extends('layouts.app')
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>Resources</h2>
		</div>
		@if(in_array(1, explode(",", \Auth::user()->programs)))
		<div class="row">
			<div class="col-xs-12">
				<a href="http://www.nbamathhoops.org/shotclock" target="_blank" class="shotclock">
					<div class="shotclock-border">
						<div class="row">
							<div class="col-xs-12 text-center">
								<img src="{{ ($app == "production") ? secure_asset('images/nba-math-hoops-white.png') : asset('images/nba-math-hoops-white.png') }}" />
								<h2>Click to try the NBA Math Hoops Shot Clock!</h2>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		@endif
		<div class="panel panel-default">
			<div class="panel-heading">
				Video Tutorials
			</div>
			<div class="panel-body">
				<div class="row resources">
					<?php $count = 0; ?>
					@foreach ($resources as $resource)
						@if ($resource->video_embed != "")
							<div class="col-sm-12 col-md-4">
								<div class="panel panel-default">
									<div class="panel-heading">
										<div class="resource-logo">
											@if($resource->program->logo)
											<img src="{{ ($app == "production") ? secure_asset($resource->program->logo) : asset($resource->program->logo) }}" />
											@endif
										</div>
										{{ $resource->title }}
									</div>
									<div class="panel-body">
										<div class="embed-responsive embed-responsive-16by9">
										{!! $resource->video_embed !!}
										</div>
										<a href="/resources/{{ $resource->id }}" class="btn btn-primary expanded">Learn More</a>
									</div>
								</div>
							</div>
						@endif
						<?php 
							$count++;
							if ($count == 3){ 
								$count = 0;
								echo "</div><div class='row resources'>";
							}							
						?>
					@endforeach
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				Downloadable Resources
			</div>
			<div class="panel-body">
				<div class="row resources">
					<?php $count = 0; ?>
					@foreach ($resources as $resource)
						@if ($resource->video_embed == "")
							<div class="col-sm-12 col-md-4">
								<div class="panel panel-info">
									<div class="panel-heading">
										<div class="resource-logo">
											@if($resource->program->logo)
											<img src="{{ ($app == "production") ? secure_asset($resource->program->logo) : asset($resource->program->logo) }}" />
											@endif
										</div>
										{{ $resource->title }}
									</div>
									<div class="panel-body">
										<a href="/resources/{{ $resource->id }}" class="btn btn-success expanded">Learn More</a>
									</div>
								</div>
							</div>
						@endif
						<?php 
							$count++;
							if ($count == 3){ 
								$count = 0;
								echo "</div><div class='row resources'>";
							}							
						?>
					@endforeach
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				Event Media
			</div>
			<div class="panel-body">
				<div class="row resources">
					<?php $count = 0; ?>
					@foreach ($eventMedia as $resource)
						@if ($resource->video_embed != "")
							<div class="col-sm-12 col-md-4">
								<div class="panel panel-default">
									<div class="panel-heading">
										{{ $resource->title }}
									</div>
									<div class="panel-body">
										<div class="embed-responsive embed-responsive-16by9">
										{!! $resource->video_embed !!}
										</div>
										<a href="/resources/{{ $resource->id }}" class="btn btn-primary expanded">Learn More</a>
									</div>
								</div>
							</div>
						@else
							<div class="col-sm-12 col-md-4">
								<div class="panel panel-info">
									<div class="panel-heading">
										{{ $resource->title }}
									</div>
									<div class="panel-body">
										<a href="/resources/{{ $resource->id }}" class="btn btn-success expanded">Learn More</a>
									</div>
								</div>
							</div>
						@endif
						
						<?php 
							$count++;
							if ($count == 3){ 
								$count = 0;
								echo "</div><div class='row resources'>";
							}							
						?>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	
@endsection