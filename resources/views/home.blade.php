@extends('layouts.app')

@section('content')

<div class="container">
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
    		<div class="col-sm-12 col-md-3">
	    		
	    		@if($gameNight)
		    		<div class="panel panel-default">
		    			<div class="panel-heading">
		    				<strong>Game Night</strong>
		    			</div>
		    			<div class="panel-body">
			    			<div class="list-group">
								<a href="/event/{{ $gameNight->id }}" class="list-group-item upcoming-event" style="background: url({{ ($app == "production") ? secure_asset("/team-logos/" . $gameNight->team . "_primary-icon.jpg") : asset("/team-logos/" . $gameNight->team . "_primary-icon.jpg") }}) center right no-repeat;">
									<div class="row">
										<div class="col-sm-3 text-center">
											<div class="month">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s T', $gameNight->event_date . ' ' . $gameNight->timezone)->format('M') }}</div>
											<div class="day">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s T', $gameNight->event_date . ' ' . $gameNight->timezone)->format('j') }}</div>
										</div>
										<div class="col-sm-9">
											<h5>{{ $gameNight->title }}</h5>
											<h6>{{ $gameNight->location }}</h6>
										</div>
									</div>
								</a>
							</div>
		    			</div>
		    		</div>
	    		@endif
	    		
    			<div class="panel panel-default">
	    			<div class="panel-heading">
	    				<strong>Events Calendar</strong>
	    			</div>
	    			<div class="panel-body">
	    				<div class="list-group">
	    					@if (count($events) > 0)
								@foreach ($events as $event)
									<a href="/event/{{ $event->id }}" class="list-group-item upcoming-event" style="background: url({{ ($app == "production") ? secure_asset("/team-logos/" . $event->team . "_primary-icon.jpg") : asset("/team-logos/" . $event->team . "_primary-icon.jpg") }}) center right no-repeat;">
										<div class="row">
											<div class="col-sm-3 text-center">
												<div class="month">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s T', $event->event_date . ' ' . $event->timezone)->format('M') }}</div>
												<div class="day">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s T', $event->event_date . ' ' . $event->timezone)->format('j') }}</div>
											</div>
											<div class="col-sm-9">
												<h5>{{ $event->title }}</h5>
												<h6>{{ $event->location }}</h6>
											</div>
										</div>
									</a>
								@endforeach
							@else
								<div class="list-group-item">
									No upcoming events!
								</div>
							@endif
						</div>
						<a href="/events" class="btn btn-primary btn-block">View All Events</a>
	    			</div>
	    		</div>
	    		<div class="panel panel-default">
	    			<div class="panel-heading">
	    				<strong>Purchase Additional Games</strong>
	    			</div>
	    			<div class="panel-body">
	    				<p>Need additional games? Click here to order more!</p>
	    				
	    				<a href="/purchase-games" class="btn btn-primary expanded">Purchase Games</a>
	    			</div>
	    		</div>
	    		<div class="tweet-container">
	    			<div class="tweet-title">
	    				<span class="twitter"><i class="fa fa-twitter"></i></span> What's Happening?
	    			</div>
	    			<div class="list-group">
	    				@foreach ($tweets as $tweet)
			    			<a href="https://twitter.com/{{ $tweet->user->screen_name }}/status/{{ $tweet->id }}" class="list-group-item tweet" target="_blank">
		    					<div class="row">
				    				<div class="col-xs-12">
				    					@if (isset($tweet->entities->media))
				    					<div class="image"><img src="{{ $tweet->entities->media[0]->media_url_https }}" /></div>
				    					@else
				    						@if (isset($tweet->extended_entities->media[0]->media_url_https))
					    					<div class="image"><img src="{{ $tweet->extended_entities->media[0]->media_url_https }}" /></div>
					    					@endif
				    					@endif
				    					
				    					<p>{{ $tweet->text }}</p>
				    					<h5><strong>{{ "@" }}{{ $tweet->user->screen_name }}</strong></h5>
				    				</div>
				    			</div>
			    			</a>
			    		@endforeach
	    			</div>
	    		</div>
    		</div>
        <div class="col-sm-12 col-md-9">
        	@if ($completed == 2)
						<div class="week-container">
	            <div class="panel panel-default finish-season">
	            	<div class="row">
	            		<div class="col-sm-12 text-center">
	            			<h2>Congratulations!</h2>
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-sm-12 col-md-10 col-md-offset-1 text-center">
	            			<p>You and your students have reached the end of the season. We’re proud to have your incredible group of Math Champs in our community.</p>

										<p>To start a new season, please click the link below:</p>
										
										<p><a href="/new-season" class="btn btn-primary new-season">Start A New Season</a></p>
	            		</div>
	            	</div>
	            </div>
        		</div>
        	@else
        		<div id="currentWeek" style="display:none;">{{ $weekNumber }}</div>
	        	@if (($programs && \Auth::user()->pre_assessment_complete == 1) || \Auth::user()->account_level == 1 ||  \Auth::user()->account_level == "silver")
	        		@if (count($programs) > 1)
	        		<select id="change-program">
	        			@foreach ($programs as $program)
	        				<?php $program = \App\Program::find($program); ?>
	        				<option value="#program{{$program->id}}">{{ $program->title }}</option>
	        			@endforeach
	        		</select>
	        		@endif
	        		@if(count($programs) > 0)
	        		<div class="week-container">
		        	@foreach($programs as $program)
		        		<?php 
			        		$program = \App\Program::find($program); 
			        	?>
		            <div class="panel panel-default weeks" id="program{{$program['id']}}" style="background: url({{ ($app == "production") ? secure_asset($program['logo']) : asset($program['logo']) }}) right -20px bottom -40px no-repeat #fff;">
		            	@if($program)
		            	@if($program['title'] == "NBA Math Hoops")
						<ul class="bxslider nbamathhoopsslider">
						@else
						<ul class="bxslider">
						@endif
			            @if($program['title'] == "NBA Math Hoops")
			            <li>
			            	<div class="row">
				            	<div class="col-sm-12">
					            	<h4 class="text-center">Welcome to the NBA Math Hoops program!</h4>
				            	</div>
			            	</div>
			            	<div class="row">
				            	<div class="col-sm-12 col-md-10 col-md-offset-1 text-center">
					            	<p>Welcome to the NBA Math Hoops program! Through this experience, your students will learn, play, and compete for the title of Math Champion. Along the way, they’ll improve important math and social-emotional skills.</p>

									<p>To get started, please visit “Program Resources and Media”, which includes links to gameplay tutorial videos and the full Season Guide. Within, you’ll find all 12 lessons in the NBA Math Hoops program.</p>

									<p>Starting on Monday of next week, you will also receive your first “weekly tip”, which will appear in this space to guide you from lesson to lesson. To check out future lessons and tips, or to move ahead sooner, simply place your cursor over this box and click on the left/right arrows.</p>

									<p>Best of luck as you get started with NBA Math Hoops! </p>
				            	</div>
			            	</div>
			            </li>
			            @endif
		            	@foreach($program->weeks as $week)
		            	<li>
			            	<div class="row">
			            		<div class="col-sm-12">
			            			<h4 class="text-center">Welcome to Lesson {{ $week->week_number }} of the {{ $program->title }} Season:</h4>
					            	<h2 class="text-center">{{ $week->title }}</h2>
			            		</div>
			            	</div>
			            	<div class="row">
			            		<div class="col-sm-12 col-md-5">
							          {!! $week->description !!}				          
			            		</div>
			            		<div class="col-sm-12 col-md-7">
					            	<div class="action-items">
					            		<div class="list-group">
					            		@foreach ($week->items as $item)
					            			<div class="list-group-item">{!! $item->text !!}</div>
					            		@endforeach
					            		</div>
					            	</div>
			            		</div>
			            	</div>
		            	</li>
		            	@endforeach
		            </ul>
		            @endif
		            </div>
		          @endforeach
	        		</div>
	        		@endif
	        	@else
	        		<div class="week-container">
		            <div class="panel panel-default weeks">
		            	<div class="row">
		            		<div class="col-sm-12 text-center">
		            			<h2>Welcome to the Learn Fresh Coaches Association!</h2>
		            		</div>
		            	</div>
		            	<div class="row">
		            		<div class="col-sm-12 col-md-7">
		            			
		            			<div class="embed-responsive embed-responsive-16by9">
												<iframe width="560" height="315" src="https://www.youtube.com/embed/O6pe6kdG07g?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
											</div>
											
											<p style="font-size: 0.9em;font-style:italic;margin:15px 0px 0px 0px;">If you don't have access to devices in your classroom, you may have students complete the pre-test using paper copies. Once complete, please input all students' results through the online pre-test link before submitting your data.</p>
		            		</div>
		            		<div class="col-sm-12 col-md-5">
		            			<a href="{{ ($app == "production") ? secure_url("/assessment/" . Auth::user()->id)  : url("/assessment/" . Auth::user()->id)  }}" class="btn btn-primary expanded take-pretest">Take Pretest</a><br>
											<a href="/assessment/submit" class="btn btn-primary expanded">Submit All Pretests</a>
											
											<p style="font-size: 0.9em;">In order to receive games and get started with the season, please have all participating students take the NBA Math Hoops pre-test! This will allow us to evaluate the effectiveness of our work throughout the season, and also ensure that we ship the correct number of games for your program or classroom. One game will be shipped for every four students who have taken the assessment, as soon as you press the "Complete Pretest" button!</p>
											
											<p style="font-size: 0.9em;">
												<a href="{{ ($app == "production") ? secure_asset("/assessments/learn-fresh-pre-test.pdf") : asset("/assessments/learn-fresh-pre-test.pdf") }}" target="_blank">Printable Pretest</a>
											</p>
											
											<div class="address-container">
												{{ \Auth::user()->shipping_address_1 }}<br>
												{{ \Auth::user()->shipping_city }}, {{ \Auth::user()->shipping_state }} {{ \Auth::user()->shipping_zip_code }}
											</div>
		            		</div>
		            	</div>
		            </div>
	        		</div>
	          @endif
          @endif
          @if($weekNumber >= 6)
          <div>
            <div class="panel panel-default post-test-container" style="display:block;min-height:0px;">
            	<div class="row">
            		<div class="col-sm-12 text-center">
            			<h2>Thank you for your participation this season!</h2>
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-sm-12 col-md-7">  
            			<a href="{{ ($app == "production") ? secure_url("/assessment/" . Auth::user()->id)  : url("/assessment/" . Auth::user()->id)  }}" class="btn btn-primary expanded take-posttest">Take Post-test</a><br>
									<a href="/assessment/{{ str_replace(" ", "-", strtolower(Auth::user()->id)) }}/complete" class="btn btn-primary expanded complete-posttest">Submit All Post-tests</a>
            		</div>
            		<div class="col-sm-12 col-md-5">
            			
							
									<p style="font-size: 0.9em;">As a reminder, all students from your site must complete the LFCA post-test. Click the links to access your site's assessment. Once you complete and submit your post-test data, you’ll be entered to win a <strong>$300 gift card</strong> for you and your students. Be sure to wrap up your season within two weeks of your regional tournament!</p>
									<p style="font-size: 0.9em;"><a href="{{ ($app == "production") ? secure_asset("/assessments/learn-fresh-post-test.pdf") : asset("/assessments/learn-fresh-post-test.pdf") }}" target="_blank">Printable Posttest</a></p>
	
            		</div>
            	</div>
            </div>
      		</div>
          @endif
          @if($checkpoint)
          @if ((Auth::user()->account_level == 2 || Auth::user()->account_level == "gold"))
          	<div class="panel checkpoint">
          		<div class="panel-body">
          			<div class="row">
          				<div class="col-sm-12 text-center">
          					<div class="icon"><img src="{{ ($app == "production") ? secure_asset('check.svg') : asset('check.svg') }}" /></div><br>
	          		 		<?php
		          		 		$checkpointDate = new \Carbon\Carbon($checkpoint->close_date,'America/Los_Angeles');
		          		 
		          		 	?>
		          		 	<div id="checkpoint-countdown-holder"></div>
          					<h4>You have a reward checkpoint available!</h4>
		          			<p>Complete the form below to let us know how frequently you’ve been participating with your students! In exchange for your participation in the survey, you’ll have a chance to win awesome prizes including NBA apparel, tickets to games, and special event experiences. You must complete the form by end-of-day on Friday to qualify!</p>
		          			@if(Auth::user()->needstoCompleteCheckpoint())
		          			<a href="/checkpoint" class="btn">Share Data</a>
		          			@else
		          			<?php
			          			$cc = \App\CheckpointResult::where('user_id',\Auth::user()->id)->where('checkpoint_id',$checkpoint->id)->first();	
			          		?>
		          			<div class="btn">Thanks for submitting your data!<br><small>Submitted on: {{ \Carbon\Carbon::parse($cc->created_at)->format('F jS, Y') }}</small></div>
		          			@endif
          				</div>
          			</div>
          		</div>
          	</div>
          @endif
          @endif
<!--
          
          <div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="small-12 columns text-center">
							<div class="hcs-logo" style="max-width: 125px;"><img src="{{ url('images/home-court-series-logo.png') }}" /></div>
							<h2 style="margin-bottom: 0px;">Learn Fresh Home Court Series Preorder</h2>
							<h4 style="margin: 5px 0px 0px 0px;">Available for a limited time only!</h4>
					        <p style="margin: 10px 0px 20px 0px;">It’s tournament time for your Math Champs! As you finish up your NBA Math Hoops season, we invite you to take advantage of this specially-designed Home Court Series Tournament Kit as a reward for your students. Every kit includes awards, signage, shirts, and more to help you recognize their accomplishments in the program and their performance in your end-of-season championship.</p>
					        <a href="/kit" class="btn btn-primary">Learn More</a>
						</div>
					</div>
				</div>
			</div>
-->
			
          @if($championship && (\Auth::user()->account_level == "gold" || \Auth::user()->account_level == 2))
          <?php $eventDate = $championship->countdown_date; ?>
					<div class="panel panel-default championship">
						<div class="panel-body">
							<div class="row">
								<div class="small-12 columns text-center">
									<div class="trophy"><i class="fa fa-trophy"></i></div>
									<?php
										$championshipDate = new \Carbon\Carbon($championship->countdown_date, 'America/Chicago');
										$now = \Carbon\Carbon::now('America/Chicago');
										if($now < $championshipDate){
									?>
									<h3>Help your students qualify for the 2020 National Championship!</h3>
									<p>Click below for details about the 2020 championship weekend.</p>
									<div id="countdown-holder"></div>
									<?php } else { ?>
									<h3>Help your students qualify for the 2020 National Championship!</h3>
									<p>Click below for details about the 2020 championship weekend.</p>
									<?php } ?>
									<p><br><a href="/championship" class="btn btn-primary">Learn More</a></p>
								</div>
							</div>
						</div>
					</div>
					@endif
          <div class="row">
			    	<div class="col-sm-12 col-md-6">
			    		<div class="panel panel-default resource">
			    			<div class="panel-heading">
			    				<strong>Program Resources and Media</strong>
			    			</div>
			    			<div class="panel-body">
				    			
			    						<div class="list-group feature-resource">
				    				@foreach ($featuredResources as $resource)
			    					
			    								<a href="/resources/{{ $resource['id'] }}" class="list-group-item">
				    								<h5>{{ $resource['title'] }}</h5>
				    							</a>
			    						
				    				@endforeach
			    				</div>
									<a href="/resources/all" class="btn btn-primary btn-block">View All Resources</a>
			    			</div>
			    		</div>
			    	</div>
			    	<div class="col-sm-12 col-md-6">
			    		<div class="panel panel-default">
			    			<div class="panel-heading">
			    				<strong>LFCA Community Forum</strong>
			    			</div>
			    			<div class="panel-body">
			    				<div class="list-group">
			    				@if ($topics)
									@foreach ($topics as $topic)
			    					<a href="/community/{{ $topic->slug }}" class="list-group-item">
											<h5><strong>{{ $topic->title }}</strong></h5>
											<h6>Posted {{ $topic->created_at->setTimezone('America/Chicago')->diffForHumans() }} | {{ count($topic->comments) }} comments</h6>
										</a>
									@endforeach
									@else
										<div class="list-group-item">
											No open topics!
										</div>
									@endif
			    				</div>
			    				<a href="/community" class="btn btn-primary btn-block">View All Community Posts</a>
			    			</div>
			    		</div>
			    	</div>
			    </div>
        </div>
    </div>
 
</div>

<div class="share-bar" data-toggle="modal" data-target="#share">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center">
				<div class="heart"><i class="fa fa-heart"></i></div>
				<h3>Love your Learn Fresh program?</h3>
				<p>Click here to share the LFCA with other educators!</p>
			</div>
		</div>
	</div>
</div>

<div id="share" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-body">
        <p>Enter your friend's email to share the LFCA!</p>
        <form action="/share" method="post">
        	{{ csrf_field() }}
        	<div class="form-group">
        		<label for="email">Email</label>
        		<input type="email" name="email" id="email" class="form-control" required />
        	</div>
        	<div class="form-group">
        		<label for="message">Custom Message (Optional)</label>
        		<textarea name="message" id="message" class="form-control"></textarea>
        	</div>
        	<div class="form-group">
        		<input type="submit" class="btn btn-primary expanded" value="Share The LFCA" />
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
	</div>
</div>

<?php
	$noFooterMargin = true;
?>
@endsection