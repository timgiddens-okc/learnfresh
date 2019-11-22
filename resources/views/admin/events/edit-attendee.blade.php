@extends("layouts.app")
@section("content")
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-8 col-md-offset-2">
				<div class="page-header">
					<h1>Edit Attendee</h1>
				</div>
				@if (count($errors))
					<div class="alert alert-danger">
					<strong>Uh oh!</strong>
					@foreach ($errors->all() as $error)
						<br>{{ $error }}
					@endforeach
					</div>
				@endif
				<form action="" method="post">
					{{ csrf_field() }}
					<?php
						$thisUser = App\User::find($attendee->user_id)
					?>
					<div class="row">
						<div class="col-sm-3 form-group">
							<label>School/Program Name</label><br>
							{{ $thisUser->school_program_name }}
						</div>
						<div class="col-sm-3 form-group">
							<label>Name</label><br>
							{{ $thisUser->name }}
						</div>					
						<div class="col-sm-3 form-group">
							<label>Email</label><br>
							{{ $thisUser->email }}
						</div>
						<div class="col-sm-3 form-group">
							<label>Phone</label><br>
							{{ $thisUser->phone }}
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6 form-group">
							<label for="students">Students</label>
							<textarea name="students" class="form-control not-rich" id="students">{{ $attendee->students }}</textarea>
							<p>Please separate names with a comma.</p>
						</div>
						<div class="col-sm-6 form-group">
							<label for="shirt_sizes">Shirt Sizes</label>
							<textarea name="shirt_sizes" class="form-control not-rich" id="shirt_sizes">{{ $attendee->shirt_sizes }}</textarea>
							<p>Please separate shirt sizes with a comma.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 form-group">
							<label for="guests">Additional Guests</label>
							<textarea name="additional_guests" class="form-control not-rich" id="guests">{{ $attendee->additional_guests }}</textarea>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group col-sm-12">
							<button type="submit" class="btn btn-success pull-right">Update Order</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection