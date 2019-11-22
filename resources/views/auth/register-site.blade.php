@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                		<div class="row">
											<div class="col-sm-12">
												@foreach (['danger', 'warning', 'success', 'info'] as $msg)
										      @if(Session::has('alert-' . $msg))
										      <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
										      @endif
										    @endforeach
											</div>
										</div>
                    <form class="form-horizontal" role="form" method="POST" action="/register-site">
                        {{ csrf_field() }}
    
                        <h2>Your Site</h2>
                        <p>Finish your registration!</p>
                        
                        <div class="form-group{{ $errors->has('school_program_name') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">School/Program Name</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="school_program_name" value="{{ old('school_program_name') }}" required>

                                @if ($errors->has('school_program_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('school_program_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('shipping_address_1') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Shipping Address Line 1</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="shipping_address_1" value="{{ old('shipping_address_1') }}" required>

                                @if ($errors->has('shipping_address_1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shipping_address_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('shipping_address_2') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Shipping Address Line 2</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="shipping_address_2" value="{{ old('shipping_address_2') }}">

                                @if ($errors->has('shipping_address_2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shipping_address_2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('shipping_city') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Shipping City</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="shipping_city" value="{{ old('shipping_city') }}" required>

                                @if ($errors->has('shipping_city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shipping_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('shipping_state') ? ' has-error' : '' }}">
                            <label for="shipping_state" class="col-md-4 control-label">Shipping State/Province</label>

                            <div class="col-md-6">
                            		<select name="shipping_state" id="shipping_state" class="form-control">
																	<option value="N/A">N/A</option>
																	<option value="AL" selected>Alabama</option>
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

                                @if ($errors->has('shipping_state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shipping_state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="country" class="col-md-4 control-label">Country</label>

                            <div class="col-md-6">
                            		<select name="country" id="country" class="form-control">
                            			<option value="USA">United States</option>
																	<option value="AFG">Afghanistan</option>
																	<option value="ALA">Åland Islands</option>
																	<option value="ALB">Albania</option>
																	<option value="DZA">Algeria</option>
																	<option value="ASM">American Samoa</option>
																	<option value="AND">Andorra</option>
																	<option value="AGO">Angola</option>
																	<option value="AIA">Anguilla</option>
																	<option value="ATA">Antarctica</option>
																	<option value="ATG">Antigua and Barbuda</option>
																	<option value="ARG">Argentina</option>
																	<option value="ARM">Armenia</option>
																	<option value="ABW">Aruba</option>
																	<option value="AUS">Australia</option>
																	<option value="AUT">Austria</option>
																	<option value="AZE">Azerbaijan</option>
																	<option value="BHS">Bahamas</option>
																	<option value="BHR">Bahrain</option>
																	<option value="BGD">Bangladesh</option>
																	<option value="BRB">Barbados</option>
																	<option value="BLR">Belarus</option>
																	<option value="BEL">Belgium</option>
																	<option value="BLZ">Belize</option>
																	<option value="BEN">Benin</option>
																	<option value="BMU">Bermuda</option>
																	<option value="BTN">Bhutan</option>
																	<option value="BOL">Bolivia, Plurinational State of</option>
																	<option value="BES">Bonaire, Sint Eustatius and Saba</option>
																	<option value="BIH">Bosnia and Herzegovina</option>
																	<option value="BWA">Botswana</option>
																	<option value="BVT">Bouvet Island</option>
																	<option value="BRA">Brazil</option>
																	<option value="IOT">British Indian Ocean Territory</option>
																	<option value="BRN">Brunei Darussalam</option>
																	<option value="BGR">Bulgaria</option>
																	<option value="BFA">Burkina Faso</option>
																	<option value="BDI">Burundi</option>
																	<option value="KHM">Cambodia</option>
																	<option value="CMR">Cameroon</option>
																	<option value="CAN">Canada</option>
																	<option value="CPV">Cape Verde</option>
																	<option value="CYM">Cayman Islands</option>
																	<option value="CAF">Central African Republic</option>
																	<option value="TCD">Chad</option>
																	<option value="CHL">Chile</option>
																	<option value="CHN">China</option>
																	<option value="CXR">Christmas Island</option>
																	<option value="CCK">Cocos (Keeling) Islands</option>
																	<option value="COL">Colombia</option>
																	<option value="COM">Comoros</option>
																	<option value="COG">Congo</option>
																	<option value="COD">Congo, the Democratic Republic of the</option>
																	<option value="COK">Cook Islands</option>
																	<option value="CRI">Costa Rica</option>
																	<option value="CIV">Côte d'Ivoire</option>
																	<option value="HRV">Croatia</option>
																	<option value="CUB">Cuba</option>
																	<option value="CUW">Curaçao</option>
																	<option value="CYP">Cyprus</option>
																	<option value="CZE">Czech Republic</option>
																	<option value="DNK">Denmark</option>
																	<option value="DJI">Djibouti</option>
																	<option value="DMA">Dominica</option>
																	<option value="DOM">Dominican Republic</option>
																	<option value="ECU">Ecuador</option>
																	<option value="EGY">Egypt</option>
																	<option value="SLV">El Salvador</option>
																	<option value="GNQ">Equatorial Guinea</option>
																	<option value="ERI">Eritrea</option>
																	<option value="EST">Estonia</option>
																	<option value="ETH">Ethiopia</option>
																	<option value="FLK">Falkland Islands (Malvinas)</option>
																	<option value="FRO">Faroe Islands</option>
																	<option value="FJI">Fiji</option>
																	<option value="FIN">Finland</option>
																	<option value="FRA">France</option>
																	<option value="GUF">French Guiana</option>
																	<option value="PYF">French Polynesia</option>
																	<option value="ATF">French Southern Territories</option>
																	<option value="GAB">Gabon</option>
																	<option value="GMB">Gambia</option>
																	<option value="GEO">Georgia</option>
																	<option value="DEU">Germany</option>
																	<option value="GHA">Ghana</option>
																	<option value="GIB">Gibraltar</option>
																	<option value="GRC">Greece</option>
																	<option value="GRL">Greenland</option>
																	<option value="GRD">Grenada</option>
																	<option value="GLP">Guadeloupe</option>
																	<option value="GUM">Guam</option>
																	<option value="GTM">Guatemala</option>
																	<option value="GGY">Guernsey</option>
																	<option value="GIN">Guinea</option>
																	<option value="GNB">Guinea-Bissau</option>
																	<option value="GUY">Guyana</option>
																	<option value="HTI">Haiti</option>
																	<option value="HMD">Heard Island and McDonald Islands</option>
																	<option value="VAT">Holy See (Vatican City State)</option>
																	<option value="HND">Honduras</option>
																	<option value="HKG">Hong Kong</option>
																	<option value="HUN">Hungary</option>
																	<option value="ISL">Iceland</option>
																	<option value="IND">India</option>
																	<option value="IDN">Indonesia</option>
																	<option value="IRN">Iran, Islamic Republic of</option>
																	<option value="IRQ">Iraq</option>
																	<option value="IRL">Ireland</option>
																	<option value="IMN">Isle of Man</option>
																	<option value="ISR">Israel</option>
																	<option value="ITA">Italy</option>
																	<option value="JAM">Jamaica</option>
																	<option value="JPN">Japan</option>
																	<option value="JEY">Jersey</option>
																	<option value="JOR">Jordan</option>
																	<option value="KAZ">Kazakhstan</option>
																	<option value="KEN">Kenya</option>
																	<option value="KIR">Kiribati</option>
																	<option value="PRK">Korea, Democratic People's Republic of</option>
																	<option value="KOR">Korea, Republic of</option>
																	<option value="KWT">Kuwait</option>
																	<option value="KGZ">Kyrgyzstan</option>
																	<option value="LAO">Lao People's Democratic Republic</option>
																	<option value="LVA">Latvia</option>
																	<option value="LBN">Lebanon</option>
																	<option value="LSO">Lesotho</option>
																	<option value="LBR">Liberia</option>
																	<option value="LBY">Libya</option>
																	<option value="LIE">Liechtenstein</option>
																	<option value="LTU">Lithuania</option>
																	<option value="LUX">Luxembourg</option>
																	<option value="MAC">Macao</option>
																	<option value="MKD">Macedonia, the former Yugoslav Republic of</option>
																	<option value="MDG">Madagascar</option>
																	<option value="MWI">Malawi</option>
																	<option value="MYS">Malaysia</option>
																	<option value="MDV">Maldives</option>
																	<option value="MLI">Mali</option>
																	<option value="MLT">Malta</option>
																	<option value="MHL">Marshall Islands</option>
																	<option value="MTQ">Martinique</option>
																	<option value="MRT">Mauritania</option>
																	<option value="MUS">Mauritius</option>
																	<option value="MYT">Mayotte</option>
																	<option value="MEX">Mexico</option>
																	<option value="FSM">Micronesia, Federated States of</option>
																	<option value="MDA">Moldova, Republic of</option>
																	<option value="MCO">Monaco</option>
																	<option value="MNG">Mongolia</option>
																	<option value="MNE">Montenegro</option>
																	<option value="MSR">Montserrat</option>
																	<option value="MAR">Morocco</option>
																	<option value="MOZ">Mozambique</option>
																	<option value="MMR">Myanmar</option>
																	<option value="NAM">Namibia</option>
																	<option value="NRU">Nauru</option>
																	<option value="NPL">Nepal</option>
																	<option value="NLD">Netherlands</option>
																	<option value="NCL">New Caledonia</option>
																	<option value="NZL">New Zealand</option>
																	<option value="NIC">Nicaragua</option>
																	<option value="NER">Niger</option>
																	<option value="NGA">Nigeria</option>
																	<option value="NIU">Niue</option>
																	<option value="NFK">Norfolk Island</option>
																	<option value="MNP">Northern Mariana Islands</option>
																	<option value="NOR">Norway</option>
																	<option value="OMN">Oman</option>
																	<option value="PAK">Pakistan</option>
																	<option value="PLW">Palau</option>
																	<option value="PSE">Palestinian Territory, Occupied</option>
																	<option value="PAN">Panama</option>
																	<option value="PNG">Papua New Guinea</option>
																	<option value="PRY">Paraguay</option>
																	<option value="PER">Peru</option>
																	<option value="PHL">Philippines</option>
																	<option value="PCN">Pitcairn</option>
																	<option value="POL">Poland</option>
																	<option value="PRT">Portugal</option>
																	<option value="PRI">Puerto Rico</option>
																	<option value="QAT">Qatar</option>
																	<option value="REU">Réunion</option>
																	<option value="ROU">Romania</option>
																	<option value="RUS">Russian Federation</option>
																	<option value="RWA">Rwanda</option>
																	<option value="BLM">Saint Barthélemy</option>
																	<option value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
																	<option value="KNA">Saint Kitts and Nevis</option>
																	<option value="LCA">Saint Lucia</option>
																	<option value="MAF">Saint Martin (French part)</option>
																	<option value="SPM">Saint Pierre and Miquelon</option>
																	<option value="VCT">Saint Vincent and the Grenadines</option>
																	<option value="WSM">Samoa</option>
																	<option value="SMR">San Marino</option>
																	<option value="STP">Sao Tome and Principe</option>
																	<option value="SAU">Saudi Arabia</option>
																	<option value="SEN">Senegal</option>
																	<option value="SRB">Serbia</option>
																	<option value="SYC">Seychelles</option>
																	<option value="SLE">Sierra Leone</option>
																	<option value="SGP">Singapore</option>
																	<option value="SXM">Sint Maarten (Dutch part)</option>
																	<option value="SVK">Slovakia</option>
																	<option value="SVN">Slovenia</option>
																	<option value="SLB">Solomon Islands</option>
																	<option value="SOM">Somalia</option>
																	<option value="ZAF">South Africa</option>
																	<option value="SGS">South Georgia and the South Sandwich Islands</option>
																	<option value="SSD">South Sudan</option>
																	<option value="ESP">Spain</option>
																	<option value="LKA">Sri Lanka</option>
																	<option value="SDN">Sudan</option>
																	<option value="SUR">Suriname</option>
																	<option value="SJM">Svalbard and Jan Mayen</option>
																	<option value="SWZ">Swaziland</option>
																	<option value="SWE">Sweden</option>
																	<option value="CHE">Switzerland</option>
																	<option value="SYR">Syrian Arab Republic</option>
																	<option value="TWN">Taiwan, Province of China</option>
																	<option value="TJK">Tajikistan</option>
																	<option value="TZA">Tanzania, United Republic of</option>
																	<option value="THA">Thailand</option>
																	<option value="TLS">Timor-Leste</option>
																	<option value="TGO">Togo</option>
																	<option value="TKL">Tokelau</option>
																	<option value="TON">Tonga</option>
																	<option value="TTO">Trinidad and Tobago</option>
																	<option value="TUN">Tunisia</option>
																	<option value="TUR">Turkey</option>
																	<option value="TKM">Turkmenistan</option>
																	<option value="TCA">Turks and Caicos Islands</option>
																	<option value="TUV">Tuvalu</option>
																	<option value="UGA">Uganda</option>
																	<option value="UKR">Ukraine</option>
																	<option value="ARE">United Arab Emirates</option>
																	<option value="GBR">United Kingdom</option>
																	<option value="UMI">United States Minor Outlying Islands</option>
																	<option value="URY">Uruguay</option>
																	<option value="UZB">Uzbekistan</option>
																	<option value="VUT">Vanuatu</option>
																	<option value="VEN">Venezuela, Bolivarian Republic of</option>
																	<option value="VNM">Viet Nam</option>
																	<option value="VGB">Virgin Islands, British</option>
																	<option value="VIR">Virgin Islands, U.S.</option>
																	<option value="WLF">Wallis and Futuna</option>
																	<option value="ESH">Western Sahara</option>
																	<option value="YEM">Yemen</option>
																	<option value="ZMB">Zambia</option>
																	<option value="ZWE">Zimbabwe</option>
																</select>

                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('shipping_zip_code') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Shipping Zip Code</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="shipping_zip_code" value="{{ old('shipping_zip_code') }}" required>

                                @if ($errors->has('shipping_zip_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shipping_zip_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('favorite_team') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">What is your favorite NBA/WNBA team?</label>

                            <div class="col-md-6">
                                <select name="favorite_team" class="team-select form-control">
																	<option value="null"></option>
																	<option value="Atlanta Hawks">Atlanta Hawks</option>
																	<option value="Brooklyn Nets">Brooklyn Nets</option>
																	<option value="Boston Celtics">Boston Celtics</option>
																	<option value="Charlotte Hornets">Charlotte Hornets</option>
																	<option value="Chicago Bulls">Chicago Bulls</option>
																	<option value="Cleveland Cavaliers">Cleveland Cavaliers</option>
																	<option value="Dallas Mavericks">Dallas Mavericks</option>
																	<option value="Denver Nuggets">Denver Nuggets</option>
																	<option value="Detroit Pistons">Detroit Pistons</option>
																	<option value="Golden State Warriors">Golden State Warriors</option>
																	<option value="Houston Rockets">Houston Rockets</option>
																	<option value="Indiana Pacers">Indiana Pacers</option>
																	<option value="Los Angeles Clippers">Los Angeles Clippers</option>
																	<option value="Los Angeles Lakers">Los Angeles Lakers</option>
																	<option value="Memphis Grizzlies">Memphis Grizzlies</option>
																	<option value="Miami Heat">Miami Heat</option>
																	<option value="Milwakee Bucks">Milwakee Bucks</option>
																	<option value="Minessota Timberwolves">Minessota Timberwolves</option>
																	<option value="New Orleans Pelicans">New Orleans Pelicans</option>
																	<option value="New York Knicks">New York Knicks</option>
																	<option value="Oklahoma City Thunder">Oklahoma City Thunder</option>
																	<option value="Orlando Magic">Orlando Magic</option>
																	<option value="Philadelphia 76ers">Philadelphia 76ers</option>
																	<option value="Phoenix Suns">Phoenix Suns</option>
																	<option value="Portland Trailblazers">Portland Trailblazers</option>
																	<option value="Sacramento Kings">Sacramento Kings</option>
																	<option value="San Antonio Spurs">San Antonio Spurs</option>
																	<option value="Toronto Raptors">Toronto Raptors</option>
																	<option value="Utah Jazz">Utah Jazz</option>
																	<option value="Washington Wizards">Washington Wizards</option>
																	<option value="null"></option>
																	<option value="Atlanta Dream">Atlanta Dream</option>
																	<option value="Chicago Sky">Chicago Sky</option>
																	<option value="Connecticut Sun">Connecticut Sun</option>
																	<option value="Dallas Wings">Dallas Wings</option>
																	<option value="Indiana Fever">Indiana Fever</option>
																	<option value="Los Angeles Sparks">Los Angeles Sparks</option>
																	<option value="Minnesota Lynx">Minnesota Lynx</option>
																	<option value="New York Liberty">New York Liberty</option>
																	<option value="Phoenix Mercury">Phoenix Mercury</option>
																	<option value="San Antonio Stars">San Antonio Stars</option>
																	<option value="Seattle Storm">Seattle Storm</option>
																	<option value="Washington Mystics">Washington Mystics</option>
																</select>

                                @if ($errors->has('favorite_team'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('favorite_team') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('referral') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Were you referred by anyone? If so, please share their name.</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="referral" value="{{ old('referral') }}">

                                @if ($errors->has('referral'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('referral') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('first_year') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Is this your first year using a Learn Fresh program?</label>

                            <div class="col-md-6">
                                <select name="first_year" class="form-control">
                                	<option value="0">No</option>
                                	<option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('years_using_program') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">If no, how many years have you been using one?</label>

                            <div class="col-md-6">
                                <select name="years_using_program" class="form-control">
                                	<option value="0">0</option>
                                	<option value="1">1</option>
                                	<option value="2">2</option>
                                	<option value="3">3</option>
                                	<option value="4">4</option>
                                	<option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('first_year') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Have you attended an in-person training for a Learn Fresh program?</label>

                            <div class="col-md-6">
                                <select name="in_person_training" class="form-control">
                                	<option value="0">No</option>
                                	<option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                        	<label for="programs" class="col-md-4 control-label">Select what programs you want to subscribe to:</label>
                        	<div class="col-md-6">
														@foreach (\App\Program::all() as $program)
														<br><input type="checkbox" name="programs[]" value="{{ $program->id }}"> {{ $program->title }}
														@endforeach
                        	</div>
												</div>
                        
												<hr>
												
												<div class="form-group">
                        	<label for="discount" class="col-md-4 control-label">Enter your discount code!</label>
                        	<div class="col-md-6">
														<input id="discount" name="discount" type="text" class="form-control" />
                        	</div>
												</div>
												
												<hr>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
