@extends("layouts.app")
	
@section("content")
	
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-header">
					<h1>Resources</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<a href="/resources/all" class="btn btn-primary">View All Resources</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						Edit Resource
					</div>
					<div class="panel-body">
						<form action="" method="post">
							{{ csrf_field() }}
						
							<ul class="list-group" id="sortable">
							@foreach($resources as $resource)
								<li class="list-group-item"><input type="hidden" name="resources[]" value="{{ $resource->id }}" /><i class="fa fa-sort" style="margin-right: 7px;"></i> {{ $resource->title }}</li>
							@endforeach
							</ul>
							
							<div class="form-group">
								<input type="submit" class="btn btn-success pull-right" value="Save Resource Order" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection