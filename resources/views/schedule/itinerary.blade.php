@extends('layouts.app')
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>Itinerary</h2>
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

				<h4>{{ $scheduleDay->title }} - {{ \Carbon\Carbon::parse($scheduleDay->date)->format('F jS, Y') }}</h4>

				@if($scheduleDay->items)
				<table class="table table-bordered" style="margin-top: 15px;">
					<tbody>
				@foreach($scheduleDay->items as $item)
						<tr>
							<td>{{ $item->start_time }}</td>
							<td>{{ $item->end_time }}</td>
							<td>{{ $item->event_name }}</td>
							<td class='{{ ($item->event_name == "Travel") ? "table-secondary" : "" }}'>{{ $item->event_location }}</td>
							<td class='{{ ($item->event_name == "Travel") ? "table-secondary" : "" }}'>{{ $item->event_address }}</td>
							<td class='{{ ($item->event_name == "Travel") ? "table-secondary" : "" }}'>{{ $item->event_details }}</td>
						</tr>
				@endforeach
					</tbody>
				</table>
				@endif
				
				<form action="" method="post">
					{{ csrf_field() }}
					<div id="days">
						<div class="day-block">
							<div class="form-group col-sm-2">
								<input type="text" name="start_time[]" placeholder="Start Time" class="form-control" />
							</div>
							<div class="form-group col-sm-2">
								<input type="text" name="end_time[]" placeholder="End Time" class="form-control" />
							</div>
							<div class="form-group col-sm-2">
								<input type="text" name="event_name[]" placeholder="Event Name" class="form-control" />
							</div>
							<div class="form-group col-sm-2">
								<input type="text" name="event_location[]" placeholder="Event Location" class="form-control" />
							</div>
							<div class="form-group col-sm-2">
								<input type="text" name="event_address[]" placeholder="Event Address" class="form-control" />
							</div>
							<div class="form-group col-sm-2">
								<textarea name="event_details[]" placeholder="Event Details" class="form-control not-rich" style="height: 36px;"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 text-right">
							<a href="#" id="add-another-item">Add Another Item</a>
						</div>
					</div>
					
					<div class="form-group col-sm-12">
						<button type="submit" class="btn btn-primary">Finish Up</button>
					</div>
				</form>
			</div>
		</div>		
	</div>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#add-another-item").click(function(e){
				e.preventDefault();
				$("#days").append('<div class="day-block"><div class="form-group col-sm-2"><input type="text" name="start_time[]" placeholder="Start Time" class="form-control" /></div><div class="form-group col-sm-2"><input type="text" name="end_time[]" placeholder="End Time" class="form-control" /></div><div class="form-group col-sm-2"><input type="text" name="event_name[]" placeholder="Event Name" class="form-control" /></div><div class="form-group col-sm-2"><input type="text" name="event_location[]" placeholder="Event Location" class="form-control" /></div><div class="form-group col-sm-2"><input type="text" name="event_address[]" placeholder="Event Address" class="form-control" /></div><div class="form-group col-sm-2"><textarea name="event_details[]" placeholder="Event Details" class="form-control not-rich" style="height: 36px;"></textarea></div></div>');
			});
		});
	</script>
	
@endsection