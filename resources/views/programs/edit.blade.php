@extends("layouts.app")
@section("content")
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-8 col-md-offset-2">
				<div class="page-header">
					<h1>Edit Program</h1>
				</div>
				<form action="" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<div class="form-group">
							<label for="programName">Program Name</label>
							<input type="text" name="title" class="form-control" id="programName" value="{{ $program->title }}" required>
					</div>
					<div class="form-group">
							<label for="programDescription">Program Description</label>
							<textarea name="description" class="form-control" id="programDescription">{!! $program->description !!}</textarea>
					</div>
					<div class="form-group">
						<label for="resourceDescription">Program Logo</label>
						<input type="file" name="logo" />
					</div>
					<div class="form-group">
							<button type="submit" class="btn btn-success pull-right">Update Program</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection