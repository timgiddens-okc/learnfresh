@extends("layouts.app")
	
@section("content")

	@if(\Auth::user()->isAdmin())
		@include("national-championship.national-championship-nav")
	@endif

<div class="container">
	<div class="page-header">
		<h2>Participants</h2>
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
			<h3>{{ count($applications) }} Participants</h3>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Region/Team</td>
							<td>Student Name</td>
							<td>Educator Name</td>	
							<td>Educator Email</td>
							<td>Educator Phone</td>
							<td>Viewed By</td>
							<td>Votes</td>
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
							<td>{{ $application->educator_name }}</td>							
							<td>{{ $educator->email }}</td>
							<td>{{ $educator->phone }}</td>
							<td>
								@foreach($views as $view)
									<?php $user = \App\User::where('id',$view->user_id)->first(); ?>
									
									@if(!$loop->last)
									{{ $user->name }}, 
									@else
									{{ $user->name }}
									@endif
								@endforeach
							</td>
							<td>{{ $application->votes->count() }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection