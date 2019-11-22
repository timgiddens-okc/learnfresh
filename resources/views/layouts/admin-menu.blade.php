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
		    	<a href="#" class="toggle-submenu" data-toggle="users">Users <span class="caret"></span></a>
		    	<a href="#" class="toggle-submenu" data-toggle="events">Events <span class="caret"></span></a>
		    	<a href="#" class="toggle-submenu" data-toggle="orders">Orders <span class="caret"></span></a>
		    	<a href="#" class="toggle-submenu" data-toggle="contact">Contact <span class="caret"></span></a>
		    	<a href="#" class="toggle-submenu" data-toggle="media">Media <span class="caret"></span></a>
		    	<a href="#" class="toggle-submenu" data-toggle="testing">Testing <span class="caret"></span></a>
		    	<a href="#" class="toggle-submenu" data-toggle="checkpoints">Checkpoints <span class="caret"></span></a>
		    	<a href="#" class="toggle-submenu" data-toggle="forum">Community Forum <span class="caret"></span></a>
		    	<a href="#" class="toggle-submenu" data-toggle="reports">Reports <span class="caret"></span></a>
		    	<a href="#" class="toggle-submenu" data-toggle="resources">Resources <span class="caret"></span></a>
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
	<div id="users" class="submenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/admin/users">All Users</a>
			    	<a href="#">All Star Educators</a>
			    	<a href="#">General Managers</a>
			    	<a href="/admin/administrators">Administrators</a>
			    	<a href="/admin/purchase-orders">Purchase Orders</a>
			    	<a href="/admin/training-codes">Training Codes</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="events" class="submenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/events/calendar">Calendar</a>
			    	<a href="#" class="toggle-micro-menu" data-toggle="tournaments">Tournaments</a>
			    	<a href="#" class="toggle-micro-menu" data-toggle="training-camp">Training Camp</a>
			    	<a href="#" class="toggle-micro-menu" data-toggle="national-championship">National Championship</a>
			    	<a href="#" class="toggle-micro-menu" data-toggle="seasons">Seasons</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="orders" class="submenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/admin/orders/create-new">Create New</a>
			    	<a href="/admin/orders/incentives">Incentives</a>
			    	<a href="/admin/orders/pending">Pending</a>
			    	<a href="/admin/orders/past">Past</a>
			    	<a href="#" class="toggle-micro-menu" data-toggle="warehouse">Warehouse</a>
			    	
			    	<a href="/admin/orders/kit">Kit Orders</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="contact" class="submenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/contact/send-email">Send Email</a>
			    	<a href="/contact/templates">Templates</a>
			    	<a href="/contact/templates/add-new">Add New</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="media" class="submenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="#">Photos</a>
			    	<a href="#">Videos</a>
			    	<a href="#">Articles</a>
			    	<a href="#">Logos</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="testing" class="submenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/admin/pretests">Pre-test</a>
			    	<a href="/admin/posttests">Post-test</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="checkpoints" class="submenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/admin/checkpoints/create">Create Checkpoint</a>
			    	<a href="/admin/checkpoints/current-season">Current Season</a>
			    	<a href="/admin/checkpoints/past-seasons">Past Seasons</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="forum" class="submenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
		    		<a href="/community">Community</a>
			    	<a href="#">FAQs</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="reports" class="submenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="#">Run Report</a>
			    	<a href="#" class="toggle-micro-menu" data-toggle="templates">Templates</a>
			    	<a href="#">Impact Report</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="resources" class="submenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="#" class="toggle-micro-menu" data-toggle="nba-math-hoops">NBA Math Hoops</a>
			    	<a href="#" class="toggle-micro-menu" data-toggle="athletics-math-hits">Athletics Math Hits</a>
			    	<a href="#" class="toggle-micro-menu" data-toggle="broncos-first-and-ten">Broncos First & Ten</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="tournaments" class="micromenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="#">Check-In</a>
			    	<a href="#">Certificates</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="training-camp" class="micromenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="#">Check-In</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="national-championship" class="micromenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/national-championship/application">Application</a>
			    	<a href="/national-championship/applicants">Applicants</a>
			    	<a href="/national-championship/votes">Votes</a>
			    	<a href="/national-championship/participants">Participants</a>
			    	<a href="/national-championship/schedule">Schedule</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="seasons" class="micromenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="#">Current Season</a>
			    	<a href="#">Past Seasons</a>
			    	<a href="#">Create New Season</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="warehouse" class="micromenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/admin/warehouse/catalog">Catalog</a>
			    	<a href="/admin/warehouse/inventory-on-hand">Inventory on Hand</a>
			    	<a href="/admin/warehouse/update-inventory">Update Inventory</a>
			    	<a href="/admin/warehouse/past-inventory">Past Inventory</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="templates" class="micromenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="#">Modify Existing Report</a>
			    	<a href="#">Create New</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="nba-math-hoops" class="micromenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/resources/nba-math-hoops/documents">Curriculum/Documents</a>
			    	<a href="/resources/nba-math-hoops/tips">Tips of the Week</a>
			    	<a href="/resources/nba-math-hoops/videos">Tutorial Videos</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="athletics-math-hits" class="micromenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/resources/athletics-math-hits/documents">Curriculum/Documents</a>
			    	<a href="/resources/athletics-math-hits/tips">Tips of the Week</a>
			    	<a href="/resources/athletics-math-hits/videos">Tutorial Videos</a>
		    	</div>
	    	</div>
    	</div>
	</div>
	<div id="broncos-first-and-ten" class="micromenu">
    	<div class="container">
	    	<div class="row">
		    	<div class="col-sm-12">
			    	<a href="/resources/first-and-ten/documents">Curriculum/Documents</a>
			    	<a href="/resources/first-and-ten/tips">Tips of the Week</a>
			    	<a href="/resources/first-and-ten/videos">Tutorial Videos</a>
		    	</div>
	    	</div>
    	</div>
	</div>
</div>