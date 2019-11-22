@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="page-header">
		<h2>Championship Updates</h2>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-6 col-md-offset-3">
			<form action="" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
			
				<div class="form-group">
					<label for="date">Date</label>
					<input type="text" id="date" name="date" class="form-control" value="{{ $championship->date }}" />
				</div>
				<div class="form-group">
					<label for="countdown_date">Countdown Date</label>
					<input type="text" id="countdown_date" name="countdown_date" class="form-control" value="{{ $championship->countdown_date }}" />
				</div>
				<div class="form-group">
					<label for="location">Location</label>
					<input type="text" id="location" name="location" class="form-control" value="{{ $championship->location }}" />
				</div>
				<div class="form-group">
					<label for="video">Video Embed Code</label>
					<input type="text" id="video" name="video" class="form-control" value="{{ $championship->video }}" />
				</div>
				<div class="form-group">
					<label for="qualify">How To Qualify</label>
					<textarea id="qualify" name="how_to_qualify" class="form-control">{!! $championship->how_to_qualify !!}</textarea>
				</div>
				<div class="form-group">
					<label for="details">Event Details</label>
					<textarea id="details" name="event_details" class="form-control">{!! $championship->event_details !!}</textarea>
				</div>
				<div class="form-group">
					<label for="qualify-image">How To Qualify (Image)</label>
					<input type="file" id="qualify-image" name="qualify_image" />
				</div>
				<div class="form-group">
					<label for="details-image">Event Details (Image)</label>
					<input type="file" id="details-image" name="event_details_image" />
				</div>
				<div class="form-group">
					<label for="display">Display?</label>
					<select name="display" class="form-control">
						<option value="0" {{ ($championship->display == 0) ? "selected" : "" }}>No</option>
						<option value="1" {{ ($championship->display == 1) ? "selected" : "" }}>Yes</option>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-success expanded" value="Update Championship Details" />
				</div>
			</form>
		</div>
	</div>
</div>
@endsection