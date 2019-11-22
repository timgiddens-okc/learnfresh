@extends('layouts.blank')
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>Learn Fresh Pre-Test</h2>
		</div>
		
		<form action="" method="post" accept-charset="utf-8" id="assessment">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="assessment-viewport">
		<div class="assessment-container">
			<div class="assessment-panel">
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="panel panel-default">
							<div class="panel-body">
							
								<input type="hidden" name="school_program_name" value="{{ $teacher->school_program_name }}" />
								<input type="hidden" name="state" value="{{ $teacher->shipping_state }}" />
							
								<div class="form-group">
									<label>Name (First and Last)</label>
									<input type="text" name="name" class="form-control student-name" required />
								</div>
								
								<div class="form-group">
									<label id="grade">Grade</label>
									<select name="grade" class="form-control grade-change">
										<option value="3 or Under">3 or Under</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9 or Over">9 or Over</option>
									</select>
								</div>
								
								<div class="form-group">
									<label>Gender</label>
									<select name="gender" class="form-control" required>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
								
								<div class="form-group">
									<label>Ethnicity</label>
									<select name="ethnicity" class="form-control dont-tab" required>
										<option value="American Indian or Alaskan Native">American Indian or Alaskan Native</option>
										<option value="Asian, Native Hawaiian, or other Pacific Islander">Asian, Native Hawaiian, or other Pacific Islander</option>
										<option value="Black or African-American">Black or African-American</option>
										<option value="Hispanic or Latino">Hispanic or Latino</option>
										<option value="White">White</option>
										<option value="Other">Other</option>
									</select>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="panel panel-default">
							<div class="panel-body">
								@if(stripos($teacher->programs, "3") !== false)
								<div class="form-group">
									<label>Which team won the World Series last season?</label>
									<div class="champion-select">
										<div class="row">
											<div class="col-sm-6 col-md-3">
												<label for="houa" class="dont-tab">
													<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Houston-Astros-Logo.svg/1200px-Houston-Astros-Logo.svg.png" />
												</label>
												<input type="radio" id="houa" name="mlb_champion" class="dont-tab" value="1" />
											</div>
											<div class="col-sm-6 col-md-3">
												<label for="bosrs" class="dont-tab">
													<img src="https://upload.wikimedia.org/wikipedia/en/thumb/6/6d/RedSoxPrimary_HangingSocks.svg/1200px-RedSoxPrimary_HangingSocks.svg.png" />
												</label>
												<input type="radio" id="bosrs" name="mlb_champion" class="dont-tab" value="2" checked />
											</div>
											<div class="col-sm-6 col-md-3">
												<label for="oaka" class="dont-tab">
													<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Oakland_A%27s_logo.svg/1200px-Oakland_A%27s_logo.svg.png" />
												</label>
												<input type="radio" id="oaka" name="mlb_champion" class="dont-tab" value="3" />
											</div>
											<div class="col-sm-6 col-md-3">
												<label for="la" class="dont-tab">
													<img src="https://upload.wikimedia.org/wikipedia/en/thumb/6/69/Los_Angeles_Dodgers_logo.svg/1200px-Los_Angeles_Dodgers_logo.svg.png" />
												</label>
												<input type="radio" id="la" name="mlb_champion" value="4" class="dont-tab" />
											</div>
										</div>
									</div>
								</div>								
								@else								
								<div class="form-group">
									<label>Which team won the NBA Championship last season?</label>
									<div class="champion-select">
										<div class="row">
											<div class="col-sm-6 col-md-3">
												<label for="cle" class="dont-tab">
													<img src="{{ ($app == "production") ? secure_asset("team-logos/cle_primary-icon.jpg") : asset("team-logos/cle_primary-icon.jpg") }}" />
												</label>
												<input type="radio" id="cle" name="nba_champion" class="dont-tab" value="1" />
											</div>
											<div class="col-sm-6 col-md-3">
												<label for="gsw" class="dont-tab">
													<img src="{{ ($app == "production") ? secure_asset("team-logos/gsw_primary-icon.jpg") : asset("team-logos/gsw_primary-icon.jpg") }}" />
												</label>
												<input type="radio" id="gsw" name="nba_champion" class="dont-tab" value="2" checked />
											</div>
											<div class="col-sm-6 col-md-3">
												<label for="tor" class="dont-tab">
													<img src="{{ ($app == "production") ? secure_asset("team-logos/tor_primary-icon.jpg") : asset("team-logos/tor_primary-icon.jpg") }}" />
												</label>
												<input type="radio" id="tor" name="nba_champion" class="dont-tab" value="3" />
											</div>
											<div class="col-sm-6 col-md-3">
												<label for="hou" class="dont-tab">
													<img src="{{ ($app == "production") ? secure_asset("team-logos/hou_primary-icon.jpg") : asset("team-logos/hou_primary-icon.jpg") }}" />
												</label>
												<input type="radio" id="hou" name="nba_champion" value="4" class="dont-tab" />
											</div>
										</div>
									</div>
								</div>
								@endif
								
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 text-right">
						<div class="btn btn-primary continue">Continue</div>
					</div>
				</div>
			</div>
			
			<div class="assessment-panel">
			
				<div class="page-header">
					<h3>Pre-Test Survey</h3>
					<p>Select the response that best describes how you feel.</p>
				</div>
				
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							<table class="table table-striped survey">
								<tbody>
								
									<tr>
										<td>
											<p>I stay calm when there is a problem or an argument.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="stay_calm" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="stay_calm" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="stay_calm" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="stay_calm" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I try to help other people when they need help.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="help_others" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="help_others" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="help_others" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="help_others" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I like doing things for others.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="doing_things" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="doing_things" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="doing_things" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="doing_things" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I am good at solving problems.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="solving_problems" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="solving_problems" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="solving_problems" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="solving_problems" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I do not give up.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="do_not_give_up" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="do_not_give_up" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="do_not_give_up" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="do_not_give_up" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I give compliments to other people.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="give_compliments" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="give_compliments" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="give_compliments" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="give_compliments" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I like to do the right thing.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="do_the_right_thing" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="do_the_right_thing" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="do_the_right_thing" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="do_the_right_thing" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I am good at making decisions.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="making_decisions" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="making_decisions" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="making_decisions" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="making_decisions" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I think before I act.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="think_before_i_act" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="think_before_i_act" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="think_before_i_act" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="think_before_i_act" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>Other people see me as a leader.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="leader" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="leader" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="leader" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="leader" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>Other kids respect me.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="respect" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="respect" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="respect" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="respect" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I make good decisions.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="good_decisions" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="good_decisions" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="good_decisions" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="good_decisions" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I am an honest person.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="honest_person" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="honest_person" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="honest_person" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="honest_person" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I understand the importance of learning.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="importance_of_learning" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="importance_of_learning" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="importance_of_learning" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="importance_of_learning" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I think about my problems in ways that help.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="think_about_problems" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="think_about_problems" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="think_about_problems" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="think_about_problems" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I am a responsible person.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="responsible_person" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="responsible_person" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="responsible_person" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="responsible_person" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I can work through problems with others.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="work_through_problems" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="work_through_problems" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="work_through_problems" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="work_through_problems" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I know how to set goals for what I want to achieve.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="set_goals" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="set_goals" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="set_goals" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="set_goals" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I understand how to overcome a challenge.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="overcome_a_challenge" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="overcome_a_challenge" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="overcome_a_challenge" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="overcome_a_challenge" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											<p>I work well with other kids on school projects.</p>
										</td>
										<td>
											<div class="survey-options">
												<div class="radio-inline">
													<input type="radio" name="work_well_with_others" class="dont-tab" value="1" /> Never
												</div>
												<div class="radio-inline">
													<input type="radio" name="work_well_with_others" class="dont-tab" value="2" checked /> Sometimes
												</div>
												<div class="radio-inline">
													<input type="radio" name="work_well_with_others" class="dont-tab" value="3" /> Most of the Time
												</div>
												<div class="radio-inline">
													<input type="radio" name="work_well_with_others" class="dont-tab" value="4" /> Always
												</div>
											</div>
										</td>
									</tr>
																
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12 text-right">
						<div class="btn btn-primary continue">Continue</div>
					</div>
				</div>
			</div>
			
			<div class="assessment-panel hidden-formulas" id="agility">
			
				<div class="agility-overlay">
					<div class="agility-content">
						<h2>Math Hoops Agility!</h2>
						<p>This is a timed section. You have 90 seconds to complete as many problems as possible. At the end of 90 seconds, you will automatically be redirected to the next page. <strong>Numbers that are not whole should be rounded to the nearest whole number.</strong> Try your best!</p>
						<a href="#" class="start-agility btn btn-primary">Start</a>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12">
						<div class="agility-timer">
							:<span>90</span>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-6 col-md-3">
						<div class="panel panel-default">
							<div class="panel-body">
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">7 + 1 =</div>
										<input type="text" class="form-control" name="7+1" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">6 - 3 =</div>
										<input type="text" class="form-control" name="6-3" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">6 x 6 =</div>
										<input type="text" class="form-control" name="6x6" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">9 / 3 =</div>
										<input type="text" class="form-control" name="9/3" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">7 + 5 =</div>
										<input type="text" class="form-control" name="7+5" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">9 x 0 =</div>
										<input type="text" class="form-control" name="9x0" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">7 x 7 =</div>
										<input type="text" class="form-control" name="7x7" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">7 - 1 =</div>
										<input type="text" class="form-control" name="7-1" />
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="panel panel-default">
							<div class="panel-body">
							
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">4 x 5 =</div>
										<input type="text" class="form-control" name="4x5" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">9 / 2 =</div>
										<input type="text" class="form-control" name="9/2" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">8 x 7 =</div>
										<input type="text" class="form-control" name="8x7" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">8 - 8 =</div>
										<input type="text" class="form-control" name="8-8" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">5 / 2 =</div>
										<input type="text" class="form-control" name="5/2" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">7 x 9 =</div>
										<input type="text" class="form-control" name="7x9" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">4 + 3 =</div>
										<input type="text" class="form-control" name="4+3" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">6 + 5 =</div>
										<input type="text" class="form-control" name="6+5" />
									</div>
								</div>
									
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="panel panel-default">
							<div class="panel-body">
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">9 - 7 =</div>
										<input type="text" class="form-control" name="9-7" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">2 x 8 =</div>
										<input type="text" class="form-control" name="2x8" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">7 / 1 =</div>
										<input type="text" class="form-control" name="7/1" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">9 - 1 =</div>
										<input type="text" class="form-control" name="9-1" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">6 / 2 =</div>
										<input type="text" class="form-control" name="6/2" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">5 x 2 =</div>
										<input type="text" class="form-control" name="5x2" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">8 / 2 =</div>
										<input type="text" class="form-control" name="8/2" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">3 x 4 =</div>
										<input type="text" class="form-control" name="3x4" />
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="panel panel-default">
							<div class="panel-body">
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">8 - 7 =</div>
										<input type="text" class="form-control" name="8-7" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">5 x 8 =</div>
										<input type="text" class="form-control" name="5x8" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">1 x 1 =</div>
										<input type="text" class="form-control" name="1x1" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">10 / 3 =</div>
										<input type="text" class="form-control" name="10/3" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">9 + 8 =</div>
										<input type="text" class="form-control" name="9+8" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">3 - 2 =</div>
										<input type="text" class="form-control dont-tab" name="3-2" />
									</div>
								</div>
									
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 text-right">
						<div class="btn btn-primary continue finish-agility">Continue</div>
					</div>
				</div>
			</div>
			
			<div class="assessment-panel">
				<div class="page-header">
					<h3>Multiple Choice</h3>
					<p>Select your answer for each of the following questions.</p>
				</div>
				
				<div class="row">
					<div class="col-sm-12 col-md-6">
					
						<div class="panel">
							<div class="panel-heading">
								<img src="{{ url("images/chart-1.svg") }}" />
								<strong>Question 1)</strong><br>
								All of the pie charts above represent WNBA players’ odds of making a shot.
								<br><br>
								Which player’s chart is about half of the value of Player X?
							</div>
							<div class="panel-body">
							
								<div class="radio">
									<label>
										<input type="radio" name="half_of_value" value="1"> Player A
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="half_of_value" value="2"> Player B
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="half_of_value" value="3"> Player C
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="half_of_value" value="4"> Player D
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="half_of_value" value="5"> Player E
									</label>
								</div>
								
							</div>
						</div>
						
						<div class="panel ">
							<div class="panel-heading">
								<img src="{{ url("images/chart-2.svg") }}" />
								<strong>Question 2)</strong><br>
								Which of the following decimal numbers can be represented by point X on the number line?
							</div>
							<div class="panel-body">
							
								<div class="radio">
									<label>
										<input type="radio" name="decimal_numbers_represent" value="1"> 0.4
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="decimal_numbers_represent" value="2"> 1.1
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="decimal_numbers_represent" value="3"> 2.7
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="decimal_numbers_represent" value="4"> 3.1
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="decimal_numbers_represent" value="5"> 4.5
									</label>
								</div>
								
							</div>
						</div>
						
						<div class="panel ">
							<div class="panel-heading">
								<strong>Question 3)</strong><br>
								An NFL kicker makes 80 percent of his field goals in a given season.<br><br>
								Which of the following statements describes how frequently he makes field goals?

							</div>
							<div class="panel-body">
							
								<div class="radio">
									<label>
										<input type="radio" name="nfl_kicker" value="1"> He makes 1/5 of his field goals.
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="nfl_kicker" value="2"> He makes 1/25 of his field goals
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="nfl_kicker" value="3"> He makes 4/5 of his field goals.
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="nfl_kicker" value="4"> He makes 1/3 of his field goals.
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="nfl_kicker" value="5"> He makes 1/10 of his field goals.
									</label>
								</div>
								
							</div>
						</div>
						
						<div class="panel">
							<div class="panel-heading">
								<img src="{{ url("images/chart-3.svg") }}" />
								<strong>Question 4)</strong><br>
								The chart above represents an NBA player’s odds of making a free throw. Which percentage is represented by the chart above?
							</div>
							<div class="panel-body">
							
								<div class="radio">
									<label>
										<input type="radio" name="free_throws" value="1"> 10%
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="free_throws" value="2"> 25%
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="free_throws" value="3"> 67%
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="free_throws" value="4"> 79%
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="free_throws" value="5"> 91%
									</label>
								</div>
								
							</div>
						</div>
						
					</div>
					<div class="col-sm-12 col-md-6">
						
						<div class="panel ">
							<div class="panel-heading">
								<img src="{{ url("images/chart-4.svg") }}" />
								<strong>Question 5)</strong><br>									
								The charts above represent two WNBA players’ odds of making free throws. Which of the following statements about the represented values is true?
							</div>
							<div class="panel-body">
							
								<div class="radio">
									<label>
										<input type="radio" name="wnba_free_throws" value="1"> The represented values are more than 10 percentage points apart.
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="wnba_free_throws" value="2"> The represented values are between 5-9 percentage points apart.
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="wnba_free_throws" value="3"> The represented values are between 2-4 percentage points apart.
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="wnba_free_throws" value="4"> The represented values are 1 percentage point apart.
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="wnba_free_throws" value="5"> The represented values are the same.
									</label>
								</div>
								
							</div>
						</div>
						
						<div class="panel ">
							<div class="panel-heading">
								<strong>Question 6)</strong><br>									
								Four NBA players competed in three separate games. The table shows the total number of shots each player had made after each game.								
								<table class="table">
									<thead>
										<tr>
											<td></td>
											<td>Shots Made After Game 1</td>
											<td>Shots Made After Game 2</td>
											<td>Shots Made After Game 3</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Player A</td>
											<td class="text-center">10</td>
											<td class="text-center">20</td>
											<td class="text-center">25</td>
										</tr>
										<tr>
											<td>Player B</td>
											<td class="text-center">4</td>
											<td class="text-center">11</td>
											<td class="text-center">20</td>
										</tr>
										<tr>
											<td>Player C</td>
											<td class="text-center">3</td>
											<td class="text-center">6</td>
											<td class="text-center">9</td>
										</tr>
										<tr>
											<td>Player D</td>
											<td class="text-center">10</td>
											<td class="text-center">13</td>
											<td class="text-center">19</td>
										</tr>
									</tbody>
								</table>
								Which player made the same number of shots in each game?
							</div>
							<div class="panel-body">
							
								<div class="radio">
									<label>
										<input type="radio" name="same_shots" value="1"> Player A
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="same_shots" value="2"> Player B
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="same_shots" value="3"> Player C
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="same_shots" value="4"> Player D
									</label>
								</div>
								
							</div>
						</div>
						
						<div class="panel ">
							<div class="panel-heading">
								<img src="{{ url("images/chart-5.svg") }}" />
								<strong>Question 7)</strong><br>									
								The pie chart above represents a WNBA player’s odds of making a three-point shot. The percentage represented is 45%.<br><br>
								If the player takes 200 shots, approximately how many shots should she expect to make?
							
							</div>
							<div class="panel-body">
							
								<div class="radio">
									<label>
										<input type="radio" name="odds_of_three_point" value="1"> 25
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="odds_of_three_point" value="2"> 42
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="odds_of_three_point" value="3"> 90
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="odds_of_three_point" value="4"> 127
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="odds_of_three_point" value="5"> 200
									</label>
								</div>
								
							</div>
						</div>
						
						<div class="panel ">
							<div class="panel-heading">
								<strong>Question 8)</strong><br>									
								A basketball player makes 8 of 16 shots in a game. This performance represents his usual odds of making shots during a game.<br><br>
								How many shots should he expect to make if he takes 8 shots in his next game?

							
							</div>
							<div class="panel-body">
							
								<div class="radio">
									<label>
										<input type="radio" name="shot_odds" value="1"> 0
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="shot_odds" value="2"> 1
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="shot_odds" value="3"> 2
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="shot_odds" value="4"> 4
									</label>
								</div>
								
								<div class="radio">
									<label>
										<input type="radio" name="shot_odds" value="5"> 8
									</label>
								</div>
								
							</div>
						</div>
					
					</div>
				</div>

				
				<div class="row">
					<div class="col-sm-12">
						<input type="submit" class="btn btn-primary pull-right" value="Complete Test" />
					</div>
				</div>
			
			</div>
			
		</div>
		</div>
		</form>
		
	</div>
	
@endsection