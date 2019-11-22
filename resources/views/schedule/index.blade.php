@extends('layouts.app')
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>Schedules</h2>
			<a href="/schedule/create" class="btn btn-primary">Create New Schedule</a>
		</div>
		
		<div class="row">
			<div class="col-sm-7">
				<div class="list-group">
				@foreach ($schedules as $schedule)
					<a href="/schedule/{{ $schedule->id }}" class="list-group-item">
						{{ $schedule->title }} – {{ count($schedule->days) }} Days
					</a>
				@endforeach
				</div>
			</div>
		</div>
		
		
	</div>
	
@endsection