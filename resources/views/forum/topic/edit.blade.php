@extends("layouts.app")
@section("content")
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-8 col-md-offset-2">
				<div class="page-header">
					<h1>Edit Topic</h1>
				</div>
				<form action="" method="post">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					
					<div class="form-group">
						<label for="topicTitle">Topic</label>
						<input type="text" name="title" class="form-control" id="topicTitle" value="{{ $topic->title }}" />
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-success pull-right">Update Topic</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection