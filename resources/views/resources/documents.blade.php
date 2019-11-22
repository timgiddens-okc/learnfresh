@extends('layouts.app')
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>Curriculum/Documents</h2>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row resources">
					<?php $count = 0; ?>
					@foreach ($docs as $resource)
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
	</div>
	
@endsection