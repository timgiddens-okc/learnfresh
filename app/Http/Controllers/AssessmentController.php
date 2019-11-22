<?php

namespace App\Http\Controllers;

use App\Student;
use App\FundedRegion;
use App\User;
use App\SubAdmin;
use App\ShippingList;
use App\Preassessment;
use App\Postassessment;
use App\SavedAssessment;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{

		public function pretestLanding()
		{
			$twentyFourHours = Preassessment::where("created_at",">",Carbon::now()->subDay())->count();
			$lastWeek = Preassessment::where("created_at",">",Carbon::now()->subWeek())->count();
			$lastTwoWeeks = Preassessment::where("created_at",">",Carbon::now()->subDays(14))->count();
			$lastMonth = Preassessment::where("created_at",">",Carbon::now()->startOfMonth()->subMonth()->toDateString())->count();
			
			$total = Preassessment::get();
			$totalCount = count($total);
			$percentOfUsers = round((User::where('account_level','gold')->where('pre_assessment_complete',1)->count()/User::where('account_level','gold')->count())*100,2);
			
			$totalMath = $totalCount * 30;
			$totalMultiChoice = $totalCount * 8;
			
			
			$totalCorrect = 0;
			$totalCorrectMulti = 0;
			
			$male = 0;
			$female = 0;
			$native = 0;
			$pacificIslander = 0;
			$black = 0;
			$hispanic = 0;
			$white = 0;
			$other = 0;
			$thirdGrade = 0;
			$fourthGrade = 0;
			$fifthGrade = 0;
			$sixthGrade = 0;
			$seventhGrade = 0;
			$eighthGrade = 0;
			$ninthGrade = 0;
			
			foreach($total as $t){
				
				$student = Student::where("id", $t['student_id'])->first();
				
				if($student['gender'] == "Male") $male++;
				if($student['gender'] == "Female") $female++;
				
				if($student['ethnicity'] == "American Indian or Alaskan Native") $native++;
				if($student['ethnicity'] == "Asian, Native Hawaiian, or other Pacific Islander") $pacificIslander++;
				if($student['ethnicity'] == "Black or African-American") $black++;
				if($student['ethnicity'] == "Hispanic or Latino") $hispanic++;
				if($student['ethnicity'] == "White") $white++;
				if($student['ethnicity'] == "Other") $other++;
				
				if($student['grade'] == "3 or Under") $thirdGrade++;
				if($student['grade'] == "4") $fourthGrade++;
				if($student['grade'] == "5") $fifthGrade++;
				if($student['grade'] == "6") $sixthGrade++;
				if($student['grade'] == "7") $seventhGrade++;
				if($student['grade'] == "8") $eighthGrade++;
				if($student['grade'] == "9 or Over") $ninthGrade++;
				
				
				if($t['7+1'] == 8) $totalCorrect++;
				if($t['6-3'] == 3) $totalCorrect++;
				if($t['6x6'] == 36) $totalCorrect++;
				if($t['9/3'] == 3) $totalCorrect++;
				if($t['7+5'] == 12) $totalCorrect++;
				if($t['9x0'] == 0) $totalCorrect++;
				if($t['7x7'] == 49) $totalCorrect++;
				if($t['7-1'] == 6) $totalCorrect++;
				if($t['4x5'] == 20) $totalCorrect++;
				if($t['9/2'] == 5) $totalCorrect++;
				if($t['8x7'] == 56) $totalCorrect++;
				if($t['8-8'] == 0) $totalCorrect++;
				if($t['5/2'] == 2.5) $totalCorrect++;
				if($t['7x9'] == 63) $totalCorrect++;
				if($t['4+3'] == 7) $totalCorrect++;
				if($t['6+5'] == 11) $totalCorrect++;
				if($t['9-7'] == 2) $totalCorrect++;
				if($t['2x8'] == 16) $totalCorrect++;
				if($t['7/1'] == 7) $totalCorrect++;
				if($t['9-1'] == 8) $totalCorrect++;
				if($t['6/2'] == 3) $totalCorrect++;
				if($t['5x2'] == 10) $totalCorrect++;
				if($t['8/2'] == 4) $totalCorrect++;
				if($t['3x4'] == 12) $totalCorrect++;
				if($t['8-7'] == 1) $totalCorrect++;
				if($t['5x8'] == 40) $totalCorrect++;
				if($t['1x1'] == 1) $totalCorrect++;
				if($t['10/3'] == 3) $totalCorrect++;
				if($t['9+8'] == 17) $totalCorrect++;
				if($t['3-2'] == 1) $totalCorrect++;
				
				if($t['half_of_value'] == 3) $totalCorrectMulti++;
				if($t['decimal_numbers_represent'] == 4) $totalCorrectMulti++;
				if($t['nfl_kicker'] == 3) $totalCorrectMulti++;
				if($t['free_throws'] == 5) $totalCorrectMulti++;
				if($t['wnba_free_throws'] == 2) $totalCorrectMulti++;
				if($t['same_shots'] == 3) $totalCorrectMulti++;
				if($t['odds_of_three_point'] == 3) $totalCorrectMulti++;
				if($t['shot_odds'] == 4) $totalCorrectMulti++;
			}
			
			$mathPercentage = round(($totalCorrect / $totalMath)*100,2);
			$multiPercentage = round(($totalCorrectMulti / $totalMultiChoice)*100,2);
			
			$male = round(($male/$totalCount)*100,2);
			$female = round(($female/$totalCount)*100,2);
			$native = round(($native/$totalCount)*100,2);
			$pacificIslander = round(($pacificIslander/$totalCount)*100,2);
			$black = round(($black/$totalCount)*100,2);
			$hispanic = round(($hispanic/$totalCount)*100,2);
			$white = round(($white/$totalCount)*100,2);
			$other = round(($other/$totalCount)*100,2);
			$thirdGrade = round(($thirdGrade/$totalCount)*100,2);
			$fourthGrade = round(($fourthGrade/$totalCount)*100,2);
			$fifthGrade = round(($fifthGrade/$totalCount)*100,2);
			$sixthGrade = round(($sixthGrade/$totalCount)*100,2);
			$seventhGrade = round(($seventhGrade/$totalCount)*100,2);
			$eighthGrade = round(($eighthGrade/$totalCount)*100,2);
			$ninthGrade = round(($ninthGrade/$totalCount)*100,2);
			
			
			return view("admin.tests.pretest", [
				"twentyFourHours" => $twentyFourHours,
				"lastWeek" => $lastWeek,
				"lastTwoWeeks" => $lastTwoWeeks,
				"lastMonth" => $lastMonth,
				"percentOfUsers" => $percentOfUsers,
				"totalCount" => $totalCount,
				"mathPercentage" => $mathPercentage,
				"multiPercentage" => $multiPercentage,
				"male" => $male,
				"female" => $female,
				"native" => $native,
				"pacificIslander" => $pacificIslander,
				"black" => $black,
				"hispanic" => $hispanic,
				"white" => $white,
				"third" => $thirdGrade,
				"fourth" => $fourthGrade,
				"fifth" => $fifthGrade,
				"sixth" => $sixthGrade,
				"seventh" => $seventhGrade,
				"eighth" => $eighthGrade,
				"ninth" => $ninthGrade,
				"other" => $other,
			]);
		}
		
		public function posttestLanding()
		{
			$twentyFourHours = Postassessment::where("created_at",">",Carbon::now()->subDay())->count();
			$lastWeek = Postassessment::where("created_at",">",Carbon::now()->subWeek())->count();
			$lastTwoWeeks = Postassessment::where("created_at",">",Carbon::now()->subDays(14))->count();
			$lastMonth = Postassessment::where("created_at",">",Carbon::now()->startOfMonth()->subMonth()->toDateString())->count();
			
			$total = Postassessment::get();
			$totalCount = count($total);
			$percentOfUsers = round((User::where('account_level','gold')->where('post_assessment_complete',1)->count()/User::where('account_level','gold')->count())*100,2);
			
			$totalMath = $totalCount * 30;
			$totalMultiChoice = $totalCount * 8;
			
			
			$totalCorrect = 0;
			$totalCorrectMulti = 0;
			
			$male = 0;
			$female = 0;
			$native = 0;
			$pacificIslander = 0;
			$black = 0;
			$hispanic = 0;
			$white = 0;
			$other = 0;
			$thirdGrade = 0;
			$fourthGrade = 0;
			$fifthGrade = 0;
			$sixthGrade = 0;
			$seventhGrade = 0;
			$eighthGrade = 0;
			$ninthGrade = 0;
			
			foreach($total as $t){
				
				$student = Student::where("id", $t['student_id'])->first();
				
				if($student['gender'] == "Male") $male++;
				if($student['gender'] == "Female") $female++;
				
				if($student['ethnicity'] == "American Indian or Alaskan Native") $native++;
				if($student['ethnicity'] == "Asian, Native Hawaiian, or other Pacific Islander") $pacificIslander++;
				if($student['ethnicity'] == "Black or African-American") $black++;
				if($student['ethnicity'] == "Hispanic or Latino") $hispanic++;
				if($student['ethnicity'] == "White") $white++;
				if($student['ethnicity'] == "Other") $other++;
				
				if($student['grade'] == "3 or Under") $thirdGrade++;
				if($student['grade'] == "4") $fourthGrade++;
				if($student['grade'] == "5") $fifthGrade++;
				if($student['grade'] == "6") $sixthGrade++;
				if($student['grade'] == "7") $seventhGrade++;
				if($student['grade'] == "8") $eighthGrade++;
				if($student['grade'] == "9 or Over") $ninthGrade++;
				
				
				if($t['7+1'] == 8) $totalCorrect++;
				if($t['6-3'] == 3) $totalCorrect++;
				if($t['6x6'] == 36) $totalCorrect++;
				if($t['9/3'] == 3) $totalCorrect++;
				if($t['7+5'] == 12) $totalCorrect++;
				if($t['9x0'] == 0) $totalCorrect++;
				if($t['7x7'] == 49) $totalCorrect++;
				if($t['7-1'] == 6) $totalCorrect++;
				if($t['4x5'] == 20) $totalCorrect++;
				if($t['9/2'] == 5) $totalCorrect++;
				if($t['8x7'] == 56) $totalCorrect++;
				if($t['8-8'] == 0) $totalCorrect++;
				if($t['5/2'] == 2.5) $totalCorrect++;
				if($t['7x9'] == 63) $totalCorrect++;
				if($t['4+3'] == 7) $totalCorrect++;
				if($t['6+5'] == 11) $totalCorrect++;
				if($t['9-7'] == 2) $totalCorrect++;
				if($t['2x8'] == 16) $totalCorrect++;
				if($t['7/1'] == 7) $totalCorrect++;
				if($t['9-1'] == 8) $totalCorrect++;
				if($t['6/2'] == 3) $totalCorrect++;
				if($t['5x2'] == 10) $totalCorrect++;
				if($t['8/2'] == 4) $totalCorrect++;
				if($t['3x4'] == 12) $totalCorrect++;
				if($t['8-7'] == 1) $totalCorrect++;
				if($t['5x8'] == 40) $totalCorrect++;
				if($t['1x1'] == 1) $totalCorrect++;
				if($t['10/3'] == 3) $totalCorrect++;
				if($t['9+8'] == 17) $totalCorrect++;
				if($t['3-2'] == 1) $totalCorrect++;
				
				if($t['half_of_value'] == 3) $totalCorrectMulti++;
				if($t['decimal_numbers_represent'] == 4) $totalCorrectMulti++;
				if($t['nfl_kicker'] == 3) $totalCorrectMulti++;
				if($t['free_throws'] == 5) $totalCorrectMulti++;
				if($t['wnba_free_throws'] == 2) $totalCorrectMulti++;
				if($t['same_shots'] == 3) $totalCorrectMulti++;
				if($t['odds_of_three_point'] == 3) $totalCorrectMulti++;
				if($t['shot_odds'] == 4) $totalCorrectMulti++;
			}
			
			$mathPercentage = round(($totalCorrect / $totalMath)*100,2);
			$multiPercentage = round(($totalCorrectMulti / $totalMultiChoice)*100,2);
			
			$male = round(($male/$totalCount)*100,2);
			$female = round(($female/$totalCount)*100,2);
			$native = round(($native/$totalCount)*100,2);
			$pacificIslander = round(($pacificIslander/$totalCount)*100,2);
			$black = round(($black/$totalCount)*100,2);
			$hispanic = round(($hispanic/$totalCount)*100,2);
			$white = round(($white/$totalCount)*100,2);
			$other = round(($other/$totalCount)*100,2);
			$thirdGrade = round(($thirdGrade/$totalCount)*100,2);
			$fourthGrade = round(($fourthGrade/$totalCount)*100,2);
			$fifthGrade = round(($fifthGrade/$totalCount)*100,2);
			$sixthGrade = round(($sixthGrade/$totalCount)*100,2);
			$seventhGrade = round(($seventhGrade/$totalCount)*100,2);
			$eighthGrade = round(($eighthGrade/$totalCount)*100,2);
			$ninthGrade = round(($ninthGrade/$totalCount)*100,2);
			
			
			return view("admin.tests.posttest", [
				"twentyFourHours" => $twentyFourHours,
				"lastWeek" => $lastWeek,
				"lastTwoWeeks" => $lastTwoWeeks,
				"lastMonth" => $lastMonth,
				"percentOfUsers" => $percentOfUsers,
				"totalCount" => $totalCount,
				"mathPercentage" => $mathPercentage,
				"multiPercentage" => $multiPercentage,
				"male" => $male,
				"female" => $female,
				"native" => $native,
				"pacificIslander" => $pacificIslander,
				"black" => $black,
				"hispanic" => $hispanic,
				"white" => $white,
				"third" => $thirdGrade,
				"fourth" => $fourthGrade,
				"fifth" => $fifthGrade,
				"sixth" => $sixthGrade,
				"seventh" => $seventhGrade,
				"eighth" => $eighthGrade,
				"ninth" => $ninthGrade,
				"other" => $other,
			]);
		}
		
		public function posttestNoUsage()
		{
			$twentyFourHours = Postassessment::where("created_at",">",Carbon::now()->subDay())->where("games_completed","1")->count();
			$lastWeek = Postassessment::where("created_at",">",Carbon::now()->subWeek())->where("games_completed","1")->count();
			$lastTwoWeeks = Postassessment::where("created_at",">",Carbon::now()->subDays(14))->where("games_completed","1")->count();
			$lastMonth = Postassessment::where("created_at",">",Carbon::now()->startOfMonth()->subMonth()->toDateString())->where("games_completed","1")->count();
			
			$total = Postassessment::where("games_completed","1")->get();
			$totalCount = count($total);
			$percentOfUsers = round((User::where('account_level','gold')->where('post_assessment_complete',1)->count()/$totalCount)*100,2);
			
			$totalMath = $totalCount * 30;
			$totalMultiChoice = $totalCount * 8;
			
			
			$totalCorrect = 0;
			$totalCorrectMulti = 0;
			
			$male = 0;
			$female = 0;
			$native = 0;
			$pacificIslander = 0;
			$black = 0;
			$hispanic = 0;
			$white = 0;
			$other = 0;
			$thirdGrade = 0;
			$fourthGrade = 0;
			$fifthGrade = 0;
			$sixthGrade = 0;
			$seventhGrade = 0;
			$eighthGrade = 0;
			$ninthGrade = 0;
			
			foreach($total as $t){
				
				$student = Student::where("id", $t['student_id'])->first();
				
				if($student['gender'] == "Male") $male++;
				if($student['gender'] == "Female") $female++;
				
				if($student['ethnicity'] == "American Indian or Alaskan Native") $native++;
				if($student['ethnicity'] == "Asian, Native Hawaiian, or other Pacific Islander") $pacificIslander++;
				if($student['ethnicity'] == "Black or African-American") $black++;
				if($student['ethnicity'] == "Hispanic or Latino") $hispanic++;
				if($student['ethnicity'] == "White") $white++;
				if($student['ethnicity'] == "Other") $other++;
				
				if($student['grade'] == "3 or Under") $thirdGrade++;
				if($student['grade'] == "4") $fourthGrade++;
				if($student['grade'] == "5") $fifthGrade++;
				if($student['grade'] == "6") $sixthGrade++;
				if($student['grade'] == "7") $seventhGrade++;
				if($student['grade'] == "8") $eighthGrade++;
				if($student['grade'] == "9 or Over") $ninthGrade++;
				
				
				if($t['7+1'] == 8) $totalCorrect++;
				if($t['6-3'] == 3) $totalCorrect++;
				if($t['6x6'] == 36) $totalCorrect++;
				if($t['9/3'] == 3) $totalCorrect++;
				if($t['7+5'] == 12) $totalCorrect++;
				if($t['9x0'] == 0) $totalCorrect++;
				if($t['7x7'] == 49) $totalCorrect++;
				if($t['7-1'] == 6) $totalCorrect++;
				if($t['4x5'] == 20) $totalCorrect++;
				if($t['9/2'] == 5) $totalCorrect++;
				if($t['8x7'] == 56) $totalCorrect++;
				if($t['8-8'] == 0) $totalCorrect++;
				if($t['5/2'] == 2.5) $totalCorrect++;
				if($t['7x9'] == 63) $totalCorrect++;
				if($t['4+3'] == 7) $totalCorrect++;
				if($t['6+5'] == 11) $totalCorrect++;
				if($t['9-7'] == 2) $totalCorrect++;
				if($t['2x8'] == 16) $totalCorrect++;
				if($t['7/1'] == 7) $totalCorrect++;
				if($t['9-1'] == 8) $totalCorrect++;
				if($t['6/2'] == 3) $totalCorrect++;
				if($t['5x2'] == 10) $totalCorrect++;
				if($t['8/2'] == 4) $totalCorrect++;
				if($t['3x4'] == 12) $totalCorrect++;
				if($t['8-7'] == 1) $totalCorrect++;
				if($t['5x8'] == 40) $totalCorrect++;
				if($t['1x1'] == 1) $totalCorrect++;
				if($t['10/3'] == 3) $totalCorrect++;
				if($t['9+8'] == 17) $totalCorrect++;
				if($t['3-2'] == 1) $totalCorrect++;
				
				if($t['half_of_value'] == 3) $totalCorrectMulti++;
				if($t['decimal_numbers_represent'] == 4) $totalCorrectMulti++;
				if($t['nfl_kicker'] == 3) $totalCorrectMulti++;
				if($t['free_throws'] == 5) $totalCorrectMulti++;
				if($t['wnba_free_throws'] == 2) $totalCorrectMulti++;
				if($t['same_shots'] == 3) $totalCorrectMulti++;
				if($t['odds_of_three_point'] == 3) $totalCorrectMulti++;
				if($t['shot_odds'] == 4) $totalCorrectMulti++;
			}
			
			$mathPercentage = round(($totalCorrect / $totalMath)*100,2);
			$multiPercentage = round(($totalCorrectMulti / $totalMultiChoice)*100,2);
			
			$male = round(($male/$totalCount)*100,2);
			$female = round(($female/$totalCount)*100,2);
			$native = round(($native/$totalCount)*100,2);
			$pacificIslander = round(($pacificIslander/$totalCount)*100,2);
			$black = round(($black/$totalCount)*100,2);
			$hispanic = round(($hispanic/$totalCount)*100,2);
			$white = round(($white/$totalCount)*100,2);
			$other = round(($other/$totalCount)*100,2);
			$thirdGrade = round(($thirdGrade/$totalCount)*100,2);
			$fourthGrade = round(($fourthGrade/$totalCount)*100,2);
			$fifthGrade = round(($fifthGrade/$totalCount)*100,2);
			$sixthGrade = round(($sixthGrade/$totalCount)*100,2);
			$seventhGrade = round(($seventhGrade/$totalCount)*100,2);
			$eighthGrade = round(($eighthGrade/$totalCount)*100,2);
			$ninthGrade = round(($ninthGrade/$totalCount)*100,2);
			
			
			return view("admin.tests.posttest-no-usage", [
				"twentyFourHours" => $twentyFourHours,
				"lastWeek" => $lastWeek,
				"lastTwoWeeks" => $lastTwoWeeks,
				"lastMonth" => $lastMonth,
				"percentOfUsers" => $percentOfUsers,
				"totalCount" => $totalCount,
				"mathPercentage" => $mathPercentage,
				"multiPercentage" => $multiPercentage,
				"male" => $male,
				"female" => $female,
				"native" => $native,
				"pacificIslander" => $pacificIslander,
				"black" => $black,
				"hispanic" => $hispanic,
				"white" => $white,
				"third" => $thirdGrade,
				"fourth" => $fourthGrade,
				"fifth" => $fifthGrade,
				"sixth" => $sixthGrade,
				"seventh" => $seventhGrade,
				"eighth" => $eighthGrade,
				"ninth" => $ninthGrade,
				"other" => $other,
			]);
		}
		
		public function posttestFullUsage()
		{
			$twentyFourHours = Postassessment::where("created_at",">",Carbon::now()->subDay())->where("games_completed","5")->count();
			$lastWeek = Postassessment::where("created_at",">",Carbon::now()->subWeek())->where("games_completed","5")->count();
			$lastTwoWeeks = Postassessment::where("created_at",">",Carbon::now()->subDays(14))->where("games_completed","5")->count();
			$lastMonth = Postassessment::where("created_at",">",Carbon::now()->startOfMonth()->subMonth()->toDateString())->where("games_completed","5")->count();
			
			$total = Postassessment::where("games_completed","5")->get();
			$totalCount = count($total);
			$percentOfUsers = round((User::where('account_level','gold')->where('post_assessment_complete',1)->count()/$totalCount)*100,2);
			
			$totalMath = $totalCount * 30;
			$totalMultiChoice = $totalCount * 8;
			
			
			$totalCorrect = 0;
			$totalCorrectMulti = 0;
			
			$male = 0;
			$female = 0;
			$native = 0;
			$pacificIslander = 0;
			$black = 0;
			$hispanic = 0;
			$white = 0;
			$other = 0;
			$thirdGrade = 0;
			$fourthGrade = 0;
			$fifthGrade = 0;
			$sixthGrade = 0;
			$seventhGrade = 0;
			$eighthGrade = 0;
			$ninthGrade = 0;
			
			foreach($total as $t){
				
				$student = Student::where("id", $t['student_id'])->first();
				
				if($student['gender'] == "Male") $male++;
				if($student['gender'] == "Female") $female++;
				
				if($student['ethnicity'] == "American Indian or Alaskan Native") $native++;
				if($student['ethnicity'] == "Asian, Native Hawaiian, or other Pacific Islander") $pacificIslander++;
				if($student['ethnicity'] == "Black or African-American") $black++;
				if($student['ethnicity'] == "Hispanic or Latino") $hispanic++;
				if($student['ethnicity'] == "White") $white++;
				if($student['ethnicity'] == "Other") $other++;
				
				if($student['grade'] == "3 or Under") $thirdGrade++;
				if($student['grade'] == "4") $fourthGrade++;
				if($student['grade'] == "5") $fifthGrade++;
				if($student['grade'] == "6") $sixthGrade++;
				if($student['grade'] == "7") $seventhGrade++;
				if($student['grade'] == "8") $eighthGrade++;
				if($student['grade'] == "9 or Over") $ninthGrade++;
				
				
				if($t['7+1'] == 8) $totalCorrect++;
				if($t['6-3'] == 3) $totalCorrect++;
				if($t['6x6'] == 36) $totalCorrect++;
				if($t['9/3'] == 3) $totalCorrect++;
				if($t['7+5'] == 12) $totalCorrect++;
				if($t['9x0'] == 0) $totalCorrect++;
				if($t['7x7'] == 49) $totalCorrect++;
				if($t['7-1'] == 6) $totalCorrect++;
				if($t['4x5'] == 20) $totalCorrect++;
				if($t['9/2'] == 5) $totalCorrect++;
				if($t['8x7'] == 56) $totalCorrect++;
				if($t['8-8'] == 0) $totalCorrect++;
				if($t['5/2'] == 2.5) $totalCorrect++;
				if($t['7x9'] == 63) $totalCorrect++;
				if($t['4+3'] == 7) $totalCorrect++;
				if($t['6+5'] == 11) $totalCorrect++;
				if($t['9-7'] == 2) $totalCorrect++;
				if($t['2x8'] == 16) $totalCorrect++;
				if($t['7/1'] == 7) $totalCorrect++;
				if($t['9-1'] == 8) $totalCorrect++;
				if($t['6/2'] == 3) $totalCorrect++;
				if($t['5x2'] == 10) $totalCorrect++;
				if($t['8/2'] == 4) $totalCorrect++;
				if($t['3x4'] == 12) $totalCorrect++;
				if($t['8-7'] == 1) $totalCorrect++;
				if($t['5x8'] == 40) $totalCorrect++;
				if($t['1x1'] == 1) $totalCorrect++;
				if($t['10/3'] == 3) $totalCorrect++;
				if($t['9+8'] == 17) $totalCorrect++;
				if($t['3-2'] == 1) $totalCorrect++;
				
				if($t['half_of_value'] == 3) $totalCorrectMulti++;
				if($t['decimal_numbers_represent'] == 4) $totalCorrectMulti++;
				if($t['nfl_kicker'] == 3) $totalCorrectMulti++;
				if($t['free_throws'] == 5) $totalCorrectMulti++;
				if($t['wnba_free_throws'] == 2) $totalCorrectMulti++;
				if($t['same_shots'] == 3) $totalCorrectMulti++;
				if($t['odds_of_three_point'] == 3) $totalCorrectMulti++;
				if($t['shot_odds'] == 4) $totalCorrectMulti++;
			}
			
			$mathPercentage = round(($totalCorrect / $totalMath)*100,2);
			$multiPercentage = round(($totalCorrectMulti / $totalMultiChoice)*100,2);
			
			$male = round(($male/$totalCount)*100,2);
			$female = round(($female/$totalCount)*100,2);
			$native = round(($native/$totalCount)*100,2);
			$pacificIslander = round(($pacificIslander/$totalCount)*100,2);
			$black = round(($black/$totalCount)*100,2);
			$hispanic = round(($hispanic/$totalCount)*100,2);
			$white = round(($white/$totalCount)*100,2);
			$other = round(($other/$totalCount)*100,2);
			$thirdGrade = round(($thirdGrade/$totalCount)*100,2);
			$fourthGrade = round(($fourthGrade/$totalCount)*100,2);
			$fifthGrade = round(($fifthGrade/$totalCount)*100,2);
			$sixthGrade = round(($sixthGrade/$totalCount)*100,2);
			$seventhGrade = round(($seventhGrade/$totalCount)*100,2);
			$eighthGrade = round(($eighthGrade/$totalCount)*100,2);
			$ninthGrade = round(($ninthGrade/$totalCount)*100,2);
			
			
			return view("admin.tests.posttest-full-usage", [
				"twentyFourHours" => $twentyFourHours,
				"lastWeek" => $lastWeek,
				"lastTwoWeeks" => $lastTwoWeeks,
				"lastMonth" => $lastMonth,
				"percentOfUsers" => $percentOfUsers,
				"totalCount" => $totalCount,
				"mathPercentage" => $mathPercentage,
				"multiPercentage" => $multiPercentage,
				"male" => $male,
				"female" => $female,
				"native" => $native,
				"pacificIslander" => $pacificIslander,
				"black" => $black,
				"hispanic" => $hispanic,
				"white" => $white,
				"third" => $thirdGrade,
				"fourth" => $fourthGrade,
				"fifth" => $fifthGrade,
				"sixth" => $sixthGrade,
				"seventh" => $seventhGrade,
				"eighth" => $eighthGrade,
				"ninth" => $ninthGrade,
				"other" => $other,
			]);
		}
	
		public function sortPretests(Request $request)
		{
			$pretests = Preassessment::where($request->input('location'),'like', '%'.$request->input('query').'%')->get();
			
			$columns = \DB::connection()->getSchemaBuilder()->getColumnListing("preassessments");		
			$saved = SavedAssessment::where("type","=",1)->get();
			$students = count($pretests);
			$studentIds = array();
			foreach($pretests as $test){
				$studentIds[] = $test->student_id;
			}
			$total = count($pretests);
			$pretests = Preassessment::where($request->input('location'),'like', '%'.$request->input('query').'%')->paginate(25);
		
			
			return view("admin.pre-sorted", [
				"assessments" => $pretests,
				"students" => $students,
				"columns" => $columns,
				"saved" => $saved,
				"studentIds" => $studentIds,
				"total" => $total
			]);
		}
		
		public function sortPosttests(Request $request)
		{
			$posttests = Postassessment::where($request->input('location'),'like', '%'.$request->input('query').'%')->get();
			
			$columns = \DB::connection()->getSchemaBuilder()->getColumnListing("postassessments");		
			$saved = SavedAssessment::where("type","=",1)->get();
			$students = count($posttests);
			$studentIds = array();
			foreach($posttests as $test){
				$studentIds[] = $test->student_id;
			}
			$total = count($posttests);
			$posttests = Postassessment::where($request->input('location'),'like', '%'.$request->input('query').'%')->paginate(25);
			
			return view("admin.post-sorted", [
				"assessments" => $posttests,
				"students" => $students,
				"columns" => $columns,
				"saved" => $saved,
				"studentIds" => $studentIds,
				"total" => $total
			]);
		}
	
		public function sortPreassessments(Request $request)
	  {
		  $columns = \Schema::getColumnListing('preassessments');
		  $saved = SavedAssessment::where("type","=",1)->get();
		  
		  $sorting = array();
		  
		  if($request->input('school_program_name') != 'null')
		  	$sorting[] = ["school_program_name", "=", $request->input('school_program_name')];
		  	
		  if($request->input('state') != 'null')
		  	$sorting[] = ["state", "=", $request->input('state')];
		  	
		  $assessments = Preassessment::where($sorting)->orderBy('created_at','desc')->paginate(25);
		  
		  $all = Preassessment::where($sorting)->orderBy('created_at','desc')->get();
		  
		  return view('admin.pre-sorted', [
			  "assessments" => $assessments,
		    "columns" => $columns,
		    "saved" => $saved,
		    "all" => $all
		  ]);
	  }
	  
	  public function sortPostassessments(Request $request)
	  {
		  $columns = \Schema::getColumnListing('postassessments');
		  $saved = SavedAssessment::where("type","=",1)->get();
		  
		  $sorting = array();
		  
		  if($request->input('school_program_name') != 'null')
		  	$sorting[] = ["school_program_name", "=", $request->input('school_program_name')];
		  	
		  if($request->input('state') != 'null')
		  	$sorting[] = ["state", "=", $request->input('state')];
		  	
		  $assessments = Postassessment::where($sorting)->orderBy('created_at','desc')->paginate(25);
		  
		  $all = Postassessment::where($sorting)->orderBy('created_at','desc')->get();
		  
		  return view('admin.post-sorted', [
			  "assessments" => $assessments,
		    "columns" => $columns,
		    "saved" => $saved,
		    "all" => $all
		  ]);
	  }
	
    public function show(User $user)
    {
	    	$teacher = $user;
	    	if($teacher){
	    	if($teacher->pre_assessment_complete == 1){
		    	return view('assessments.post', [
			    	'teacher' => $teacher
		    	]);
	    	}
    		return view('assessments.pre', [
	    		'teacher' => $teacher
    		]);
    		} else {
	    		\Session::flash('alert-danger', 'We did not find an assessment at that link. Please double check that you have the correct URL!');
	    		return redirect("/home");
    		}
    }
    
    public function store(Request $request, User $user)
    {
		    	$teacher = $user;
		    						
					if($teacher->pre_assessment_complete == 0){
    				$student = new Student($request->all());   		
    				$student->pre_assessment = 1;
						$student->save();	
						$teacher->addStudent($student);
						
						$assessment = new Preassessment($request->except(['name','grade','gender', 'ethnicity']));
						$assessment->student_id = $student->id;
						$assessment->save();
						
						return redirect('preassessment/complete');
    			} else {
	    			$student = Student::where('id',$request->input('student'))->first();
	    			$student->post_assessment = 1;
						$student->save();
						
						$assessment = new Postassessment($request->except(['student']));
						$assessment->student_id = $student->id;
						$assessment->save();
						return redirect('postassessment/complete');
    			}
    						
    			
    			
    			
    			
    }
    
    public function complete()
    {
    			return view('assessments.complete');
    }
    
    public function submit()
    {
	    $count = ceil(count(\Auth::user()->students)/4);
		if($count > 8){
				$count = 8;    
	    }
	    
	    if($count == 0){
		    $count = 1;
	    }
	    return view('assessments.submit', [
		    "count" => $count
	    ]);
    }
    
    public function finish(Request $request)
    {
	    if(\Auth::user()->pre_assessment_complete == 0) {
		    \Auth::user()->pre_assessment_complete = 1;
		    \Auth::user()->save();
		    
		    if($request->input('cards-only') == "no-cards"){
			    
			    $order = new \LaravelShipStation\Models\Order();
			    
			    $count = ceil(count(\Auth::user()->students)/4);
				if($count > 8){
						$count = 8;    
			    }
			    
			    if($count == 0){
				    $count = 1;
			    }
			    
			    $cards = ceil($count/2);
			    
				if($cards == 0){
					$cards++;
				}
				
				$lastOrder = ShippingList::orderby('created_at','desc')->first();
				
				$orderNumber = \Carbon\Carbon::now()->format("Ymd") . "001";	
				if($lastOrder){
					if($orderNumber <= $lastOrder->order_number){
						$orderNumber = $lastOrder->order_number + 1;
					}
				}
				
				
				$shippingMethod = "Fedex Ground";
				
				if(!\Auth::user()->country || \Auth::user()->country == null || \Auth::user()->country == ""){
  				\Auth::user()->country = "USA";
  				\Auth::user()->save();
				}
				
				
				if(\Auth::user()->country != "USA"){
					$shippingMethod = "Fedex International";
				}
				
				$cards = $cards;
				
				$shippingName = \Auth::user()->name;
				if(\Auth::user()->shipping_name){
					$shippingName = \Auth::user()->shipping_name;
				}
				
				$shipStation = new \LaravelShipStation\ShipStation(getenv('SS_KEY'), getenv('SS_SECRET'));
			
				$address = new \LaravelShipStation\Models\Address();
				
				$address->name = $shippingName;
			    $address->street1 = \Auth::user()->shipping_address_1;
			    $address->street2 = \Auth::user()->shipping_address_2;
			    $address->city = \Auth::user()->shipping_city;
			    $address->state = \Auth::user()->shipping_state;
			    $address->postalCode = \Auth::user()->shipping_zip_code;
			    $address->country = "US";
			    $address->phone = \Auth::user()->phone;
				
				if(!\Auth::user()->isDemo()){
		 		    
		 		    ShippingList::create([
					    "order_number" => $orderNumber,
					    "item" => 48826,
					    "quantity" => $cards,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
		 		    ]);
		 		    
		 		    $item = new \LaravelShipStation\Models\OrderItem();
	
				    $item->sku = 48826;
				    $item->name = "Cards";
				    $item->quantity = $cards;
				    $item->unitPrice = "0.00";
				    
				    $order->items[] = $item;
	 		    
	 		    }
			    
			    $order = new \LaravelShipStation\Models\Order();

			    $order->orderNumber = $orderNumber;
			    $order->orderDate = \Carbon\Carbon::now()->toDateString();
			    $order->orderStatus = 'awaiting_shipment';
			    $order->amountPaid = '0.00';
			    $order->taxAmount = '0.00';
			    $order->shippingAmount = '0.00';
			    $order->billTo = $address;
			    $order->shipTo = $address;	    
				
				$shipStation->orders->post($order, 'createorder');
			    
			    \Session::flash('alert-success', 'Thank you for completing the pretest! Cards will be automatically sent to the shipping address in your profile this week.');
				return redirect('/home');
			    
		    } else {
			    
			    $quantity = $request->input('game-count');
		        if($quantity != 0){
		    
		    	$order = new \LaravelShipStation\Models\Order();
		    
		    	
		    	
				$cards = ceil($quantity/2);
				
				if($quantity == 0){
					$quantity++;
				}
				
				$stickers = $quantity * 2;
				
				if($cards == 0){
					$cards++;
				}
				
				$lastOrder = ShippingList::orderby('created_at','desc')->first();
				
				$orderNumber = \Carbon\Carbon::now()->format("Ymd") . "001";	
				if($lastOrder){
					if($orderNumber <= $lastOrder->order_number){
						$orderNumber = $lastOrder->order_number + 1;
					}
				}
				
				
				$shippingMethod = "Fedex Ground";
				
				if(!\Auth::user()->country || \Auth::user()->country == null || \Auth::user()->country == ""){
  				\Auth::user()->country = "USA";
  				\Auth::user()->save();
				}
				
				
				if(\Auth::user()->country != "USA"){
					$shippingMethod = "Fedex International";
				}
				
				$games = $quantity;
				$cards = $cards;
				
				$shippingName = \Auth::user()->name;
				if(\Auth::user()->shipping_name){
					$shippingName = \Auth::user()->shipping_name;
				}
				
				$shipStation = new \LaravelShipStation\ShipStation(getenv('SS_KEY'), getenv('SS_SECRET'));
			
				$address = new \LaravelShipStation\Models\Address();
				
				$address->name = $shippingName;
			    $address->street1 = \Auth::user()->shipping_address_1;
			    $address->street2 = \Auth::user()->shipping_address_2;
			    $address->city = \Auth::user()->shipping_city;
			    $address->state = \Auth::user()->shipping_state;
			    $address->postalCode = \Auth::user()->shipping_zip_code;
			    $address->country = "US";
			    $address->phone = \Auth::user()->phone;
				
				if(!\Auth::user()->isDemo()){
			    
		    
			    ShippingList::create([
				    "order_number" => $orderNumber,
				    "item" => 48720,
				    "quantity" => $games,
				    "recipient" => $shippingName,
				    "company" => \Auth::user()->school_program_name,
				    "address_1" => \Auth::user()->shipping_address_1,
				    "address_2" => \Auth::user()->shipping_address_2,
				    "city" => \Auth::user()->shipping_city,
				    "state" => \Auth::user()->shipping_state,			    
				    "post_code" => \Auth::user()->shipping_zip_code,
				    "country" => \Auth::user()->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => \Auth::user()->email
	 		    ]);
	 		    
	 		    ShippingList::create([
				    "order_number" => $orderNumber,
				    "item" => 48826,
				    "quantity" => $cards,
				    "recipient" => $shippingName,
				    "company" => \Auth::user()->school_program_name,
				    "address_1" => \Auth::user()->shipping_address_1,
				    "address_2" => \Auth::user()->shipping_address_2,
				    "city" => \Auth::user()->shipping_city,
				    "state" => \Auth::user()->shipping_state,
				    "post_code" => \Auth::user()->shipping_zip_code,
				    "country" => \Auth::user()->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => \Auth::user()->email
	 		    ]);
	 		    
	 		    // Shipstation
	 		    
	 		    $item = new \LaravelShipStation\Models\OrderItem();
	
			    $item->sku = 48720;
			    $item->name = "Game";
			    $item->quantity = $games;
			    $item->unitPrice = "0.00";
			    
			    $order->items[] = $item;
			    
			    $item = new \LaravelShipStation\Models\OrderItem();
	
			    $item->sku = 48826;
			    $item->name = "Cards";
			    $item->quantity = $cards;
			    $item->unitPrice = "0.00";
			    
			    $order->items[] = $item;
	 		    
	 		    if(\Auth::user()->shipping_state == "UT"){
		 		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51011,
		  			    "quantity" => $games,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,			    
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
		   		    ]);
		   		    
		   		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51012,
		  			    "quantity" => $cards,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
		   		    ]);
		   		    
		   		    $item = new \LaravelShipStation\Models\OrderItem();
		
				    $item->sku = 51011;
				    $item->name = "Utah Items";
				    $item->quantity = $games;
				    $item->unitPrice = "0.00";
				    
				    $order->items[] = $item;
				    
				    $item = new \LaravelShipStation\Models\OrderItem();
		
				    $item->sku = 51012;
				    $item->name = "Utah Items";
				    $item->quantity = $cards;
				    $item->unitPrice = "0.00";
				    
				    $order->items[] = $item;
		 		  }
		 		  
		 		  if(\Auth::user()->shipping_state == "WI"){
		 		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51021,
		  			    "quantity" => $games,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,			    
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
		   		    ]);
		   		    
		   		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51022,
		  			    "quantity" => $cards,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
		   		    ]);
		   		    
		   		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51023,
		  			    "quantity" => $games,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,			    
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
		   		    ]);
		   		    
		   		    $item = new \LaravelShipStation\Models\OrderItem();
		
				    $item->sku = 51021;
				    $item->name = "Wisconsin Items";
				    $item->quantity = $games;
				    $item->unitPrice = "0.00";
				    
				    $order->items[] = $item;
				    
				    $item = new \LaravelShipStation\Models\OrderItem();
		
				    $item->sku = 51022;
				    $item->name = "Wisconsin Items";
				    $item->quantity = $cards;
				    $item->unitPrice = "0.00";
				    
				    $order->items[] = $item;
				    
				    $item = new \LaravelShipStation\Models\OrderItem();
		
				    $item->sku = 51023;
				    $item->name = "Wisconsin Items";
				    $item->quantity = $games;
				    $item->unitPrice = "0.00";
				    
				    $order->items[] = $item;
		   		    
		 		  }
			    
			    if(\Auth::user()->shipping_state == "MI"){
	  		    
		  		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51001,
		  			    "quantity" => $games,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,			    
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
		   		    ]);
		   		    
		   		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51002,
		  			    "quantity" => $cards,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
		   		    ]);
		   		    
		   		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51003,
		  			    "quantity" => $games,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
		   		    ]);
		   		    
		   		    $item = new \LaravelShipStation\Models\OrderItem();
		
				    $item->sku = 51001;
				    $item->name = "Minnesota Items";
				    $item->quantity = $games;
				    $item->unitPrice = "0.00";
				    
				    $order->items[] = $item;
				    
				    $item = new \LaravelShipStation\Models\OrderItem();
		
				    $item->sku = 51002;
				    $item->name = "Minnesota Items";
				    $item->quantity = $cards;
				    $item->unitPrice = "0.00";
				    
				    $order->items[] = $item;
				    
				    $item = new \LaravelShipStation\Models\OrderItem();
		
				    $item->sku = 51003;
				    $item->name = "Minnesota Items";
				    $item->quantity = $games;
				    $item->unitPrice = "0.00";
				    
				    $order->items[] = $item;
	  		    
			    }
			    
			    $laZips = array(
						"90016",
						"90002",
						"90061",
						"90002",
						"90002",
						"90003",
						"90002",
						"90003",
						"90002",
						"90002",
						"90061",
						"90061",
						"90059",
						"90061",
						"90002",
						"90002",
						"91306",
						"91306",
						"91306",
						"91306",
						"91351",
						"91306",
						"91324",
						"90016",
						"90002",
						"90061",
						"90003",
						"90059",
						"91306",
						"91351",
						"91324"
					);
					
					if(in_array(\Auth::user()->shipping_zip_code, $laZips)){
						ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51031,
						    "quantity" => $games,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
					    ]);
					    
					    ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51032,
						    "quantity" => $cards,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
					    ]);
					    
					    ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51033,
						    "quantity" => $games,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
					    ]);
					    
					    ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51034,
						    "quantity" => $games,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
					    ]);
					    
					    ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51035,
						    "quantity" => $cards,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
					    ]);
					    
					    ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51036,
						    "quantity" => $games,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
					    ]);
					    
					    $item = new \LaravelShipStation\Models\OrderItem();
			
					    $item->sku = 51031;
					    $item->name = "Los Angeles Items";
					    $item->quantity = $games;
					    $item->unitPrice = "0.00";
					    
					    $order->items[] = $item;
					    
					    $item = new \LaravelShipStation\Models\OrderItem();
			
					    $item->sku = 51032;
					    $item->name = "Los Angeles Items";
					    $item->quantity = $cards;
					    $item->unitPrice = "0.00";
					    
					    $order->items[] = $item;
					    
					    $item = new \LaravelShipStation\Models\OrderItem();
			
					    $item->sku = 51033;
					    $item->name = "Los Angeles Items";
					    $item->quantity = $games;
					    $item->unitPrice = "0.00";
					    
					    $order->items[] = $item;
					    
					    $item = new \LaravelShipStation\Models\OrderItem();
			
					    $item->sku = 51034;
					    $item->name = "Los Angeles Items";
					    $item->quantity = $games;
					    $item->unitPrice = "0.00";
					    
					    $order->items[] = $item;
					    
					    $item = new \LaravelShipStation\Models\OrderItem();
			
					    $item->sku = 51035;
					    $item->name = "Los Angeles Items";
					    $item->quantity = $cards;
					    $item->unitPrice = "0.00";
					    
					    $order->items[] = $item;
					    
					    $item = new \LaravelShipStation\Models\OrderItem();
			
					    $item->sku = 51036;
					    $item->name = "Los Angeles Items";
					    $item->quantity = $games;
					    $item->unitPrice = "0.00";
					    
					    $order->items[] = $item;
					}
					
					$philZips = FundedRegion::where('team','phi')->get()->toArray();
					
					if(in_array(\Auth::user()->site_zip_code, $philZips) || in_array(\Auth::user()->shipping_zip_code, $philZips)){
						ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51041,
						    "quantity" => $cards,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
					    ]);
					    
					    ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51042,
						    "quantity" => $games,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
					    ]);
					    
					    $item = new \LaravelShipStation\Models\OrderItem();
			
					    $item->sku = 51041;
					    $item->name = "Philadelphia Items";
					    $item->quantity = $cards;
					    $item->unitPrice = "0.00";
					    
					    $order->items[] = $item;
					    
					    $item = new \LaravelShipStation\Models\OrderItem();
			
					    $item->sku = 51042;
					    $item->name = "Philadelphia Items";
					    $item->quantity = $games;
					    $item->unitPrice = "0.00";
					    
					    $order->items[] = $item;
					}
					
					$order->orderNumber = $orderNumber;
				    $order->orderDate = \Carbon\Carbon::now()->toDateString();
				    $order->orderStatus = 'awaiting_shipment';
				    $order->amountPaid = '0.00';
				    $order->taxAmount = '0.00';
				    $order->shippingAmount = '0.00';
				    $order->billTo = $address;
				    $order->shipTo = $address;	    
					
					$shipStation->orders->post($order, 'createorder');
					
				}
	 		    
	 		}
	 		  
		    
		    \Session::flash('alert-success', 'Thank you for completing the pretest! Games will be automatically sent to the shipping address in your profile this week.');
				return redirect('/home');
				
			}
	    }
	    if(\Auth::user()->pre_assessment_complete == 1) {
		    \Auth::user()->post_assessment_complete = 1;
		    \Auth::user()->save();
		    \Session::flash('alert-success', 'Thank you for completing your post-assessment! We hoped you enjoyed the season!');
				return back();
	    }
	    
	    \Session::flash('alert-danger', 'Something went wrong! Try it again.');
	    return back();
    }
    
    public function preResults()
    {
			$assessments = Preassessment::orderBy('created_at','desc')->paginate(25);

			$columns = \DB::connection()->getSchemaBuilder()->getColumnListing("preassessments");		
			$saved = SavedAssessment::where("type","=",1)->get();
		
			//$programs = Preassessment::orderBy('school_program_name')->get();
 			//$states = Preassessment::orderBy('state')->get();

			//$lower = Preassessment::where("steph_curry","!=",null)->count();
			//$higher = Preassessment::where("lebron_james","!=",null)->count();
			
			$total = $assessments->total();
			
			$students = Student::count();

			return view("assessments.pre-list", [
				'assessments' => $assessments,
				'columns' => $columns,

				'saved' => $saved,
			
				//'programs' => $programs,
				//'states' => $states,
				'total' => $total,
				//'lower' => $lower,
				//'higher' => $higher,
				'students' => $students

			]);

    }
    
    public function preResultsSubAdmin()
    {
	    $sites = array();
			$su = SubAdmin::where("admin","=",\Auth::user()->id)->get();
			foreach($su as $u){
				$thisUser = User::find($u->user);
				foreach($thisUser->students as $student){
					$sites[] = $student->id;
				}
			}
			$assessments = Preassessment::whereIn('student_id',$sites)->orderBy('created_at','desc')->paginate(25);

			if($assessments){
			$columns = array_keys($assessments->toArray()['data'][0]);		
			} else {
				$columns = false;
			}

			return view("sub-admin.pre-assessments", [
				'assessments' => $assessments,
				'columns' => $columns,
			]);

    }
    
    public function postResultsSubAdmin()
    {
	    $sites = array();
			$su = SubAdmin::where("admin","=",\Auth::user()->id)->get();
			foreach($su as $u){
				$thisUser = User::find($u->user);
				foreach($thisUser->students as $student){
					$sites[] = $student->id;
				}
			}
			$assessments = Postassessment::whereIn('student_id',$sites)->orderBy('created_at','desc')->paginate(25);

			if(count($assessments) > 0){
			$columns = array_keys($assessments->toArray()['data'][0]);		
			} else {
				$columns = false;
			}

			return view("sub-admin.post-assessments", [
				'assessments' => $assessments,
				'columns' => $columns,
			]);

    }
    
    public function preResultsArchive()
    {
	    ini_set('max_execution_time', 300);
	    ini_set('memory_limit', '2048M');
			$assessments = array();
			Preassessment::where("created_at", "<", \Carbon\Carbon::parse("July 1st, 2019"))->chunk(100, function($as) use (&$assessments) {
				foreach($as as $assessment){
					unset($assessment->id);
					$student = Student::find($assessment->student_id);
					$assessment->gender = $student['gender'];
					$assessment->ethnicity = $student['ethnicity'];
					$assessment->grade = $student['grade'];
					unset($assessment->created_at);
					unset($assessment->updated_at);
					
					$assessment =  json_decode(json_encode($assessment), true);
					array_push($assessments, $assessment);
				}
			});
			$title = md5(time());
			$count = 0;
			$filepath = Excel::create($title, function($excel) use (&$assessments) {
				$excel->sheet('Results', function($sheet) use(&$assessments) {
					$sheet->fromArray($assessments);
				});
			})->store('xls', false, true);
	    
	    
	    SavedAssessment::create([
		    'file' => "/storage/exports/" . $filepath['file'],
		    'type' => 1
	    ]);
	    
		//Preassessment::truncate();
	    
	    \Session::flash("alert-success", "The results have been archived!");
	    return back();
    }
    
    public function postResults()
    {
			$assessments = Postassessment::orderBy('created_at','desc')->paginate(25);

			$columns = \DB::connection()->getSchemaBuilder()->getColumnListing("postassessments");		
			$saved = SavedAssessment::where("type","=",2)->get();
		
			//$programs = Postassessment::orderBy('school_program_name')->get();
 			//$states = Postassessment::orderBy('state')->get();

			//$lower = Postassessment::where("steph_curry","!=",null)->count();
			//$higher = Postassessment::where("lebron_james","!=",null)->count();
			
			$total = $assessments->total();
			
			$students = Student::count();

			return view("assessments.post-list", [
				'assessments' => $assessments,
				'columns' => $columns,
				'saved' => $saved,			
				//'programs' => $programs,
				//'states' => $states,
				'total' => $total,
				//'lower' => $lower,
				//'higher' => $higher,
				'students' => $students

			]);
    }
    
    public function postResultsArchive()
    {
			$assessments = Postassessment::all();
			$title = md5(time());
			
			foreach($assessments as $assessment){
				unset($assessment->id);
				$student = Student::find($assessment->student_id);
				$assessment->gender = $student['gender'];
				$assessment->ethnicity = $student['ethnicity'];
				$assessment->grade = $student['grade'];
				unset($assessment->created_at);
				unset($assessment->updated_at);
			}
			
			$filepath = Excel::create($title, function($excel) use($assessments) {
		    $excel->sheet('Results', function($sheet) use($assessments) {
			    $sheet->fromArray($assessments);
		    });
	    })->store('xls', false, true);
	    
	    SavedAssessment::create([
		    'file' => "/storage/exports/" . $filepath['file'],
		    'type' => 2
	    ]);
	    
	    Postassessment::truncate();
	    
	    \Session::flash("alert-success", "The results have been archived!");
	    return back();
    }
}
