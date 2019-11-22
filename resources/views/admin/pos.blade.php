@extends("layouts.app")
	
@section("content")

@if(\Auth::user()->isAdmin())
		@include("nav.users")
	@endif

<div class="container">
	
	<div class="page-header">
		<h2>Purchase Orders</h2>
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
								<td>PO#</td>
								<td>Name</td>
								<td>Email</td>
								<td>Paid</td>
							</tr>
						</thead>
						<tbody>
							<?php $currentCount = 1; ?>
							@foreach ($pos as $po)
							<tr>
								<td>{{ $currentCount }}</td>
								<td>{{ \Carbon\Carbon::parse($po->created_at)->format("F jS, Y") }}</td>
								<td>{{ $po->purchase_order_number }}</td>
								<?php
									$poUser = \App\User::where('id',$po->user_id)->first();	
								?>
								<td>
									{{ $poUser->name }}
								</td>
								<td>
									{{ $poUser->email }}
								</td>
								<td>
									<a href="/admin/purchase-orders/{{ $po->id }}" class="btn btn-primary small">Mark As Paid</a>
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
</div>
@endsection