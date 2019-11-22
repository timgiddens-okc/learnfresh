@extends("layouts.app")
	
@section("content")

@if(\Auth::user()->isAdmin())
		@include("nav.users")
	@endif

<div class="container">
	
	<div class="page-header">
		<h2>Training Codes</h2>
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
								<td></td>
								<td>Date Created</td>
								<td>Code</td>
								<td>Expiration</td>
								<td>Delete</td>
							</tr>
						</thead>
						<tbody>
							<?php $currentCount = 1; ?>
							@foreach ($codes as $code)
							<tr>
								<td>{{ $currentCount }}</td>
								<td>{{ \Carbon\Carbon::parse($code->created_at)->format("F jS, Y") }}</td>
								<td>{{ $code->code }}</td>
								<td>{{ \Carbon\Carbon::parse($code->expiration)->format("F jS, Y") }}</td>
								<td>
									<a href="/admin/training-codes/{{ $code->id }}" class="btn btn-primary small">Delete Code</a>
								</td>
							</tr>
							<?php $currentCount++; ?>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<h2>Add New Code</h2>
			<form action="/admin/training-codes/new" method="post">
				{{ csrf_field() }}
				
				<p>
					Code<br>
					<input type="text" name="code" class="form-control">
				</p>
				<p>
					Expiration Date<br>
					<input type="date" name="expiration" class="form-control"/>
				</p>
				<p class="text-right">
					<button type="submit" class="btn btn-primary">Submit Code</button>
				</p>
			</form>
		</div>
	</div>
</div>
@endsection