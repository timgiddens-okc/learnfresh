<div class="header">
	<div class="header-background"></div>
	<div class="container">
		<div class="row">
	    	<div class="col-sm-2 vcenter">
		    	<a class="logo" href="/home">
	              <img src="{{ ($app == "production") ? secure_asset('images/logo.svg') : asset('images/logo.svg') }}" />
	            </a>
	    	</div><!--
	     --><div class="col-sm-10 text-right vcenter links">
		    	<a href="#" class="toggle-submenu" data-toggle="educator-resources">Program Resources <span class="caret"></span></a>
		    	<a href="#" class="toggle-submenu" data-toggle="educator-events">Events <span class="caret"></span></a>
		    	<a href="#" class="toggle-submenu" data-toggle="educator-assessments">Assessments <span class="caret"></span></a>
		    	<a href="/checkpoints">Checkpoints</a>
		    	<a href="#" class="toggle-submenu" data-toggle="educator-forum">Support <span class="caret"></span></a>
		    	<a href="/settings">Settings</a>
		    	<a href="/logout"
	      onclick="event.preventDefault();
	               document.getElementById('logout-form').submit();">
	      Logout
	  </a>
	
	  <form id="logout-form" action="/logout" method="POST" style="display: none;">
	      {{ csrf_field() }}
	  </form>
	    	</div>
		</div>
	</div>
	<div id="educator-events" class="submenu">
		<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/events/region">In Your Region</a>
			    	<a href="/events/calendar">Calendar</a>
			    	<a href="#" class="toggle-micro-menu" data-toggle="educator-national-championship">National Championship</a>
		    	</div>
	    	</div>
		</div>
	</div>
	<div id="educator-assessments" class="submenu">
		<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/my-class">My Class</a>
			    	<a href="/pretest">Pre-test</a>
			    	<?php
				    	$navWeekNumber = 1;
						$navLastWeek = \App\CompletedWeek::where("user_id",\Auth::user()->id)->orderBy('created_at', 'desc')->first();	
						
						if($navLastWeek){
							$navWeekNumber = $navLastWeek->week_number;
							$navWeekNumber++;
						}
						
						if($navWeekNumber > 7){	
				    ?>
			    	<a href="/posttest">Post-test</a>
			    	<?php
				    	}	
				    ?>
			    	@if(\Auth::user()->sub_admin == 1)
			    	<a href="/general-manager">General Manager</a>
			    	@endif
		    	</div>
	    	</div>
		</div>
	</div>
	<div id="educator-forum" class="submenu">
		<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
		    		<a href="/community">Community</a>
		    	</div>
	    	</div>
		</div>
	</div>
	<div id="educator-resources" class="submenu">
		<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="#" class="toggle-micro-menu" data-toggle="educator-nba-math-hoops">NBA Math Hoops</a>
			    	@if(strpos(\Auth::user()->programs, "3") !== false)
			    	<a href="#" class="toggle-micro-menu" data-toggle="educator-athletics-math-hits">Athletics Math Hits</a>
			    	@endif
			    	@if(strpos(\Auth::user()->programs, "2") !== false)
			    	<a href="#" class="toggle-micro-menu" data-toggle="educator-broncos-first-and-ten">Broncos First & Ten</a>
			    	@endif
		    	</div>
	    	</div>
		</div>
	</div>
	<div id="educator-national-championship" class="micromenu">
		<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/championship">Information</a>
			    	<a href="/national-championship/application">Application</a>
			    	<a href="/national-championship/my-applicants">My Applicants</a>
		    	</div>
	    	</div>
		</div>
	</div>
	<div id="educator-nba-math-hoops" class="micromenu">
		<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/resources/nba-math-hoops/documents">Documents</a>
			    	<a href="/resources/nba-math-hoops/videos">Tutorial Videos</a>
			    	<a href="/resources/nba-math-hoops/tips">Lesson Tips</a>
			    	<a href="http://www.nbamathhoops.org/shotclock" target="_blank">Shot Clock</a>
			    	<a href="/purchase-games">Purchase Games</a>
		    	</div>
	    	</div>
		</div>
	</div>
	<div id="educator-athletics-math-hits" class="micromenu">
		<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/resources/athletics-math-hits/documents">Documents</a>
		    	</div>
	    	</div>
		</div>
	</div>
	<div id="educator-broncos-first-and-ten" class="micromenu">
		<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/resources/first-and-ten/documents">Documents</a>
		    	</div>
	    	</div>
		</div>
	</div>
</div>