@extends("layouts.app")
@section("content")
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-8 col-md-offset-2">
				<div class="page-header">
					<h1>Edit Student</h1>
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
					
					<div class="form-group">
						<label for="student">Student Name</label>
						<input type="text" name="name" class="form-control" id="student" value="{{ $student->name }}" />
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-success pull-right">Update Student Name</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection