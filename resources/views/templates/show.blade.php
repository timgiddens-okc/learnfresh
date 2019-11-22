@extends("layouts.app")

@section("content")

	<div class="container">
		
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="page-header">
					<h1>{{ $template->name }}</h1>
					<a href="/contact/templates">Back To All Templates</a>
				</div>
				{!! $template->template !!}
				<p>
					The Learn Fresh Team<br>
					<i>Creating Math Champions, One Game at a Time</i>
				</p>
				
				<div class="template-actions">
					<div class="row">
						<div class="col-sm-6">
							<?php
								$created = \App\User::where('id',$template->created_by)->first();	
								$modified = \App\User::where('id',$template->last_modified_by)->first();	
							?>
							<p class="disclaimer">
								Created By: {{ $created->name }}<br>
								Last Modified By: {{ $modified->name }}
							</p>
						</div>
						<div class="col-sm-6 text-right">
							<a href="/contact/template/{{ $template->id }}/edit" class="btn btn-primary">Edit Template</a>
							<a href="/contact/template/{{ $template->id }}/delete" class="btn btn-danger delete">Delete Template</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
@endsection