@extends("layouts.app")

@section("content")

	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h1>Register for the LFCA today!</h1>
				<div class="embed-responsive embed-responsive-16by9">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/O6pe6kdG07g?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
		
		<div class="actions">
			<div class="row">
				<div class="col-sm-12 text-center">
					<a href="/login" class="btn btn-lg btn-success">Login</a>
					<a href="/register" class="btn btn-lg btn-primary">Register</a>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12 text-center">
				<h3 class="intro-text">Welcome to the home of the most student and teacher-friendly programs in education!</h3>
				<p>As a member of the Learn Fresh Coaches Association, you'll have access to experiences like NBA Math Hoops, a board game, curriculum, and community program that allows students to hone essential math skills through the game of basketball. You'll also be joined by an all-star staff and highly-engaged educator network that will support your implementation.</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12 text-center">
				<h3 class="intro-text">The entire experience starts at $100 per year, paid at registration.</h3>
			</div>
		</div>
		
		<div class="row intro-block">
			<div class="col-xs-12 col-sm-5 vcenter">
				<img src="{{ (App::environment() == "production") ? secure_asset("images/trophies.jpg") : asset("images/trophies.jpg") }}" />
			</div><!--
	 --><div class="col-xs-12 col-sm-7 vcenter">
	 			<h3 class="intro-text">As a member of the LFCA, you will receive:</h3>
	 			<ul>
	 				<li>Unlimited board games for the students in your classroom or program.</li>
	 				<li>All other program materials required to run your program, including the newly-refined 12 lesson curriculum and in-depth tutorial videos.</li>
	 				<li>Access to weekly tips that will help to guide your implementation of the program, and provide extra content to use with your students.</li>
	 				<li>Opportunities to earn rewards for yourself and your students, based upon how frequently you use the program. These incentives can include apparel, tickets to games, and access to special events.</li>
	 				<li>Access to regional trainings, championship tournaments, and the NBA Math Hoops National Championship.</li>
	 			</ul>
	 		</div>
		</div>
		
		<div class="row intro-block">
			<div class="col-xs-12 col-sm-7 vcenter">
				<h2>From Our Community</h2>
	 			<p>"NBA Math Hoops has increased student participation in our 4th-8th grade groups. Students are always asking when they can play. Students have more confidence in themselves and their math skills. Focusing on the basic math functions while incorporating it into a sport like basketball brings it alive! While one might think statistics aren't interesting, using them with their favorite players brings a new interest and understanding to how the statistics impact the game. The Learn Fresh team is extremely dedicated and helpful. Everything they do is driven by intentionality and excellence. They truly are student centered!”</p>
					<h4>Rachel Nelson, Educator from Denver, CO</h4>
	 		</div><!--
	 --><div class="col-xs-12 col-sm-5 vcenter">
	 			<img src="{{ (App::environment() == "production") ? secure_asset("images/rachel-nelson.jpg") : asset("images/rachel-nelson.jpg") }}" />
			</div>
		</div>
		
		<div class="row intro-block">
			<div class="col-xs-12 col-sm-5 vcenter">
				<img src="{{ (App::environment() == "production") ? secure_asset("images/lisa-brody.jpg") : asset("images/lisa-brody.jpg") }}" />
			</div><!--
	 --><div class="col-xs-12 col-sm-7 vcenter">
	 			<p>"NBA Math Hoops has been an incredible experience for my whole class. As an educator, I always welcome new and innovative ways to teach math. The kids' math skills skyrocketed throughout the program. The regional tournament was so much fun and well organized at the Kings arena. As if that wasn’t enough, the NBA Math Hoops National Championship was an amazing experience. Learn Fresh planned an extraordinary weekend for the kids, educators and parents. I am so excited to start the program again next school year.”</p>
				<h4>Lisa Brody, Educator from Sacramento, CA</h4>
	 		</div>
		</div>
		
		
		
	</div>
	
@endsection