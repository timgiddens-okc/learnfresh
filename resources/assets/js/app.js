
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.moment = require('moment');
require('./jquery.bxslider.min.js');
require('./jquery-ui.min.js');
require('./combodate.js');
require('./jquery.countdown.js');
require('../../../node_modules/flipclock/compiled/flipclock.min.js');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

$(window).on("load", function(){
	$(".bxslider").bxSlider({
		infiniteLoop: false,
		pager: false,
		touchEnabled: false,
		adaptiveHeight: true
	});
});

$(document).ready(function () {
	
	if($(".description").length > 0){
		$(".description").each(function(){
			$("p:not(:first)", this).wrapAll("<div class='hide-text' />");
		});
		$(".hide-text").after("<div class='toggle-week-text'>Show More</div>");
	}
	
	$(document).on("click", ".toggle-week-text", function(){
		var textContainer = $(this).parent().find(".hide-text");
		if($(this).text() == "Show More"){
			textContainer.slideDown(200);
			$(this).text("Show Less");
		} else {
			textContainer.slideUp(200);
			$(this).text("Show More");
		}
	});
	
	if($("#assessment").length > 0){
		$("#assessment").on("keyup keypress", function(e) {
			var keyCode = e.keyCode || e.which;
			if (keyCode === 13) {
				e.preventDefault();
				return false;
			}
		});
	}
	
	Shadowbox.init();
	
	$("#sortable").sortable();
	$("#sortable").disableSelection();
	
	$(".student-change").on("change", function(){
		var thisValue = $(this).val();
		var thisStudent = $("#student-" + thisValue).text();
		if(thisStudent == "3 or Under" || thisStudent == "4" || thisStudent == "5"){
			$("#five-and-under").show();
			$("#six-and-over").hide();
		} else {
			$("#five-and-under").hide();
			$("#six-and-over").show();
		}
	});
	
	$(".grade-change").on("change", function(){
		var thisValue = $(this).val();
		if(thisValue == "3 or Under" || thisValue == "4" || thisValue == "5"){
			$("#five-and-under").show();
			$("#six-and-over").hide();
		} else {
			$("#five-and-under").hide();
			$("#six-and-over").show();
		}
	});

	$(".weeks:first").addClass("active");

	$(".feature-resource:first").addClass("active");

	$("#change-program").on("change", function () {
		var thisValue = $(this).val();
		if (!$(thisValue).hasClass("active")) {
			$(".weeks.active").slideUp(200, function () {
				$(this).removeClass("active");
			});
			$(thisValue).slideDown(200, function () {
				$(this).addClass("active");
			});
		}
		if (!$(thisValue + "-resource").hasClass("active")) {
			$(".feature-resource.active").slideUp(200, function () {
				$(this).removeClass("active");
			});
			$(thisValue + "-resource").slideDown(200, function () {
				$(this).addClass("active");
			});
		}
	});

	$(".champion-select label").on("click", function () {
		$(".champion-select .active").removeClass("active");
		$(this).addClass("active");
	});

	$(".embed-responsive").each(function () {
		$("iframe", this).addClass("embed-responsive-item");
	});

	$("textarea").not("#notes,.not-rich").each(function () {
		if (!$(this).hasClass('embed')) {
			CKEDITOR.replace($(this).attr('name'));
		}
	});

	$(".list-group-item a").each(function () {
		var linkUrl = $(this).attr("href");
		if (linkUrl.indexOf("youtube") >= 0) {
			$(this).attr('data-lity', '');
		}
	});

	$(".delete").on("click", function (e) {
		e.preventDefault();
		var targetUrl = $(this).attr("href");
		$.confirm({
			title: 'Are you sure?',
			content: 'Are you sure you want to delete this? Click to confirm!',
			buttons: {
				confirm: function confirm() {
					document.location.href = targetUrl;
				},
				cancel: function cancel() {}
			}
		});
	});
	
	$(".delete-image").on("click", function (e) {
		e.preventDefault();
		var targetForm = $(this).parent();
		$.confirm({
			title: 'Are you sure?',
			content: 'Are you sure you want to delete this image? Click to confirm!',
			buttons: {
				confirm: function confirm() {
					targetForm.submit();
				},
				cancel: function cancel() {}
			}
		});
	});
	
	$(".take-pretest").on("click", function (e) {
		e.preventDefault();
		var targetUrl = $(this).attr("href");
		$.confirm({
			title: 'Take Pretest',
			content: 'Here is the link to your site\'s custom pretest! Please have all participating students go to this link and complete the assessment. Once all students have finished the pretest, press the "Complete Pretest" button to receive your games in the mail!<br><br><strong>' + targetUrl + '</strong>'
		});
	});
	
	$(".take-posttest").on("click", function (e) {
		e.preventDefault();
		var targetUrl = $(this).attr("href");
		$.confirm({
			title: 'Take Post-test',
			content: 'Here is the link to your site\'s custom post-test! Please have all participating students go to this link and complete the assessment. Once all students have finished the post-test, press the "Complete Post-test" button to finish your season!<br><br><strong>' + targetUrl + '</strong>'
		});
	});

	$(".complete-pretest").on("click", function (e) {
		e.preventDefault();
		var userAddress = $(".address-container").html();
		var targetUrl = $(this).attr("href");
		$.confirm({
			title: 'Important Reminder:',
			content: 'Are you sure that all students have taken the pre-test? If not, you must have all students participate to receive the correct number of games!<br><br><strong>We will ship your games to:</strong><br>' + userAddress,
			buttons: {
				confirm: function confirm() {
					document.location.href = targetUrl;
				},
				edit: {
					text: 'Edit Address',
					action: function () {
						window.location.replace("/settings");
					}
				},
				cancel: function cancel() {}
			}
		});
	});

	$("#eventDate").combodate();

	if ($(".assessment-viewport").length > 0) {
		var viewportWidth = $(".assessment-viewport").width();
		var panelCount = $(".assessment-panel").length;
		$(".assessment-container").css({ "width": viewportWidth * panelCount });
		$(".assessment-panel").css({ "width": viewportWidth });
	}

	$(".assessment-panel .continue").on("click", function (e) {
		if($(".student-name").length > 0 && $(".student-name").val() == ""){
			$.confirm({
				title: 'Uh oh!',
				content: 'Make sure you fill out your name before you continue!'
			});
		} else {
			var thisIndex = $(this).parent().parent().parent().index();
			thisIndex++;
			var viewportWidth = $(".assessment-viewport").width();
			$(".assessment-container").css({ "left": -(viewportWidth * thisIndex) });
		}
	});

	$("#agility input").on("focus", function () {
		setTimeout(function () {
			var thisIndex = 3;
			var viewportWidth = $(".assessment-viewport").width();
			$(".assessment-container").css({ "left": -(viewportWidth * thisIndex) });
		}, 1000 * 90);
	});
	
}); 

$(window).resize(function () {
	if ($(".assessment-viewport").length > 0) {
		var viewportWidth = $(".assessment-viewport").width();
		var panelCount = $(".assessment-panel").length;
		$(".assessment-container").css({ "width": viewportWidth * panelCount });
		$(".assessment-panel").css({ "width": viewportWidth });
	}
});