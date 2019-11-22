function orderSearch($query) {
	var $query = $("#search-orders").val();
	if($query == ""){
		if($("#previous-orders").length > 0){
			$.ajax({
				method: "GET",
				url: "/past-orders",
				success: function(data){
					$("#orders-data").html(data);
				}
			});
		} else {
			$.ajax({
				method: "GET",
				url: "/all-orders",
				success: function(data){
					$("#orders-data").html(data);
				}
			});
		}
	} else {
		$.ajax({
			method: "GET",
			url: "/search-orders",
			data: {
				query: $query
			}, 
			success: function(data){
				$("#orders-data").html(data);
			}
		});	
	}
}

function userSearch($query) {
	var $query = $("#search-users").val();
	if($query == ""){
		$.ajax({
			method: "GET",
			url: "/all-users",
			success: function(data){
				$("#users").html(data);
			}
		});
	} else {
		$.ajax({
			method: "GET",
			url: "/search-users",
			data: {
				query: $query
			}, 
			success: function(data){
				$("#users").html(data);
			}
		});	
	}
}

function updateOrder($query) {
	var $query = $("#students").val();
	$.ajax({
		method: "GET",
		url: "/update-order",
		data: {
			query: $query
		}, 
		success: function(data){
			$("#order-details").html(data);
		}
	});	
}



$(window).on("load", function () {
	var currentWeek = parseInt($("#currentWeek").text());
	
	if(currentWeek){
	  currentWeek = currentWeek;
	  if(currentWeek != 1){
		  currentWeek = currentWeek + 1;
	  }
	} else {
		currentWeek = 0;
	}
	
	otherWeek = currentWeek - 1;
	
	$(".bxslider").bxSlider({
		infiniteLoop: false,
		pager: false,
		touchEnabled: false,
		adaptiveHeight: true,
		startSlide: otherWeek
	});
	
	$(".nbamathhoopsslider").bxSlider({
		infiniteLoop: false,
		pager: false,
		touchEnabled: false,
		adaptiveHeight: true,
		startSlide: currentWeek
	});
	
	$(".weeks").not(".active").css({"display" : "none"});
});

$(document).ready(function(){
	
	$("#add-shirts").on("click", function(e){
		e.preventDefault();
		var smallShirts = parseInt($("input[name='small']").val());
		var mediumShirts = parseInt($("input[name='medium']").val());
		var largeShirts = parseInt($("input[name='large']").val());
		var xlShirts = parseInt($("input[name='x-large']").val());
		var totalShirts = smallShirts + mediumShirts + largeShirts + xlShirts;
		
		if(smallShirts == 0){
			$(".qty","#small-shirts").text("0");
			$(".price","#small-shirts").text("0.00");
			$("#small-shirts").hide();
		} else {
			$(".qty","#small-shirts").text(smallShirts);
			$(".price","#small-shirts").text($.number(14.99*smallShirts,2));
			$("#small-shirts").show();
		}
		
		if(mediumShirts == 0){
			$(".qty","#medium-shirts").text("0");
			$(".price","#medium-shirts").text("0.00");
			$("#medium-shirts").hide();
		} else {
			$(".qty","#medium-shirts").text(mediumShirts);
			$(".price","#medium-shirts").text($.number(14.99*mediumShirts,2));
			$("#medium-shirts").show();
		}
		
		if(largeShirts == 0){
			$(".qty","#large-shirts").text("0");
			$(".price","#large-shirts").text("0.00");
			$("#large-shirts").hide();
		} else {
			$(".qty","#large-shirts").text(largeShirts);
			$(".price","#large-shirts").text($.number(14.99*largeShirts,2));
			$("#large-shirts").show();
		}
		
		if(xlShirts == 0){
			$(".qty","#xl-shirts").text("0");
			$(".price","#xl-shirts").text("0.00");
			$("#xl-shirts").hide();
		} else {
			$(".qty","#xl-shirts").text(xlShirts);
			$(".price","#xl-shirts").text($.number(14.99*xlShirts,2));
			$("#xl-shirts").show();
		}
		
		var $total = $.number((totalShirts * 14.99) + 199.99,2);
		$("#grand-total").html($total);
		
	});

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	
	$(".event-type-selection").on("change", function(){
		var $type = $(this).val();
		$.ajax({
			method: "POST",
			url: "/event-type-selection",
			data: {
				type: $type
			},
			success: function(data){
				$("#event-section").html(data);
			}
		});
	});

	$(".status-change").on("change", function(){
		var $url = $(this).parent().attr("action");
		var $status = $(this).val();
		var $this = $(this);
		$.ajax({
			method: "POST",
			url: $url,
			data: {
				status: $status
			},
			success: function(data){
				$this.after("<i class='fa fa-check-circle'></i>");
				setTimeout(function(){
					$(".fa-check-circle").remove();
				}, 1000*3);
			}
		});
	});
	
	$(".count-text").on("keyup", function(){
		var textLength = $(this).val().length;
		$(".max-length .current").text(textLength);
		if(textLength < 1500){
			$(".max-length").removeClass("danger");
			$(".max-length").removeClass("full");
		} 
		
		if(textLength > 1500 && textLength < 2000){
			$(".max-length").addClass("danger");
			$(".max-length").removeClass("full");
		}
		
		if(textLength == 2000) {
			$(".max-length").removeClass("danger");
			$(".max-length").addClass("full");
		}
	});

	$(".header").on("mouseleave", function(){
		$(".submenu").removeClass("active");
		$(".micromenu").removeClass("active");
	});
	
	$(".toggle-submenu").on("click", function(e){
		e.preventDefault();
		var target = "#" + $(this).data('toggle');
		$(".submenu").not(target).removeClass("active");
		$(".micromenu").removeClass("active");
		$(target).addClass("active");
	});
	
	$(".toggle-micro-menu").on("click", function(e){
		e.preventDefault();
		var target = "#" + $(this).data('toggle');
		$(".micromenu").not(target).removeClass("active");
		$(target).addClass("active");
	});
	
	$(".dont-tab").on('keydown', function (e) {
    if (e.which == 9) {
        e.preventDefault();
    }
	});
	
	var interval;
	
	$(".start-agility").on("click", function(e){
		e.preventDefault();
		$(".hidden-formulas").removeClass("hidden-formulas");
		$(".agility-overlay").fadeOut(200, function(){
			$("#agility input:first").focus();
			var counter = 90;
			interval = setInterval(function(){
				counter--;
				$(".agility-timer span").text(counter);
				if(counter == 0){
					clearInterval(interval);
				}
			}, 1000);
			setTimeout(function () {
				var thisIndex = 3;
				var viewportWidth = $(".assessment-viewport").width();
				$(".assessment-container").css({ "left": -(viewportWidth * thisIndex) });
			}, 1000 * 90);
		});
	});
	
	$(".finish-agility").on("click", function(){
		clearInterval(interval);
	});
	
	$("#query-select").on("change", function(){
		var thisVal = $(this).val();
		var textVal = $("#query-container input[type='text']").val();
		if(!textVal){
			textVal = "";
		}
		switch(thisVal){
			case "account_level":
				$("#query-container").html("<select name='query' class='form-control'><option value='1'>Math Hoops</option><option value='2'>Math Hoops +</option></select>");
				break;
			case "pre_assessment_complete":
				$("#query-container").html("<select name='query' class='form-control'><option value='0'>Not Complete</option><option value='1'>Complete</option></select>");
				break;
			case "post_assessment_complete":
				$("#query-container").html("<select name='query' class='form-control'><option value='0'>Not Complete</option><option value='1'>Complete</option></select>");
				break;
			case "checkpoint":
				$("#query-container").html("<select name='query' class='form-control'><option value='not-submitted'>Not Submitted</option><option value='submitted'>Submitted</option></select>");
				break;
			case "rsvp":
				$("#query-container").html("<select name='query' class='form-control'><option value='no-rsvp'>No RSVP</option><option value='rsvp'>RSVP</option></select>");
				break;
			case "team":
				$("#query-container").html('<select name="query" class="form-control"><option value="oakland-as">Oakland A\'s</option><option value="atl">Atlanta Hawks</option><option value="bkn">Brooklyn Nets</option><option value="bos">Boston Celtics</option><option value="cha">Charlotte Hornets</option><option value="chi">Chicago Bulls</option><option value="cle">Cleveland Cavaliers</option><option value="dal">Dallas Mavericks</option><option value="den">Denver Nuggets</option><option value="det">Detroit Pistons</option><option value="gsw">Golden State Warriors</option><option value="hou">Houston Rockets</option><option value="ind">Indiana Pacers</option><option value="lac">Los Angeles Clippers</option><option value="lal">Los Angeles Lakers</option><option value="mem">Memphis Grizzlies</option><option value="mia">Miami Heat</option><option value="mil">Milwakee Bucks</option><option value="min">Minessota Timberwolves</option><option value="nop">New Orleans Pelicans</option><option value="nyk">New York Knicks</option><option value="okc">Oklahoma City Thunder</option><option value="orl">Orlando Magic</option><option value="phi">Philadelphia 76ers</option><option value="phx">Phoenix Suns</option><option value="por">Portland Trailblazers</option><option value="sac">Sacramento Kings</option><option value="sas">San Antonio Spurs</option><option value="tor">Toronto Raptors</option><option value="uta">Utah Jazz</option><option value="was">Washington Wizards</option><option value="null"></option><option value="wnba_atl">Atlanta Dream</option><option value="wnba_chi">Chicago Sky</option><option value="wnba_con">Connecticut Sun</option><option value="wnba_dal">Dallas Wings</option><option value="wnba_ind">Indiana Fever</option><option value="wnba_lva">Las Vegas Aces</option><option value="wnba_las">Los Angeles Sparks</option><option value="wnba_min">Minnesota Lynx</option><option value="wnba_nyl">New York Liberty</option><option value="wnba_pho">Phoenix Mercury</option><option value="wnba_sea">Seattle Storm</option><option value="wnba_was">Washington Mystics</option></select>');
				break;
			case "program":
				$("#query-container").html("<select name='query' class='form-control'><option value='1'>NBA Math Hoops</option><option value='2'>Broncos First & 10</option><option value='3'>Athletics Math Hits</option></select>");
				break;
			case "inactive":
				$("#query-container").html("<select name='query' class='form-control'><option value='all'>Hasn't Logged In This Season</option><option value='no-tier'>No Tier Selected</option></select>");
				break;
			default:
				$("#query-container").html('<input type="text" name="query" class="form-control" placeholder="Enter your search term and select where you want to search." value="' + textVal + '" />');
				break;
		}
	});
	
	$(".loader").on("click", function(){
		$(this).html("<i class='fa fa-spinner fa-spin'></i>");
	});
	
	$("form").on("submit", function(){
		$("button", this).attr("disabled", true);
	});
	
	var typingTimer;
	var userTimer;
	var doneTypingInterval = 500;
	
	$("#students").on("keyup", function(){
		$("#users").html("<div class='loader-icon'><i class='fa fa-spinner fa-spin'></i></div>");
		clearTimeout(typingTimer);
		typingTimer = setTimeout(updateOrder, doneTypingInterval);
	});
	
	$("#students").on("change", function(){
		updateOrder();
	});
	
	$("#search-orders").on("keyup", function(){
		$("#orders-data").html("<div class='loader-icon'><i class='fa fa-spinner fa-spin'></i></div>");
		clearTimeout(typingTimer);
		typingTimer = setTimeout(orderSearch, doneTypingInterval);
	});
	
	$("#search-users").on("keyup", function(){
		$("#users").html("<div class='loader-icon'><i class='fa fa-spinner fa-spin'></i></div>");
		clearTimeout(userTimer);
		userTimer = setTimeout(userSearch, doneTypingInterval);
	});

});