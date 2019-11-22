@extends("layouts.app")

@section("content")

	<div class="container">
		
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
			<div class="col-xs-12 text-center">
				<div class="hcs-logo"><img src="{{ url('images/home-court-series-logo.png') }}" /></div>
				<h1 style="margin-bottom: 0px;">Learn Fresh Home Court Series Preorder</h1>
				<h3 style="margin: 5px 0px 0px 0px;">Available for a limited time only!</h3>
				<p style="margin-top: 10px;">It’s tournament time for your Math Champs! As you finish up your NBA Math Hoops season, we invite you to take advantage of this specially-designed Home Court Series Tournament Kit as a reward for your students. Every kit includes awards, signage, shirts, and more to help you recognize their accomplishments in the program and their performance in your end-of-season championship. Full contents are detailed below.</p>
				<p style="margin: 5px 0px 25px 0px;">Preorder closes at 9PM Eastern on Thursday, March 14, 2019. All sales are final. Please allow 2-4 weeks for production and delivery of your Home Court Series merchandise.</p>
			</div>
		</div>
		
		<form action="" method="post" class="form-horizontal">
			{{ csrf_field() }}
		<div class="row">
			<div class="col-xs-8 col-xs-offset-2 text-center">
				<p>The kit includes:</p>
				<p>
					<strong>Award Medals</strong><br>
					2 Gold, 2 Silver, and 2 Bronze Home Court Series medals
				</p>
				<p>
					<strong>Poster</strong><br>
					One copy of the Home Court Series logo as a poster
				</p>
				<p>
					<strong>T-Shirts</strong><br>
					8 Large Home Court Series t-shirts for Final Four participants
				</p>
				<p>
					<strong>Games</strong><br>
					Two new copies of NBA Math Hoops for the winning team
				</p>
				<p>
					<strong>Participation Certificate</strong><br>
					Printable PDF of the Home Court Series Participation Certificate
				</p>
				
				<h3 class="text-center">Additional T-shirts – $14.99/each</h3>
				<div class="row">
					<div class="col-xs-3">
						<h6>Small</h6>
						<input type="number" name="small" value="0" min="0" />
					</div>
					<div class="col-xs-3">
						<h6>Medium</h6>
						<input type="number" name="medium" value="0" min="0" />
					</div>
					<div class="col-xs-3">
						<h6>Large</h6>
						<input type="number" name="large" value="0" min="0" />
					</div>
					<div class="col-xs-3">
						<h6>X-Large</h6>
						<input type="number" name="x-large" value="0" min="0" />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<button id="add-shirts" class="btn btn-primary" style="margin-top: 20px;">Add To Order</button>
					</div>
				</div>
				
				<div class="total" style="margin-top: 35px;">
					<div class="row">
						<div class="col-xs-12">
							<table class="table">
								<tr>
									<td class="text-right" style="width:75%;">Subtotal</td>
									<td class="text-left">&nbsp;$249.99</td>
								</tr>
								<tr>
									<td class="text-right" style="width:75%;">LFCA Discount</td>
									<td class="text-left">-$50.00</td>
								</tr>
								<tr id="small-shirts">
									<td class="text-right" style="width:75%;">Small T-Shirt(s) - <span class="qty"></span></td>
									<td class="text-left">$<span class="price">0.00</span></td>
								</tr>
								<tr id="medium-shirts">
									<td class="text-right" style="width:75%;">Medium T-Shirt(s) - <span class="qty"></span></td>
									<td class="text-left">$<span class="price">0.00</span></td>
								</tr>
								<tr id="large-shirts">
									<td class="text-right" style="width:75%;">Large T-Shirt(s) - <span class="qty"></span></td>
									<td class="text-left">$<span class="price">0.00</span></td>
								</tr>
								<tr id="xl-shirts">
									<td class="text-right" style="width:75%;">X-Large T-Shirt(s) - <span class="qty"></span></td>
									<td class="text-left">$<span class="price">0.00</span></td>
								</tr>
								<tr>
									<td class="text-right" style="width:75%;">Total</td>
									<td class="text-left">&nbsp;$<span id="grand-total">199.99</span></td>
								</tr>
							</table>
						</div>
					</div>
					
					@if(\Auth::user()->isAdmin())
					<div class="info-block">
						<h4>Recipient Info</h4>
						<div class="form-group">
							<div class="col-sm-6">
							<input type="text" name="recipient" class="form-control" placeholder="Recipient" required />
							</div>
							<div class="col-sm-6">
							<input type="text" name="email" class="form-control" placeholder="Email" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
							<input type="text" name="company" class="form-control" placeholder="Company" />
							</div>
	
							<div class="col-sm-6">
							<input type="text" name="phone" class="form-control" placeholder="Phone" />
							</div>
						</div>
					</div>
					<div class="info-block">
	            			<h4>Shipping Address</h4>
	            			<div class="form-group">
	            				<div class="col-sm-12">
															<input type="text" class="form-control" name="shipping_address_1" placeholder="Address Line 1" required />
	            				</div>
	            			</div>
	            			<div class="form-group">
	            				<div class="col-sm-12">
															<input type="text" class="form-control" name="shipping_address_2" placeholder="Address Line 2" />
	            				</div>
	            			</div>
	            			<div class="form-group">
	            				<div class="col-sm-6">
															<input type="text" class="form-control" name="shipping_city" placeholder="City" required />
	            				</div>
	            				<div class="col-sm-3">
	            					<select name="shipping_state" id="shipping_state" class="form-control">
									<option value="N/A">N/A</option>
									<option value="AL">Alabama</option>
									<option value="AK">Alaska</option>
									<option value="AZ">Arizona</option>
									<option value="AR">Arkansas</option>
									<option value="CA">California</option>
									<option value="CO">Colorado</option>
									<option value="CT">Connecticut</option>
									<option value="DE">Delaware</option>
									<option value="DC">District Of Columbia</option>
									<option value="FL">Florida</option>
									<option value="GA">Georgia</option>
									<option value="HI">Hawaii</option>
									<option value="ID">Idaho</option>
									<option value="IL">Illinois</option>
									<option value="IN">Indiana</option>
									<option value="IA">Iowa</option>
									<option value="KS">Kansas</option>
									<option value="KY">Kentucky</option>
									<option value="LA">Louisiana</option>
									<option value="ME">Maine</option>
									<option value="MD">Maryland</option>
									<option value="MA">Massachusetts</option>
									<option value="MI">Michigan</option>
									<option value="MN">Minnesota</option>
									<option value="MS">Mississippi</option>
									<option value="MO">Missouri</option>
									<option value="MT">Montana</option>
									<option value="NE">Nebraska</option>
									<option value="NV">Nevada</option>
									<option value="NH">New Hampshire</option>
									<option value="NJ">New Jersey</option>
									<option value="NM">New Mexico</option>
									<option value="NY">New York</option>
									<option value="NC">North Carolina</option>
									<option value="ND">North Dakota</option>
									<option value="OH">Ohio</option>
									<option value="OK">Oklahoma</option>
									<option value="OR">Oregon</option>
									<option value="PA">Pennsylvania</option>
									<option value="RI">Rhode Island</option>
									<option value="SC">South Carolina</option>
									<option value="SD">South Dakota</option>
									<option value="TN">Tennessee</option>
									<option value="TX">Texas</option>
									<option value="UT">Utah</option>
									<option value="VT">Vermont</option>
									<option value="VA">Virginia</option>
									<option value="WA">Washington</option>
									<option value="WV">West Virginia</option>
									<option value="WI">Wisconsin</option>
									<option value="WY">Wyoming</option>
									<option value=""></option>
									<option value="AB">Alberta</option>
									<option value="BC">British Columbia</option>
									<option value="MB">Manitoba</option>
									<option value="NB">New Brunswick</option>
									<option value="NL">Newfoundland and Labrador</option>
									<option value="NS">Nova Scotia</option>
									<option value="ON">Ontario</option>
									<option value="PE">Prince Edward Island</option>
									<option value="QC">Quebec</option>
									<option value="SK">Saskatchewan</option>
									<option value="NT">Northwest Territories</option>
									<option value="NU">Nunavut</option>
									<option value="YT">Yukon</option>
								</select>
	            				</div>
	            				<div class="col-sm-3">
	            					<input type="text" class="form-control" name="shipping_zip_code" placeholder="Zip Code" required />
	            				</div>
	            			</div>
					</div>
					@else
					<div class="info-block">
                        			<h4>Shipping Address</h4>
                        			<div class="form-group">
                        				<div class="col-sm-12">
																	<input type="text" class="form-control" name="shipping_address_1" value="{{ \Auth::user()->shipping_address_1 }}" placeholder="Address Line 1" required />
                        				</div>
                        			</div>
                        			<div class="form-group">
                        				<div class="col-sm-12">
																	<input type="text" class="form-control" name="shipping_address_2" value="{{ \Auth::user()->shipping_address_2 }}" placeholder="Address Line 2" />
                        				</div>
                        			</div>
                        			<div class="form-group">
                        				<div class="col-sm-6">
																	<input type="text" class="form-control" name="shipping_city" value="{{ \Auth::user()->shipping_city }}" placeholder="City" required />
                        				</div>
                        				<div class="col-sm-3">
                        					<select name="shipping_state" id="shipping_state" class="form-control">
																		<option value="N/A" {{ (Auth::user()->shipping_state == "N/A") ? "selected" : "" }}>N/A</option>
																		<option value="AL" {{ (Auth::user()->shipping_state == "AL") ? "selected" : "" }}>Alabama</option>
																		<option value="AK" {{ (Auth::user()->shipping_state == "AK") ? "selected" : "" }}>Alaska</option>
																		<option value="AZ" {{ (Auth::user()->shipping_state == "AZ") ? "selected" : "" }}>Arizona</option>
																		<option value="AR" {{ (Auth::user()->shipping_state == "AR") ? "selected" : "" }}>Arkansas</option>
																		<option value="CA" {{ (Auth::user()->shipping_state == "CA") ? "selected" : "" }}>California</option>
																		<option value="CO" {{ (Auth::user()->shipping_state == "CO") ? "selected" : "" }}>Colorado</option>
																		<option value="CT" {{ (Auth::user()->shipping_state == "CT") ? "selected" : "" }}>Connecticut</option>
																		<option value="DE" {{ (Auth::user()->shipping_state == "DE") ? "selected" : "" }}>Delaware</option>
																		<option value="DC" {{ (Auth::user()->shipping_state == "DC") ? "selected" : "" }}>District Of Columbia</option>
																		<option value="FL" {{ (Auth::user()->shipping_state == "FL") ? "selected" : "" }}>Florida</option>
																		<option value="GA" {{ (Auth::user()->shipping_state == "GA") ? "selected" : "" }}>Georgia</option>
																		<option value="HI" {{ (Auth::user()->shipping_state == "HI") ? "selected" : "" }}>Hawaii</option>
																		<option value="ID" {{ (Auth::user()->shipping_state == "ID") ? "selected" : "" }}>Idaho</option>
																		<option value="IL" {{ (Auth::user()->shipping_state == "IL") ? "selected" : "" }}>Illinois</option>
																		<option value="IN" {{ (Auth::user()->shipping_state == "IN") ? "selected" : "" }}>Indiana</option>
																		<option value="IA" {{ (Auth::user()->shipping_state == "IA") ? "selected" : "" }}>Iowa</option>
																		<option value="KS" {{ (Auth::user()->shipping_state == "KS") ? "selected" : "" }}>Kansas</option>
																		<option value="KY" {{ (Auth::user()->shipping_state == "KY") ? "selected" : "" }}>Kentucky</option>
																		<option value="LA" {{ (Auth::user()->shipping_state == "LA") ? "selected" : "" }}>Louisiana</option>
																		<option value="ME" {{ (Auth::user()->shipping_state == "ME") ? "selected" : "" }}>Maine</option>
																		<option value="MD" {{ (Auth::user()->shipping_state == "MD") ? "selected" : "" }}>Maryland</option>
																		<option value="MA" {{ (Auth::user()->shipping_state == "MA") ? "selected" : "" }}>Massachusetts</option>
																		<option value="MI" {{ (Auth::user()->shipping_state == "MI") ? "selected" : "" }}>Michigan</option>
																		<option value="MN" {{ (Auth::user()->shipping_state == "MN") ? "selected" : "" }}>Minnesota</option>
																		<option value="MS" {{ (Auth::user()->shipping_state == "MS") ? "selected" : "" }}>Mississippi</option>
																		<option value="MO" {{ (Auth::user()->shipping_state == "MO") ? "selected" : "" }}>Missouri</option>
																		<option value="MT" {{ (Auth::user()->shipping_state == "MT") ? "selected" : "" }}>Montana</option>
																		<option value="NE" {{ (Auth::user()->shipping_state == "NE") ? "selected" : "" }}>Nebraska</option>
																		<option value="NV" {{ (Auth::user()->shipping_state == "NV") ? "selected" : "" }}>Nevada</option>
																		<option value="NH" {{ (Auth::user()->shipping_state == "NH") ? "selected" : "" }}>New Hampshire</option>
																		<option value="NJ" {{ (Auth::user()->shipping_state == "NJ") ? "selected" : "" }}>New Jersey</option>
																		<option value="NM" {{ (Auth::user()->shipping_state == "NM") ? "selected" : "" }}>New Mexico</option>
																		<option value="NY" {{ (Auth::user()->shipping_state == "NY") ? "selected" : "" }}>New York</option>
																		<option value="NC" {{ (Auth::user()->shipping_state == "NC") ? "selected" : "" }}>North Carolina</option>
																		<option value="ND" {{ (Auth::user()->shipping_state == "ND") ? "selected" : "" }}>North Dakota</option>
																		<option value="OH" {{ (Auth::user()->shipping_state == "OH") ? "selected" : "" }}>Ohio</option>
																		<option value="OK" {{ (Auth::user()->shipping_state == "OK") ? "selected" : "" }}>Oklahoma</option>
																		<option value="OR" {{ (Auth::user()->shipping_state == "OR") ? "selected" : "" }}>Oregon</option>
																		<option value="PA" {{ (Auth::user()->shipping_state == "PA") ? "selected" : "" }}>Pennsylvania</option>
																		<option value="RI" {{ (Auth::user()->shipping_state == "RI") ? "selected" : "" }}>Rhode Island</option>
																		<option value="SC" {{ (Auth::user()->shipping_state == "SC") ? "selected" : "" }}>South Carolina</option>
																		<option value="SD" {{ (Auth::user()->shipping_state == "SD") ? "selected" : "" }}>South Dakota</option>
																		<option value="TN" {{ (Auth::user()->shipping_state == "TN") ? "selected" : "" }}>Tennessee</option>
																		<option value="TX" {{ (Auth::user()->shipping_state == "TX") ? "selected" : "" }}>Texas</option>
																		<option value="UT" {{ (Auth::user()->shipping_state == "UT") ? "selected" : "" }}>Utah</option>
																		<option value="VT" {{ (Auth::user()->shipping_state == "VT") ? "selected" : "" }}>Vermont</option>
																		<option value="VA" {{ (Auth::user()->shipping_state == "VA") ? "selected" : "" }}>Virginia</option>
																		<option value="WA" {{ (Auth::user()->shipping_state == "WA") ? "selected" : "" }}>Washington</option>
																		<option value="WV" {{ (Auth::user()->shipping_state == "WV") ? "selected" : "" }}>West Virginia</option>
																		<option value="WI" {{ (Auth::user()->shipping_state == "WI") ? "selected" : "" }}>Wisconsin</option>
																		<option value="WY" {{ (Auth::user()->shipping_state == "WY") ? "selected" : "" }}>Wyoming</option>
																		<option value=""></option>
																		<option {{ (Auth::user()->shipping_state == "AB") ? "selected" : "" }} value="AB">Alberta</option>
																		<option {{ (Auth::user()->shipping_state == "BC") ? "selected" : "" }} value="BC">British Columbia</option>
																		<option {{ (Auth::user()->shipping_state == "MB") ? "selected" : "" }} value="MB">Manitoba</option>
																		<option {{ (Auth::user()->shipping_state == "NB") ? "selected" : "" }} value="NB">New Brunswick</option>
																		<option {{ (Auth::user()->shipping_state == "NL") ? "selected" : "" }} value="NL">Newfoundland and Labrador</option>
																		<option {{ (Auth::user()->shipping_state == "NS") ? "selected" : "" }} value="NS">Nova Scotia</option>
																		<option {{ (Auth::user()->shipping_state == "ON") ? "selected" : "" }} value="ON">Ontario</option>
																		<option {{ (Auth::user()->shipping_state == "PE") ? "selected" : "" }} value="PE">Prince Edward Island</option>
																		<option {{ (Auth::user()->shipping_state == "QC") ? "selected" : "" }} value="QC">Quebec</option>
																		<option {{ (Auth::user()->shipping_state == "SK") ? "selected" : "" }} value="SK">Saskatchewan</option>
																		<option {{ (Auth::user()->shipping_state == "NT") ? "selected" : "" }} value="NT">Northwest Territories</option>
																		<option {{ (Auth::user()->shipping_state == "NU") ? "selected" : "" }} value="NU">Nunavut</option>
																		<option {{ (Auth::user()->shipping_state == "YT") ? "selected" : "" }} value="YT">Yukon</option>
																	</select>
                        				</div>
                        				<div class="col-sm-3">
                        					<input type="text" class="form-control" name="shipping_zip_code" value="{{ \Auth::user()->shipping_zip_code }}" placeholder="Zip Code" required />
                        				</div>
                        			</div>
                        			<h4>Payment Details</h4>
                        			<div class="form-group">
                        				<div class="col-sm-12">
																	<input type="text" class="form-control" name="card_number"  placeholder="Card Number" required />
                        				</div>
                        			</div>
                        			<div class="form-group">
                        				<div class="col-sm-4">
																	<input type="text" class="form-control" name="exp_month" placeholder="Exp. Month (MM)" required />
                        				</div>
                        				<div class="col-sm-4">
																	<input type="text" class="form-control" name="exp_year" placeholder="Exp. Year (YYYY)" required />
                        				</div>
                        				<div class="col-sm-4">
                        					<input type="text" class="form-control" name="cvc" placeholder="CVC Code" required />
                        				</div>
                        			</div>
                        		</div>
                        		
                    @endif
					
					<div class="row">
						<div class="col-xs-12">
							<button type="submit" class="btn btn-primary">Submit Order</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
	
@endsection