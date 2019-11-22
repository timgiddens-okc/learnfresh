@extends('layouts.app')
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>{{ $schedule->title }}</h2>
			<a href="/national-championship/schedule" class="btn btn-primary">View All Schedules</a>
			<a href="/print-schedule/{{ $schedule->id }}" class="btn btn-primary">Print Schedule</a>
		</div>
		
		<div class="row">
			<div class="col-sm-12">
				@if($errors->any())
				<div class="alert alert-danger">
					@foreach($errors->all() as $error)
					<p>{{ $error }}</p>
					@endforeach
				</div>
				@endif
				<div class="list-group">
				@foreach ($schedule->days as $day)
					<div class="list-group-item">
						<strong>{{ $day->title }}</strong> – {{ \Carbon\Carbon::parse($day->date)->format("F jS, Y") }}
						<a href="/schedule/{{ $schedule->id }}/day/{{ $day->id }}" class="btn btn-primary small pull-right" style="font-size: 80% !important;margin-bottom: 15px;">Add New Item</a>
						@if($day->items)
						<table class="table table-bordered" style="margin-top: 15px;">
							<tbody>
						@foreach($day->items as $item)
								<tr>
									<td>{{ $item->start_time }}</td>
									<td>{{ $item->end_time }}</td>
									<td>{{ $item->event_name }}</td>
									<td class='{{ ($item->event_name == "Travel") ? "table-secondary" : "" }}'>{{ $item->event_location }}</td>
									<td class='{{ ($item->event_name == "Travel") ? "table-secondary" : "" }}'>{{ $item->event_address }}</td>
									<td class='{{ ($item->event_name == "Travel") ? "table-secondary" : "" }}'>{{ $item->event_details }}</td>
									<td class="text-center">
										<a href="/schedule/{{ $schedule->id }}/edit-itinerary/{{ $item->id }}"><i class="fa fa-pencil"></i></a>
										<a href="/schedule/{{ $schedule->id }}/delete-itinerary/{{ $item->id }}"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
						@endforeach
							</tbody>
						</table>
						@endif
					</div>
				@endforeach
				</div>
			</div>
		</div>		
	</div>
	
@endsection