@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="page-header">
		<h2>{{ $event->title }} Attendees</h2>
		<a href="/events/{{ $event->id }}/download-guest-list" class="btn btn-success btn-sm">Download Spreadsheet</a>
		@if (count($attendees) > 0 && \Auth::user()->isAdmin())
		<a href="/event/{{ $event->id }}/email" class="btn btn-success btn-sm">Email Attendees</a>
		@endif
	</div>
	<div class="row">
		<div class="col-sm-12">
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
				<div class="col-sm-12 text-center">
					<?php
						$attendeeCount = 0;
						foreach($attendees as $attendee){
							if((App\User::where('id',$attendee->user_id)->first() == null) && $attendee->school_program_name == ""){
								
							} else {
								$attendeeCount++;
							}
						}	
					?>
					<h4>{{ $attendeeCount }} Attendees</h4>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<td></td>
							<td>School/Program Name</td>
							<td>Name</td>
							<td>Email</td>
							<td>Phone</td>
							<td>Students Attending</td>
							<td>Additional Guests</td>
							<td>Shirt Sizes</td>
							<td class="text-center">Edit</td>
						</tr>
					</thead>
					<tbody>
						<?php 
							$count = 1;
						?>
						@foreach ($attendees as $attendee)
						<?php 
						if((App\User::where('id',$attendee->user_id)->first() == null) && $attendee->school_program_name == ""){
							
						} else {
							if($attendee->user_id){
								$user = App\User::where('id',$attendee->user_id)->first();
						?>
						<tr>
							<td>{{ $count }}</td>
							<td>{{ $user->school_program_name }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->phone }}</td>
						<?php } else { ?>
							<td>{{ $count }}</td>
							<td>{{ $attendee->school_program_name }}</td>
							<td>{{ $attendee->name }}</td>
							<td>{{ $attendee->email }}</td>
							<td>{{ $attendee->phone }}</td>
						<?php } ?>
							<td>{{ $attendee->students }}</td>
							<td>{{ $attendee->additional_guests }}</td>
							<td>{{ $attendee->shirt_sizes }}</td>
							<td class="text-center">
								<a href="/attendee/{{ $attendee->id }}/edit"><i class="fa fa-pencil"></i></a>
								<a href="/attendee/{{ $attendee->id }}/delete"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						<?php
							$count++;	
						}
						?>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-8 col-md-offset-2">
			<div class="page-header">
				<h1>Add Attendee</h1>
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

				<div class="row">
					<div class="col-sm-3 form-group">
						<label>School/Program Name</label><br>
						<input type="text" name="school_program_name" class="form-control" />
					</div>
					<div class="col-sm-3 form-group">
						<label>Name</label><br>
						<input type="text" name="name" class="form-control" />
					</div>					
					<div class="col-sm-3 form-group">
						<label>Email</label><br>
						<input type="text" name="email" class="form-control" />
					</div>
					<div class="col-sm-3 form-group">
						<label>Phone</label><br>
						<input type="text" name="phone" class="form-control" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-6 form-group">
						<label for="students">Students</label>
						<textarea name="students" class="form-control not-rich" id="students"></textarea>
						<p>Please separate names with a comma.</p>
					</div>
					<div class="col-sm-6 form-group">
						<label for="shirt_sizes">Shirt Sizes</label>
						<textarea name="shirt_sizes" class="form-control not-rich" id="shirt_sizes"></textarea>
						<p>Please separate shirt sizes with a comma.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 form-group">
						<label for="guests">Additional Guests</label>
						<textarea name="additional_guests" class="form-control not-rich" id="guests"></textarea>
					</div>
				</div>
				
				<div class="row">
					<div class="form-group col-sm-12">
						<button type="submit" class="btn btn-success pull-right">Add Attendee</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection