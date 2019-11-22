@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
	                <div class="row">
											<div class="col-sm-12">
												@foreach (['danger', 'warning', 'success', 'info'] as $msg)
										      @if(Session::has('alert-' . $msg))
										      <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
										      @endif
										    @endforeach
										    	<div class="alert alert-info">Please do not refresh the page during registration.</div>
											</div>
										</div>
                
                	<div class="row">
	                	<div class="col-sm-12">
		                	<p>Did you attend an in person training session?</p>
		                	<select name="attended-training" class="form-control">
			                	<option hidden>Select your answer</option>
			                	<option value="yes">Yes</option>
			                	<option value="no">No</option>
		                	</select>
		                	
		                	<div id="attended" style="display: none;padding-top: 35px;">
			                	<form action="" method="post">
			                		{{ csrf_field() }}
				                	<div class="row">
					                	<div class="col-sm-12">
						                	<p>Please enter your promo code.</p>
						                	<input type="text" name="promo-code" required class="form-control">
					                	</div>
				                	</div>
				                	<div class="row">
				                		<div class="col-sm-12">
					                		<br>
					                		<p>Please choose your program:</p>
				                		</div>
			                		</div>
			                		<div class="row">
				                		<div class="col-sm-4 text-center">
					                		<input type="radio" required class="program-select" name="program" value="mh" id="training-mh"><label for="training-mh"><img src="{{ ($app == "production") ? secure_asset("/images/nba-math-hoops.png") : asset("/images/nba-math-hoops.png") }}" style="width: auto; height: 100px;">
					                		<div style="margin-top:15px;" class="btn btn-primary expanded">Select</div>
					                		</label>
					                		<p>Includes NBA Math Hoops board games, Common Core aligned curriculum, access to the LFCA for program support & resources</p>
				                		</div>
				                		<div class="col-sm-4 text-center">
					                		<input type="radio" required class="program-select" name="program" value="mh+" id="training-mh+"><label for="training-mh+"><img src="{{ ($app == "production") ? secure_asset("/images/nba-math-hoops-plus.png") : asset("/images/nba-math-hoops-plus.png") }}" style="width: auto; height: 100px;">
					                		<div style="margin-top:15px;" class="btn btn-primary expanded">Select</div>
					                		</label>
					                		<p>Includes all of the above PLUS the incentive program, access to regional tournaments/special events, eligibility to apply for the National Championship</p>
				                		</div>
			                		</div>
				                	<div class="row">
					                	<div class="col-sm-12 text-right"><br>
						                	<button type="submit" class="btn btn-primary">Submit Promo Code</button>
					                	</div>
				                	</div>
			                	</form>
		                	</div>
		                	<div id="didnt-attend" style="display: none;padding-top: 35px;">
			                	<form action="" method="post">
			                		{{ csrf_field() }}
			                		<div class="row">
				                		<div class="col-sm-12">
					                		<p>Please choose your programs:</p>
				                		</div>
			                		</div>
			                		<div class="row">
				                		<div class="col-sm-4 text-center">
					                		<input type="radio" required class="program-select" name="program" value="mh" id="mh"><label for="mh"><img src="{{ ($app == "production") ? secure_asset("/images/nba-math-hoops.png") : asset("/images/nba-math-hoops.png") }}" style="width: auto; height: 100px;">
					                		<h3>$250</h3>
					                		<div style="margin-top:15px;" class="btn btn-primary expanded">Select</div>
					                		</label>
					                		<p>Includes NBA Math Hoops board games, Common Core aligned curriculum, access to the LFCA for program support & resources</p>
				                		</div>
				                		<div class="col-sm-4 text-center">
					                		<input type="radio" required class="program-select" name="program" value="mh+" id="mh+"><label for="mh+"><img src="{{ ($app == "production") ? secure_asset("/images/nba-math-hoops-plus.png") : asset("/images/nba-math-hoops-plus.png") }}" style="width: auto; height: 100px;">
					                		<h3>$1,000</h3>
					                		<div style="margin-top:15px;" class="btn btn-primary expanded">Select</div>
					                		</label>
					                		<p>Includes all of the above PLUS the incentive program, access to regional tournaments/special events, eligibility to apply for the National Championship</p>
				                		</div>
			                		</div>
			                		<div class="row">
			                	<div class="col-sm-12 text-right">
				                	<button type="submit" class="btn btn-primary">Continue</button>
			                	</div>
		                	</div>
			                	</form>
		                	</div>
	                	</div>
                	</div>		                      
                
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("select[name='attended-training']").on("change", function(){
			if($(this).val() == "yes"){
				$("#attended").slideDown(400);
				$("#didnt-attend").slideUp(400);
			} else {
				$("#attended").slideUp(400);
				$("#didnt-attend").slideDown(400);
			}
		});
	});
</script>
@endsection