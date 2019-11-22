@extends("layouts.app")
@section("content")
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-10 col-md-offset-1">
				<div class="page-header">
					<h1>Edit User</h1>
					<a href="/admin/users" class="btn btn-success btn-sm">All Users</a>
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
				@if (count($errors))
					<div class="alert alert-danger">
					<strong>Uh oh!</strong>
					@foreach ($errors->all() as $error)
						<br>{{ $error }}
					@endforeach
					</div>
				@endif
				<form action="/admin/user/{{ $user->id }}/edit" method="post">
					{{ method_field('patch') }}
					{{ csrf_field() }}				
					<div class="col-sm-12 col-md-6">
						<h3>Basic Information</h3>
						
							{{ method_field('patch') }}
							{{ csrf_field() }}
							
							<div class="form-group">
								<label id="name">Name</label>
								<input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" />
							</div>
							
							<div class="form-group">
								<label id="email">Email</label>
								<input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" />
							</div>
							
							<div class="form-group">
								<label id="phone">Phone</label>
								<input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" />
							</div>
							
							<div class="form-group">
								<label id="estimated_students">Estimated Students</label>
								<input type="text" name="estimated_students" id="estimated_students" class="form-control" value="{{ $user->estimated_students }}" />
							</div>
							
							<div class="form-group">
								<label id="tier">Tier</label>
								<select name="account_level" class="form-control">
									<option value="1" {{ ($user->account_level == 1) ? "selected" : "" }}>Math Hoops</option>
									<option value="2" {{ ($user->account_level == 2) ? "selected" : "" }}>Math Hoops +</option>
								</select>
							</div>
							
							<h3>Site Information</h3>
							
							<div class="form-group">
								<label id="site">School/Program Name</label>
								<input type="text" name="school_program_name" id="site" class="form-control" value="{{ $user->school_program_name }}" />
							</div>
							
							<div class="form-group">
								<label id="site_address_1">Site Address Line 1</label>
								<input type="text" name="site_address_1" id="site_address_1" class="form-control" value="{{ $user->site_address_1 }}" />
							</div>
							
							<div class="form-group">
								<label id="site_address_2">Site Address Line 2</label>
								<input type="text" name="site_address_2" id="site_address_2" class="form-control" value="{{ $user->site_address_2 }}" />
							</div>
							
							<div class="form-group">
								<label id="site_city">City</label>
								<input type="text" name="site_city" id="site_city" class="form-control" value="{{ $user->site_city }}" />
							</div>
							
							<div class="form-group">
								<label id="site_state">State</label>
								<select name="site_state" id="site_state" class="form-control">
									<option value="N/A" {{ ($user->site_state == "N/A") ? "selected" : "" }}>N/A</option>
									<option value="AL" {{ ($user->site_state == "AL") ? "selected" : "" }}>Alabama</option>
									<option value="AK" {{ ($user->site_state == "AK") ? "selected" : "" }}>Alaska</option>
									<option value="AZ" {{ ($user->site_state == "AZ") ? "selected" : "" }}>Arizona</option>
									<option value="AR" {{ ($user->site_state == "AR") ? "selected" : "" }}>Arkansas</option>
									<option value="CA" {{ ($user->site_state == "CA") ? "selected" : "" }}>California</option>
									<option value="CO" {{ ($user->site_state == "CO") ? "selected" : "" }}>Colorado</option>
									<option value="CT" {{ ($user->site_state == "CT") ? "selected" : "" }}>Connecticut</option>
									<option value="DE" {{ ($user->site_state == "DE") ? "selected" : "" }}>Delaware</option>
									<option value="DC" {{ ($user->site_state == "DC") ? "selected" : "" }}>District Of Columbia</option>
									<option value="FL" {{ ($user->site_state == "FL") ? "selected" : "" }}>Florida</option>
									<option value="GA" {{ ($user->site_state == "GA") ? "selected" : "" }}>Georgia</option>
									<option value="HI" {{ ($user->site_state == "HI") ? "selected" : "" }}>Hawaii</option>
									<option value="ID" {{ ($user->site_state == "ID") ? "selected" : "" }}>Idaho</option>
									<option value="IL" {{ ($user->site_state == "IL") ? "selected" : "" }}>Illinois</option>
									<option value="IN" {{ ($user->site_state == "IN") ? "selected" : "" }}>Indiana</option>
									<option value="IA" {{ ($user->site_state == "IA") ? "selected" : "" }}>Iowa</option>
									<option value="KS" {{ ($user->site_state == "KS") ? "selected" : "" }}>Kansas</option>
									<option value="KY" {{ ($user->site_state == "KY") ? "selected" : "" }}>Kentucky</option>
									<option value="LA" {{ ($user->site_state == "LA") ? "selected" : "" }}>Louisiana</option>
									<option value="ME" {{ ($user->site_state == "ME") ? "selected" : "" }}>Maine</option>
									<option value="MD" {{ ($user->site_state == "MD") ? "selected" : "" }}>Maryland</option>
									<option value="MA" {{ ($user->site_state == "MA") ? "selected" : "" }}>Massachusetts</option>
									<option value="MI" {{ ($user->site_state == "MI") ? "selected" : "" }}>Michigan</option>
									<option value="MN" {{ ($user->site_state == "MN") ? "selected" : "" }}>Minnesota</option>
									<option value="MS" {{ ($user->site_state == "MS") ? "selected" : "" }}>Mississippi</option>
									<option value="MO" {{ ($user->site_state == "MO") ? "selected" : "" }}>Missouri</option>
									<option value="MT" {{ ($user->site_state == "MT") ? "selected" : "" }}>Montana</option>
									<option value="NE" {{ ($user->site_state == "NE") ? "selected" : "" }}>Nebraska</option>
									<option value="NV" {{ ($user->site_state == "NV") ? "selected" : "" }}>Nevada</option>
									<option value="NH" {{ ($user->site_state == "NH") ? "selected" : "" }}>New Hampshire</option>
									<option value="NJ" {{ ($user->site_state == "NJ") ? "selected" : "" }}>New Jersey</option>
									<option value="NM" {{ ($user->site_state == "NM") ? "selected" : "" }}>New Mexico</option>
									<option value="NY" {{ ($user->site_state == "NY") ? "selected" : "" }}>New York</option>
									<option value="NC" {{ ($user->site_state == "NC") ? "selected" : "" }}>North Carolina</option>
									<option value="ND" {{ ($user->site_state == "ND") ? "selected" : "" }}>North Dakota</option>
									<option value="OH" {{ ($user->site_state == "OH") ? "selected" : "" }}>Ohio</option>
									<option value="OK" {{ ($user->site_state == "OK") ? "selected" : "" }}>Oklahoma</option>
									<option value="OR" {{ ($user->site_state == "OR") ? "selected" : "" }}>Oregon</option>
									<option value="PA" {{ ($user->site_state == "PA") ? "selected" : "" }}>Pennsylvania</option>
									<option value="RI" {{ ($user->site_state == "RI") ? "selected" : "" }}>Rhode Island</option>
									<option value="SC" {{ ($user->site_state == "SC") ? "selected" : "" }}>South Carolina</option>
									<option value="SD" {{ ($user->site_state == "SD") ? "selected" : "" }}>South Dakota</option>
									<option value="TN" {{ ($user->site_state == "TN") ? "selected" : "" }}>Tennessee</option>
									<option value="TX" {{ ($user->site_state == "TX") ? "selected" : "" }}>Texas</option>
									<option value="UT" {{ ($user->site_state == "UT") ? "selected" : "" }}>Utah</option>
									<option value="VT" {{ ($user->site_state == "VT") ? "selected" : "" }}>Vermont</option>
									<option value="VA" {{ ($user->site_state == "VA") ? "selected" : "" }}>Virginia</option>
									<option value="WA" {{ ($user->site_state == "WA") ? "selected" : "" }}>Washington</option>
									<option value="WV" {{ ($user->site_state == "WV") ? "selected" : "" }}>West Virginia</option>
									<option value="WI" {{ ($user->site_state == "WI") ? "selected" : "" }}>Wisconsin</option>
									<option value="WY" {{ ($user->site_state == "WY") ? "selected" : "" }}>Wyoming</option>
								</select>
							</div>
							
							<div class="form-group">
								<label id="site_zip_code">Zip Code</label>
								<input type="text" name="site_zip_code" id="site_zip_code" class="form-control" value="{{ $user->site_zip_code }}" />
							</div>
						
					</div>
					<div class="col-sm-12 col-md-6">
						<h3>Shipping Information</h3>
						
						<div class="form-group">
							<label id="shipping_name">Shipping Name</label>
							<input type="text" name="shipping_name" id="shipping_name" class="form-control" value="{{ $user->shipping_name }}" />
						</div>
						
						<div class="form-group">
							<label id="shipping_address_1">Shipping Address Line 1</label>
							<input type="text" name="shipping_address_1" id="shipping_address_1" class="form-control" value="{{ $user->shipping_address_1 }}" />
						</div>
						
						<div class="form-group">
							<label id="shipping_address_2">Shipping Address Line 2</label>
							<input type="text" name="shipping_address_2" id="shipping_address_2" class="form-control" value="{{ $user->shipping_address_2 }}" />
						</div>
						
						<div class="form-group">
							<label id="shipping_city">City</label>
							<input type="text" name="shipping_city" id="shipping_city" class="form-control" value="{{ $user->shipping_city }}" />
						</div>
						
						<div class="form-group">
							<label id="shipping_state">State</label>
							<select name="shipping_state" id="shipping_state" class="form-control">
								<option value="N/A" {{ ($user->shipping_state == "N/A") ? "selected" : "" }}>N/A</option>
								<option value="AL" {{ ($user->shipping_state == "AL") ? "selected" : "" }}>Alabama</option>
								<option value="AK" {{ ($user->shipping_state == "AK") ? "selected" : "" }}>Alaska</option>
								<option value="AZ" {{ ($user->shipping_state == "AZ") ? "selected" : "" }}>Arizona</option>
								<option value="AR" {{ ($user->shipping_state == "AR") ? "selected" : "" }}>Arkansas</option>
								<option value="CA" {{ ($user->shipping_state == "CA") ? "selected" : "" }}>California</option>
								<option value="CO" {{ ($user->shipping_state == "CO") ? "selected" : "" }}>Colorado</option>
								<option value="CT" {{ ($user->shipping_state == "CT") ? "selected" : "" }}>Connecticut</option>
								<option value="DE" {{ ($user->shipping_state == "DE") ? "selected" : "" }}>Delaware</option>
								<option value="DC" {{ ($user->shipping_state == "DC") ? "selected" : "" }}>District Of Columbia</option>
								<option value="FL" {{ ($user->shipping_state == "FL") ? "selected" : "" }}>Florida</option>
								<option value="GA" {{ ($user->shipping_state == "GA") ? "selected" : "" }}>Georgia</option>
								<option value="HI" {{ ($user->shipping_state == "HI") ? "selected" : "" }}>Hawaii</option>
								<option value="ID" {{ ($user->shipping_state == "ID") ? "selected" : "" }}>Idaho</option>
								<option value="IL" {{ ($user->shipping_state == "IL") ? "selected" : "" }}>Illinois</option>
								<option value="IN" {{ ($user->shipping_state == "IN") ? "selected" : "" }}>Indiana</option>
								<option value="IA" {{ ($user->shipping_state == "IA") ? "selected" : "" }}>Iowa</option>
								<option value="KS" {{ ($user->shipping_state == "KS") ? "selected" : "" }}>Kansas</option>
								<option value="KY" {{ ($user->shipping_state == "KY") ? "selected" : "" }}>Kentucky</option>
								<option value="LA" {{ ($user->shipping_state == "LA") ? "selected" : "" }}>Louisiana</option>
								<option value="ME" {{ ($user->shipping_state == "ME") ? "selected" : "" }}>Maine</option>
								<option value="MD" {{ ($user->shipping_state == "MD") ? "selected" : "" }}>Maryland</option>
								<option value="MA" {{ ($user->shipping_state == "MA") ? "selected" : "" }}>Massachusetts</option>
								<option value="MI" {{ ($user->shipping_state == "MI") ? "selected" : "" }}>Michigan</option>
								<option value="MN" {{ ($user->shipping_state == "MN") ? "selected" : "" }}>Minnesota</option>
								<option value="MS" {{ ($user->shipping_state == "MS") ? "selected" : "" }}>Mississippi</option>
								<option value="MO" {{ ($user->shipping_state == "MO") ? "selected" : "" }}>Missouri</option>
								<option value="MT" {{ ($user->shipping_state == "MT") ? "selected" : "" }}>Montana</option>
								<option value="NE" {{ ($user->shipping_state == "NE") ? "selected" : "" }}>Nebraska</option>
								<option value="NV" {{ ($user->shipping_state == "NV") ? "selected" : "" }}>Nevada</option>
								<option value="NH" {{ ($user->shipping_state == "NH") ? "selected" : "" }}>New Hampshire</option>
								<option value="NJ" {{ ($user->shipping_state == "NJ") ? "selected" : "" }}>New Jersey</option>
								<option value="NM" {{ ($user->shipping_state == "NM") ? "selected" : "" }}>New Mexico</option>
								<option value="NY" {{ ($user->shipping_state == "NY") ? "selected" : "" }}>New York</option>
								<option value="NC" {{ ($user->shipping_state == "NC") ? "selected" : "" }}>North Carolina</option>
								<option value="ND" {{ ($user->shipping_state == "ND") ? "selected" : "" }}>North Dakota</option>
								<option value="OH" {{ ($user->shipping_state == "OH") ? "selected" : "" }}>Ohio</option>
								<option value="OK" {{ ($user->shipping_state == "OK") ? "selected" : "" }}>Oklahoma</option>
								<option value="OR" {{ ($user->shipping_state == "OR") ? "selected" : "" }}>Oregon</option>
								<option value="PA" {{ ($user->shipping_state == "PA") ? "selected" : "" }}>Pennsylvania</option>
								<option value="RI" {{ ($user->shipping_state == "RI") ? "selected" : "" }}>Rhode Island</option>
								<option value="SC" {{ ($user->shipping_state == "SC") ? "selected" : "" }}>South Carolina</option>
								<option value="SD" {{ ($user->shipping_state == "SD") ? "selected" : "" }}>South Dakota</option>
								<option value="TN" {{ ($user->shipping_state == "TN") ? "selected" : "" }}>Tennessee</option>
								<option value="TX" {{ ($user->shipping_state == "TX") ? "selected" : "" }}>Texas</option>
								<option value="UT" {{ ($user->shipping_state == "UT") ? "selected" : "" }}>Utah</option>
								<option value="VT" {{ ($user->shipping_state == "VT") ? "selected" : "" }}>Vermont</option>
								<option value="VA" {{ ($user->shipping_state == "VA") ? "selected" : "" }}>Virginia</option>
								<option value="WA" {{ ($user->shipping_state == "WA") ? "selected" : "" }}>Washington</option>
								<option value="WV" {{ ($user->shipping_state == "WV") ? "selected" : "" }}>West Virginia</option>
								<option value="WI" {{ ($user->shipping_state == "WI") ? "selected" : "" }}>Wisconsin</option>
								<option value="WY" {{ ($user->shipping_state == "WY") ? "selected" : "" }}>Wyoming</option>
							</select>
						</div>
						
						<div class="form-group">
							<label id="country">Country</label>
							<select name="country" id="country" class="form-control">
								<option value="USA" {{ ($user->country == "USA") ? "selected" : "" }}>United States</option>
								<option value="AFG" {{ ($user->country == "AFG") ? "selected" : "" }}>Afghanistan</option>
								<option value="ALA" {{ ($user->country == "ALA") ? "selected" : "" }}>Åland Islands</option>
								<option value="ALB" {{ ($user->country == "ALB") ? "selected" : "" }}>Albania</option>
								<option value="DZA" {{ ($user->country == "DZA") ? "selected" : "" }}>Algeria</option>
								<option value="ASM" {{ ($user->country == "ASM") ? "selected" : "" }}>American Samoa</option>
								<option value="AND" {{ ($user->country == "AND") ? "selected" : "" }}>Andorra</option>
								<option value="AGO" {{ ($user->country == "AGO") ? "selected" : "" }}>Angola</option>
								<option value="AIA" {{ ($user->country == "AIA") ? "selected" : "" }}>Anguilla</option>
								<option value="ATA" {{ ($user->country == "ATA") ? "selected" : "" }}>Antarctica</option>
								<option value="ATG" {{ ($user->country == "ATG") ? "selected" : "" }}>Antigua and Barbuda</option>
								<option value="ARG" {{ ($user->country == "ARG") ? "selected" : "" }}>Argentina</option>
								<option value="ARM" {{ ($user->country == "ARM") ? "selected" : "" }}>Armenia</option>
								<option value="ABW" {{ ($user->country == "ABW") ? "selected" : "" }}>Aruba</option>
								<option value="AUS" {{ ($user->country == "AUS") ? "selected" : "" }}>Australia</option>
								<option value="AUT" {{ ($user->country == "AUT") ? "selected" : "" }}>Austria</option>
								<option value="AZE" {{ ($user->country == "AZE") ? "selected" : "" }}>Azerbaijan</option>
								<option value="BHS" {{ ($user->country == "BHS") ? "selected" : "" }}>Bahamas</option>
								<option value="BHR" {{ ($user->country == "BHR") ? "selected" : "" }}>Bahrain</option>
								<option value="BGD" {{ ($user->country == "BGD") ? "selected" : "" }}>Bangladesh</option>
								<option value="BRB" {{ ($user->country == "BRB") ? "selected" : "" }}>Barbados</option>
								<option value="BLR" {{ ($user->country == "BLR") ? "selected" : "" }}>Belarus</option>
								<option value="BEL" {{ ($user->country == "BEL") ? "selected" : "" }}>Belgium</option>
								<option value="BLZ" {{ ($user->country == "BLZ") ? "selected" : "" }}>Belize</option>
								<option value="BEN" {{ ($user->country == "BEM") ? "selected" : "" }}>Benin</option>
								<option value="BMU" {{ ($user->country == "BMU") ? "selected" : "" }}>Bermuda</option>
								<option value="BTN" {{ ($user->country == "BTN") ? "selected" : "" }}>Bhutan</option>
								<option value="BOL" {{ ($user->country == "BOL") ? "selected" : "" }}>Bolivia, Plurinational State of</option>
								<option value="BES" {{ ($user->country == "BES") ? "selected" : "" }}>Bonaire, Sint Eustatius and Saba</option>
								<option value="BIH" {{ ($user->country == "BIH") ? "selected" : "" }}>Bosnia and Herzegovina</option>
								<option value="BWA" {{ ($user->country == "BWA") ? "selected" : "" }}>Botswana</option>
								<option value="BVT" {{ ($user->country == "BVT") ? "selected" : "" }}>Bouvet Island</option>
								<option value="BRA" {{ ($user->country == "BRA") ? "selected" : "" }}>Brazil</option>
								<option value="IOT" {{ ($user->country == "IOT") ? "selected" : "" }}>British Indian Ocean Territory</option>
								<option value="BRN" {{ ($user->country == "BRN") ? "selected" : "" }}>Brunei Darussalam</option>
								<option value="BGR" {{ ($user->country == "BGR") ? "selected" : "" }}>Bulgaria</option>
								<option value="BFA" {{ ($user->country == "BFA") ? "selected" : "" }}>Burkina Faso</option>
								<option value="BDI" {{ ($user->country == "BDI") ? "selected" : "" }}>Burundi</option>
								<option value="KHM" {{ ($user->country == "KHM") ? "selected" : "" }}>Cambodia</option>
								<option value="CMR" {{ ($user->country == "CMR") ? "selected" : "" }}>Cameroon</option>
								<option value="CAN" {{ ($user->country == "CAN") ? "selected" : "" }}>Canada</option>
								<option value="CPV" {{ ($user->country == "CPV") ? "selected" : "" }}>Cape Verde</option>
								<option value="CYM" {{ ($user->country == "CYM") ? "selected" : "" }}>Cayman Islands</option>
								<option value="CAF" {{ ($user->country == "CAF") ? "selected" : "" }}>Central African Republic</option>
								<option value="TCD" {{ ($user->country == "TCD") ? "selected" : "" }}>Chad</option>
								<option value="CHL" {{ ($user->country == "CHL") ? "selected" : "" }}>Chile</option>
								<option value="CHN" {{ ($user->country == "CHN") ? "selected" : "" }}>China</option>
								<option value="CXR" {{ ($user->country == "CXR") ? "selected" : "" }}>Christmas Island</option>
								<option value="CCK" {{ ($user->country == "CCK") ? "selected" : "" }}>Cocos (Keeling) Islands</option>
								<option value="COL" {{ ($user->country == "COL") ? "selected" : "" }}>Colombia</option>
								<option value="COM" {{ ($user->country == "COM") ? "selected" : "" }}>Comoros</option>
								<option value="COG" {{ ($user->country == "COG") ? "selected" : "" }}>Congo</option>
								<option value="COD" {{ ($user->country == "COD") ? "selected" : "" }}>Congo, the Democratic Republic of the</option>
								<option value="COK" {{ ($user->country == "COK") ? "selected" : "" }}>Cook Islands</option>
								<option value="CRI" {{ ($user->country == "CRI") ? "selected" : "" }}>Costa Rica</option>
								<option value="CIV" {{ ($user->country == "CIV") ? "selected" : "" }}>Côte d'Ivoire</option>
								<option value="HRV" {{ ($user->country == "HRV") ? "selected" : "" }}>Croatia</option>
								<option value="CUB" {{ ($user->country == "CUB") ? "selected" : "" }}>Cuba</option>
								<option value="CUW" {{ ($user->country == "CUW") ? "selected" : "" }}>Curaçao</option>
								<option value="CYP" {{ ($user->country == "CYP") ? "selected" : "" }}>Cyprus</option>
								<option value="CZE" {{ ($user->country == "CZE") ? "selected" : "" }}>Czech Republic</option>
								<option value="DNK" {{ ($user->country == "DNK") ? "selected" : "" }}>Denmark</option>
								<option value="DJI" {{ ($user->country == "DJI") ? "selected" : "" }}>Djibouti</option>
								<option value="DMA" {{ ($user->country == "DMA") ? "selected" : "" }}>Dominica</option>
								<option value="DOM" {{ ($user->country == "DOM") ? "selected" : "" }}>Dominican Republic</option>
								<option value="ECU" {{ ($user->country == "ECU") ? "selected" : "" }}>Ecuador</option>
								<option value="EGY" {{ ($user->country == "EGY") ? "selected" : "" }}>Egypt</option>
								<option value="SLV" {{ ($user->country == "SLC") ? "selected" : "" }}>El Salvador</option>
								<option value="GNQ" {{ ($user->country == "GNQ") ? "selected" : "" }}>Equatorial Guinea</option>
								<option value="ERI" {{ ($user->country == "ERI") ? "selected" : "" }}>Eritrea</option>
								<option value="EST" {{ ($user->country == "EST") ? "selected" : "" }}>Estonia</option>
								<option value="ETH" {{ ($user->country == "ETH") ? "selected" : "" }}>Ethiopia</option>
								<option value="FLK" {{ ($user->country == "FLK") ? "selected" : "" }}>Falkland Islands (Malvinas)</option>
								<option value="FRO" {{ ($user->country == "FRO") ? "selected" : "" }}>Faroe Islands</option>
								<option value="FJI" {{ ($user->country == "FJI") ? "selected" : "" }}>Fiji</option>
								<option value="FIN" {{ ($user->country == "FIN") ? "selected" : "" }}>Finland</option>
								<option value="FRA" {{ ($user->country == "FRA") ? "selected" : "" }}>France</option>
								<option value="GUF" {{ ($user->country == "GUF") ? "selected" : "" }}>French Guiana</option>
								<option value="PYF" {{ ($user->country == "PYF") ? "selected" : "" }}>French Polynesia</option>
								<option value="ATF" {{ ($user->country == "ATF") ? "selected" : "" }}>French Southern Territories</option>
								<option value="GAB" {{ ($user->country == "FAB") ? "selected" : "" }}>Gabon</option>
								<option value="GMB" {{ ($user->country == "GMB") ? "selected" : "" }}>Gambia</option>
								<option value="GEO" {{ ($user->country == "GEO") ? "selected" : "" }}>Georgia</option>
								<option value="DEU" {{ ($user->country == "DEU") ? "selected" : "" }}>Germany</option>
								<option value="GHA" {{ ($user->country == "GHA") ? "selected" : "" }}>Ghana</option>
								<option value="GIB" {{ ($user->country == "GIB") ? "selected" : "" }}>Gibraltar</option>
								<option value="GRC" {{ ($user->country == "GRC") ? "selected" : "" }}>Greece</option>
								<option value="GRL" {{ ($user->country == "GRL") ? "selected" : "" }}>Greenland</option>
								<option value="GRD" {{ ($user->country == "GRD") ? "selected" : "" }}>Grenada</option>
								<option value="GLP" {{ ($user->country == "GLP") ? "selected" : "" }}>Guadeloupe</option>
								<option value="GUM" {{ ($user->country == "GUM") ? "selected" : "" }}>Guam</option>
								<option value="GTM" {{ ($user->country == "GTM") ? "selected" : "" }}>Guatemala</option>
								<option value="GGY" {{ ($user->country == "GGY") ? "selected" : "" }}>Guernsey</option>
								<option value="GIN" {{ ($user->country == "GIN") ? "selected" : "" }}>Guinea</option>
								<option value="GNB" {{ ($user->country == "GNB") ? "selected" : "" }}>Guinea-Bissau</option>
								<option value="GUY" {{ ($user->country == "GUY") ? "selected" : "" }}>Guyana</option>
								<option value="HTI" {{ ($user->country == "HTI") ? "selected" : "" }}>Haiti</option>
								<option value="HMD" {{ ($user->country == "HMD") ? "selected" : "" }}>Heard Island and McDonald Islands</option>
								<option value="VAT" {{ ($user->country == "VAT") ? "selected" : "" }}>Holy See (Vatican City State)</option>
								<option value="HND" {{ ($user->country == "HND") ? "selected" : "" }}>Honduras</option>
								<option value="HKG" {{ ($user->country == "HKG") ? "selected" : "" }}>Hong Kong</option>
								<option value="HUN" {{ ($user->country == "HUN") ? "selected" : "" }}>Hungary</option>
								<option value="ISL" {{ ($user->country == "ISL") ? "selected" : "" }}>Iceland</option>
								<option value="IND" {{ ($user->country == "IND") ? "selected" : "" }}>India</option>
								<option value="IDN" {{ ($user->country == "IDN") ? "selected" : "" }}>Indonesia</option>
								<option value="IRN" {{ ($user->country == "IRN") ? "selected" : "" }}>Iran, Islamic Republic of</option>
								<option value="IRQ" {{ ($user->country == "IRQ") ? "selected" : "" }}>Iraq</option>
								<option value="IRL" {{ ($user->country == "IRL") ? "selected" : "" }}>Ireland</option>
								<option value="IMN" {{ ($user->country == "IMN") ? "selected" : "" }}>Isle of Man</option>
								<option value="ISR" {{ ($user->country == "ISR") ? "selected" : "" }}>Israel</option>
								<option value="ITA" {{ ($user->country == "ITA") ? "selected" : "" }}>Italy</option>
								<option value="JAM" {{ ($user->country == "JAM") ? "selected" : "" }}>Jamaica</option>
								<option value="JPN" {{ ($user->country == "JPN") ? "selected" : "" }}>Japan</option>
								<option value="JEY" {{ ($user->country == "JEY") ? "selected" : "" }}>Jersey</option>
								<option value="JOR" {{ ($user->country == "JOR") ? "selected" : "" }}>Jordan</option>
								<option value="KAZ" {{ ($user->country == "KAZ") ? "selected" : "" }}>Kazakhstan</option>
								<option value="KEN" {{ ($user->country == "KEN") ? "selected" : "" }}>Kenya</option>
								<option value="KIR" {{ ($user->country == "KIR") ? "selected" : "" }}>Kiribati</option>
								<option value="PRK" {{ ($user->country == "PRK") ? "selected" : "" }}>Korea, Democratic People's Republic of</option>
								<option value="KOR" {{ ($user->country == "KOR") ? "selected" : "" }}>Korea, Republic of</option>
								<option value="KWT" {{ ($user->country == "KWT") ? "selected" : "" }}>Kuwait</option>
								<option value="KGZ" {{ ($user->country == "KGZ") ? "selected" : "" }}>Kyrgyzstan</option>
								<option value="LAO" {{ ($user->country == "LAO") ? "selected" : "" }}>Lao People's Democratic Republic</option>
								<option value="LVA" {{ ($user->country == "LVA") ? "selected" : "" }}>Latvia</option>
								<option value="LBN" {{ ($user->country == "LBN") ? "selected" : "" }}>Lebanon</option>
								<option value="LSO" {{ ($user->country == "LSO") ? "selected" : "" }}>Lesotho</option>
								<option value="LBR" {{ ($user->country == "LBR") ? "selected" : "" }}>Liberia</option>
								<option value="LBY" {{ ($user->country == "LBY") ? "selected" : "" }}>Libya</option>
								<option value="LIE" {{ ($user->country == "LIE") ? "selected" : "" }}>Liechtenstein</option>
								<option value="LTU" {{ ($user->country == "LTU") ? "selected" : "" }}>Lithuania</option>
								<option value="LUX" {{ ($user->country == "LUX") ? "selected" : "" }}>Luxembourg</option>
								<option value="MAC" {{ ($user->country == "MAC") ? "selected" : "" }}>Macao</option>
								<option value="MKD" {{ ($user->country == "MKD") ? "selected" : "" }}>Macedonia, the former Yugoslav Republic of</option>
								<option value="MDG" {{ ($user->country == "MDG") ? "selected" : "" }}>Madagascar</option>
								<option value="MWI" {{ ($user->country == "MWI") ? "selected" : "" }}>Malawi</option>
								<option value="MYS" {{ ($user->country == "MYS") ? "selected" : "" }}>Malaysia</option>
								<option value="MDV" {{ ($user->country == "MDV") ? "selected" : "" }}>Maldives</option>
								<option value="MLI" {{ ($user->country == "MLI") ? "selected" : "" }}>Mali</option>
								<option value="MLT" {{ ($user->country == "MLT") ? "selected" : "" }}>Malta</option>
								<option value="MHL" {{ ($user->country == "MHL") ? "selected" : "" }}>Marshall Islands</option>
								<option value="MTQ" {{ ($user->country == "MTQ") ? "selected" : "" }}>Martinique</option>
								<option value="MRT" {{ ($user->country == "MRT") ? "selected" : "" }}>Mauritania</option>
								<option value="MUS" {{ ($user->country == "MUS") ? "selected" : "" }}>Mauritius</option>
								<option value="MYT" {{ ($user->country == "MYT") ? "selected" : "" }}>Mayotte</option>
								<option value="MEX" {{ ($user->country == "MEX") ? "selected" : "" }}>Mexico</option>
								<option value="FSM" {{ ($user->country == "FXM") ? "selected" : "" }}>Micronesia, Federated States of</option>
								<option value="MDA" {{ ($user->country == "MDA") ? "selected" : "" }}>Moldova, Republic of</option>
								<option value="MCO" {{ ($user->country == "MCO") ? "selected" : "" }}>Monaco</option>
								<option value="MNG" {{ ($user->country == "MNG") ? "selected" : "" }}>Mongolia</option>
								<option value="MNE" {{ ($user->country == "MNE") ? "selected" : "" }}>Montenegro</option>
								<option value="MSR" {{ ($user->country == "MSR") ? "selected" : "" }}>Montserrat</option>
								<option value="MAR" {{ ($user->country == "MAR") ? "selected" : "" }}>Morocco</option>
								<option value="MOZ" {{ ($user->country == "MOZ") ? "selected" : "" }}>Mozambique</option>
								<option value="MMR" {{ ($user->country == "MMR") ? "selected" : "" }}>Myanmar</option>
								<option value="NAM" {{ ($user->country == "NAM") ? "selected" : "" }}>Namibia</option>
								<option value="NRU" {{ ($user->country == "NRU") ? "selected" : "" }}>Nauru</option>
								<option value="NPL" {{ ($user->country == "NPL") ? "selected" : "" }}>Nepal</option>
								<option value="NLD" {{ ($user->country == "NLD") ? "selected" : "" }}>Netherlands</option>
								<option value="NCL" {{ ($user->country == "NCL") ? "selected" : "" }}>New Caledonia</option>
								<option value="NZL" {{ ($user->country == "NZL") ? "selected" : "" }}>New Zealand</option>
								<option value="NIC" {{ ($user->country == "NIC") ? "selected" : "" }}>Nicaragua</option>
								<option value="NER" {{ ($user->country == "NER") ? "selected" : "" }}>Niger</option>
								<option value="NGA" {{ ($user->country == "NGA") ? "selected" : "" }}>Nigeria</option>
								<option value="NIU" {{ ($user->country == "NIU") ? "selected" : "" }}>Niue</option>
								<option value="NFK" {{ ($user->country == "NFK") ? "selected" : "" }}>Norfolk Island</option>
								<option value="MNP" {{ ($user->country == "MNP") ? "selected" : "" }}>Northern Mariana Islands</option>
								<option value="NOR" {{ ($user->country == "NOR") ? "selected" : "" }}>Norway</option>
								<option value="OMN" {{ ($user->country == "OMN") ? "selected" : "" }}>Oman</option>
								<option value="PAK" {{ ($user->country == "PAK") ? "selected" : "" }}>Pakistan</option>
								<option value="PLW" {{ ($user->country == "PLW") ? "selected" : "" }}>Palau</option>
								<option value="PSE" {{ ($user->country == "PSE") ? "selected" : "" }}>Palestinian Territory, Occupied</option>
								<option value="PAN" {{ ($user->country == "PAN") ? "selected" : "" }}>Panama</option>
								<option value="PNG" {{ ($user->country == "PNG") ? "selected" : "" }}>Papua New Guinea</option>
								<option value="PRY" {{ ($user->country == "PRY") ? "selected" : "" }}>Paraguay</option>
								<option value="PER" {{ ($user->country == "PER") ? "selected" : "" }}>Peru</option>
								<option value="PHL" {{ ($user->country == "PHL") ? "selected" : "" }}>Philippines</option>
								<option value="PCN" {{ ($user->country == "PCN") ? "selected" : "" }}>Pitcairn</option>
								<option value="POL" {{ ($user->country == "POL") ? "selected" : "" }}>Poland</option>
								<option value="PRT" {{ ($user->country == "PRT") ? "selected" : "" }}>Portugal</option>
								<option value="PRI" {{ ($user->country == "PRI") ? "selected" : "" }}>Puerto Rico</option>
								<option value="QAT" {{ ($user->country == "QAT") ? "selected" : "" }}>Qatar</option>
								<option value="REU" {{ ($user->country == "REU") ? "selected" : "" }}>Réunion</option>
								<option value="ROU" {{ ($user->country == "ROU") ? "selected" : "" }}>Romania</option>
								<option value="RUS" {{ ($user->country == "RUS") ? "selected" : "" }}>Russian Federation</option>
								<option value="RWA" {{ ($user->country == "RWA") ? "selected" : "" }}>Rwanda</option>
								<option value="BLM" {{ ($user->country == "BLM") ? "selected" : "" }}>Saint Barthélemy</option>
								<option value="SHN" {{ ($user->country == "SHN") ? "selected" : "" }}>Saint Helena, Ascension and Tristan da Cunha</option>
								<option value="KNA" {{ ($user->country == "KNA") ? "selected" : "" }}>Saint Kitts and Nevis</option>
								<option value="LCA" {{ ($user->country == "LCA") ? "selected" : "" }}>Saint Lucia</option>
								<option value="MAF" {{ ($user->country == "MAF") ? "selected" : "" }}>Saint Martin (French part)</option>
								<option value="SPM" {{ ($user->country == "SPM") ? "selected" : "" }}>Saint Pierre and Miquelon</option>
								<option value="VCT" {{ ($user->country == "VCT") ? "selected" : "" }}>Saint Vincent and the Grenadines</option>
								<option value="WSM" {{ ($user->country == "WSM") ? "selected" : "" }}>Samoa</option>
								<option value="SMR" {{ ($user->country == "SMR") ? "selected" : "" }}>San Marino</option>
								<option value="STP" {{ ($user->country == "STP") ? "selected" : "" }}>Sao Tome and Principe</option>
								<option value="SAU" {{ ($user->country == "SAU") ? "selected" : "" }}>Saudi Arabia</option>
								<option value="SEN" {{ ($user->country == "SEN") ? "selected" : "" }}>Senegal</option>
								<option value="SRB" {{ ($user->country == "SRB") ? "selected" : "" }}>Serbia</option>
								<option value="SYC" {{ ($user->country == "SYC") ? "selected" : "" }}>Seychelles</option>
								<option value="SLE" {{ ($user->country == "SLE") ? "selected" : "" }}>Sierra Leone</option>
								<option value="SGP" {{ ($user->country == "SGP") ? "selected" : "" }}>Singapore</option>
								<option value="SXM" {{ ($user->country == "SXM") ? "selected" : "" }}>Sint Maarten (Dutch part)</option>
								<option value="SVK" {{ ($user->country == "SVK") ? "selected" : "" }}>Slovakia</option>
								<option value="SVN" {{ ($user->country == "SVN") ? "selected" : "" }}>Slovenia</option>
								<option value="SLB" {{ ($user->country == "SLB") ? "selected" : "" }}>Solomon Islands</option>
								<option value="SOM" {{ ($user->country == "SOM") ? "selected" : "" }}>Somalia</option>
								<option value="ZAF" {{ ($user->country == "ZAF") ? "selected" : "" }}>South Africa</option>
								<option value="SGS" {{ ($user->country == "SGS") ? "selected" : "" }}>South Georgia and the South Sandwich Islands</option>
								<option value="SSD" {{ ($user->country == "SSD") ? "selected" : "" }}>South Sudan</option>
								<option value="ESP" {{ ($user->country == "ESP") ? "selected" : "" }}>Spain</option>
								<option value="LKA" {{ ($user->country == "LKA") ? "selected" : "" }}>Sri Lanka</option>
								<option value="SDN" {{ ($user->country == "SDN") ? "selected" : "" }}>Sudan</option>
								<option value="SUR" {{ ($user->country == "SUR") ? "selected" : "" }}>Suriname</option>
								<option value="SJM" {{ ($user->country == "SJM") ? "selected" : "" }}>Svalbard and Jan Mayen</option>
								<option value="SWZ" {{ ($user->country == "SWZ") ? "selected" : "" }}>Swaziland</option>
								<option value="SWE" {{ ($user->country == "SWE") ? "selected" : "" }}>Sweden</option>
								<option value="CHE" {{ ($user->country == "CHE") ? "selected" : "" }}>Switzerland</option>
								<option value="SYR" {{ ($user->country == "SYR") ? "selected" : "" }}>Syrian Arab Republic</option>
								<option value="TWN" {{ ($user->country == "TWN") ? "selected" : "" }}>Taiwan, Province of China</option>
								<option value="TJK" {{ ($user->country == "TJK") ? "selected" : "" }}>Tajikistan</option>
								<option value="TZA" {{ ($user->country == "TZA") ? "selected" : "" }}>Tanzania, United Republic of</option>
								<option value="THA" {{ ($user->country == "THA") ? "selected" : "" }}>Thailand</option>
								<option value="TLS" {{ ($user->country == "TLS") ? "selected" : "" }}>Timor-Leste</option>
								<option value="TGO" {{ ($user->country == "TGO") ? "selected" : "" }}>Togo</option>
								<option value="TKL" {{ ($user->country == "TKL") ? "selected" : "" }}>Tokelau</option>
								<option value="TON" {{ ($user->country == "TON") ? "selected" : "" }}>Tonga</option>
								<option value="TTO" {{ ($user->country == "TTO") ? "selected" : "" }}>Trinidad and Tobago</option>
								<option value="TUN" {{ ($user->country == "TUN") ? "selected" : "" }}>Tunisia</option>
								<option value="TUR" {{ ($user->country == "TUR") ? "selected" : "" }}>Turkey</option>
								<option value="TKM" {{ ($user->country == "TKM") ? "selected" : "" }}>Turkmenistan</option>
								<option value="TCA" {{ ($user->country == "TCA") ? "selected" : "" }}>Turks and Caicos Islands</option>
								<option value="TUV" {{ ($user->country == "TUV") ? "selected" : "" }}>Tuvalu</option>
								<option value="UGA" {{ ($user->country == "UGA") ? "selected" : "" }}>Uganda</option>
								<option value="UKR" {{ ($user->country == "UKR") ? "selected" : "" }}>Ukraine</option>
								<option value="ARE" {{ ($user->country == "ARE") ? "selected" : "" }}>United Arab Emirates</option>
								<option value="GBR" {{ ($user->country == "GBR") ? "selected" : "" }}>United Kingdom</option>
								<option value="UMI" {{ ($user->country == "UMI") ? "selected" : "" }}>United States Minor Outlying Islands</option>
								<option value="URY" {{ ($user->country == "URY") ? "selected" : "" }}>Uruguay</option>
								<option value="UZB" {{ ($user->country == "UZB") ? "selected" : "" }}>Uzbekistan</option>
								<option value="VUT" {{ ($user->country == "VUT") ? "selected" : "" }}>Vanuatu</option>
								<option value="VEN" {{ ($user->country == "VEN") ? "selected" : "" }}>Venezuela, Bolivarian Republic of</option>
								<option value="VNM" {{ ($user->country == "VNM") ? "selected" : "" }}>Viet Nam</option>
								<option value="VGB" {{ ($user->country == "VGB") ? "selected" : "" }}>Virgin Islands, British</option>
								<option value="VIR" {{ ($user->country == "VIR") ? "selected" : "" }}>Virgin Islands, U.S.</option>
								<option value="WLF" {{ ($user->country == "WLF") ? "selected" : "" }}>Wallis and Futuna</option>
								<option value="ESH" {{ ($user->country == "ESH") ? "selected" : "" }}>Western Sahara</option>
								<option value="YEM" {{ ($user->country == "YEM") ? "selected" : "" }}>Yemen</option>
								<option value="ZMB" {{ ($user->country == "ZMB") ? "selected" : "" }}>Zambia</option>
								<option value="ZWE" {{ ($user->country == "ZWE") ? "selected" : "" }}>Zimbabwe</option>
							</select>
						</div>
						
						<div class="form-group">
							<label id="shipping_zip_code">Zip Code</label>
							<input type="text" name="shipping_zip_code" id="shipping_zip_code" class="form-control" value="{{ $user->shipping_zip_code }}" />
						</div>
						
						<div class="form-group">
							<input type="submit" class="btn btn-success pull-right" value="Update" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection