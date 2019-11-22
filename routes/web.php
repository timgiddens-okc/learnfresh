<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'admin'], function() {
	
	Route::get("/admin/convert-users", "AdminController@convertUsers");
	
	Route::post("/event-type-selection", "TemplatesController@eventType");
	
	Route::get("/contact/templates", "TemplatesController@index");
	
	Route::get("/contact/template/{template}", "TemplatesController@show");
	Route::get("/contact/template/{template}/edit", "TemplatesController@edit");
	Route::post("/contact/template/{template}/edit", "TemplatesController@update");
	Route::get("/contact/template/{template}/delete", "TemplatesController@delete");
	
	Route::get("/contact/send-email", "TemplatesController@sendEmail");
	Route::post("/contact/send-email", "TemplatesController@finalizeEmail");
	
	Route::get("/contact/templates/create-new", "TemplatesController@createNew");
	Route::post("/contact/templates/create-new", "TemplatesController@submitTemplate");
	
	Route::get("/print-schedule/{schedule}", "ScheduleController@printSchedule");
	
	Route::get("/schedule/{schedule}/edit-itinerary/{scheduleItem}", "ScheduleController@editItem");
	Route::post("/schedule/{schedule}/edit-itinerary/{scheduleItem}", "ScheduleController@updateItem");
	
	Route::get("/schedule/{schedule}/delete-itinerary/{scheduleItem}", "ScheduleController@deleteItem");
	
	Route::get("/national-championship/schedule", "ScheduleController@index");
	
	Route::get("/schedule/create", "ScheduleController@create");
	Route::post("/schedule/create", "ScheduleController@addSchedule");
	
	Route::get("/schedule/{schedule}/days", "ScheduleController@addDays");
	Route::post("/schedule/{schedule}/days", "ScheduleController@createDays");
	
	Route::get("/schedule/{schedule}/day/{scheduleDay}", "ScheduleController@itinerary");
	Route::post("/schedule/{schedule}/day/{scheduleDay}", "ScheduleController@saveItinerary");
	
	Route::get("/schedule/{schedule}", "ScheduleController@schedule");
	
	Route::get("/resources/{area}/documents", "ResourcesController@documents");
	Route::get("/resources/{area}/tips", "ResourcesController@tips");
	Route::get("/resources/{area}/videos", "ResourcesController@videos");
	
	
	Route::post("/invite-admin", "AdminController@inviteAdmin");
	
	Route::get("/admin/training-codes","AdminController@trainingCodes");
	Route::get("/admin/training-codes/{trainingCode}","AdminController@trainingCodesDelete");
	Route::post("/admin/training-codes/new","AdminController@trainingCodesNew");
	
	Route::post("/admin/add-kit-order", "PageController@addKitOrder");
	
	Route::get("/admin/purchase-orders", "AdminController@purchaseOrders");
	
	Route::get("/admin/purchase-orders/{purchaseOrder}","AdminController@updatePurchaseOrder");
	
	Route::get("/admin/pretests", "AssessmentController@pretestLanding");
	Route::get("/admin/posttests", "AssessmentController@posttestLanding");
	
	Route::get("/admin/posttests/no-usage", "AssessmentController@posttestNoUsage");
	Route::get("/admin/posttests/full-usage", "AssessmentController@posttestFullUsage");
	
	//Route::get('/admin/advance-weeks','AdminController@advanceWeeks');
	
	Route::get('/get-checkpoint-data/{checkpoint}', 'SpreadsheetController@checkpointData');
	Route::get('/get-checkpoint-data/{checkpoint}/shipping', 'SpreadsheetController@checkpointShippingList');

	Route::get('/applications','AdminController@applications');
	
	Route::get('/pre-test-count','StatController@preTestsCount');
	Route::get('/post-test-count','StatController@postTestsCount');
	Route::get('/total-users','StatController@totalUsers');
	Route::get('/total-paid-users','StatController@totalPaidUsers');
	Route::get('/total-new-users','StatController@totalNewUsers');
	Route::get('/total-returning-users','StatController@totalReturningUsers');
	Route::get('/gross-revenue','StatController@grossRevenue');
	Route::get('/event-stats','StatController@eventStats');
	Route::get('/estimated-students','StatController@estimatedStudents');
	Route::get('/registered-submitted-pretest','StatController@registeredSubmittedPretest');
	Route::get('/games-shipped','StatController@gamesShipped');
	Route::get('/pending-shipments','StatController@pendingShipments');
	Route::get('/last-comment','StatController@lastComment');
	
	Route::get('/admin/assessments/{user}','AdminController@userAssessments');
	
	Route::get('/search-orders', 'OrderController@searchOrders');	
	Route::get('/all-orders', 'OrderController@allOrders');
	Route::get('/past-orders', 'OrderController@pastOrders');
	
	Route::get('/search-users', 'AdminController@searchUsers');	
	Route::get('/all-users', 'AdminController@allUserList');
	
	Route::get('/sort-pretests', 'AssessmentController@sortPretests');
	Route::get('/sort-posttests', 'AssessmentController@sortPosttests');
	
	Route::get('/admin/orders/past', 'OrderController@past');
	
	Route::get('/event/{event}/send-email', 'EventController@sendEmail');
	
	Route::get('/event/{event}/send-training-email', 'EventController@sendTrainingEmail');
	
	Route::get('/admin/user/{user}/sub-admin', 'AdminController@makeSubAdmin');
	
	Route::get('/admin/user/{user}/edit', 'AdminController@editUser');
	
	Route::patch('/admin/user/{user}/edit', 'AdminController@updateUser');
	
	Route::post('/user/{user}/bypass-payment', 'AdminController@updatePayment');
	
	Route::get('/admin/championship', 'AdminController@championship');
	
	Route::post('/admin/championship', 'AdminController@updateChampionship');
	
	Route::get('/admin/{user}/open-pretest', 'AdminController@reopenPretest');
	
	Route::get('/admin/{user}/complete-pretest', 'AdminController@completePretest');
	
	Route::get('/admin/{user}/open-post-test', 'AdminController@reopenPosttest');
	
	Route::get('/admin/{user}/complete-post-test', 'AdminController@completePosttest');
	
	Route::get('/week/new', 'WeekController@index');

	Route::get('/week/{week}', 'WeekController@show');
	
	Route::get('/week/{week}/edit', 'WeekController@edit');
	
	Route::get('/week/{week}/delete', 'WeekController@delete');
	
	Route::patch('/week/{week}/edit', 'WeekController@update');

	Route::post('/program/{program}/week', 'WeekController@store');
	
	Route::get('/week/{week}/item/{actionItem}', 'WeekController@showEditItem');
	
	Route::patch('/week/{week}/item/{actionItem}', 'WeekController@editItem');
	
	Route::get('/week/{week}/item/{actionItem}/delete', 'WeekController@itemDestroy');
	
	Route::post('/week/{week}/items', 'ItemController@store');
	
	Route::get('/admin/events', 'EventController@index');
	
	Route::post('/admin/events/new', 'EventController@store');
	
	Route::get('/event/{event}/edit', 'EventController@edit');
	
	Route::get('/event/{event}/delete', 'EventController@delete');
	
	Route::get('/event/{event}/open-registration', 'EventController@openRegistration');
	
	Route::get('/event/{event}/close-registration', 'EventController@closeRegistration');
	
	Route::patch('/event/{event}/edit', 'EventController@update');
	
	Route::get('/admin/resources', 'ResourcesController@index');
	
	Route::get('/admin/resources/sort', 'ResourcesController@sort');
	
	Route::post('/admin/resources/sort', 'ResourcesController@saveOrder');
	
	Route::post('/admin/resources/new', 'ResourcesController@store');
	
	Route::get('/admin/resources/{resource}', 'ResourcesController@show');
	
	Route::get('/admin/resources/{resource}/edit', 'ResourcesController@edit');
	
	Route::get('/admin/resources/{resource}/delete', 'ResourcesController@delete');
	
	Route::patch('/admin/resources/{resource}/edit', 'ResourcesController@update');

	Route::get('/admin/get-users', 'SpreadsheetController@users');
	
	Route::post('/admin/get-sorted-users', 'SpreadsheetController@sortedUsers');
	
	Route::get('/admin/download-orders', 'SpreadsheetController@downloadOrders');
	
	Route::get('/admin/users', 'AdminController@allUsers');
	
	Route::get('/admin/administrators', 'AdminController@admins');
	
	Route::get('/admin/users/email', 'AdminController@emailAllUsers');
	
	Route::post('/admin/users/email', 'AdminController@sendEmailAllUsers');
	
	Route::get('/admin/email-specific-users', 'AdminController@emailSpecificUsers');
	
	Route::post('/admin/email-specific-users', 'AdminController@sendEmailSpecificUsers');
	
	Route::get('/admin/users/sorted', 'AdminController@sortUsers');
	
	Route::post('/admin/users/sorted', 'AdminController@emailSortedUsers');
	
	Route::get('/admin/user/{user}/delete','AdminController@deleteUser');
	
	
	
	Route::get('/event/{event}/email', 'RsvpController@email');
	
	Route::post('/event/{event}/email', 'RsvpController@sendEmail');
	
	Route::post('/event/{event}/add-images','EventController@addImages');
	
	Route::post('/event-photo/{eventPhoto}/delete','EventController@deleteImage');
	
	Route::get('/admin/orders/pending', 'OrderController@pending');
	
	Route::get('/admin/orders/kit', 'OrderController@kit');
	
	Route::post('/admin/orders/add-order', 'OrderController@addOrder');
	
	Route::get('/admin/orders/{shippingList}/edit', 'OrderController@editOrder');
	
	Route::post('/admin/orders/{shippingList}/edit', 'OrderController@updateOrder');
	
	Route::get('/admin/orders/{shippingList}/delete', 'SpreadsheetController@deleteOrder');
	
	Route::get('/admin/orders/sorted', 'OrderController@sortShipping');
	
	Route::get('/admin/shipping-list', 'SpreadsheetController@shippingList');
	
	Route::get('/admin/preassessment-results', 'AssessmentController@preResults');
	
	Route::get('/admin/preassessment-results/archive', 'AssessmentController@preResultsArchive');
	
	Route::get('/admin/postassessment-results', 'AssessmentController@postResults');
	
	Route::get('/admin/postassessment-results/archive', 'AssessmentController@postResultsArchive');
	
	Route::get('/admin/preassessment-results/sorted', 'AssessmentController@sortPreassessments');
	
	Route::get('/admin/postassessment-results/sorted', 'AssessmentController@sortPostassessments');
	
	Route::get('/admin/{user}/email', 'AdminController@email');
	
	Route::post('/admin/{user}/email', 'AdminController@sendEmail');
	
	Route::get('/program/new', 'ProgramController@new');
	
	Route::post('/program/new', 'ProgramController@create');
	
	Route::get('/program/{program}/edit', 'ProgramController@edit');
	
	Route::get('/program/{program}/delete', 'ProgramController@delete');
	
	Route::patch('/program/{program}/edit', 'ProgramController@update');
	
	Route::get('/program/{program}', 'ProgramController@show');
	
	Route::get('/admin/checkpoints', 'CheckpointController@index');
	
	Route::get('/admin/checkpoints/current-season', 'CheckpointController@currentSeason');
	
	Route::get('/admin/checkpoints/create', 'CheckpointController@create');
	Route::get('/admin/checkpoint/{checkpoint}', 'CheckpointController@preview');
	Route::get('/admin/checkpoint/{checkpoint}/data', 'CheckpointController@data');
	Route::get('/admin/checkpoint/{checkpoint}/edit', 'CheckpointController@edit');
	Route::post('/admin/checkpoint/{checkpoint}/edit', 'CheckpointController@update');
	Route::get('/admin/checkpoint/{checkpoint}/publish', 'CheckpointController@publish');
	Route::get('/admin/checkpoint/{checkpoint}/unpublish', 'CheckpointController@unpublish');
	
	Route::post('/admin/checkpoints/new', 'CheckpointController@new');
	
	Route::get('/admin/checkpoints/archive', 'CheckpointController@archive');

	Route::post('/admin/user/{user}/add-to-sub-admin', 'AdminController@addToSubAdmin');
	
	Route::get('/admin/orders/create-new', 'OrderController@createNew');
	
	Route::get('/admin/orders/incentives', 'OrderController@incentives');
	
	Route::get('/admin/warehouse/catalog', 'OrderController@catalog');
	Route::get('/admin/warehouse/inventory-on-hand', 'OrderController@inventoryOnHand');
	Route::get('/admin/warehouse/update-inventory', 'OrderController@updateInventory');
	Route::get('/admin/warehouse/past-inventory', 'OrderController@pastInventory');
	
	Route::get('/national-championship/applicants', 'NationalChampionshipController@applicants');
	
	Route::get('/national-championship/application/{application}', 'NationalChampionshipController@application');
	Route::post('/national-championship/application/{application}', 'NationalChampionshipController@nominate');
	
	Route::get('/national-championship/application/{application}/edit', 'NationalChampionshipController@editApplication');
	
	Route::post('/national-championship/application/{application}/edit', 'NationalChampionshipController@updateApplication');
	
	Route::get('/national-championship/votes', 'NationalChampionshipController@votes');
	
	Route::get('/national-championship/participants', 'NationalChampionshipController@participants');
	
	Route::post('/national-championship/application/{application}/status', 'NationalChampionshipController@status');

	Route::get('/events/calendar/filter', 'EventController@calendarFilter');

});

Route::get('/storage/exports/{file}','FileController@download');

Route::get('/week', function() {
	return redirect('/home');
});


Route::get('/', function () {
	    return view('welcome');
	});
	
Route::group(['middleware' => 'registration'], function(){
	Route::group(['middleware' => 'payment'], function(){
		Route::group(['middleware' => 'subadmin'], function(){
			
			Route::get('/general-manager', 'UserController@generalManager');
			
			Route::get('/general-manager/checkpoints', 'CheckpointController@subAdminIndex');
			
			Route::get('/general-manager/preassessment-results', 'AssessmentController@preResultsSubAdmin');
	
			Route::get('/general-manager/postassessment-results', 'AssessmentController@postResultsSubAdmin');
			
		});
	});
});

// Routes Require Payment Validation

Route::group(['middleware' => 'registration'], function(){
	Route::group(['middleware' => 'payment'], function(){
		Route::group(['middleware' => 'password_expired'], function(){
			
		Route::get('/my-class', 'UserController@myClass');
		Route::post('/my-class','UserController@addStudent');
		
		Route::get('/pretest', 'UserController@pretest');
		Route::get('/posttest', 'UserController@posttest');
		
		Route::get('/national-championship/my-applicants', 'UserController@myApplicants');
		
		Route::get('/events/calendar', 'EventController@calendar');
		Route::get('/events/region', 'EventController@regionEvents');
		
		Route::get('/checkpoints', 'UserController@checkpoints');
		
		Route::get('/kit', 'PageController@kit');
		Route::post('/kit', 'PageController@purchaseKit');
		
		Route::get('/events/{event}/download-guest-list', 'SpreadsheetController@attendees');
		Route::get('/event/{event}/rsvp-list', 'RsvpController@attendees');	
		Route::post('/event/{event}/rsvp-list', 'RsvpController@addAttendees');
		Route::get('/attendee/{rsvp}/edit','AdminController@editAttendee');	
		Route::post('/attendee/{rsvp}/edit','AdminController@updateAttendee');	
		Route::get('/attendee/{rsvp}/delete','AdminController@deleteAttendee');
		
		Route::get('/application', function(){
			return redirect("/national-championship/application");
		});
		

		Route::get('/national-championship/application', 'PageController@application');
		
		Route::post('/national-championship/application', 'PageController@submitApplication');
		
		Route::get('/championship', 'PageController@championship');
	
		Route::get('/settings', 'UserController@settings');
		
		Route::patch('/settings', 'UserController@update');
		
		Route::get('/event/{event}', 'EventController@show');
	
		Route::get('/home', 'HomeController@index');
		
		Route::post('/share', 'HomeController@share');
		
		// Resources
		Route::get('/resources/all', 'ResourcesController@all');
		Route::get('/resources/{resource}', 'ResourcesController@show');
		Route::get('/resource-files/{resource}', 'ResourcesController@download');
		
		// Forum
		Route::get('/community', 'ForumController@index');
		
		Route::get('/community/search', 'ForumController@search');
		
		Route::get('/community/category/{category}','ForumController@category');
		
		Route::post('/community/topic/new', 'ForumController@addTopic');
		
		Route::get('/community/new-post', 'ForumController@newPost');
		Route::post('/community/new-post', 'ForumController@postNewPost');
		
		Route::get('/community/{slug}', 'ForumController@getTopic');
		
		Route::post('/community/{slug}/comment', 'ForumController@addComment');
		
		Route::get('/community/{slug}/edit', 'ForumController@edit');
		
		Route::patch('/community/{slug}/edit', 'ForumController@update');
		
		Route::get('/community/{slug}/delete', 'ForumController@delete');
		
		Route::get('/community/{slug}/comment/{comment}/edit', 'ForumController@editComment');
		
		Route::patch('/community/{slug}/comment/{comment}/edit', 'ForumController@updateComment');
		
		Route::get('/community/{slug}/comment/{comment}/delete', 'ForumController@deleteComment');
		
		Route::post('/settings/change-password', 'UserController@changePassword');
		
		Route::get('/event/{event}/rsvp', 'RsvpController@rsvp');
		
		Route::post('/event/{event}/rsvp', 'RsvpController@rsvpWithKids');
		
		Route::get('/events', 'EventController@all');
		
		Route::get('/checkpoint', 'CheckpointController@show');
		
		Route::post('/checkpoint/submit', 'CheckpointController@store');
		
		Route::get('/student/{student}/edit', 'UserController@editStudent');
		Route::get('/student/{student}/delete', 'UserController@deleteStudent');
		Route::post('/student/{student}/edit', 'UserController@updateStudent');
		
		// Assessments
		Route::get('/assessment/{access}/complete', 'AssessmentController@finish');
		
		Route::get('/comment-file/{commentFile}/delete','ForumController@deleteCommentFile');
		
		Route::get('/new-season','UserController@newSeason');
		
		Route::get('/attendee/{rsvp}/edit-rsvp','EventController@editAttendeeRsvp');
	
		Route::post('/attendee/{rsvp}/edit-rsvp','EventController@updateAttendeeRsvp');
		
		Route::get('/attendee/{rsvp}/cancel-rsvp','EventController@cancelRsvp');
		
		Route::get('/purchase-games','UserController@requestGames');
		
		Route::post('/purchase-games','UserController@placeGamesOrder');
		
		Route::get('/update-order','UserController@updateOrder');
		
		});
	
	});
});
	Route::get("/assessment/submit", 'AssessmentController@submit');
	Route::post("/assessment/submit", 'AssessmentController@finish');
	Route::post('/assessment/{user}', 'AssessmentController@store');
	Route::get('/assessment/{user}', 'AssessmentController@show');
	Route::get('/preassessment/complete', 'AssessmentController@complete');
	Route::get('/postassessment/complete', 'AssessmentController@complete');

	Route::post('/register-site', 'UserController@registerSite');
	
	Route::get('/register-site', 'UserController@finishRegister');
	
	Route::get('/demo', 'UserController@demo');
	
	Route::get('/register/tier', 'UserController@tierSelect');
		
	Route::post('/register/tier', 'UserController@tierContinue');
	
	Route::get('/register/payment', 'UserController@payment');
	
	Route::post('/register/payment', 'UserController@paymentStep');
	
	Route::get('/register/purchase-order', 'UserController@purchaseOrder');
		
	Route::get('/register/terms','UserController@terms');
	
	Route::post('/register/terms','UserController@termsAccept');
	
	Route::get('/register/confirmation','UserController@confirmation');
	
	Route::post('/register/confirmation','UserController@confirmationProcess');

// Payments
Route::get('/payment', 'PaymentController@show');
Route::post('/payment', 'PaymentController@makePayment');

Route::get('/event/{event}/pre-register', 'EventController@preRegister');
	Route::post('/event/{event}/pre-register', 'EventController@preRegisterSubmit');

Route::get('/admin/preassessment-results/bypassed', 'AssessmentController@preResults');

Route::prefix('impersonation')->group(function ($router) {
    $router->get('revert', 'ImpersonateController@revert')->name('impersonate.revert');
    $router->get('{user}', 'ImpersonateController@impersonate')->name('impersonate.impersonate');
});

Route::get('password/expired', 'ExpiredPasswordController@expired')
        ->name('password.expired');
Route::post('password/post_expired', 'ExpiredPasswordController@postExpired')
        ->name('password.post_expired');