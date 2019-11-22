@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="page-header">
			<h1>Settings</h1>
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
			<form action="/settings" method="post">
				<div class="col-sm-12 col-md-6">
					<h3>Basic Information</h3>
					
						{{ method_field('patch') }}
						{{ csrf_field() }}
						
						<div class="form-group">
							<label id="name">Name</label>
							<input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}" />
						</div>
						
						<div class="form-group">
							<label id="email">Email</label>
							<input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" />
						</div>
						
						<div class="form-group">
							<label id="phone">Phone</label>
							<input type="text" name="phone" id="phone" class="form-control" value="{{ Auth::user()->phone }}" />
						</div>
						
						<h3>Site Information</h3>
						
						<div class="form-group">
							<label id="site">School/Program Name</label>
							<input type="text" name="school_program_name" id="site" class="form-control" value="{{ Auth::user()->school_program_name }}" />
						</div>
						
						<div class="form-group">
							<label id="site_address_1">Site Address Line 1</label>
							<input type="text" name="site_address_1" id="site_address_1" class="form-control" value="{{ Auth::user()->site_address_1 }}" />
						</div>
						
						<div class="form-group">
							<label id="site_address_2">Site Address Line 2</label>
							<input type="text" name="site_address_2" id="site_address_2" class="form-control" value="{{ Auth::user()->site_address_2 }}" />
						</div>
						
						<div class="form-group">
							<label id="site_city">City</label>
							<input type="text" name="site_city" id="site_city" class="form-control" value="{{ Auth::user()->site_city }}" />
						</div>
						
						<div class="form-group">
							<label id="site_state">State/Province</label>
							<select name="site_state" id="site_state" class="form-control">
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
								<option value=""></option>
								<option {{ (Auth::user()->site_state == "AB") ? "selected" : "" }} value="AB">Alberta</option>
								<option {{ (Auth::user()->site_state == "BC") ? "selected" : "" }} value="BC">British Columbia</option>
								<option {{ (Auth::user()->site_state == "MB") ? "selected" : "" }} value="MB">Manitoba</option>
								<option {{ (Auth::user()->site_state == "NB") ? "selected" : "" }} value="NB">New Brunswick</option>
								<option {{ (Auth::user()->site_state == "NL") ? "selected" : "" }} value="NL">Newfoundland and Labrador</option>
								<option {{ (Auth::user()->site_state == "NS") ? "selected" : "" }} value="NS">Nova Scotia</option>
								<option {{ (Auth::user()->site_state == "ON") ? "selected" : "" }} value="ON">Ontario</option>
								<option {{ (Auth::user()->site_state == "PE") ? "selected" : "" }} value="PE">Prince Edward Island</option>
								<option {{ (Auth::user()->site_state == "QC") ? "selected" : "" }} value="QC">Quebec</option>
								<option {{ (Auth::user()->site_state == "SK") ? "selected" : "" }} value="SK">Saskatchewan</option>
								<option {{ (Auth::user()->site_state == "NT") ? "selected" : "" }} value="NT">Northwest Territories</option>
								<option {{ (Auth::user()->site_state == "NU") ? "selected" : "" }} value="NU">Nunavut</option>
								<option {{ (Auth::user()->site_state == "YT") ? "selected" : "" }} value="YT">Yukon</option>
							</select>
						</div>
						
						<div class="form-group">
							<label id="site_zip_code">Zip Code</label>
							<input type="text" name="site_zip_code" id="site_zip_code" class="form-control" value="{{ Auth::user()->site_zip_code }}" />
						</div>
					
				</div>
				<div class="col-sm-12 col-md-6">
					<h3>Shipping Information</h3>
					
					<div class="form-group">
						<label id="shipping_name">Shipping Name</label>
						<input type="text" name="shipping_name" id="shipping_name" class="form-control" value="{{ Auth::user()->shipping_name }}" />
					</div>
					
					<div class="form-group">
						<label id="shipping_address_1">Shipping Address Line 1</label>
						<input type="text" name="shipping_address_1" id="shipping_address_1" class="form-control" value="{{ Auth::user()->shipping_address_1 }}" />
					</div>
					
					<div class="form-group">
						<label id="shipping_address_2">Shipping Address Line 2</label>
						<input type="text" name="shipping_address_2" id="shipping_address_2" class="form-control" value="{{ Auth::user()->shipping_address_2 }}" />
					</div>
					
					<div class="form-group">
						<label id="shipping_city">City</label>
						<input type="text" name="shipping_city" id="shipping_city" class="form-control" value="{{ Auth::user()->shipping_city }}" />
					</div>
					
					<div class="form-group">
						<label id="shipping_state">State/Province</label>
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
					
					<div class="form-group">
						<label id="country">Country</label>
						<select name="country" id="country" class="form-control">
							<option value="USA" {{ (Auth::user()->country == "USA") ? "selected" : "" }}>United States</option>
							<option value="AFG" {{ (Auth::user()->country == "AFG") ? "selected" : "" }}>Afghanistan</option>
							<option value="ALA" {{ (Auth::user()->country == "ALA") ? "selected" : "" }}>Åland Islands</option>
							<option value="ALB" {{ (Auth::user()->country == "ALB") ? "selected" : "" }}>Albania</option>
							<option value="DZA" {{ (Auth::user()->country == "DZA") ? "selected" : "" }}>Algeria</option>
							<option value="ASM" {{ (Auth::user()->country == "ASM") ? "selected" : "" }}>American Samoa</option>
							<option value="AND" {{ (Auth::user()->country == "AND") ? "selected" : "" }}>Andorra</option>
							<option value="AGO" {{ (Auth::user()->country == "AGO") ? "selected" : "" }}>Angola</option>
							<option value="AIA" {{ (Auth::user()->country == "AIA") ? "selected" : "" }}>Anguilla</option>
							<option value="ATA" {{ (Auth::user()->country == "ATA") ? "selected" : "" }}>Antarctica</option>
							<option value="ATG" {{ (Auth::user()->country == "ATG") ? "selected" : "" }}>Antigua and Barbuda</option>
							<option value="ARG" {{ (Auth::user()->country == "ARG") ? "selected" : "" }}>Argentina</option>
							<option value="ARM" {{ (Auth::user()->country == "ARM") ? "selected" : "" }}>Armenia</option>
							<option value="ABW" {{ (Auth::user()->country == "ABW") ? "selected" : "" }}>Aruba</option>
							<option value="AUS" {{ (Auth::user()->country == "AUS") ? "selected" : "" }}>Australia</option>
							<option value="AUT" {{ (Auth::user()->country == "AUT") ? "selected" : "" }}>Austria</option>
							<option value="AZE" {{ (Auth::user()->country == "AZE") ? "selected" : "" }}>Azerbaijan</option>
							<option value="BHS" {{ (Auth::user()->country == "BHS") ? "selected" : "" }}>Bahamas</option>
							<option value="BHR" {{ (Auth::user()->country == "BHR") ? "selected" : "" }}>Bahrain</option>
							<option value="BGD" {{ (Auth::user()->country == "BGD") ? "selected" : "" }}>Bangladesh</option>
							<option value="BRB" {{ (Auth::user()->country == "BRB") ? "selected" : "" }}>Barbados</option>
							<option value="BLR" {{ (Auth::user()->country == "BLR") ? "selected" : "" }}>Belarus</option>
							<option value="BEL" {{ (Auth::user()->country == "BEL") ? "selected" : "" }}>Belgium</option>
							<option value="BLZ" {{ (Auth::user()->country == "BLZ") ? "selected" : "" }}>Belize</option>
							<option value="BEN" {{ (Auth::user()->country == "BEM") ? "selected" : "" }}>Benin</option>
							<option value="BMU" {{ (Auth::user()->country == "BMU") ? "selected" : "" }}>Bermuda</option>
							<option value="BTN" {{ (Auth::user()->country == "BTN") ? "selected" : "" }}>Bhutan</option>
							<option value="BOL" {{ (Auth::user()->country == "BOL") ? "selected" : "" }}>Bolivia, Plurinational State of</option>
							<option value="BES" {{ (Auth::user()->country == "BES") ? "selected" : "" }}>Bonaire, Sint Eustatius and Saba</option>
							<option value="BIH" {{ (Auth::user()->country == "BIH") ? "selected" : "" }}>Bosnia and Herzegovina</option>
							<option value="BWA" {{ (Auth::user()->country == "BWA") ? "selected" : "" }}>Botswana</option>
							<option value="BVT" {{ (Auth::user()->country == "BVT") ? "selected" : "" }}>Bouvet Island</option>
							<option value="BRA" {{ (Auth::user()->country == "BRA") ? "selected" : "" }}>Brazil</option>
							<option value="IOT" {{ (Auth::user()->country == "IOT") ? "selected" : "" }}>British Indian Ocean Territory</option>
							<option value="BRN" {{ (Auth::user()->country == "BRN") ? "selected" : "" }}>Brunei Darussalam</option>
							<option value="BGR" {{ (Auth::user()->country == "BGR") ? "selected" : "" }}>Bulgaria</option>
							<option value="BFA" {{ (Auth::user()->country == "BFA") ? "selected" : "" }}>Burkina Faso</option>
							<option value="BDI" {{ (Auth::user()->country == "BDI") ? "selected" : "" }}>Burundi</option>
							<option value="KHM" {{ (Auth::user()->country == "KHM") ? "selected" : "" }}>Cambodia</option>
							<option value="CMR" {{ (Auth::user()->country == "CMR") ? "selected" : "" }}>Cameroon</option>
							<option value="CAN" {{ (Auth::user()->country == "CAN") ? "selected" : "" }}>Canada</option>
							<option value="CPV" {{ (Auth::user()->country == "CPV") ? "selected" : "" }}>Cape Verde</option>
							<option value="CYM" {{ (Auth::user()->country == "CYM") ? "selected" : "" }}>Cayman Islands</option>
							<option value="CAF" {{ (Auth::user()->country == "CAF") ? "selected" : "" }}>Central African Republic</option>
							<option value="TCD" {{ (Auth::user()->country == "TCD") ? "selected" : "" }}>Chad</option>
							<option value="CHL" {{ (Auth::user()->country == "CHL") ? "selected" : "" }}>Chile</option>
							<option value="CHN" {{ (Auth::user()->country == "CHN") ? "selected" : "" }}>China</option>
							<option value="CXR" {{ (Auth::user()->country == "CXR") ? "selected" : "" }}>Christmas Island</option>
							<option value="CCK" {{ (Auth::user()->country == "CCK") ? "selected" : "" }}>Cocos (Keeling) Islands</option>
							<option value="COL" {{ (Auth::user()->country == "COL") ? "selected" : "" }}>Colombia</option>
							<option value="COM" {{ (Auth::user()->country == "COM") ? "selected" : "" }}>Comoros</option>
							<option value="COG" {{ (Auth::user()->country == "COG") ? "selected" : "" }}>Congo</option>
							<option value="COD" {{ (Auth::user()->country == "COD") ? "selected" : "" }}>Congo, the Democratic Republic of the</option>
							<option value="COK" {{ (Auth::user()->country == "COK") ? "selected" : "" }}>Cook Islands</option>
							<option value="CRI" {{ (Auth::user()->country == "CRI") ? "selected" : "" }}>Costa Rica</option>
							<option value="CIV" {{ (Auth::user()->country == "CIV") ? "selected" : "" }}>Côte d'Ivoire</option>
							<option value="HRV" {{ (Auth::user()->country == "HRV") ? "selected" : "" }}>Croatia</option>
							<option value="CUB" {{ (Auth::user()->country == "CUB") ? "selected" : "" }}>Cuba</option>
							<option value="CUW" {{ (Auth::user()->country == "CUW") ? "selected" : "" }}>Curaçao</option>
							<option value="CYP" {{ (Auth::user()->country == "CYP") ? "selected" : "" }}>Cyprus</option>
							<option value="CZE" {{ (Auth::user()->country == "CZE") ? "selected" : "" }}>Czech Republic</option>
							<option value="DNK" {{ (Auth::user()->country == "DNK") ? "selected" : "" }}>Denmark</option>
							<option value="DJI" {{ (Auth::user()->country == "DJI") ? "selected" : "" }}>Djibouti</option>
							<option value="DMA" {{ (Auth::user()->country == "DMA") ? "selected" : "" }}>Dominica</option>
							<option value="DOM" {{ (Auth::user()->country == "DOM") ? "selected" : "" }}>Dominican Republic</option>
							<option value="ECU" {{ (Auth::user()->country == "ECU") ? "selected" : "" }}>Ecuador</option>
							<option value="EGY" {{ (Auth::user()->country == "EGY") ? "selected" : "" }}>Egypt</option>
							<option value="SLV" {{ (Auth::user()->country == "SLC") ? "selected" : "" }}>El Salvador</option>
							<option value="GNQ" {{ (Auth::user()->country == "GNQ") ? "selected" : "" }}>Equatorial Guinea</option>
							<option value="ERI" {{ (Auth::user()->country == "ERI") ? "selected" : "" }}>Eritrea</option>
							<option value="EST" {{ (Auth::user()->country == "EST") ? "selected" : "" }}>Estonia</option>
							<option value="ETH" {{ (Auth::user()->country == "ETH") ? "selected" : "" }}>Ethiopia</option>
							<option value="FLK" {{ (Auth::user()->country == "FLK") ? "selected" : "" }}>Falkland Islands (Malvinas)</option>
							<option value="FRO" {{ (Auth::user()->country == "FRO") ? "selected" : "" }}>Faroe Islands</option>
							<option value="FJI" {{ (Auth::user()->country == "FJI") ? "selected" : "" }}>Fiji</option>
							<option value="FIN" {{ (Auth::user()->country == "FIN") ? "selected" : "" }}>Finland</option>
							<option value="FRA" {{ (Auth::user()->country == "FRA") ? "selected" : "" }}>France</option>
							<option value="GUF" {{ (Auth::user()->country == "GUF") ? "selected" : "" }}>French Guiana</option>
							<option value="PYF" {{ (Auth::user()->country == "PYF") ? "selected" : "" }}>French Polynesia</option>
							<option value="ATF" {{ (Auth::user()->country == "ATF") ? "selected" : "" }}>French Southern Territories</option>
							<option value="GAB" {{ (Auth::user()->country == "FAB") ? "selected" : "" }}>Gabon</option>
							<option value="GMB" {{ (Auth::user()->country == "GMB") ? "selected" : "" }}>Gambia</option>
							<option value="GEO" {{ (Auth::user()->country == "GEO") ? "selected" : "" }}>Georgia</option>
							<option value="DEU" {{ (Auth::user()->country == "DEU") ? "selected" : "" }}>Germany</option>
							<option value="GHA" {{ (Auth::user()->country == "GHA") ? "selected" : "" }}>Ghana</option>
							<option value="GIB" {{ (Auth::user()->country == "GIB") ? "selected" : "" }}>Gibraltar</option>
							<option value="GRC" {{ (Auth::user()->country == "GRC") ? "selected" : "" }}>Greece</option>
							<option value="GRL" {{ (Auth::user()->country == "GRL") ? "selected" : "" }}>Greenland</option>
							<option value="GRD" {{ (Auth::user()->country == "GRD") ? "selected" : "" }}>Grenada</option>
							<option value="GLP" {{ (Auth::user()->country == "GLP") ? "selected" : "" }}>Guadeloupe</option>
							<option value="GUM" {{ (Auth::user()->country == "GUM") ? "selected" : "" }}>Guam</option>
							<option value="GTM" {{ (Auth::user()->country == "GTM") ? "selected" : "" }}>Guatemala</option>
							<option value="GGY" {{ (Auth::user()->country == "GGY") ? "selected" : "" }}>Guernsey</option>
							<option value="GIN" {{ (Auth::user()->country == "GIN") ? "selected" : "" }}>Guinea</option>
							<option value="GNB" {{ (Auth::user()->country == "GNB") ? "selected" : "" }}>Guinea-Bissau</option>
							<option value="GUY" {{ (Auth::user()->country == "GUY") ? "selected" : "" }}>Guyana</option>
							<option value="HTI" {{ (Auth::user()->country == "HTI") ? "selected" : "" }}>Haiti</option>
							<option value="HMD" {{ (Auth::user()->country == "HMD") ? "selected" : "" }}>Heard Island and McDonald Islands</option>
							<option value="VAT" {{ (Auth::user()->country == "VAT") ? "selected" : "" }}>Holy See (Vatican City State)</option>
							<option value="HND" {{ (Auth::user()->country == "HND") ? "selected" : "" }}>Honduras</option>
							<option value="HKG" {{ (Auth::user()->country == "HKG") ? "selected" : "" }}>Hong Kong</option>
							<option value="HUN" {{ (Auth::user()->country == "HUN") ? "selected" : "" }}>Hungary</option>
							<option value="ISL" {{ (Auth::user()->country == "ISL") ? "selected" : "" }}>Iceland</option>
							<option value="IND" {{ (Auth::user()->country == "IND") ? "selected" : "" }}>India</option>
							<option value="IDN" {{ (Auth::user()->country == "IDN") ? "selected" : "" }}>Indonesia</option>
							<option value="IRN" {{ (Auth::user()->country == "IRN") ? "selected" : "" }}>Iran, Islamic Republic of</option>
							<option value="IRQ" {{ (Auth::user()->country == "IRQ") ? "selected" : "" }}>Iraq</option>
							<option value="IRL" {{ (Auth::user()->country == "IRL") ? "selected" : "" }}>Ireland</option>
							<option value="IMN" {{ (Auth::user()->country == "IMN") ? "selected" : "" }}>Isle of Man</option>
							<option value="ISR" {{ (Auth::user()->country == "ISR") ? "selected" : "" }}>Israel</option>
							<option value="ITA" {{ (Auth::user()->country == "ITA") ? "selected" : "" }}>Italy</option>
							<option value="JAM" {{ (Auth::user()->country == "JAM") ? "selected" : "" }}>Jamaica</option>
							<option value="JPN" {{ (Auth::user()->country == "JPN") ? "selected" : "" }}>Japan</option>
							<option value="JEY" {{ (Auth::user()->country == "JEY") ? "selected" : "" }}>Jersey</option>
							<option value="JOR" {{ (Auth::user()->country == "JOR") ? "selected" : "" }}>Jordan</option>
							<option value="KAZ" {{ (Auth::user()->country == "KAZ") ? "selected" : "" }}>Kazakhstan</option>
							<option value="KEN" {{ (Auth::user()->country == "KEN") ? "selected" : "" }}>Kenya</option>
							<option value="KIR" {{ (Auth::user()->country == "KIR") ? "selected" : "" }}>Kiribati</option>
							<option value="PRK" {{ (Auth::user()->country == "PRK") ? "selected" : "" }}>Korea, Democratic People's Republic of</option>
							<option value="KOR" {{ (Auth::user()->country == "KOR") ? "selected" : "" }}>Korea, Republic of</option>
							<option value="KWT" {{ (Auth::user()->country == "KWT") ? "selected" : "" }}>Kuwait</option>
							<option value="KGZ" {{ (Auth::user()->country == "KGZ") ? "selected" : "" }}>Kyrgyzstan</option>
							<option value="LAO" {{ (Auth::user()->country == "LAO") ? "selected" : "" }}>Lao People's Democratic Republic</option>
							<option value="LVA" {{ (Auth::user()->country == "LVA") ? "selected" : "" }}>Latvia</option>
							<option value="LBN" {{ (Auth::user()->country == "LBN") ? "selected" : "" }}>Lebanon</option>
							<option value="LSO" {{ (Auth::user()->country == "LSO") ? "selected" : "" }}>Lesotho</option>
							<option value="LBR" {{ (Auth::user()->country == "LBR") ? "selected" : "" }}>Liberia</option>
							<option value="LBY" {{ (Auth::user()->country == "LBY") ? "selected" : "" }}>Libya</option>
							<option value="LIE" {{ (Auth::user()->country == "LIE") ? "selected" : "" }}>Liechtenstein</option>
							<option value="LTU" {{ (Auth::user()->country == "LTU") ? "selected" : "" }}>Lithuania</option>
							<option value="LUX" {{ (Auth::user()->country == "LUX") ? "selected" : "" }}>Luxembourg</option>
							<option value="MAC" {{ (Auth::user()->country == "MAC") ? "selected" : "" }}>Macao</option>
							<option value="MKD" {{ (Auth::user()->country == "MKD") ? "selected" : "" }}>Macedonia, the former Yugoslav Republic of</option>
							<option value="MDG" {{ (Auth::user()->country == "MDG") ? "selected" : "" }}>Madagascar</option>
							<option value="MWI" {{ (Auth::user()->country == "MWI") ? "selected" : "" }}>Malawi</option>
							<option value="MYS" {{ (Auth::user()->country == "MYS") ? "selected" : "" }}>Malaysia</option>
							<option value="MDV" {{ (Auth::user()->country == "MDV") ? "selected" : "" }}>Maldives</option>
							<option value="MLI" {{ (Auth::user()->country == "MLI") ? "selected" : "" }}>Mali</option>
							<option value="MLT" {{ (Auth::user()->country == "MLT") ? "selected" : "" }}>Malta</option>
							<option value="MHL" {{ (Auth::user()->country == "MHL") ? "selected" : "" }}>Marshall Islands</option>
							<option value="MTQ" {{ (Auth::user()->country == "MTQ") ? "selected" : "" }}>Martinique</option>
							<option value="MRT" {{ (Auth::user()->country == "MRT") ? "selected" : "" }}>Mauritania</option>
							<option value="MUS" {{ (Auth::user()->country == "MUS") ? "selected" : "" }}>Mauritius</option>
							<option value="MYT" {{ (Auth::user()->country == "MYT") ? "selected" : "" }}>Mayotte</option>
							<option value="MEX" {{ (Auth::user()->country == "MEX") ? "selected" : "" }}>Mexico</option>
							<option value="FSM" {{ (Auth::user()->country == "FXM") ? "selected" : "" }}>Micronesia, Federated States of</option>
							<option value="MDA" {{ (Auth::user()->country == "MDA") ? "selected" : "" }}>Moldova, Republic of</option>
							<option value="MCO" {{ (Auth::user()->country == "MCO") ? "selected" : "" }}>Monaco</option>
							<option value="MNG" {{ (Auth::user()->country == "MNG") ? "selected" : "" }}>Mongolia</option>
							<option value="MNE" {{ (Auth::user()->country == "MNE") ? "selected" : "" }}>Montenegro</option>
							<option value="MSR" {{ (Auth::user()->country == "MSR") ? "selected" : "" }}>Montserrat</option>
							<option value="MAR" {{ (Auth::user()->country == "MAR") ? "selected" : "" }}>Morocco</option>
							<option value="MOZ" {{ (Auth::user()->country == "MOZ") ? "selected" : "" }}>Mozambique</option>
							<option value="MMR" {{ (Auth::user()->country == "MMR") ? "selected" : "" }}>Myanmar</option>
							<option value="NAM" {{ (Auth::user()->country == "NAM") ? "selected" : "" }}>Namibia</option>
							<option value="NRU" {{ (Auth::user()->country == "NRU") ? "selected" : "" }}>Nauru</option>
							<option value="NPL" {{ (Auth::user()->country == "NPL") ? "selected" : "" }}>Nepal</option>
							<option value="NLD" {{ (Auth::user()->country == "NLD") ? "selected" : "" }}>Netherlands</option>
							<option value="NCL" {{ (Auth::user()->country == "NCL") ? "selected" : "" }}>New Caledonia</option>
							<option value="NZL" {{ (Auth::user()->country == "NZL") ? "selected" : "" }}>New Zealand</option>
							<option value="NIC" {{ (Auth::user()->country == "NIC") ? "selected" : "" }}>Nicaragua</option>
							<option value="NER" {{ (Auth::user()->country == "NER") ? "selected" : "" }}>Niger</option>
							<option value="NGA" {{ (Auth::user()->country == "NGA") ? "selected" : "" }}>Nigeria</option>
							<option value="NIU" {{ (Auth::user()->country == "NIU") ? "selected" : "" }}>Niue</option>
							<option value="NFK" {{ (Auth::user()->country == "NFK") ? "selected" : "" }}>Norfolk Island</option>
							<option value="MNP" {{ (Auth::user()->country == "MNP") ? "selected" : "" }}>Northern Mariana Islands</option>
							<option value="NOR" {{ (Auth::user()->country == "NOR") ? "selected" : "" }}>Norway</option>
							<option value="OMN" {{ (Auth::user()->country == "OMN") ? "selected" : "" }}>Oman</option>
							<option value="PAK" {{ (Auth::user()->country == "PAK") ? "selected" : "" }}>Pakistan</option>
							<option value="PLW" {{ (Auth::user()->country == "PLW") ? "selected" : "" }}>Palau</option>
							<option value="PSE" {{ (Auth::user()->country == "PSE") ? "selected" : "" }}>Palestinian Territory, Occupied</option>
							<option value="PAN" {{ (Auth::user()->country == "PAN") ? "selected" : "" }}>Panama</option>
							<option value="PNG" {{ (Auth::user()->country == "PNG") ? "selected" : "" }}>Papua New Guinea</option>
							<option value="PRY" {{ (Auth::user()->country == "PRY") ? "selected" : "" }}>Paraguay</option>
							<option value="PER" {{ (Auth::user()->country == "PER") ? "selected" : "" }}>Peru</option>
							<option value="PHL" {{ (Auth::user()->country == "PHL") ? "selected" : "" }}>Philippines</option>
							<option value="PCN" {{ (Auth::user()->country == "PCN") ? "selected" : "" }}>Pitcairn</option>
							<option value="POL" {{ (Auth::user()->country == "POL") ? "selected" : "" }}>Poland</option>
							<option value="PRT" {{ (Auth::user()->country == "PRT") ? "selected" : "" }}>Portugal</option>
							<option value="PRI" {{ (Auth::user()->country == "PRI") ? "selected" : "" }}>Puerto Rico</option>
							<option value="QAT" {{ (Auth::user()->country == "QAT") ? "selected" : "" }}>Qatar</option>
							<option value="REU" {{ (Auth::user()->country == "REU") ? "selected" : "" }}>Réunion</option>
							<option value="ROU" {{ (Auth::user()->country == "ROU") ? "selected" : "" }}>Romania</option>
							<option value="RUS" {{ (Auth::user()->country == "RUS") ? "selected" : "" }}>Russian Federation</option>
							<option value="RWA" {{ (Auth::user()->country == "RWA") ? "selected" : "" }}>Rwanda</option>
							<option value="BLM" {{ (Auth::user()->country == "BLM") ? "selected" : "" }}>Saint Barthélemy</option>
							<option value="SHN" {{ (Auth::user()->country == "SHN") ? "selected" : "" }}>Saint Helena, Ascension and Tristan da Cunha</option>
							<option value="KNA" {{ (Auth::user()->country == "KNA") ? "selected" : "" }}>Saint Kitts and Nevis</option>
							<option value="LCA" {{ (Auth::user()->country == "LCA") ? "selected" : "" }}>Saint Lucia</option>
							<option value="MAF" {{ (Auth::user()->country == "MAF") ? "selected" : "" }}>Saint Martin (French part)</option>
							<option value="SPM" {{ (Auth::user()->country == "SPM") ? "selected" : "" }}>Saint Pierre and Miquelon</option>
							<option value="VCT" {{ (Auth::user()->country == "VCT") ? "selected" : "" }}>Saint Vincent and the Grenadines</option>
							<option value="WSM" {{ (Auth::user()->country == "WSM") ? "selected" : "" }}>Samoa</option>
							<option value="SMR" {{ (Auth::user()->country == "SMR") ? "selected" : "" }}>San Marino</option>
							<option value="STP" {{ (Auth::user()->country == "STP") ? "selected" : "" }}>Sao Tome and Principe</option>
							<option value="SAU" {{ (Auth::user()->country == "SAU") ? "selected" : "" }}>Saudi Arabia</option>
							<option value="SEN" {{ (Auth::user()->country == "SEN") ? "selected" : "" }}>Senegal</option>
							<option value="SRB" {{ (Auth::user()->country == "SRB") ? "selected" : "" }}>Serbia</option>
							<option value="SYC" {{ (Auth::user()->country == "SYC") ? "selected" : "" }}>Seychelles</option>
							<option value="SLE" {{ (Auth::user()->country == "SLE") ? "selected" : "" }}>Sierra Leone</option>
							<option value="SGP" {{ (Auth::user()->country == "SGP") ? "selected" : "" }}>Singapore</option>
							<option value="SXM" {{ (Auth::user()->country == "SXM") ? "selected" : "" }}>Sint Maarten (Dutch part)</option>
							<option value="SVK" {{ (Auth::user()->country == "SVK") ? "selected" : "" }}>Slovakia</option>
							<option value="SVN" {{ (Auth::user()->country == "SVN") ? "selected" : "" }}>Slovenia</option>
							<option value="SLB" {{ (Auth::user()->country == "SLB") ? "selected" : "" }}>Solomon Islands</option>
							<option value="SOM" {{ (Auth::user()->country == "SOM") ? "selected" : "" }}>Somalia</option>
							<option value="ZAF" {{ (Auth::user()->country == "ZAF") ? "selected" : "" }}>South Africa</option>
							<option value="SGS" {{ (Auth::user()->country == "SGS") ? "selected" : "" }}>South Georgia and the South Sandwich Islands</option>
							<option value="SSD" {{ (Auth::user()->country == "SSD") ? "selected" : "" }}>South Sudan</option>
							<option value="ESP" {{ (Auth::user()->country == "ESP") ? "selected" : "" }}>Spain</option>
							<option value="LKA" {{ (Auth::user()->country == "LKA") ? "selected" : "" }}>Sri Lanka</option>
							<option value="SDN" {{ (Auth::user()->country == "SDN") ? "selected" : "" }}>Sudan</option>
							<option value="SUR" {{ (Auth::user()->country == "SUR") ? "selected" : "" }}>Suriname</option>
							<option value="SJM" {{ (Auth::user()->country == "SJM") ? "selected" : "" }}>Svalbard and Jan Mayen</option>
							<option value="SWZ" {{ (Auth::user()->country == "SWZ") ? "selected" : "" }}>Swaziland</option>
							<option value="SWE" {{ (Auth::user()->country == "SWE") ? "selected" : "" }}>Sweden</option>
							<option value="CHE" {{ (Auth::user()->country == "CHE") ? "selected" : "" }}>Switzerland</option>
							<option value="SYR" {{ (Auth::user()->country == "SYR") ? "selected" : "" }}>Syrian Arab Republic</option>
							<option value="TWN" {{ (Auth::user()->country == "TWN") ? "selected" : "" }}>Taiwan, Province of China</option>
							<option value="TJK" {{ (Auth::user()->country == "TJK") ? "selected" : "" }}>Tajikistan</option>
							<option value="TZA" {{ (Auth::user()->country == "TZA") ? "selected" : "" }}>Tanzania, United Republic of</option>
							<option value="THA" {{ (Auth::user()->country == "THA") ? "selected" : "" }}>Thailand</option>
							<option value="TLS" {{ (Auth::user()->country == "TLS") ? "selected" : "" }}>Timor-Leste</option>
							<option value="TGO" {{ (Auth::user()->country == "TGO") ? "selected" : "" }}>Togo</option>
							<option value="TKL" {{ (Auth::user()->country == "TKL") ? "selected" : "" }}>Tokelau</option>
							<option value="TON" {{ (Auth::user()->country == "TON") ? "selected" : "" }}>Tonga</option>
							<option value="TTO" {{ (Auth::user()->country == "TTO") ? "selected" : "" }}>Trinidad and Tobago</option>
							<option value="TUN" {{ (Auth::user()->country == "TUN") ? "selected" : "" }}>Tunisia</option>
							<option value="TUR" {{ (Auth::user()->country == "TUR") ? "selected" : "" }}>Turkey</option>
							<option value="TKM" {{ (Auth::user()->country == "TKM") ? "selected" : "" }}>Turkmenistan</option>
							<option value="TCA" {{ (Auth::user()->country == "TCA") ? "selected" : "" }}>Turks and Caicos Islands</option>
							<option value="TUV" {{ (Auth::user()->country == "TUV") ? "selected" : "" }}>Tuvalu</option>
							<option value="UGA" {{ (Auth::user()->country == "UGA") ? "selected" : "" }}>Uganda</option>
							<option value="UKR" {{ (Auth::user()->country == "UKR") ? "selected" : "" }}>Ukraine</option>
							<option value="ARE" {{ (Auth::user()->country == "ARE") ? "selected" : "" }}>United Arab Emirates</option>
							<option value="GBR" {{ (Auth::user()->country == "GBR") ? "selected" : "" }}>United Kingdom</option>
							<option value="UMI" {{ (Auth::user()->country == "UMI") ? "selected" : "" }}>United States Minor Outlying Islands</option>
							<option value="URY" {{ (Auth::user()->country == "URY") ? "selected" : "" }}>Uruguay</option>
							<option value="UZB" {{ (Auth::user()->country == "UZB") ? "selected" : "" }}>Uzbekistan</option>
							<option value="VUT" {{ (Auth::user()->country == "VUT") ? "selected" : "" }}>Vanuatu</option>
							<option value="VEN" {{ (Auth::user()->country == "VEN") ? "selected" : "" }}>Venezuela, Bolivarian Republic of</option>
							<option value="VNM" {{ (Auth::user()->country == "VNM") ? "selected" : "" }}>Viet Nam</option>
							<option value="VGB" {{ (Auth::user()->country == "VGB") ? "selected" : "" }}>Virgin Islands, British</option>
							<option value="VIR" {{ (Auth::user()->country == "VIR") ? "selected" : "" }}>Virgin Islands, U.S.</option>
							<option value="WLF" {{ (Auth::user()->country == "WLF") ? "selected" : "" }}>Wallis and Futuna</option>
							<option value="ESH" {{ (Auth::user()->country == "ESH") ? "selected" : "" }}>Western Sahara</option>
							<option value="YEM" {{ (Auth::user()->country == "YEM") ? "selected" : "" }}>Yemen</option>
							<option value="ZMB" {{ (Auth::user()->country == "ZMB") ? "selected" : "" }}>Zambia</option>
							<option value="ZWE" {{ (Auth::user()->country == "ZWE") ? "selected" : "" }}>Zimbabwe</option>
						</select>
					</div>
					
					<div class="form-group">
						<label id="shipping_zip_code">Zip Code</label>
						<input type="text" name="shipping_zip_code" id="shipping_zip_code" class="form-control" value="{{ Auth::user()->shipping_zip_code }}" />
					</div>
					
					<div class="form-group">
						<input type="submit" class="btn btn-success pull-right" value="Update" />
					</div>
				</div>
			</form>
		</div>
		
		<div class="row">
			<form action="/settings/change-password" method="post">
				<div class="col-sm-12 col-md-6">
					<h3>Update Password</h3>
						{{ csrf_field() }}
						
						<div class="form-group">
							<label id="password">Password</label>
							<input id="password" type="password" class="form-control" name="password" required>
						</div>
						@if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
						
						<div class="form-group">
							<label id="password-confirm">Confirm Password</label>
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
						</div>
						
						<div class="form-group">
							<input type="submit" class="btn btn-success pull-right" value="Update Password" />
						</div>
					
				</div>
			</form>
		</div>
		

		@if(\Auth::user()->account_level == 2)
		
		<div class="page-header">
			<h3>Students</h3>
			<p>This has been moved to "My Class". Click the link below to go to the new location.</p>
			<a href="/my-class" class="btn btn-primary">View My Class</a>
		</div>
		<!--
		<div class="row">
			<div class="col-sm-12">
				<h5>Pretests</h5>
				@if (count($students))
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
								@if(!\Session::has('original_user'))
									<td>Student Name</td>
								@else
									<td>Student ID</td>
								@endif
									<td>
									Nba Champion
								</td> 
								<td>
								7+1
							</td>
							<td>
								6-3
							</td>
							<td>
								6x6
							</td>
							<td>
								9/3
							</td>
							<td>
								7+5
							</td>
							<td>
								9x0
							</td>
							<td>
								7x7
							</td>
							<td>
								7-1
							</td>
							<td>
								4x5
							</td>
							<td>
								9/2
							</td>
							<td>
								8x7
							</td>
							<td>
								8-8
							</td>
							<td>
								5/2
							</td>
							<td>
								7x9
							</td>
							<td>
								4+3
							</td>
							<td>
								6+5
							</td>
							<td>
								9-7
							</td>
							<td>
								2x8
							</td>
							<td>
								7/1
							</td>
							<td>
								9-1
							</td>
							<td>
								6/2
							</td>
							<td>
								5x2
							</td>
							<td>
								8/2
							</td>
							<td>
								3x4
							</td>
							<td>
								8-7
							</td>
							<td>
								5x8
							</td>
							<td>
								1x1
							</td>
							<td>
								10/3
							</td>
							<td>
								9+8
							</td>
							<td>
								3-2
							</td>
							<td>Stay Calm</td>
							<td>Help Others</td>
							<td>Doing Things</td>
							<td>Solving Problems</td>
							<td>Do Not Give Up</td>
							<td>Give Compliments</td>
							<td>Do The Right Thing</td>
							<td>Making Decisions</td>
							<td>Think Before I Act</td>
							<td>Leader</td>
							<td>Respect</td>
							<td>Good Decisions</td>
							<td>Honest Person</td>
							<td>Importance Of Learning</td>
							<td>Think About Problems</td>
							<td>Responsible Person</td>
							<td>Work Through Problems</td>
							<td>Set Goals</td>
							<td>Overcome A Challenge</td>
							<td>Work Well With Others</td>
							<td>Half Of Value</td>
							<td>Decimal Numbers Represent</td>
							<td>NFL Kicker</td>
							<td>Free Throws</td>
							<td>WNBA Free Throws</td>
							<td>Same Shots</td>
							<td>Odds Of Three Point</td>
							<td>Shot Odds</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($students as $s)
									<?php 
										$results = \App\Preassessment::where('student_id',$s->id)->get()->toArray(); 
									?>
									<?php 
										if(!$results) 
											continue;
									?>
									<?php $results = $results[0]; ?>
								<tr>
									@if(!\Session::has('original_user'))
									<td>
										{{ $s->name }} 
										<a href="/student/{{ $s->id }}/edit"><i class="fa fa-pencil"></i></a>
										<a href="/student/{{ $s->id }}/delete" class="delete"><i class="fa fa-minus-circle"></i></a>
									</td>
									@else
									<td>
										{{ $s->id }}
									</td>
									@endif
									<td>{{ $results['nba_champion'] }}</td>
									<td>{{ $results['7+1'] }}</td>
									<td>{{ $results['6-3'] }}</td>
									<td>{{ $results['6x6'] }}</td>
									<td>{{ $results['9/3'] }}</td>
									<td>{{ $results['7+5'] }}</td>
									<td>{{ $results['9x0'] }}</td>
									<td>{{ $results['7x7'] }}</td>
									<td>{{ $results['7-1'] }}</td>
									<td>{{ $results['4x5'] }}</td>
									<td>{{ $results['9/2'] }}</td>
									<td>{{ $results['8x7'] }}</td>
									<td>{{ $results['8-8'] }}</td>
									<td>{{ $results['5/2'] }}</td>
									<td>{{ $results['7x9'] }}</td>
									<td>{{ $results['4+3'] }}</td>
									<td>{{ $results['6+5'] }}</td>
									<td>{{ $results['9-7'] }}</td>
									<td>{{ $results['2x8'] }}</td>
									<td>{{ $results['7/1'] }}</td>
									<td>{{ $results['9-1'] }}</td>
									<td>{{ $results['6/2'] }}</td>
									<td>{{ $results['5x2'] }}</td>
									<td>{{ $results['8/2'] }}</td>
									<td>{{ $results['3x4'] }}</td>
									<td>{{ $results['8-7'] }}</td>
									<td>{{ $results['5x8'] }}</td>
									<td>{{ $results['1x1'] }}</td>
									<td>{{ $results['10/3'] }}</td>
									<td>{{ $results['9+8'] }}</td>
									<td>{{ $results['3-2'] }}</td>
									<td>{{ $results['stay_calm'] }}</td>
									<td>{{ $results['help_others'] }}</td>
									<td>{{ $results['doing_things'] }}</td>
									<td>{{ $results['solving_problems'] }}</td>
									<td>{{ $results['do_not_give_up'] }}</td>
									<td>{{ $results['give_compliments'] }}</td>
									<td>{{ $results['do_the_right_thing'] }}</td>
									<td>{{ $results['making_decisions'] }}</td>
									<td>{{ $results['think_before_i_act'] }}</td>
									<td>{{ $results['leader'] }}</td>
									<td>{{ $results['respect'] }}</td>
									<td>{{ $results['good_decisions'] }}</td>
									<td>{{ $results['honest_person'] }}</td>
									<td>{{ $results['importance_of_learning'] }}</td>
									<td>{{ $results['think_about_problems'] }}</td>
									<td>{{ $results['responsible_person'] }}</td>
									<td>{{ $results['work_through_problems'] }}</td>
									<td>{{ $results['set_goals'] }}</td>
									<td>{{ $results['overcome_a_challenge'] }}</td>
									<td>{{ $results['work_well_with_others'] }}</td>
									<td>{{ $results['half_of_value'] }}</td>
									<td>{{ $results['decimal_numbers_represent'] }}</td>
									<td>{{ $results['nfl_kicker'] }}</td>
									<td>{{ $results['free_throws'] }}</td>
									<td>{{ $results['wnba_free_throws'] }}</td>
									<td>{{ $results['same_shots'] }}</td>
									<td>{{ $results['odds_of_three_point'] }}</td>
									<td>{{ $results['shot_odds'] }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@else
				  <p>No students added. Please have your students take the pre-test to log them here.</p>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h5>Post-tests</h5>
				@if (count($students))
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
								@if(!\Session::has('original_user'))
									<td>Student Name</td>
								@else
									<td>Student ID</td>
								@endif
								<td>
									Nba Champion
								</td> 
								<td>
									7+1
								</td>
								<td>
									6-3
								</td>
								<td>
									6x6
								</td>
								<td>
									9/3
								</td>
								<td>
									7+5
								</td>
								<td>
									9x0
								</td>
								<td>
									7x7
								</td>
								<td>
									7-1
								</td>
								<td>
									4x5
								</td>
								<td>
									9/2
								</td>
								<td>
									8x7
								</td>
								<td>
									8-8
								</td>
								<td>
									5/2
								</td>
								<td>
									7x9
								</td>
								<td>
									4+3
								</td>
								<td>
									6+5
								</td>
								<td>
									9-7
								</td>
								<td>
									2x8
								</td>
								<td>
									7/1
								</td>
								<td>
									9-1
								</td>
								<td>
									6/2
								</td>
								<td>
									5x2
								</td>
								<td>
									8/2
								</td>
								<td>
									3x4
								</td>
								<td>
									8-7
								</td>
								<td>
									5x8
								</td>
								<td>
									1x1
								</td>
								<td>
									10/3
								</td>
								<td>
									9+8
								</td>
								<td>
									3-2
								</td>
								<td>Stay Calm</td>
								<td>Help Others</td>
								<td>Doing Things</td>
								<td>Solving Problems</td>
								<td>Do Not Give Up</td>
								<td>Give Compliments</td>
								<td>Do The Right Thing</td>
								<td>Making Decisions</td>
								<td>Think Before I Act</td>
								<td>Leader</td>
								<td>Respect</td>
								<td>Good Decisions</td>
								<td>Honest Person</td>
								<td>Importance Of Learning</td>
								<td>Think About Problems</td>
								<td>Responsible Person</td>
								<td>Work Through Problems</td>
								<td>Set Goals</td>
								<td>Overcome A Challenge</td>
								<td>Work Well With Others</td>
								<td>Half Of Value</td>
								<td>Decimal Numbers Represent</td>
								<td>NFL Kicker</td>
								<td>Free Throws</td>
								<td>WNBA Free Throws</td>
								<td>Same Shots</td>
								<td>Odds Of Three Point</td>
								<td>Shot Odds</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($students as $s)
									<?php $results = \App\Postassessment::where('student_id',$s->id)->get()->toArray(); ?>
									<?php
										if (!$results)
											continue;
									?>
									<?php $results = $results[0]; ?>
								<tr>
									@if(!\Session::has('original_user'))
									<td>
										{{ $s->name }} 
										<a href="/student/{{ $s->id }}/edit"><i class="fa fa-pencil"></i></a>
										<a href="/student/{{ $s->id }}/delete" class="delete"><i class="fa fa-minus-circle"></i></a>
									</td>
									@else
									<td>
										{{ $s->id }}
									</td>
									@endif
									<td>{{ $results['nba_champion'] }}</td>
									<td>{{ $results['7+1'] }}</td>
									<td>{{ $results['6-3'] }}</td>
									<td>{{ $results['6x6'] }}</td>
									<td>{{ $results['9/3'] }}</td>
									<td>{{ $results['7+5'] }}</td>
									<td>{{ $results['9x0'] }}</td>
									<td>{{ $results['7x7'] }}</td>
									<td>{{ $results['7-1'] }}</td>
									<td>{{ $results['4x5'] }}</td>
									<td>{{ $results['9/2'] }}</td>
									<td>{{ $results['8x7'] }}</td>
									<td>{{ $results['8-8'] }}</td>
									<td>{{ $results['5/2'] }}</td>
									<td>{{ $results['7x9'] }}</td>
									<td>{{ $results['4+3'] }}</td>
									<td>{{ $results['6+5'] }}</td>
									<td>{{ $results['9-7'] }}</td>
									<td>{{ $results['2x8'] }}</td>
									<td>{{ $results['7/1'] }}</td>
									<td>{{ $results['9-1'] }}</td>
									<td>{{ $results['6/2'] }}</td>
									<td>{{ $results['5x2'] }}</td>
									<td>{{ $results['8/2'] }}</td>
									<td>{{ $results['3x4'] }}</td>
									<td>{{ $results['8-7'] }}</td>
									<td>{{ $results['5x8'] }}</td>
									<td>{{ $results['1x1'] }}</td>
									<td>{{ $results['10/3'] }}</td>
									<td>{{ $results['9+8'] }}</td>
									<td>{{ $results['3-2'] }}</td>
									<td>{{ $results['stay_calm'] }}</td>
									<td>{{ $results['help_others'] }}</td>
									<td>{{ $results['doing_things'] }}</td>
									<td>{{ $results['solving_problems'] }}</td>
									<td>{{ $results['do_not_give_up'] }}</td>
									<td>{{ $results['give_compliments'] }}</td>
									<td>{{ $results['do_the_right_thing'] }}</td>
									<td>{{ $results['making_decisions'] }}</td>
									<td>{{ $results['think_before_i_act'] }}</td>
									<td>{{ $results['leader'] }}</td>
									<td>{{ $results['respect'] }}</td>
									<td>{{ $results['good_decisions'] }}</td>
									<td>{{ $results['honest_person'] }}</td>
									<td>{{ $results['importance_of_learning'] }}</td>
									<td>{{ $results['think_about_problems'] }}</td>
									<td>{{ $results['responsible_person'] }}</td>
									<td>{{ $results['work_through_problems'] }}</td>
									<td>{{ $results['set_goals'] }}</td>
									<td>{{ $results['overcome_a_challenge'] }}</td>
									<td>{{ $results['work_well_with_others'] }}</td>
									<td>{{ $results['half_of_value'] }}</td>
									<td>{{ $results['decimal_numbers_represent'] }}</td>
									<td>{{ $results['nfl_kicker'] }}</td>
									<td>{{ $results['free_throws'] }}</td>
									<td>{{ $results['wnba_free_throws'] }}</td>
									<td>{{ $results['same_shots'] }}</td>
									<td>{{ $results['odds_of_three_point'] }}</td>
									<td>{{ $results['shot_odds'] }}</td>
									<td>{{ $results['math_hoops_games'] }}</td>
									<td>{{ $results['worksheets'] }}</td>
									<td>{{ $results['math_more_fun'] }}</td>
									<td>{{ $results['confident_after'] }}</td>
									<td>{{ $results['games_completed'] }}</td>
									<td>{{ $results['skills_pieces'] }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@else
				  <p>No students added. Please have your students take the post-test to log them here.</p>
				@endif
			</div>
		</div>
		
		
		
		@if(count($checkpoints) > 0)
		<div class="page-header">
			<h3>Checkpoints</h3>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Date Submitted</td>
							<td>Number of students participating</td>
							<td>Average number of games played per student</td>
							<td>Average number of curriculum pieces completed per student</td>
							<td>Average number of sportsmanship points earned per student</td>
							<td>Total number of games played</td>
							<td>Total number of curriculum pieces completed</td>
							<td>Total number of sportsmanship points earned</td>
							<td>Number of students eligible to apply for the National Championship</td>						
						</tr>
					</thead>
					<tbody>
						@foreach ($checkpoints as $a)
						<tr>
							<td>
								{{ $a->created_at->diffForHumans() }}
							</td>
							<td>{{ $a->studentsParticipating }}</td>
							<td>{{ $a->gamesPerStudent }}</td>
							<td>{{ $a->curriculumPerStudent }}</td>
							<td>{{ $a->sportsmanshipPointsPerStudent }}</td>
							<td>{{ $a->gamesPlayed }}</td>
							<td>{{ $a->curriculumCompleted }}</td>
							<td>{{ $a->sportsmanshipPoints }}</td>
							<td>{{ $a->studentsEligible }}</td>
							
						</tr>
						@endforeach
					</tbody>
				</table>
				</div>
			</div>
		</div>
		@endif
		-->

		
		@if(count($finished) > 0)
		<div class="page-header">
			<h2>Finished Seasons</h2>
			<div class="list-group">
				@foreach ($finished as $t)
				<a href="{{ $t->file }}" class="list-group-item"><span class="glyphicon glyphicon-open-file"></span> Archived on {{ $t->created_at->format('M d, Y') }}</a>
				@endforeach
			</div>
		</div>
		@endif
		
		@endif

	</div>
@endsection
