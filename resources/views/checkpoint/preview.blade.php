@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="page-header">
		<h2>Checkpoints</h2>
		<p><strong>Open Date:</strong> {{ \Carbon\Carbon::parse($checkpoint->open_date)->format("F jS, Y") }}</p>
		<p><strong>Close Date:</strong> {{ \Carbon\Carbon::parse($checkpoint->close_date)->format("F jS, Y") }}</p>
		<p><strong>Status</strong> {{ ($checkpoint->published == 1) ? "Published" : "Not Published" }}</p>
		<p>
			<a href="/admin/checkpoint/{{ $checkpoint->id }}/edit" class="btn btn-primary">Edit</a>
			@if($checkpoint->published == 0)
				<a href="/admin/checkpoint/{{ $checkpoint->id }}/publish" class="btn btn-primary">Publish</a>
			@else
				<a href="/admin/checkpoint/{{ $checkpoint->id }}/unpublish" class="btn btn-primary">Un-Publish</a>
			@endif	
			<a href="/admin/checkpoints/create" class="btn btn-primary">All Checkpoints</a>
		</p>
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
			<h4>Preview Checkpoint</h4>
			<p>Please report participation data that has been accumulated since <strong>{{ $checkpoint->since_date }}</strong>.</p>

			@if($checkpoint->studentsParticipating)
				<div class="form-group">
					<label>Number of students participating</label>
					<input type="text" name="studentsParticipating" class="form-control" />
				</div>
			@endif
			
			@if($checkpoint->gamesPerStudent)
				<div class="form-group">
					<label>Average number of games played per student</label>
					<input type="text" name="gamesPerStudent" class="form-control" />
				</div>
			@endif
			
			@if($checkpoint->curriculumPerStudent)
				<div class="form-group">
					<label>Average number of curriculum pieces completed per student</label>
					<input type="text" name="curriculumPerStudent" class="form-control" />
				</div>
			@endif
			
			@if($checkpoint->sportsmanshipPointsPerStudent)
				<div class="form-group">
					<label>Average number of sportsmanship points earned per student</label>
					<input type="text" name="sportsmanshipPointsPerStudent" class="form-control" />
				</div>
			@endif
			
			@if($checkpoint->gamesPlayed)
				<div class="form-group">
					<label>Total number of games played</label>
					<input type="text" name="gamesPlayed" class="form-control" />
				</div>
			@endif
			
			@if($checkpoint->curriculumCompleted)
				<div class="form-group">
					<label>Total number of curriculum pieces completed</label>
					<input type="text" name="curriculumCompleted" class="form-control" />
				</div>
			@endif
			
			@if($checkpoint->sportsmanshipPoints)
				<div class="form-group">
					<label>Total number of sportsmanship points earned</label>
					<input type="text" name="sportsmanshipPoints" class="form-control" />
				</div>
			@endif
			
			@if($checkpoint->studentsEligible)
				<div class="form-group">
					<label>Number of students eligible to apply for the National Championship<br>(25 games played + 10 curriculum pieces completed)</label>
					<input type="text" name="studentsEligible" class="form-control" />
				</div>
			@endif

			</div>
		</div>
	</div>
</div>
@endsection