@extends("layouts.app")
	
@section("content")

	@if(\Auth::user()->isAdmin())
		@include("nav.orders")
	@endif

<div class="container">
	<div class="page-header">
		<h2>Incentives</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
		
		</div>
	</div>
</div>
@endsection