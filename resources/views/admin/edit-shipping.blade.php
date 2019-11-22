@extends("layouts.app")
@section("content")
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-8 col-md-offset-2">
				<div class="page-header">
					<h1>Edit Order</h1>
				</div>
				@if (count($errors))
					<div class="alert alert-danger">
					<strong>Uh oh!</strong>
					@foreach ($errors->all() as $error)
						<br>{{ $error }}
					@endforeach
					</div>
				@endif
				<form action="" method="post">
					{{ csrf_field() }}
					
					<div class="row">
						<div class="col-sm-4 form-group">
							<label>Item #</label>
							<input type="text" name="item" class="form-control" required="true" value="{{ $order->item }}" />
						</div>
						<div class="col-sm-4 form-group">
							<label>Quantity</label>
							<input type="text" name="quantity" class="form-control" required="true" value="{{ $order->quantity }}" />
						</div>
						<div class="col-sm-4 form-group">
							<label>Recipient</label>
							<input type="text" name="recipient" class="form-control" required="true" value="{{ $order->recipient }}" />
						</div>
					</div>
					<div class="row">						
						<div class="col-sm-4 form-group">
							<label>Company</label>
							<input type="text" name="company" class="form-control" value="{{ $order->company }}" />
						</div>
						<div class="col-sm-4 form-group">
							<label>Address Line 1</label>
							<input type="text" name="address_1" class="form-control" required="true" value="{{ $order->address_1 }}" />
						</div>
						<div class="col-sm-4 form-group">
							<label>Address Line 2</label>
							<input type="text" name="address_2" class="form-control" value="{{ $order->address_2 }}" />
						</div>
					</div>
					<div class="row">						
						<div class="col-sm-3 form-group">
							<label>City</label>
							<input type="text" name="city" class="form-control" required="true" value="{{ $order->city }}" />
						</div>
						<div class="col-sm-3 form-group">
							<label>State</label>
							<select name="state" class="form-control">
								<option value="AL" {{ ($order->state == "AL") ? "selected" : "" }}>Alabama</option>
								<option value="AK" {{ ($order->state == "AK") ? "selected" : "" }}>Alaska</option>
								<option value="AZ" {{ ($order->state == "AZ") ? "selected" : "" }}>Arizona</option>
								<option value="AR" {{ ($order->state == "AR") ? "selected" : "" }}>Arkansas</option>
								<option value="CA" {{ ($order->state == "CA") ? "selected" : "" }}>California</option>
								<option value="CO" {{ ($order->state == "CO") ? "selected" : "" }}>Colorado</option>
								<option value="CT" {{ ($order->state == "CT") ? "selected" : "" }}>Connecticut</option>
								<option value="DE" {{ ($order->state == "DE") ? "selected" : "" }}>Delaware</option>
								<option value="DC" {{ ($order->state == "DC") ? "selected" : "" }}>District Of Columbia</option>
								<option value="FL" {{ ($order->state == "FL") ? "selected" : "" }}>Florida</option>
								<option value="GA" {{ ($order->state == "GA") ? "selected" : "" }}>Georgia</option>
								<option value="HI" {{ ($order->state == "HI") ? "selected" : "" }}>Hawaii</option>
								<option value="ID" {{ ($order->state == "ID") ? "selected" : "" }}>Idaho</option>
								<option value="IL" {{ ($order->state == "IL") ? "selected" : "" }}>Illinois</option>
								<option value="IN" {{ ($order->state == "IN") ? "selected" : "" }}>Indiana</option>
								<option value="IA" {{ ($order->state == "IA") ? "selected" : "" }}>Iowa</option>
								<option value="KS" {{ ($order->state == "KS") ? "selected" : "" }}>Kansas</option>
								<option value="KY" {{ ($order->state == "KY") ? "selected" : "" }}>Kentucky</option>
								<option value="LA" {{ ($order->state == "LA") ? "selected" : "" }}>Louisiana</option>
								<option value="ME" {{ ($order->state == "ME") ? "selected" : "" }}>Maine</option>
								<option value="MD" {{ ($order->state == "MD") ? "selected" : "" }}>Maryland</option>
								<option value="MA" {{ ($order->state == "MA") ? "selected" : "" }}>Massachusetts</option>
								<option value="MI" {{ ($order->state == "MI") ? "selected" : "" }}>Michigan</option>
								<option value="MN" {{ ($order->state == "MN") ? "selected" : "" }}>Minnesota</option>
								<option value="MS" {{ ($order->state == "MS") ? "selected" : "" }}>Mississippi</option>
								<option value="MO" {{ ($order->state == "MO") ? "selected" : "" }}>Missouri</option>
								<option value="MT" {{ ($order->state == "MT") ? "selected" : "" }}>Montana</option>
								<option value="NE" {{ ($order->state == "NE") ? "selected" : "" }}>Nebraska</option>
								<option value="NV" {{ ($order->state == "NV") ? "selected" : "" }}>Nevada</option>
								<option value="NH" {{ ($order->state == "NH") ? "selected" : "" }}>New Hampshire</option>
								<option value="NJ" {{ ($order->state == "NJ") ? "selected" : "" }}>New Jersey</option>
								<option value="NM" {{ ($order->state == "NM") ? "selected" : "" }}>New Mexico</option>
								<option value="NY" {{ ($order->state == "NY") ? "selected" : "" }}>New York</option>
								<option value="NC" {{ ($order->state == "NC") ? "selected" : "" }}>North Carolina</option>
								<option value="ND" {{ ($order->state == "ND") ? "selected" : "" }}>North Dakota</option>
								<option value="OH" {{ ($order->state == "OH") ? "selected" : "" }}>Ohio</option>
								<option value="OK" {{ ($order->state == "OK") ? "selected" : "" }}>Oklahoma</option>
								<option value="OR" {{ ($order->state == "OR") ? "selected" : "" }}>Oregon</option>
								<option value="PA" {{ ($order->state == "PA") ? "selected" : "" }}>Pennsylvania</option>
								<option value="RI" {{ ($order->state == "RI") ? "selected" : "" }}>Rhode Island</option>
								<option value="SC" {{ ($order->state == "SC") ? "selected" : "" }}>South Carolina</option>
								<option value="SD" {{ ($order->state == "SD") ? "selected" : "" }}>South Dakota</option>
								<option value="TN" {{ ($order->state == "TN") ? "selected" : "" }}>Tennessee</option>
								<option value="TX" {{ ($order->state == "TX") ? "selected" : "" }}>Texas</option>
								<option value="UT" {{ ($order->state == "UT") ? "selected" : "" }}>Utah</option>
								<option value="VT" {{ ($order->state == "VT") ? "selected" : "" }}>Vermont</option>
								<option value="VA" {{ ($order->state == "VA") ? "selected" : "" }}>Virginia</option>
								<option value="WA" {{ ($order->state == "WA") ? "selected" : "" }}>Washington</option>
								<option value="WV" {{ ($order->state == "WV") ? "selected" : "" }}>West Virginia</option>
								<option value="WI" {{ ($order->state == "WI") ? "selected" : "" }}>Wisconsin</option>
								<option value="WY" {{ ($order->state == "WY") ? "selected" : "" }}>Wyoming</option>
							</select>
						</div>
						<div class="col-sm-3 form-group">
							<label>Post Code</label>
							<input type="text" name="post_code" class="form-control" required="true" value="{{ $order->post_code }}" />
						</div>
						<div class="col-sm-3 form-group">
							<label>Country</label>
							<select name="country" class="form-control">
								<option value="USA" {{ ($order->country == "USA") ? "selected" : "" }}>United States</option>
								<option value="AFG" {{ ($order->country == "AFG") ? "selected" : "" }}>Afghanistan</option>
								<option value="ALA" {{ ($order->country == "ALA") ? "selected" : "" }}>Åland Islands</option>
								<option value="ALB" {{ ($order->country == "ALB") ? "selected" : "" }}>Albania</option>
								<option value="DZA" {{ ($order->country == "DZA") ? "selected" : "" }}>Algeria</option>
								<option value="ASM" {{ ($order->country == "ASM") ? "selected" : "" }}>American Samoa</option>
								<option value="AND" {{ ($order->country == "AND") ? "selected" : "" }}>Andorra</option>
								<option value="AGO" {{ ($order->country == "AGO") ? "selected" : "" }}>Angola</option>
								<option value="AIA" {{ ($order->country == "AIA") ? "selected" : "" }}>Anguilla</option>
								<option value="ATA" {{ ($order->country == "ATA") ? "selected" : "" }}>Antarctica</option>
								<option value="ATG" {{ ($order->country == "ATG") ? "selected" : "" }}>Antigua and Barbuda</option>
								<option value="ARG" {{ ($order->country == "ARG") ? "selected" : "" }}>Argentina</option>
								<option value="ARM" {{ ($order->country == "ARM") ? "selected" : "" }}>Armenia</option>
								<option value="ABW" {{ ($order->country == "ABW") ? "selected" : "" }}>Aruba</option>
								<option value="AUS" {{ ($order->country == "AUS") ? "selected" : "" }}>Australia</option>
								<option value="AUT" {{ ($order->country == "AUT") ? "selected" : "" }}>Austria</option>
								<option value="AZE" {{ ($order->country == "AZE") ? "selected" : "" }}>Azerbaijan</option>
								<option value="BHS" {{ ($order->country == "BHS") ? "selected" : "" }}>Bahamas</option>
								<option value="BHR" {{ ($order->country == "BHR") ? "selected" : "" }}>Bahrain</option>
								<option value="BGD" {{ ($order->country == "BGD") ? "selected" : "" }}>Bangladesh</option>
								<option value="BRB" {{ ($order->country == "BRB") ? "selected" : "" }}>Barbados</option>
								<option value="BLR" {{ ($order->country == "BLR") ? "selected" : "" }}>Belarus</option>
								<option value="BEL" {{ ($order->country == "BEL") ? "selected" : "" }}>Belgium</option>
								<option value="BLZ" {{ ($order->country == "BLZ") ? "selected" : "" }}>Belize</option>
								<option value="BEN" {{ ($order->country == "BEM") ? "selected" : "" }}>Benin</option>
								<option value="BMU" {{ ($order->country == "BMU") ? "selected" : "" }}>Bermuda</option>
								<option value="BTN" {{ ($order->country == "BTN") ? "selected" : "" }}>Bhutan</option>
								<option value="BOL" {{ ($order->country == "BOL") ? "selected" : "" }}>Bolivia, Plurinational State of</option>
								<option value="BES" {{ ($order->country == "BES") ? "selected" : "" }}>Bonaire, Sint Eustatius and Saba</option>
								<option value="BIH" {{ ($order->country == "BIH") ? "selected" : "" }}>Bosnia and Herzegovina</option>
								<option value="BWA" {{ ($order->country == "BWA") ? "selected" : "" }}>Botswana</option>
								<option value="BVT" {{ ($order->country == "BVT") ? "selected" : "" }}>Bouvet Island</option>
								<option value="BRA" {{ ($order->country == "BRA") ? "selected" : "" }}>Brazil</option>
								<option value="IOT" {{ ($order->country == "IOT") ? "selected" : "" }}>British Indian Ocean Territory</option>
								<option value="BRN" {{ ($order->country == "BRN") ? "selected" : "" }}>Brunei Darussalam</option>
								<option value="BGR" {{ ($order->country == "BGR") ? "selected" : "" }}>Bulgaria</option>
								<option value="BFA" {{ ($order->country == "BFA") ? "selected" : "" }}>Burkina Faso</option>
								<option value="BDI" {{ ($order->country == "BDI") ? "selected" : "" }}>Burundi</option>
								<option value="KHM" {{ ($order->country == "KHM") ? "selected" : "" }}>Cambodia</option>
								<option value="CMR" {{ ($order->country == "CMR") ? "selected" : "" }}>Cameroon</option>
								<option value="CAN" {{ ($order->country == "CAN") ? "selected" : "" }}>Canada</option>
								<option value="CPV" {{ ($order->country == "CPV") ? "selected" : "" }}>Cape Verde</option>
								<option value="CYM" {{ ($order->country == "CYM") ? "selected" : "" }}>Cayman Islands</option>
								<option value="CAF" {{ ($order->country == "CAF") ? "selected" : "" }}>Central African Republic</option>
								<option value="TCD" {{ ($order->country == "TCD") ? "selected" : "" }}>Chad</option>
								<option value="CHL" {{ ($order->country == "CHL") ? "selected" : "" }}>Chile</option>
								<option value="CHN" {{ ($order->country == "CHN") ? "selected" : "" }}>China</option>
								<option value="CXR" {{ ($order->country == "CXR") ? "selected" : "" }}>Christmas Island</option>
								<option value="CCK" {{ ($order->country == "CCK") ? "selected" : "" }}>Cocos (Keeling) Islands</option>
								<option value="COL" {{ ($order->country == "COL") ? "selected" : "" }}>Colombia</option>
								<option value="COM" {{ ($order->country == "COM") ? "selected" : "" }}>Comoros</option>
								<option value="COG" {{ ($order->country == "COG") ? "selected" : "" }}>Congo</option>
								<option value="COD" {{ ($order->country == "COD") ? "selected" : "" }}>Congo, the Democratic Republic of the</option>
								<option value="COK" {{ ($order->country == "COK") ? "selected" : "" }}>Cook Islands</option>
								<option value="CRI" {{ ($order->country == "CRI") ? "selected" : "" }}>Costa Rica</option>
								<option value="CIV" {{ ($order->country == "CIV") ? "selected" : "" }}>Côte d'Ivoire</option>
								<option value="HRV" {{ ($order->country == "HRV") ? "selected" : "" }}>Croatia</option>
								<option value="CUB" {{ ($order->country == "CUB") ? "selected" : "" }}>Cuba</option>
								<option value="CUW" {{ ($order->country == "CUW") ? "selected" : "" }}>Curaçao</option>
								<option value="CYP" {{ ($order->country == "CYP") ? "selected" : "" }}>Cyprus</option>
								<option value="CZE" {{ ($order->country == "CZE") ? "selected" : "" }}>Czech Republic</option>
								<option value="DNK" {{ ($order->country == "DNK") ? "selected" : "" }}>Denmark</option>
								<option value="DJI" {{ ($order->country == "DJI") ? "selected" : "" }}>Djibouti</option>
								<option value="DMA" {{ ($order->country == "DMA") ? "selected" : "" }}>Dominica</option>
								<option value="DOM" {{ ($order->country == "DOM") ? "selected" : "" }}>Dominican Republic</option>
								<option value="ECU" {{ ($order->country == "ECU") ? "selected" : "" }}>Ecuador</option>
								<option value="EGY" {{ ($order->country == "EGY") ? "selected" : "" }}>Egypt</option>
								<option value="SLV" {{ ($order->country == "SLC") ? "selected" : "" }}>El Salvador</option>
								<option value="GNQ" {{ ($order->country == "GNQ") ? "selected" : "" }}>Equatorial Guinea</option>
								<option value="ERI" {{ ($order->country == "ERI") ? "selected" : "" }}>Eritrea</option>
								<option value="EST" {{ ($order->country == "EST") ? "selected" : "" }}>Estonia</option>
								<option value="ETH" {{ ($order->country == "ETH") ? "selected" : "" }}>Ethiopia</option>
								<option value="FLK" {{ ($order->country == "FLK") ? "selected" : "" }}>Falkland Islands (Malvinas)</option>
								<option value="FRO" {{ ($order->country == "FRO") ? "selected" : "" }}>Faroe Islands</option>
								<option value="FJI" {{ ($order->country == "FJI") ? "selected" : "" }}>Fiji</option>
								<option value="FIN" {{ ($order->country == "FIN") ? "selected" : "" }}>Finland</option>
								<option value="FRA" {{ ($order->country == "FRA") ? "selected" : "" }}>France</option>
								<option value="GUF" {{ ($order->country == "GUF") ? "selected" : "" }}>French Guiana</option>
								<option value="PYF" {{ ($order->country == "PYF") ? "selected" : "" }}>French Polynesia</option>
								<option value="ATF" {{ ($order->country == "ATF") ? "selected" : "" }}>French Southern Territories</option>
								<option value="GAB" {{ ($order->country == "FAB") ? "selected" : "" }}>Gabon</option>
								<option value="GMB" {{ ($order->country == "GMB") ? "selected" : "" }}>Gambia</option>
								<option value="GEO" {{ ($order->country == "GEO") ? "selected" : "" }}>Georgia</option>
								<option value="DEU" {{ ($order->country == "DEU") ? "selected" : "" }}>Germany</option>
								<option value="GHA" {{ ($order->country == "GHA") ? "selected" : "" }}>Ghana</option>
								<option value="GIB" {{ ($order->country == "GIB") ? "selected" : "" }}>Gibraltar</option>
								<option value="GRC" {{ ($order->country == "GRC") ? "selected" : "" }}>Greece</option>
								<option value="GRL" {{ ($order->country == "GRL") ? "selected" : "" }}>Greenland</option>
								<option value="GRD" {{ ($order->country == "GRD") ? "selected" : "" }}>Grenada</option>
								<option value="GLP" {{ ($order->country == "GLP") ? "selected" : "" }}>Guadeloupe</option>
								<option value="GUM" {{ ($order->country == "GUM") ? "selected" : "" }}>Guam</option>
								<option value="GTM" {{ ($order->country == "GTM") ? "selected" : "" }}>Guatemala</option>
								<option value="GGY" {{ ($order->country == "GGY") ? "selected" : "" }}>Guernsey</option>
								<option value="GIN" {{ ($order->country == "GIN") ? "selected" : "" }}>Guinea</option>
								<option value="GNB" {{ ($order->country == "GNB") ? "selected" : "" }}>Guinea-Bissau</option>
								<option value="GUY" {{ ($order->country == "GUY") ? "selected" : "" }}>Guyana</option>
								<option value="HTI" {{ ($order->country == "HTI") ? "selected" : "" }}>Haiti</option>
								<option value="HMD" {{ ($order->country == "HMD") ? "selected" : "" }}>Heard Island and McDonald Islands</option>
								<option value="VAT" {{ ($order->country == "VAT") ? "selected" : "" }}>Holy See (Vatican City State)</option>
								<option value="HND" {{ ($order->country == "HND") ? "selected" : "" }}>Honduras</option>
								<option value="HKG" {{ ($order->country == "HKG") ? "selected" : "" }}>Hong Kong</option>
								<option value="HUN" {{ ($order->country == "HUN") ? "selected" : "" }}>Hungary</option>
								<option value="ISL" {{ ($order->country == "ISL") ? "selected" : "" }}>Iceland</option>
								<option value="IND" {{ ($order->country == "IND") ? "selected" : "" }}>India</option>
								<option value="IDN" {{ ($order->country == "IDN") ? "selected" : "" }}>Indonesia</option>
								<option value="IRN" {{ ($order->country == "IRN") ? "selected" : "" }}>Iran, Islamic Republic of</option>
								<option value="IRQ" {{ ($order->country == "IRQ") ? "selected" : "" }}>Iraq</option>
								<option value="IRL" {{ ($order->country == "IRL") ? "selected" : "" }}>Ireland</option>
								<option value="IMN" {{ ($order->country == "IMN") ? "selected" : "" }}>Isle of Man</option>
								<option value="ISR" {{ ($order->country == "ISR") ? "selected" : "" }}>Israel</option>
								<option value="ITA" {{ ($order->country == "ITA") ? "selected" : "" }}>Italy</option>
								<option value="JAM" {{ ($order->country == "JAM") ? "selected" : "" }}>Jamaica</option>
								<option value="JPN" {{ ($order->country == "JPN") ? "selected" : "" }}>Japan</option>
								<option value="JEY" {{ ($order->country == "JEY") ? "selected" : "" }}>Jersey</option>
								<option value="JOR" {{ ($order->country == "JOR") ? "selected" : "" }}>Jordan</option>
								<option value="KAZ" {{ ($order->country == "KAZ") ? "selected" : "" }}>Kazakhstan</option>
								<option value="KEN" {{ ($order->country == "KEN") ? "selected" : "" }}>Kenya</option>
								<option value="KIR" {{ ($order->country == "KIR") ? "selected" : "" }}>Kiribati</option>
								<option value="PRK" {{ ($order->country == "PRK") ? "selected" : "" }}>Korea, Democratic People's Republic of</option>
								<option value="KOR" {{ ($order->country == "KOR") ? "selected" : "" }}>Korea, Republic of</option>
								<option value="KWT" {{ ($order->country == "KWT") ? "selected" : "" }}>Kuwait</option>
								<option value="KGZ" {{ ($order->country == "KGZ") ? "selected" : "" }}>Kyrgyzstan</option>
								<option value="LAO" {{ ($order->country == "LAO") ? "selected" : "" }}>Lao People's Democratic Republic</option>
								<option value="LVA" {{ ($order->country == "LVA") ? "selected" : "" }}>Latvia</option>
								<option value="LBN" {{ ($order->country == "LBN") ? "selected" : "" }}>Lebanon</option>
								<option value="LSO" {{ ($order->country == "LSO") ? "selected" : "" }}>Lesotho</option>
								<option value="LBR" {{ ($order->country == "LBR") ? "selected" : "" }}>Liberia</option>
								<option value="LBY" {{ ($order->country == "LBY") ? "selected" : "" }}>Libya</option>
								<option value="LIE" {{ ($order->country == "LIE") ? "selected" : "" }}>Liechtenstein</option>
								<option value="LTU" {{ ($order->country == "LTU") ? "selected" : "" }}>Lithuania</option>
								<option value="LUX" {{ ($order->country == "LUX") ? "selected" : "" }}>Luxembourg</option>
								<option value="MAC" {{ ($order->country == "MAC") ? "selected" : "" }}>Macao</option>
								<option value="MKD" {{ ($order->country == "MKD") ? "selected" : "" }}>Macedonia, the former Yugoslav Republic of</option>
								<option value="MDG" {{ ($order->country == "MDG") ? "selected" : "" }}>Madagascar</option>
								<option value="MWI" {{ ($order->country == "MWI") ? "selected" : "" }}>Malawi</option>
								<option value="MYS" {{ ($order->country == "MYS") ? "selected" : "" }}>Malaysia</option>
								<option value="MDV" {{ ($order->country == "MDV") ? "selected" : "" }}>Maldives</option>
								<option value="MLI" {{ ($order->country == "MLI") ? "selected" : "" }}>Mali</option>
								<option value="MLT" {{ ($order->country == "MLT") ? "selected" : "" }}>Malta</option>
								<option value="MHL" {{ ($order->country == "MHL") ? "selected" : "" }}>Marshall Islands</option>
								<option value="MTQ" {{ ($order->country == "MTQ") ? "selected" : "" }}>Martinique</option>
								<option value="MRT" {{ ($order->country == "MRT") ? "selected" : "" }}>Mauritania</option>
								<option value="MUS" {{ ($order->country == "MUS") ? "selected" : "" }}>Mauritius</option>
								<option value="MYT" {{ ($order->country == "MYT") ? "selected" : "" }}>Mayotte</option>
								<option value="MEX" {{ ($order->country == "MEX") ? "selected" : "" }}>Mexico</option>
								<option value="FSM" {{ ($order->country == "FXM") ? "selected" : "" }}>Micronesia, Federated States of</option>
								<option value="MDA" {{ ($order->country == "MDA") ? "selected" : "" }}>Moldova, Republic of</option>
								<option value="MCO" {{ ($order->country == "MCO") ? "selected" : "" }}>Monaco</option>
								<option value="MNG" {{ ($order->country == "MNG") ? "selected" : "" }}>Mongolia</option>
								<option value="MNE" {{ ($order->country == "MNE") ? "selected" : "" }}>Montenegro</option>
								<option value="MSR" {{ ($order->country == "MSR") ? "selected" : "" }}>Montserrat</option>
								<option value="MAR" {{ ($order->country == "MAR") ? "selected" : "" }}>Morocco</option>
								<option value="MOZ" {{ ($order->country == "MOZ") ? "selected" : "" }}>Mozambique</option>
								<option value="MMR" {{ ($order->country == "MMR") ? "selected" : "" }}>Myanmar</option>
								<option value="NAM" {{ ($order->country == "NAM") ? "selected" : "" }}>Namibia</option>
								<option value="NRU" {{ ($order->country == "NRU") ? "selected" : "" }}>Nauru</option>
								<option value="NPL" {{ ($order->country == "NPL") ? "selected" : "" }}>Nepal</option>
								<option value="NLD" {{ ($order->country == "NLD") ? "selected" : "" }}>Netherlands</option>
								<option value="NCL" {{ ($order->country == "NCL") ? "selected" : "" }}>New Caledonia</option>
								<option value="NZL" {{ ($order->country == "NZL") ? "selected" : "" }}>New Zealand</option>
								<option value="NIC" {{ ($order->country == "NIC") ? "selected" : "" }}>Nicaragua</option>
								<option value="NER" {{ ($order->country == "NER") ? "selected" : "" }}>Niger</option>
								<option value="NGA" {{ ($order->country == "NGA") ? "selected" : "" }}>Nigeria</option>
								<option value="NIU" {{ ($order->country == "NIU") ? "selected" : "" }}>Niue</option>
								<option value="NFK" {{ ($order->country == "NFK") ? "selected" : "" }}>Norfolk Island</option>
								<option value="MNP" {{ ($order->country == "MNP") ? "selected" : "" }}>Northern Mariana Islands</option>
								<option value="NOR" {{ ($order->country == "NOR") ? "selected" : "" }}>Norway</option>
								<option value="OMN" {{ ($order->country == "OMN") ? "selected" : "" }}>Oman</option>
								<option value="PAK" {{ ($order->country == "PAK") ? "selected" : "" }}>Pakistan</option>
								<option value="PLW" {{ ($order->country == "PLW") ? "selected" : "" }}>Palau</option>
								<option value="PSE" {{ ($order->country == "PSE") ? "selected" : "" }}>Palestinian Territory, Occupied</option>
								<option value="PAN" {{ ($order->country == "PAN") ? "selected" : "" }}>Panama</option>
								<option value="PNG" {{ ($order->country == "PNG") ? "selected" : "" }}>Papua New Guinea</option>
								<option value="PRY" {{ ($order->country == "PRY") ? "selected" : "" }}>Paraguay</option>
								<option value="PER" {{ ($order->country == "PER") ? "selected" : "" }}>Peru</option>
								<option value="PHL" {{ ($order->country == "PHL") ? "selected" : "" }}>Philippines</option>
								<option value="PCN" {{ ($order->country == "PCN") ? "selected" : "" }}>Pitcairn</option>
								<option value="POL" {{ ($order->country == "POL") ? "selected" : "" }}>Poland</option>
								<option value="PRT" {{ ($order->country == "PRT") ? "selected" : "" }}>Portugal</option>
								<option value="PRI" {{ ($order->country == "PRI") ? "selected" : "" }}>Puerto Rico</option>
								<option value="QAT" {{ ($order->country == "QAT") ? "selected" : "" }}>Qatar</option>
								<option value="REU" {{ ($order->country == "REU") ? "selected" : "" }}>Réunion</option>
								<option value="ROU" {{ ($order->country == "ROU") ? "selected" : "" }}>Romania</option>
								<option value="RUS" {{ ($order->country == "RUS") ? "selected" : "" }}>Russian Federation</option>
								<option value="RWA" {{ ($order->country == "RWA") ? "selected" : "" }}>Rwanda</option>
								<option value="BLM" {{ ($order->country == "BLM") ? "selected" : "" }}>Saint Barthélemy</option>
								<option value="SHN" {{ ($order->country == "SHN") ? "selected" : "" }}>Saint Helena, Ascension and Tristan da Cunha</option>
								<option value="KNA" {{ ($order->country == "KNA") ? "selected" : "" }}>Saint Kitts and Nevis</option>
								<option value="LCA" {{ ($order->country == "LCA") ? "selected" : "" }}>Saint Lucia</option>
								<option value="MAF" {{ ($order->country == "MAF") ? "selected" : "" }}>Saint Martin (French part)</option>
								<option value="SPM" {{ ($order->country == "SPM") ? "selected" : "" }}>Saint Pierre and Miquelon</option>
								<option value="VCT" {{ ($order->country == "VCT") ? "selected" : "" }}>Saint Vincent and the Grenadines</option>
								<option value="WSM" {{ ($order->country == "WSM") ? "selected" : "" }}>Samoa</option>
								<option value="SMR" {{ ($order->country == "SMR") ? "selected" : "" }}>San Marino</option>
								<option value="STP" {{ ($order->country == "STP") ? "selected" : "" }}>Sao Tome and Principe</option>
								<option value="SAU" {{ ($order->country == "SAU") ? "selected" : "" }}>Saudi Arabia</option>
								<option value="SEN" {{ ($order->country == "SEN") ? "selected" : "" }}>Senegal</option>
								<option value="SRB" {{ ($order->country == "SRB") ? "selected" : "" }}>Serbia</option>
								<option value="SYC" {{ ($order->country == "SYC") ? "selected" : "" }}>Seychelles</option>
								<option value="SLE" {{ ($order->country == "SLE") ? "selected" : "" }}>Sierra Leone</option>
								<option value="SGP" {{ ($order->country == "SGP") ? "selected" : "" }}>Singapore</option>
								<option value="SXM" {{ ($order->country == "SXM") ? "selected" : "" }}>Sint Maarten (Dutch part)</option>
								<option value="SVK" {{ ($order->country == "SVK") ? "selected" : "" }}>Slovakia</option>
								<option value="SVN" {{ ($order->country == "SVN") ? "selected" : "" }}>Slovenia</option>
								<option value="SLB" {{ ($order->country == "SLB") ? "selected" : "" }}>Solomon Islands</option>
								<option value="SOM" {{ ($order->country == "SOM") ? "selected" : "" }}>Somalia</option>
								<option value="ZAF" {{ ($order->country == "ZAF") ? "selected" : "" }}>South Africa</option>
								<option value="SGS" {{ ($order->country == "SGS") ? "selected" : "" }}>South Georgia and the South Sandwich Islands</option>
								<option value="SSD" {{ ($order->country == "SSD") ? "selected" : "" }}>South Sudan</option>
								<option value="ESP" {{ ($order->country == "ESP") ? "selected" : "" }}>Spain</option>
								<option value="LKA" {{ ($order->country == "LKA") ? "selected" : "" }}>Sri Lanka</option>
								<option value="SDN" {{ ($order->country == "SDN") ? "selected" : "" }}>Sudan</option>
								<option value="SUR" {{ ($order->country == "SUR") ? "selected" : "" }}>Suriname</option>
								<option value="SJM" {{ ($order->country == "SJM") ? "selected" : "" }}>Svalbard and Jan Mayen</option>
								<option value="SWZ" {{ ($order->country == "SWZ") ? "selected" : "" }}>Swaziland</option>
								<option value="SWE" {{ ($order->country == "SWE") ? "selected" : "" }}>Sweden</option>
								<option value="CHE" {{ ($order->country == "CHE") ? "selected" : "" }}>Switzerland</option>
								<option value="SYR" {{ ($order->country == "SYR") ? "selected" : "" }}>Syrian Arab Republic</option>
								<option value="TWN" {{ ($order->country == "TWN") ? "selected" : "" }}>Taiwan, Province of China</option>
								<option value="TJK" {{ ($order->country == "TJK") ? "selected" : "" }}>Tajikistan</option>
								<option value="TZA" {{ ($order->country == "TZA") ? "selected" : "" }}>Tanzania, United Republic of</option>
								<option value="THA" {{ ($order->country == "THA") ? "selected" : "" }}>Thailand</option>
								<option value="TLS" {{ ($order->country == "TLS") ? "selected" : "" }}>Timor-Leste</option>
								<option value="TGO" {{ ($order->country == "TGO") ? "selected" : "" }}>Togo</option>
								<option value="TKL" {{ ($order->country == "TKL") ? "selected" : "" }}>Tokelau</option>
								<option value="TON" {{ ($order->country == "TON") ? "selected" : "" }}>Tonga</option>
								<option value="TTO" {{ ($order->country == "TTO") ? "selected" : "" }}>Trinidad and Tobago</option>
								<option value="TUN" {{ ($order->country == "TUN") ? "selected" : "" }}>Tunisia</option>
								<option value="TUR" {{ ($order->country == "TUR") ? "selected" : "" }}>Turkey</option>
								<option value="TKM" {{ ($order->country == "TKM") ? "selected" : "" }}>Turkmenistan</option>
								<option value="TCA" {{ ($order->country == "TCA") ? "selected" : "" }}>Turks and Caicos Islands</option>
								<option value="TUV" {{ ($order->country == "TUV") ? "selected" : "" }}>Tuvalu</option>
								<option value="UGA" {{ ($order->country == "UGA") ? "selected" : "" }}>Uganda</option>
								<option value="UKR" {{ ($order->country == "UKR") ? "selected" : "" }}>Ukraine</option>
								<option value="ARE" {{ ($order->country == "ARE") ? "selected" : "" }}>United Arab Emirates</option>
								<option value="GBR" {{ ($order->country == "GBR") ? "selected" : "" }}>United Kingdom</option>
								<option value="UMI" {{ ($order->country == "UMI") ? "selected" : "" }}>United States Minor Outlying Islands</option>
								<option value="URY" {{ ($order->country == "URY") ? "selected" : "" }}>Uruguay</option>
								<option value="UZB" {{ ($order->country == "UZB") ? "selected" : "" }}>Uzbekistan</option>
								<option value="VUT" {{ ($order->country == "VUT") ? "selected" : "" }}>Vanuatu</option>
								<option value="VEN" {{ ($order->country == "VEN") ? "selected" : "" }}>Venezuela, Bolivarian Republic of</option>
								<option value="VNM" {{ ($order->country == "VNM") ? "selected" : "" }}>Viet Nam</option>
								<option value="VGB" {{ ($order->country == "VGB") ? "selected" : "" }}>Virgin Islands, British</option>
								<option value="VIR" {{ ($order->country == "VIR") ? "selected" : "" }}>Virgin Islands, U.S.</option>
								<option value="WLF" {{ ($order->country == "WLF") ? "selected" : "" }}>Wallis and Futuna</option>
								<option value="ESH" {{ ($order->country == "ESH") ? "selected" : "" }}>Western Sahara</option>
								<option value="YEM" {{ ($order->country == "YEM") ? "selected" : "" }}>Yemen</option>
								<option value="ZMB" {{ ($order->country == "ZMB") ? "selected" : "" }}>Zambia</option>
								<option value="ZWE" {{ ($order->country == "ZWE") ? "selected" : "" }}>Zimbabwe</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 form-group">
							<label>Phone</label>
							<input type="text" name="phone" class="form-control" value="{{ $order->phone }}" />
						</div>
						<div class="col-sm-4 form-group">
							<label>Ship Method</label>
							<select name="ship_method" class="form-control">
								<option {{ ($order->ship_method == "Fedex Ground") ? "selected" : "" }} value="FedEx Ground">FedEx Ground</option>
								<option {{ ($order->ship_method == "Fedex 2 Day") ? "selected" : "" }} value="FedEx 2 Day">FedEx 2 Day</option>
								<option {{ ($order->ship_method == "FedEx Standard Overnight") ? "selected" : "" }} value="FedEx Standard Overnight">FedEx Standard Overnight</option>
								<option {{ ($order->ship_method == "FedEx Priority Overnight") ? "selected" : "" }} value="FedEx Priority Overnight">FedEx Priority Overnight</option>
							</select>
						</div>
						<div class="col-sm-4 form-group">
							<label>Recipient Email</label>
							<input type="text" name="recipient_email" class="form-control" value="{{ $order->recipient_email }}" />
						</div>
					</div>
					<div class="row">						
						<div class="col-sm-6 form-group">
							<label>Sender Email</label>
							<input type="text" name="sender_email" class="form-control" value="{{ $order->sender_email }}" />
						</div>
						<div class="col-sm-6 form-group">
							<label>Sender Email 2</label>
							<input type="text" name="sender_email_2" class="form-control" value="{{ $order->sender_email_2 }}" />
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							<label>Notes</label>
							<textarea name="notes" class="form-control" id="notes">{{ $order->notes }}</textarea>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							<button type="submit" class="btn btn-success pull-right">Update Order</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection