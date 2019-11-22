@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="page-header">
		<h2>Edit Checkpoint</h2>
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
		<div class="col-sm-7">
			<h4>Edit Checkpoint</h4>
			<p>Select which fields will be displayed.</p>
			<form action="" method="post">
				{{ csrf_field() }}
				<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="open_date">Open Date</label>
					<input type="date" name="open_date" class="form-control" value="{{ \Carbon\Carbon::parse($checkpoint->open_date)->format('Y-m-d') }}" id="open_date" />
				</div>
				<div class="form-group col-sm-6">
					<label for="close_date">Close Date</label>
					<input type="date" name="close_date" class="form-control" value="{{ \Carbon\Carbon::parse($checkpoint->close_date)->format('Y-m-d') }}" id="close_date" />
				</div>
				</div>
				<div class="form-group">
					<label for="since_date">Data Since This Date (or Week):</label>
					<input type="text" name="since_date" value="{{ $checkpoint->since_date }}" class="form-control" style="max-width: 200px;" placeholder="Week or Specific Date" />
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" {{ ($checkpoint->studentsParticipating) ? "checked" : "" }} name="studentsParticipating" value="1" />  Number of students participating
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" {{ ($checkpoint->gamesPerStudent) ? "checked" : "" }} name="gamesPerStudent" value="1" />  Average number of games played per student
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" {{ ($checkpoint->curriculumPerStudent) ? "checked" : "" }} name="curriculumPerStudent" value="1" />  Average number of curriculum pieces completed per student
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" {{ ($checkpoint->sportsmanshipPointsPerStudent) ? "checked" : "" }} name="sportsmanshipPointsPerStudent" value="1" />  Average number of sportsmanship points earned per student
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" {{ ($checkpoint->gamesPlayed) ? "checked" : "" }} name="gamesPlayed" value="1" />  Total number of games played
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" {{ ($checkpoint->curriculumCompleted) ? "checked" : "" }} name="curriculumCompleted" value="1" />  Total number of curriculum pieces completed
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="sportsmanshipPoints" {{ ($checkpoint->sportsmanshipPoints) ? "checked" : "" }} value="1" />  Total number of sportsmanship points earned
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="studentsEligible" {{ ($checkpoint->studentsEligible) ? "checked" : "" }} value="1" />  Number of students eligible to apply for the National Championship (30 games played + 10 curriculum pieces completed)
					</label>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Edit Checkpoint" />
				</div>
			</form>
		</div>
	</div>
</div>
@endsection