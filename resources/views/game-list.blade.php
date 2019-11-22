<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<tbody>
			<tr>
				<td class="text-right">
					{{ $games }} Board Games + Player Cards
				</td>
				<td class="text-right">
					<h3 style="margin: 0px;">${{ number_format($cost,2) }}</h3>
				</td>
			</tr>
			<tr>
				<td class="text-right">
					Shipping
				</td>
				<td class="text-right">
					<h3 style="margin: 0px;">${{ number_format($shipping,2) }}</h3>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td class="text-right">
					Total
				</td>
				<td class="text-right">
					<h3 style="margin: 0px;">${{ number_format($cost + $shipping,2) }}</h3>
				</td>
			</tr>
		</tfoot>
	</table>
</div>