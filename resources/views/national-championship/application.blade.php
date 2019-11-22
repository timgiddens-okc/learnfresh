@extends('layouts.app')
	
@section('content')

	@if(\Auth::user()->isAdmin())
		@include("national-championship.national-championship-nav")
	@endif
	
	<div class="container" id="national-championship-application">
		<div class="page-header">
			<h2>National Championship Application</h2>
		</div>
		
		<form action="" method="post">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label>
							Student Name
							<input type="text" name="student_name" class="form-control" required />
						</label>
					</div>
					<div class="form-group">
						<label>
							Student Grade Level
							<input type="text" name="student_grade_level" class="form-control" required />
						</label>
					</div>
					<div class="form-group">
						<label>
							School/Program Name
							<input type="text" name="school_program_name" class="form-control" value="{{ \Auth::user()->school_program_name }}" required />
						</label>
					</div>
					<div class="form-group">
						<label>
							Favorite Team
							<input type="text" name="favorite_team" class="form-control" required />
						</label>
					</div>
					<div class="form-group">
						<label>
							Educator Name
							<input type="text" name="educator_name" class="form-control" value="{{ \Auth::user()->name }}" required />
						</label>
					</div>
					<?php
						$region = \App\FundedRegion::where('zip_code', \Auth::user()->site_zip_code)->first();
						$team = "";
						if($region){
							switch($region->team){
								case "nyk":
									$team = "New York Knicks";
									break;
								case "phi":
									$team = "Philadelphia 76ers";
									break;
								case "atl":
									$team = "Atlanta Hawks";
									break;
								case "orl":
									$team = "Orlando Magic";
									break;
								case "cle":
									$team = "Cleveland Cavaliers";
									break;
								case "det":
									$team = "Detroit Pistons";
									break;
								case "mil":
									$team = "Milwaukee Bucks";
									break;
								case "den":
									$team = "Denver Nuggets";
									break;
								case "uta":
									$team = "Utah Jazz";
									break;
								case "pho":
									$team = "Phoenix Suns";
									break;
								case "gsw":
									$team = "Golden State Warriors";
									break;
								case "sac":
									$team = "Sacramento Kings";
									break;
								case "lac":
									$team = "LA Clippers";
									break;
								default:
									$team = "";
									break;
							}
						}
					?>
					<div class="form-group">
						<label>
							Team/Region
							<input type="text" name="team_region" class="form-control" value="{{ $team }}" required />
						</label>
					</div>
					<div class="form-group">
						<label>
							Games Played
							<input type="text" name="games_played" class="form-control" required />
						</label>
					</div>
					<div class="form-group">
						<label>
							Curriculum Pieces Complete
							<input type="text" name="curriculum_pieces_completed" class="form-control" required />
						</label>
					</div>
					<div class="form-group">
						<label>
							Sportsmanship Points Earned
							<input type="text" name="sportsmanship_points_earned" class="form-control" required />
						</label>
					</div>
					<div class="form-group">
						<label>
							Letter of Recommendation <div class="max-length pull-right"><span class="current">0</span>/2000</div>
							<textarea name="letter_of_recommendation" class="form-control not-rich count-text" maxlength="2000" required></textarea>
						</label>
					</div>
					<div class="form-group">
						<label>
							YouTube Applicant Video (paste link to video)
							<input type="text" name="applicant_video" class="form-control" required />
						</label>
					</div>
					
					<div class="row">
						<div class="col-sm-12">
							<input type="submit" class="btn btn-primary pull-right" value="Submit Application" />
						</div>
					</div>
				</div>
			</div>
		</form>
		
	</div>
	
@endsection