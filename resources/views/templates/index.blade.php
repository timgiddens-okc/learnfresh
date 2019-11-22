@extends("layouts.app")

@section("content")

	<div class="container">
		
		<div class="row">
			<div class="col-sm-8">
				<div class="page-header">
					<h1>Templates</h1>
				</div>
				<div class="list-group">
					@foreach($templates as $template)
					<a href="/contact/template/{{ $template->id }}" class="list-group-item">{{ $template->name }}</a>
					@endforeach
				</div>
			</div>
			<div class="col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						Add New Template
					</div>
					<div class="panel-body">
						<a href="/contact/templates/create-new" class="btn btn-primary expanded">Create New</a>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
@endsection