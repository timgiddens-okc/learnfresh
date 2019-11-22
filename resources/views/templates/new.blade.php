@extends("layouts.app")

@section("content")

	<div class="container">
		
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="page-header">
					<h1>New Template</h1>
					<a href="/contact/templates">Back To All Templates</a>
				</div>
				@if($errors->any())
				<ul class="errors required">
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
				@endif
				<form action="" method="post" accept-charset="utf-8">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="name">Template Name <span class="required">*</span></label>
						<input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}" />
					</div>
					<div class="form-group">
						<label for="template">Template <span class="required">*</span></label>
						<p>To use the person's name, please use: [name]</p>
						<textarea name="template" id="template" required>{{ old('template') }}</textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Submit Template</button>
					</div>
				</form>
			</div>
		</div>
		
	</div>
	
@endsection