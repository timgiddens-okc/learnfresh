@extends("layouts.app")
	
@section("content")

	@if(\Auth::user()->isAdmin())
		@include("nav.orders")
	@endif

<div class="container">
	<div class="page-header">
		<h2>Pending Orders</h2>
		<a href="/admin/orders/pending" class="btn btn-success btn-sm">All Pending Orders</a>
	</div>
	<div class="sort">
	<h5>Show Orders By Field(s):</h5>
	<form action="/admin/orders/sorted" method="get" class="form-inline sort-users">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="recipient">Recipient</label><br>
			<select name="recipient">
				<option value="null"></option>
				<?php
					$used = array();
				?>
				@foreach ($allorders as $order)
					@if(!in_array($order->recipient, $used))
						<option value="{{ $order->recipient }}" {{ ($order->recipient == $_GET['recipient']) ? "selected" : "" }}>{{ $order->recipient }}</option>
					<?php 
						$used[] = $order->recipient;	 
					?>
					@endif
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="orderNumber">Order #</label><br>
			<input type="number" name="order_number" value="{{ $_GET['order_number'] }}" />			
		</div>
		<div class="form-group">
			<label for="state">State</label><br>
			<select name="state">
				<option value="null"></option>
				<?php
					$used = array();
				?>
				@foreach ($allorders as $order)
					@if(!in_array($order->state, $used))
						<option value="{{ $order->state }}" {{ ($order->state == $_GET['state']) ? "selected" : "" }}>{{ $order->state }}</option>
					<?php 
						$used[] = $order->state;	 
					?>
					@endif
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="post_code">Post Code</label><br>
			<select name="post_code">
				<option value="null"></option>
				<?php
					$used = array();
				?>
				@foreach ($allorders as $order)
					@if(!in_array($order->post_code, $used))
						<option value="{{ $order->post_code }}" {{ ($order->post_code == $_GET['post_code']) ? "selected" : "" }}>{{ $order->post_code }}</option>
					<?php 
						$used[] = $order->post_code;	 
					?>
					@endif
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="country">Country</label><br>
			<select name="country">
				<option value="null"></option>
				<?php
					$used = array();
				?>
				@foreach ($allorders as $order)
					@if(!in_array($order->country, $used))
						<option value="{{ $order->country }}" {{ ($order->country == $_GET['country']) ? "selected" : "" }}>{{ $order->country }}</option>
					<?php 
						$used[] = $order->country;	 
					?>
					@endif
				@endforeach
			</select>			
		</div>
		<br>
		<button type="submit" class="btn btn-primary">Sort Orders</button>
	</form>
	</div>
	<div class="row">
		<div class="col-sm-12">
			@foreach (['danger', 'warning', 'success', 'info'] as $msg)
	      @if(Session::has('alert-' . $msg))
	      <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><div>
	      @endif
	    @endforeach
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
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
							<td>Notes</td>
							<td class="text-center">Edit Order</td>
							<td class="text-center">Delete Order</td>
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
							<td>{{ $order->notes }}</td>
							<td class="text-center"><a href="/admin/orders/{{ $order->id }}/edit"><i class="fa fa-pencil"></i></a></td>
							<td class="text-center"><a href="/admin/orders/{{ $order->id }}/delete" class="delete"><i class="fa fa-minus-circle"></i></a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection