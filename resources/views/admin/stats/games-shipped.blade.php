<div class="row">
	<div class="col-sm-3 text-center">
		<h2 style="margin: 0px;">{{ \App\ShippingList::where([["item","=","48822"],["archived","=",1]])->orWhere([["item","=","48720"],["archived","=",1]])->count() }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">All Time</h6>
	</div>
	<div class="col-sm-3 text-center">
		<h2 style="margin: 0px;">{{ \App\ShippingList::where([["created_at",">",\Carbon\Carbon::parse('2019/08/01')->toDateTimeString()],["item","=","48822"],["archived","=",1]])->orWhere([["created_at",">",\Carbon\Carbon::parse('2019/08/01')->toDateTimeString()],["item","=","48720"],["archived","=",1]])->count() }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">This Year<br>Since 8/1/19</h6>
	</div>
	<div class="col-sm-3 text-center">
		<h2 style="margin: 0px;">{{ \App\ShippingList::where([["created_at",">",\Carbon\Carbon::now()->startOfMonth()->toDateTimeString()],["item","=","48822"],["archived","=",1]])->orWhere([["created_at",">",\Carbon\Carbon::now()->startOfMonth()->toDateTimeString()],["item","=","48720"],["archived","=",1]])->count() }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">This Month</h6>
	</div>
	
	<div class="col-sm-3 text-center">
		<h2 style="margin: 0px;">{{ \App\ShippingList::where([["created_at",">",\Carbon\Carbon::now()->subDays(7)->toDateTimeString()],["item","=","48822"],["archived","=",1]])->orWhere([["created_at",">",\Carbon\Carbon::now()->subDays(7)->toDateTimeString()],["item","=","48720"],["archived","=",1]])->count() }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">This Week</h6>
	</div>
</div>