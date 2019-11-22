@extends("layouts.app")
	
@section("content")

<div class="container">
	
	<div class="page-header">
		<h2>Submit Your Pretests</h2>
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
		<div class="col-sm-10 col-offset-1">
			<p>Confirm your shipping address below, and select the number of games you would like to receive.</p>
			<form action="" method="post">
				{{ csrf_field() }}
				<p>
					{{ \Auth::user()->shipping_address_1 }}<br>
					{{ \Auth::user()->shipping_city }}, {{ \Auth::user()->shipping_state }} {{ \Auth::user()->shipping_zip_code }}
				</p>
				<p><a href="/settings">Edit Shipping Address</a></p>
				<br>
				<p>Please enter the desired number of games you'd like to receive up to {{ $count }}.</p>
				<input type="number" max="{{ $count }}" min="0" name="game-count" class="form-control" value="1">
				<br>
				<p><input type="checkbox" name="cards-only" value="no-cards"> Only receive player cards</p>
				<br>
				<p><button type="submit" class="btn btn-primary">Submit Pretests</button></p>
			</form>
		</div>
	</div>
</div>
@endsection