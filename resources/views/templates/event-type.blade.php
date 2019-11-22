<div class="form-group">
	<label>Event</label>
	<select name="event" class="form-control">
		@foreach($events as $event)
		<option value="{{ $event->id }}">{{ $event->title }}</option>
		@endforeach
	</select>
</div>