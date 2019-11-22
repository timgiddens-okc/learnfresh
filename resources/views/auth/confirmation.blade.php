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
                    <form class="form-horizontal" role="form" method="POST" action="/register/confirmation">
                        {{ csrf_field() }}
    
                        <h2>Confirmation</h2>
                        
                        <p>Thank you for registering for MyLFCA! Please verify your shipping address as your games will be shipped to your submitted address. {{ (!\Auth::user()->isFunded()) ? "You should receive a receipt for your registration fee. " : "" }}We thank you for joining us this season! </p>
                        
                        <div class="row">
                        	<div class="col-sm-12 col-md-4">
                        		<div class="info-block">
                        			<h6>Account Level</h6>
															<p>{{ ucwords(\Auth::user()->account_level) }}</p>
                        		</div>
                        		<div class="info-block">
                        			<h6>Name</h6>
															<p>{{ \Auth::user()->name }}</p>
                        		</div>
                        		<div class="info-block">
                        			<h6>Email</h6>
															<p>{{ \Auth::user()->email }}</p>
                        		</div>
                        		<div class="info-block">
                        			<h6>Phone</h6>
															<p>{{ \Auth::user()->phone }}</p>
                        		</div>
                        		<div class="info-block">
                        			<h6>Estimated Students</h6>
															<p>{{ \Auth::user()->estimated_students }}</p>
                        		</div>
                        		<div class="info-block">
                        			<h6>School/Program Name</h6>
															<p>{{ \Auth::user()->school_program_name }}</p>
                        		</div>
                        		<div class="info-block">
                        			<h6>School/Program Address</h6>
															<p>
																{{ \Auth::user()->site_address_1 }}
																@if(\Auth::user()->site_address_2)
																<br>{{ \Auth::user()->site_address_2 }}
																@endif
																<br>{{ \Auth::user()->site_city }}, {{ \Auth::user()->site_state }} {{ \Auth::user()->site_zip_code }}
																<br>{{ \Auth::user()->country }}
															</p>
                        		</div>
                        		@if(!\Auth::user()->isFunded() && \Auth::user()->discount_code != "LF100")
                        		<div class="info-block">
                        			<h6>Billing Address</h6>
															<p>
																{{ \Auth::user()->billing_address_1 }}
																@if(\Auth::user()->billing_address_2)
																<br>{{ \Auth::user()->billing_address_2 }}
																@endif
																<br>{{ \Auth::user()->billing_city }}, {{ \Auth::user()->billing_state }} {{ \Auth::user()->billing_zip_code }}
															</p>
                        		</div>
                        		@endif
                        	</div>
                        	<div class="col-sm-12 col-md-8">
                        		<div class="info-block">
                        			<h6>Shipping Address</h6>
                        			<div class="form-group">
                        				<div class="col-sm-12">
																	<input type="text" class="form-control" name="shipping_name" value="{{ \Auth::user()->shipping_name }}" placeholder="Shipping Name" />
                        				</div>
                        			</div>
                        			<div class="form-group">
                        				<div class="col-sm-12">
																	<input type="text" class="form-control" name="shipping_address_1" value="{{ \Auth::user()->shipping_address_1 }}" placeholder="Address Line 1" />
                        				</div>
                        			</div>
                        			<div class="form-group">
                        				<div class="col-sm-12">
																	<input type="text" class="form-control" name="shipping_address_2" value="{{ \Auth::user()->shipping_address_2 }}" placeholder="Address Line 2" />
                        				</div>
                        			</div>
                        			<div class="form-group">
                        				<div class="col-sm-6">
																	<input type="text" class="form-control" name="shipping_city" value="{{ \Auth::user()->shipping_city }}" placeholder="City" />
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
                        					<input type="text" class="form-control" name="shipping_zip_code" value="{{ \Auth::user()->shipping_zip_code }}" placeholder="Zip Code" />
                        				</div>
                        			</div>
                        		</div>
                        	</div>
                        </div>
                                       
                        <div class="row">
                        	<div class="col-sm-12 text-right">
                        		<button type="submit" class="btn btn-primary">Finalize</button>
                        	</div>
                        </div>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection