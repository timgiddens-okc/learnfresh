@extends("layouts.app")
	
@section("content")

	@if(\Auth::user()->isAdmin())
		@include("nav.orders")
	@endif

<div class="container">
	<div class="page-header">
		<h2>Kit Orders</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div id="orders-data">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<td>Date Placed</td>
								<td>Order #</td>
								<td>Item #</td>
								<td>Quantity</td>
								<td>Recipient</td>
								<td>Company</td>
								<td>Address 1</td>
								<td>Address 2</td>
								<td>City</td>
								<td>State</td>
								<td>Post Code</td>
								<td>Country</td>
								<td>Phone</td>
								<td>Shipping Method</td>
							</tr>
						</thead>
						<tbody>
							@foreach ($orders as $order)
							<tr class='{{ ($order->submitted_by == 1) ? "admin-submitted" : "" }}'>
								<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('m/d/y - h:ia') }}</td>
								<td>#{{ $order->order_number }}</td>
								<td>{{ $order->item }}</td>
								<td>{{ $order->quantity }}</td>
								<td>{{ $order->recipient }}</td>
								<td>{{ $order->company }}</td>
								<td>{{ $order->address_1 }}</td>
								<td>{{ $order->address_2 }}</td>
								<td>{{ $order->city }}</td>
								<td>{{ $order->state }}</td>
								<td>{{ $order->post_code }}</td>
								<td>{{ $order->country }}</td>
								<td>{{ $order->phone }}</td>
								<td>{{ $order->ship_method }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection