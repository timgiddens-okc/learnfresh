@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="page-header">
		<h2>Email {{ $users->count() }} User(s)</h2>
		<p>
			<?php $count = 0; ?>
			@foreach($users as $user)
			<?php if($count > 0){ echo ","; } ?> {{ $user->email }}<?php $count++; ?> 
			@endforeach
		</p>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-6 col-md-offset-3">
			<form action="" method="post">
				{{ csrf_field() }}
			
				<div class="form-group">
					<label for="subject">Subject</label>
					<input type="text" id="subject" name="subject" class="form-control" />
				</div>
				<div class="form-group">
					<label for="message">Message</label>
					<textarea name="message" id="message" class="form-control"></textarea>
				</div>
				<input type="hidden" name="location" value="{{ $_GET['location'] }}" />
				<input type="hidden" name="query" value="{{ $_GET['query'] }}" />
				<div class="form-group">
					<input type="submit" class="btn btn-success expanded" value="Send Email" />
				</div>
			</form>
		</div>
	</div>
</div>
@endsection