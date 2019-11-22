<?php
	$app = App::environment(); 
?>
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1170">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ ($app == "production") ? secure_asset('css/navbar.css') : asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ ($app == "production") ? secure_asset('css/app.css') : asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ ($app == "production") ? secure_asset('js/jquery.bxslider.css') : asset('js/jquery.bxslider.css') }}" rel="stylesheet">
    <link href="{{ ($app == "production") ? secure_asset('js/lity/lity.min.css') : asset('js/lity/lity.min.css') }}" rel="stylesheet">
    <link href="{{ ($app == "production") ? secure_asset('js/shadowbox/shadowbox.css') : asset('js/shadowbox/shadowbox.css') }}" rel="stylesheet">
         
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

    @if (Auth::guest())
    
    @else
    {!! Auth::user()->regionalStylesheet() !!}
    @endif

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/kineticjs/5.2.0/kinetic.min.js"></script>
	
		
		<script src="{{ ($app == "production") ? secure_asset('js/countdown.js') : asset('js/countdown.js') }}"></script>
		<script src="{{ ($app == "production") ? secure_asset('js/jquery.bxslider.min.js') : asset('js/jquery.bxslider.min.js') }}"></script>
		<script src="{{ ($app == "production") ? secure_asset('js/shadowbox/shadowbox.js') : asset('js/shadowbox/shadowbox.js') }}"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    
    <script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-58525296-37', 'auto');
		  ga('send', 'pageview');
		
		</script>
		
</head>
<body>


        @yield('content')
        
        <?php
	        if(isset($noFooterMargin)){
        ?>
        <footer class="no-margin-top">
        <?php } else { ?>
        <footer>
        <?php } ?>
        	<div class="container">
	        	<div class="row">
	        		<div class="col-sm-12 col-md-4 logo-container">
	        			<div class="logo">
	        				<img src="{{ ($app == "production") ? secure_asset("images/logo.svg") : asset("images/logo.svg") }}" />
	        			</div>
	        			
	        		</div><!--
	         --><div class="col-sm-12 col-md-8 text-right social-media">
	         			<p>
	         				&copy;{{ date("Y") }} Learn Fresh Coaches Association, All Rights Reserved.
	         			</p>
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-sm-12 text-center">
	        			
	        		</div>
	        	</div>
        	</div>
        </footer>
    </div>
    
    

    <!-- Scripts -->
    <script src="{{ ($app == "production") ? secure_asset('js/app.js') : asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/df-number-format/2.1.6/jquery.number.min.js"></script>
    <script src="{{ ($app == "production") ? secure_asset('js/script-v3.js') : asset('js/script-v3.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.js"></script>
    <script src="{{ ($app == "production") ? secure_asset('js/lity/lity.min.js') : asset('js/lity/lity.min.js') }}"></script>
    <script src="{{ ($app == "production") ? secure_asset('js/navbar.js') : asset('js/navbar.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    
    <?php if(isset($eventDate)){ ?>
    <?php $eventTime = date("m/d/y H:i:s",strtotime($eventDate)); ?>
    <script type="text/javascript">		
			var countDownDate = new Date('<?php echo $eventTime; ?>').getTime();
			var x = setInterval(function(){
				var now = new Date().getTime();
				var distance = countDownDate - now;
				var days = Math.floor(distance / (1000 * 60 * 60 * 24));
				var hours = Math.floor(distance % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
				var minutes = Math.floor(distance % (1000 * 60 * 60) / (1000 * 60));
				var seconds = Math.floor(distance % (1000 * 60) / 1000);
				$("#countdown-holder").html("<div class='days'>" + days + "<span>days</span></div><div class='hours'>" + hours + "<span>hours</span></div><div class='minutes'>" + minutes + "<span>minutes</span></div><div class='seconds'>" + seconds + "<span>seconds</span></div>");
			}, 1000);
		</script>
		<?php } ?>
</body>
</html>
