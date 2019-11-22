@extends("layouts.blank")

<h2>{{ $schedule->title }}</h2>
<div class="list-group">
@foreach ($schedule->days as $day)
	<div class="list-group-item">
		<strong>{{ $day->title }}</strong> – {{ \Carbon\Carbon::parse($day->date)->format("F jS, Y") }}
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
				</tr>
		@endforeach
			</tbody>
		</table>
		@endif
	</div>
@endforeach
</div>