@extends("layouts.app")
	
@section("content")
	
	<div class="container">
		<div class="page-header">
			<h2>Thank you for registering!</h2>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="row">
					<div class="col-sm-12">
						@foreach (['danger', 'warning', 'success', 'info'] as $msg)
				      @if(Session::has('alert-' . $msg))
				      <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><div>
				      @endif
				    @endforeach
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<form action="/payment" method="post">
							{{ csrf_field() }}
							
							<div class="row form-group{{ $errors->has('card_number') ? ' has-error' : '' }}">
								<div class="col-md-12">
									<label for="card_number">Card Number</label>
									<input type="text" name="card_number" class="form-control" id="card_number" value="{{ old('card_number') }}" />	
									
									@if ($errors->has('card_number'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('card_number') }}</strong>
	                    </span>
	                @endif
								</div>
							</div>
							
							<div class="row form-group{{ $errors->has('exp_month') || $errors->has('exp_year') || $errors->has('exp_cvc') ? ' has-error' : '' }}">
								<div class="col-md-4">
									<label for="exp_month">Exp Month (MM)</label>
									<input type="number" id="exp_month" class="form-control" name="exp_month" value="{{ old('exp_month') }}" />
									
									@if ($errors->has('exp_month'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('exp_month') }}</strong>
	                    </span>
	                @endif
								</div>
								<div class="col-md-4">
									<label for="exp_year">Exp Year (YYYY)</label>
									<input type="number" id="exp_year" class="form-control" name="exp_year" value="{{ old('exp_year') }}" />
									
									@if ($errors->has('exp_year'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('exp_year') }}</strong>
	                    </span>
	                @endif
								</div>
								<div class="col-md-4">
									<label for="cvc">CVC</label>
									<input type="number" id="cvc" class="form-control" name="cvc" value="{{ old('cvc') }}" />
									
									@if ($errors->has('cvc'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('cvc') }}</strong>
	                    </span>
	                @endif
								</div>
							</div>
							
							<div class="form-group">
								<button type="submit" class="btn btn-primary expanded">Submit Payment</button>
							</div>
							
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<p>To complete your registration, please submit your payment of {{ (\Auth::user()->discount_code == "LF50") ? "$50" : "$100" }} to cover the cost of program materials, shipping, and ongoing support for the year. You will also receive as many games as needed for the students in your program, classroom, or school.</p>

				<p>We are a 501(c)(3) nonprofit, with a purely social mission of making learning fun for students. Our team is mostly comprised of former educators, and we know how hard you work! We appreciate your willingness to pay for this exceptional learning experience.</p>
			</div>
		</div>
	</div>
	
@endsection