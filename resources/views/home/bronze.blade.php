@extends('layouts.app')

@section('content')

<div class="container">
	<div class="account-spacer">
		<div class="row">
			<div class="col-sm-12 text-center">
				<div class="medal"><img src="{{ url('images/bronze.svg') }}" /></div>
				<h1>Thank you for participating this season!</h1>
			</div>
		</div>
	</div>
</div>
<?php
	$noFooterMargin = true;
?>
@endsection