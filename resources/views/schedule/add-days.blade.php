@extends('layouts.app')
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>Create New Schedule</h2>
			<p>Great job! Next, let's add the days for the schedule.</p>
		</div>
		
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				@if($errors->any())
				<div class="alert alert-danger">
					@foreach($errors->all() as $error)
					<p>{{ $error }}</p>
					@endforeach
				</div>
				@endif
				<form action="" method="post">
					{{ csrf_field() }}
					<div id="days">
						<div class="day-block">
							<div class="form-group col-sm-6">
								<label>Day of the Week</label>
								<input type="text" name="title[]" class="form-control" />
							</div>
							<div class="form-group col-sm-6">
								<label>Date (MM-DD-YYYY)</label>
								<input type="date" name="date[]" class="form-control" />
							</div>
						</div>
					</div>
					<div class="form-group col-sm-12 text-right">
						<a href="" id="add-another-day">Add another day</a>
					</div>
					<div class="form-group col-sm-12">
						<button type="submit" class="btn btn-primary">Next Step</button>
					</div>
				</form>
			</div>
		</div>		
	</div>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#add-another-day").click(function(e){
				e.preventDefault();
				$("#days").append('<div class="day-block"><div class="form-group col-sm-6"><label>Day of the Week</label><input type="text" name="title[]" class="form-control" /></div><div class="form-group col-sm-6"><label>Date (MM-DD-YYYY)</label><input type="date" name="date[]" class="form-control" /></div></div>');
			});
		});
	</script>
	
@endsection