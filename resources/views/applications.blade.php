@extends("layouts.app")
	
@section("content")

<div class="container">
	<div class="page-header">
		<h2>My Applicants</h2>
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
		<div class="col-sm-12">
			<h3>{{ count($applications) }} Applications</h3>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Region/Team</td>
							<td>Student Name</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($applications as $application)
						<?php 
							$educator = \App\User::where('id',$application->educator_id)->first(); 
							$views = \App\View::where('application_id',$application->id)->get();
						?>
						<tr>		
							<td>{{ $application->team_region }}</td>				
							<td><a href="/national-championship/application/{{ $application->id }}">{{ $application->student_name }}</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection