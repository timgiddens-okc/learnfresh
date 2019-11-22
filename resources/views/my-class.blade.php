@extends("layouts.app")
	
@section("content")

<div class="national-championship-nav">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<a href="/my-class">My Class</a>
				<a href="/pretest">Pre-Test</a>
				<a href="/posttest">Post-Test</a>
			</div>
		</div>
	</div>
</div>

<div class="container">
	
	<div class="page-header">
		<h2>My Class</h2>
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
		<div class="col-sm-12">
			<div id="users-list">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								@if(!\Session::has('original_user') || \Auth::user()->isAdmin())
									<td>Student Name</td>
								@else
									<td>Student ID</td>
								@endif
								<td class="text-center">Pretest</td>
								<td class="text-center">Posttest</td>
							</tr>
						</thead>
						<tbody>
							@foreach($students as $student)
							<tr>
								@if(!\Session::has('original_user') || \Auth::user()->isAdmin())
								<td>{{ $student->name }}</td>
								@else
								<td>{{ $student->id }}</td>
								@endif
								
								<td class="text-center">
									@if($student->pre_assessment == 1)
										<i class="fa fa-check"></i>
									@endif
								</td>
								<td class="text-center">
									@if($student->post_assessment == 1)
										<i class="fa fa-check"></i>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			
			@if(\Auth::user()->pre_assessment_complete == 1)
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<h2>Add Student</h2>
					<p>These students will not take the post-test.</p>
					<form action="" method="post">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="name">Student Name</label>
							<input type="text" name="name" id="name" class="form-control">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Add Student</button>
						</div>
					</form>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
@endsection