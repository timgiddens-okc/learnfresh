@extends('layouts.app')
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>New Post</h2>
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
			<div class="col-sm-12 col-md-8 col-md-offset-2">
				<form action="" method="post">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="category">Select A Category</label>
						<select name="category" class="form-control" id="category">
							<option value="media">Media</option>
							<option value="program-support">Program Support</option>
							<option value="testing">Testing</option>
							<option value="all-star-advice">All-Star Advice</option>
							<option value="events">Events</option>
							<option value="classroom-creations">Classroom Creations</option>
							<option value="other">Other</option>
						</select>
					</div>
					<div class="form-group">
						<label for="subject">Subject</label>
						<input type="text" name="subject" class="form-control" id="subject" value="{{ old('subject') }}" required />
					</div>
					<div class="form-group">
						<label for="text">Text</label>
						<textarea name="text" class="form-control" required>{{ old('text') }}</textarea>
					</div>
					<div class="form-group">
						<label for="files">Upload File(s)</label><br>
						<input type="file" name="files[]" multiple />
					</div>
					<div class="form-group text-right">
						<button type="submit" class="btn btn-primary">Submit New Post</button>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection