@extends('layouts.app')
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>Videos</h2>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row resources">
					<?php $count = 0; ?>
					@if (count($videos) > 0)
					@foreach ($videos as $resource)
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
					@else
						<p>No videos at this time. Check back later!</p>
					@endif
				</div>
			</div>
		</div>
	</div>
	
@endsection