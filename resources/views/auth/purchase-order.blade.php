@extends('layouts.app')

@section('content')

<div class="container">
	<div class="account-spacer">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 text-center">
				<h1>Purchase Order</h1>
				<p>Please mail in your payment to be granted access to the MyLFCA.</p>
				
				<div class="purchase-order" style="margin-top: 50px;">
					<div class="row">
						<div class="col-sm-6 text-left">
							<img src="{{ ($app == "production") ? secure_asset("/images/logo.svg") : asset("/images/logo.svg") }}" style="width: 125px; height: auto;">
							
						</div>
						<div class="col-sm-6 text-right">
							<h3 style="margin-top: 0px;">Purchase Order #{{ $po->purchase_order_number }}</h3>
							<p>Date: {{ \Carbon\Carbon::parse($po->created_at)->format('F jS, Y') }}</p>
						</div>
					</div>
					<div class="row" style="margin-top: 35px;">
						<div class="col-sm-6 text-left">
							<h4>Bill To</h4>
							<p><strong>Learn Fresh Education Co</strong><br>3461 Ringsby Ct Suite 315<br>Denver, CO 80216</p>
						</div>
						<div class="col-sm-6 text-left">
							<h4>Ship To</h4>
							<p><strong>{{ \Auth::user()->name }}</strong><br>{{ \Auth::user()->shipping_address_1 }}<br>{{ \Auth::user()->shipping_city }}, {{ \Auth::user()->shipping_state }} {{ \Auth::user()->shipping_zip_code }}</p>
						</div>
					</div>
					
					<hr>
					
					<table class="table text-left">
						<thead>
							<tr>
								<td><strong>Program Name</strong></td>
								<td class="text-right"><strong>Program Cost</strong></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ (\Auth::user()->account_level == 1) ? 'NBA Math Hoops' : 'NBA Math Hoops Plus' }}</td>
								<td class="text-right">{{ (\Auth::user()->account_level == 1) ? '$500' : '$1,000' }}</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td class="text-right"><strong>Total Cost</strong></td>
								<td class="text-right"><h2 style="margin: 0px;">{{ (\Auth::user()->account_level == 1) ? '$500' : '$1,000' }}</h2></td>
							</tr>
						</tfoot>
					</table>
					
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	$noFooterMargin = true;
?>
@endsection