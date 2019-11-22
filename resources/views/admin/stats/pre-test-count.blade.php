<?php
	$goldUsersStudents = array();
	\App\User::where("account_level",2)->chunk(150, function($users) use (&$goldUsersStudents) {
		foreach($users as $user){
			foreach($user->students as $student){
				$goldUsersStudents[] = $student->id;
			}
		}
	});	
	$preTestsComplete = \App\Preassessment::where('created_at','>',\Carbon\Carbon::parse("2019/08/01")->toDateTimeString())->whereIn('student_id',$goldUsersStudents)->count();
?>

<h1>{{ number_format($preTestsComplete) }}</h1>
<p>Since 8/1/19</p>