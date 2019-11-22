@extends('layouts.app')
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>Create New Schedule</h2>
			<p>Awesome! First, let's start with the name of the schedule.</p>
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
					<div class="form-group">
						<label>Title</label>
						<input type="text" name="title" class="form-control" />
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Add Schedule</button>
					</div>
				</form>
			</div>
		</div>
		
	</div>
	
@endsection