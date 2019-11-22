@extends("layouts.app")
@section("content")
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-8 col-md-offset-2">
				<div class="page-header">
					<h1>Add New Week</h1>
				</div>
				<form action="" method="post">
					{{ csrf_field() }}
					<div class="form-group">
						<div class="col-sm-12 col-md-6">
							<label for="weekNumber">Week Number</label>
							<input type="number" name="week_number" class="form-control" id="weekNumber" required>
						</div>
						<div class="col-sm-12 col-md-6">
							<label for="weekTitle">Week Title</label>
							<input type="text" name="title" class="form-control" id="weekTitle">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<label for="weekDescription">Week Description</label>
							<textarea name="description" class="form-control" id="weekDescription"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<label>Featured Resource</label><br>
							<select name="featured_resource" class="form-control">
								<option value="">No Featured Resource</option>
								@foreach ($resources as $resource)
									<option value="{{ $resource->id }}">{{ $resource->title }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-success pull-right">Add New Week</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection