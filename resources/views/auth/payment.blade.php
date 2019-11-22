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
                    <form class="form-horizontal" role="form" method="POST" action="/register/payment">
                       {{ csrf_field() }}
                        
                       <h2>Shipping Address</h2>       
                       <p>If different than your school/site address, please update.</p>               
                        
                        <div class="form-group{{ $errors->has('shipping_name') ? ' has-error' : '' }}">
                            <label for="shipping_name" class="col-md-4 control-label">Shipping Name <span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="shipping_name" type="text" class="form-control" name="shipping_name" value="{{ Auth::user()->name }}" required>

                                @if ($errors->has('shipping_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shipping_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('shipping_address_1') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Address Line 1 <span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="shipping_address_1" value="{{ Auth::user()->site_address_1 }}" required>

                                @if ($errors->has('shipping_address_1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shipping_address_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('shipping_address_2') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Address Line 2</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="shipping_address_2" value="{{ Auth::user()->site_address_2 }}">

                                @if ($errors->has('shipping_address_2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shipping_address_2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('shipping_city') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">City <span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="shipping_city" value="{{ Auth::user()->site_city }}" required>

                                @if ($errors->has('shipping_city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shipping_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('shipping_state') ? ' has-error' : '' }}">
                            <label for="shipping_state" class="col-md-4 control-label">State <span class="required">*</span></label>

                            <div class="col-md-6">
                            		<select name="shipping_state" id="shipping_state" class="form-control">
																	<option value="N/A" {{ (Auth::user()->site_state == "N/A") ? "selected" : "" }}>N/A</option>
																	<option value="AL" {{ (Auth::user()->site_state == "AL") ? "selected" : "" }}>Alabama</option>
																	<option value="AK" {{ (Auth::user()->site_state == "AK") ? "selected" : "" }}>Alaska</option>
																	<option value="AZ" {{ (Auth::user()->site_state == "AZ") ? "selected" : "" }}>Arizona</option>
																	<option value="AR" {{ (Auth::user()->site_state == "AR") ? "selected" : "" }}>Arkansas</option>
																	<option value="CA" {{ (Auth::user()->site_state == "CA") ? "selected" : "" }}>California</option>
																	<option value="CO" {{ (Auth::user()->site_state == "CO") ? "selected" : "" }}>Colorado</option>
																	<option value="CT" {{ (Auth::user()->site_state == "CT") ? "selected" : "" }}>Connecticut</option>
																	<option value="DE" {{ (Auth::user()->site_state == "DE") ? "selected" : "" }}>Delaware</option>
																	<option value="DC" {{ (Auth::user()->site_state == "DC") ? "selected" : "" }}>District Of Columbia</option>
																	<option value="FL" {{ (Auth::user()->site_state == "FL") ? "selected" : "" }}>Florida</option>
																	<option value="GA" {{ (Auth::user()->site_state == "GA") ? "selected" : "" }}>Georgia</option>
																	<option value="HI" {{ (Auth::user()->site_state == "HI") ? "selected" : "" }}>Hawaii</option>
																	<option value="ID" {{ (Auth::user()->site_state == "ID") ? "selected" : "" }}>Idaho</option>
																	<option value="IL" {{ (Auth::user()->site_state == "IL") ? "selected" : "" }}>Illinois</option>
																	<option value="IN" {{ (Auth::user()->site_state == "IN") ? "selected" : "" }}>Indiana</option>
																	<option value="IA" {{ (Auth::user()->site_state == "IA") ? "selected" : "" }}>Iowa</option>
																	<option value="KS" {{ (Auth::user()->site_state == "KS") ? "selected" : "" }}>Kansas</option>
																	<option value="KY" {{ (Auth::user()->site_state == "KY") ? "selected" : "" }}>Kentucky</option>
																	<option value="LA" {{ (Auth::user()->site_state == "LA") ? "selected" : "" }}>Louisiana</option>
																	<option value="ME" {{ (Auth::user()->site_state == "ME") ? "selected" : "" }}>Maine</option>
																	<option value="MD" {{ (Auth::user()->site_state == "MD") ? "selected" : "" }}>Maryland</option>
																	<option value="MA" {{ (Auth::user()->site_state == "MA") ? "selected" : "" }}>Massachusetts</option>
																	<option value="MI" {{ (Auth::user()->site_state == "MI") ? "selected" : "" }}>Michigan</option>
																	<option value="MN" {{ (Auth::user()->site_state == "MN") ? "selected" : "" }}>Minnesota</option>
																	<option value="MS" {{ (Auth::user()->site_state == "MS") ? "selected" : "" }}>Mississippi</option>
																	<option value="MO" {{ (Auth::user()->site_state == "MO") ? "selected" : "" }}>Missouri</option>
																	<option value="MT" {{ (Auth::user()->site_state == "MT") ? "selected" : "" }}>Montana</option>
																	<option value="NE" {{ (Auth::user()->site_state == "NE") ? "selected" : "" }}>Nebraska</option>
																	<option value="NV" {{ (Auth::user()->site_state == "NV") ? "selected" : "" }}>Nevada</option>
																	<option value="NH" {{ (Auth::user()->site_state == "NH") ? "selected" : "" }}>New Hampshire</option>
																	<option value="NJ" {{ (Auth::user()->site_state == "NJ") ? "selected" : "" }}>New Jersey</option>
																	<option value="NM" {{ (Auth::user()->site_state == "NM") ? "selected" : "" }}>New Mexico</option>
																	<option value="NY" {{ (Auth::user()->site_state == "NY") ? "selected" : "" }}>New York</option>
																	<option value="NC" {{ (Auth::user()->site_state == "NC") ? "selected" : "" }}>North Carolina</option>
																	<option value="ND" {{ (Auth::user()->site_state == "ND") ? "selected" : "" }}>North Dakota</option>
																	<option value="OH" {{ (Auth::user()->site_state == "OH") ? "selected" : "" }}>Ohio</option>
																	<option value="OK" {{ (Auth::user()->site_state == "OK") ? "selected" : "" }}>Oklahoma</option>
																	<option value="OR" {{ (Auth::user()->site_state == "OR") ? "selected" : "" }}>Oregon</option>
																	<option value="PA" {{ (Auth::user()->site_state == "PA") ? "selected" : "" }}>Pennsylvania</option>
																	<option value="RI" {{ (Auth::user()->site_state == "RI") ? "selected" : "" }}>Rhode Island</option>
																	<option value="SC" {{ (Auth::user()->site_state == "SC") ? "selected" : "" }}>South Carolina</option>
																	<option value="SD" {{ (Auth::user()->site_state == "SD") ? "selected" : "" }}>South Dakota</option>
																	<option value="TN" {{ (Auth::user()->site_state == "TN") ? "selected" : "" }}>Tennessee</option>
																	<option value="TX" {{ (Auth::user()->site_state == "TX") ? "selected" : "" }}>Texas</option>
																	<option value="UT" {{ (Auth::user()->site_state == "UT") ? "selected" : "" }}>Utah</option>
																	<option value="VT" {{ (Auth::user()->site_state == "VT") ? "selected" : "" }}>Vermont</option>
																	<option value="VA" {{ (Auth::user()->site_state == "VA") ? "selected" : "" }}>Virginia</option>
																	<option value="WA" {{ (Auth::user()->site_state == "WA") ? "selected" : "" }}>Washington</option>
																	<option value="WV" {{ (Auth::user()->site_state == "WV") ? "selected" : "" }}>West Virginia</option>
																	<option value="WI" {{ (Auth::user()->site_state == "WI") ? "selected" : "" }}>Wisconsin</option>
																	<option value="WY" {{ (Auth::user()->site_state == "WY") ? "selected" : "" }}>Wyoming</option>
																</select>

                                @if ($errors->has('shipping_state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shipping_state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('shipping_zip_code') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Zip Code <span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="shipping_zip_code" value="{{ Auth::user()->site_zip_code }}" required>

                                @if ($errors->has('shipping_zip_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shipping_zip_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <hr>
                        
                        @if(!\Auth::user()->isFunded())
                        @if(\Auth::user()->discount_code != "LF100")
                        
                        <h2>Billing Address</h2> 
                        <p>If different than your school/site address, please update.</p>                      
                        
                        <div class="form-group{{ $errors->has('billing_address_1') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Address Line 1 <span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="billing_address_1" value="{{ Auth::user()->site_address_1 }}" required>

                                @if ($errors->has('billing_address_1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('billing_address_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('billing_address_2') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Address Line 2</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="billing_address_2" value="{{ Auth::user()->site_address_2 }}">

                                @if ($errors->has('billing_address_2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('billing_address_2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('billing_city') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">City <span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="billing_city" value="{{ Auth::user()->site_city }}" required>

                                @if ($errors->has('billing_city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('billing_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('billing_state') ? ' has-error' : '' }}">
                            <label for="billing_state" class="col-md-4 control-label">State <span class="required">*</span></label>

                            <div class="col-md-6">
                            		<select name="billing_state" id="billing_state" class="form-control">
																	<option value="N/A" {{ (Auth::user()->site_state == "N/A") ? "selected" : "" }}>N/A</option>
																	<option value="AL" {{ (Auth::user()->site_state == "AL") ? "selected" : "" }}>Alabama</option>
																	<option value="AK" {{ (Auth::user()->site_state == "AK") ? "selected" : "" }}>Alaska</option>
																	<option value="AZ" {{ (Auth::user()->site_state == "AZ") ? "selected" : "" }}>Arizona</option>
																	<option value="AR" {{ (Auth::user()->site_state == "AR") ? "selected" : "" }}>Arkansas</option>
																	<option value="CA" {{ (Auth::user()->site_state == "CA") ? "selected" : "" }}>California</option>
																	<option value="CO" {{ (Auth::user()->site_state == "CO") ? "selected" : "" }}>Colorado</option>
																	<option value="CT" {{ (Auth::user()->site_state == "CT") ? "selected" : "" }}>Connecticut</option>
																	<option value="DE" {{ (Auth::user()->site_state == "DE") ? "selected" : "" }}>Delaware</option>
																	<option value="DC" {{ (Auth::user()->site_state == "DC") ? "selected" : "" }}>District Of Columbia</option>
																	<option value="FL" {{ (Auth::user()->site_state == "FL") ? "selected" : "" }}>Florida</option>
																	<option value="GA" {{ (Auth::user()->site_state == "GA") ? "selected" : "" }}>Georgia</option>
																	<option value="HI" {{ (Auth::user()->site_state == "HI") ? "selected" : "" }}>Hawaii</option>
																	<option value="ID" {{ (Auth::user()->site_state == "ID") ? "selected" : "" }}>Idaho</option>
																	<option value="IL" {{ (Auth::user()->site_state == "IL") ? "selected" : "" }}>Illinois</option>
																	<option value="IN" {{ (Auth::user()->site_state == "IN") ? "selected" : "" }}>Indiana</option>
																	<option value="IA" {{ (Auth::user()->site_state == "IA") ? "selected" : "" }}>Iowa</option>
																	<option value="KS" {{ (Auth::user()->site_state == "KS") ? "selected" : "" }}>Kansas</option>
																	<option value="KY" {{ (Auth::user()->site_state == "KY") ? "selected" : "" }}>Kentucky</option>
																	<option value="LA" {{ (Auth::user()->site_state == "LA") ? "selected" : "" }}>Louisiana</option>
																	<option value="ME" {{ (Auth::user()->site_state == "ME") ? "selected" : "" }}>Maine</option>
																	<option value="MD" {{ (Auth::user()->site_state == "MD") ? "selected" : "" }}>Maryland</option>
																	<option value="MA" {{ (Auth::user()->site_state == "MA") ? "selected" : "" }}>Massachusetts</option>
																	<option value="MI" {{ (Auth::user()->site_state == "MI") ? "selected" : "" }}>Michigan</option>
																	<option value="MN" {{ (Auth::user()->site_state == "MN") ? "selected" : "" }}>Minnesota</option>
																	<option value="MS" {{ (Auth::user()->site_state == "MS") ? "selected" : "" }}>Mississippi</option>
																	<option value="MO" {{ (Auth::user()->site_state == "MO") ? "selected" : "" }}>Missouri</option>
																	<option value="MT" {{ (Auth::user()->site_state == "MT") ? "selected" : "" }}>Montana</option>
																	<option value="NE" {{ (Auth::user()->site_state == "NE") ? "selected" : "" }}>Nebraska</option>
																	<option value="NV" {{ (Auth::user()->site_state == "NV") ? "selected" : "" }}>Nevada</option>
																	<option value="NH" {{ (Auth::user()->site_state == "NH") ? "selected" : "" }}>New Hampshire</option>
																	<option value="NJ" {{ (Auth::user()->site_state == "NJ") ? "selected" : "" }}>New Jersey</option>
																	<option value="NM" {{ (Auth::user()->site_state == "NM") ? "selected" : "" }}>New Mexico</option>
																	<option value="NY" {{ (Auth::user()->site_state == "NY") ? "selected" : "" }}>New York</option>
																	<option value="NC" {{ (Auth::user()->site_state == "NC") ? "selected" : "" }}>North Carolina</option>
																	<option value="ND" {{ (Auth::user()->site_state == "ND") ? "selected" : "" }}>North Dakota</option>
																	<option value="OH" {{ (Auth::user()->site_state == "OH") ? "selected" : "" }}>Ohio</option>
																	<option value="OK" {{ (Auth::user()->site_state == "OK") ? "selected" : "" }}>Oklahoma</option>
																	<option value="OR" {{ (Auth::user()->site_state == "OR") ? "selected" : "" }}>Oregon</option>
																	<option value="PA" {{ (Auth::user()->site_state == "PA") ? "selected" : "" }}>Pennsylvania</option>
																	<option value="RI" {{ (Auth::user()->site_state == "RI") ? "selected" : "" }}>Rhode Island</option>
																	<option value="SC" {{ (Auth::user()->site_state == "SC") ? "selected" : "" }}>South Carolina</option>
																	<option value="SD" {{ (Auth::user()->site_state == "SD") ? "selected" : "" }}>South Dakota</option>
																	<option value="TN" {{ (Auth::user()->site_state == "TN") ? "selected" : "" }}>Tennessee</option>
																	<option value="TX" {{ (Auth::user()->site_state == "TX") ? "selected" : "" }}>Texas</option>
																	<option value="UT" {{ (Auth::user()->site_state == "UT") ? "selected" : "" }}>Utah</option>
																	<option value="VT" {{ (Auth::user()->site_state == "VT") ? "selected" : "" }}>Vermont</option>
																	<option value="VA" {{ (Auth::user()->site_state == "VA") ? "selected" : "" }}>Virginia</option>
																	<option value="WA" {{ (Auth::user()->site_state == "WA") ? "selected" : "" }}>Washington</option>
																	<option value="WV" {{ (Auth::user()->site_state == "WV") ? "selected" : "" }}>West Virginia</option>
																	<option value="WI" {{ (Auth::user()->site_state == "WI") ? "selected" : "" }}>Wisconsin</option>
																	<option value="WY" {{ (Auth::user()->site_state == "WY") ? "selected" : "" }}>Wyoming</option>
																</select>

                                @if ($errors->has('billing_state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('billing_state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('billing_zip_code') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Zip Code <span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="billing_zip_code" value="{{ Auth::user()->site_zip_code }}" required>

                                @if ($errors->has('billing_zip_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('billing_zip_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h2>Payment Details</h2>
                        
                        <div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
                            <label for="discount" class="col-md-4 control-label">Payment Type</label>
														
                            <div class="col-md-6">
                                <select name="payment-type" class="form-control">
	                                <option value="card">Credit/Debit Card</option>
	                                <option value="po">Purchase Order</option>
                                </select>
                            </div>
                        </div>
                        
                        <div id="card">
                        <div class="form-group{{ $errors->has('card_number') ? ' has-error' : '' }}">
                            <label for="card_number" class="col-md-4 control-label">Card Number</label>

                            <div class="col-md-6">
                                <input id="card_number" type="text" class="form-control" name="card_number" value="{{ old('card_number') }}">

                                @if ($errors->has('card_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('card_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                     
												<div class="form-group{{ $errors->has('exp_month') ? ' has-error' : '' }}">
                            <label for="exp_month" class="col-md-4 control-label">Exp Month (MM)</label>

                            <div class="col-md-6">
                                <input id="exp_month" type="text" class="form-control" name="exp_month" value="{{ old('exp_month') }}">

                                @if ($errors->has('exp_month'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('exp_month') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('exp_year') ? ' has-error' : '' }}">
                            <label for="exp_year" class="col-md-4 control-label">Exp Year (YYYY)</label>

                            <div class="col-md-6">
                                <input id="exp_year" type="text" class="form-control" name="exp_year" value="{{ old('exp_year') }}">

                                @if ($errors->has('exp_year'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('exp_year') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('cvc') ? ' has-error' : '' }}">
                            <label for="cvc" class="col-md-4 control-label">CVC</label>

                            <div class="col-md-6">
                                <input id="cvc" type="text" class="form-control" name="cvc" value="{{ old('cvc') }}">

                                @if ($errors->has('cvc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cvc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        </div>
                        
                        @endif                  
                        
                        @endif
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary disable-after">
                                    Continue
                                </button>
                            </div>
                        </div>
												                     
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".disable-after").on("click", function(){
			$(this).attr("disabled","disabled");
			$(this).html("<i class='fa fa-spinner fa-spin'></i>");
		});
		
		$("select[name='payment-type']").on("change", function(){
			if($(this).val() == "card"){
				$("#card").slideDown(400);
			} else {
				$("#card").slideUp(400);
			}
		});
	});
</script>

@endsection