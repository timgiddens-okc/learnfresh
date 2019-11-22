<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'school_program_name', 'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_state', 'shipping_zip_code', 'favorite_team', 'referral', 'first_year','pre_assessment_complete','post_assessment_complete','programs','years_using_program','in_person_training','country','payment_reminders','discount_code','type','site_address_1','site_address_2','site_city','site_state','site_zip_code','estimated_students','billing_address_1','billing_address_2','billing_city','billing_state','billing_zip_code','account_level','stripe_id','funded','registered','shipping_name', 'admin', 'password_changed_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
        
    public function purchaseOrders()
    {
	    return $this->hasMany(PurchaseOrder::class);
    }
        
    public function checkpoints()
    {
	    return $this->hasMany(Checkpoint::class);
    }
    
    public function topics()
    {
    		return $this->hasMany(Topic::class);
    }
    
    public function students()
    {
    		return $this->hasMany(Student::class);
    }
    
    public function comments()
    {
    		return $this->hasMany(Comment::class);
    }
    
    public function addStudent(Student $student)
    {
    			$this->students()->save($student);
    }
    
    public function isFunded()
    {
	    if($this->funded == 1){
		    return true;
	    }
	    return false;
    }
    
    public function isAdmin()
    {
    			if ($this->admin == 1){
	    			return true;
    			}
    			return false;
    }
    
    public function isSubAdmin()
    {
	    if($this->sub_admin == 1){
		    return true;
	    }
	    return false;
    }
    
    public function isDemo()
    {
    			if ($this->type == 0){
	    			return true;
    			}
    			return false;
    }
    
    public function belongsToSubAdmin()
    {
	    if(SubAdmin::where('user','=',$this->id)->count() > 0){
		    return true;
	    }
	    return false;
    }
    
    public function regionalStylesheet()
    {
	    $cssFile = "";
	    $app = \App::environment();
	    $zipcode = $this->shipping_zip_code;
/*
	    switch($this->shipping_state) {
				case ("AZ"): // Phoenix Suns
					$cssFile = ($app == "production") ? secure_asset('css/teams/phoenix.css') : asset('css/teams/phoenix.css');
					break;
				case ("CA"):
					if(in_array($zipcode,range(93890,94199)) || in_array($zipcode,range(94301,95200))) {
						// Golden State Warriors
						$cssFile = ($app == "production") ? secure_asset('css/teams/golden-state.css') : asset('css/teams/golden-state.css');
					} elseif (in_array($zipcode,range(94200,94300)) || in_array($zipcode,range(95201,96162))) {
						// Sacramento Kings
						$cssFile = ($app == "production") ? secure_asset('css/teams/sacramento.css') : asset('css/teams/sacramento.css');
					} elseif (in_array($zipcode,range(90000,93889))) {
						// LA Clippers
						$cssFile = ($app == "production") ? secure_asset('css/teams/la-clippers.css') : asset('css/teams/la-clippers.css');
					}
					break;
				case ("CO"): // Denver Nuggets
					if(strpos($this->programs, '2') !== false) {
						$cssFile = ($app == "production") ? secure_asset('css/teams/broncos.css') : asset('css/teams/broncos.css');
					} else {
						$cssFile = ($app == "production") ? secure_asset('css/teams/denver.css') : asset('css/teams/denver.css');
					}
					break;
				case ("CT"): // Boston
					$cssFile = ($app == "production") ? secure_asset('css/teams/boston.css') : asset('css/teams/boston.css');
					break;
				case ("RI"): // Boston
					$cssFile = ($app == "production") ? secure_asset('css/teams/boston.css') : asset('css/teams/boston.css');
					break;
				case ("DE"): // Philadelphia 76ers
					$cssFile = ($app == "production") ? secure_asset('css/teams/philadelphia.css') : asset('css/teams/philadelphia.css');
					break;
				case ("FL"): // Orlando Magic
					$cssFile = ($app == "production") ? secure_asset('css/teams/orlando.css') : asset('css/teams/orlando.css');
					break;
				case ("GA"): // Atlanta Hawks
					$cssFile = ($app == "production") ? secure_asset('css/teams/atlanta.css') : asset('css/teams/atlanta.css');
					break;
				case ("ID"): // Utah Jazz
					$cssFile = ($app == "production") ? secure_asset('css/teams/utah.css') : asset('css/teams/utah.css');
					break;
				case ("IA"): // Milwaukee Bucks
					$cssFile = ($app == "production") ? secure_asset('css/teams/milwaukee.css') : asset('css/teams/milwaukee.css');
					break;
				case ("KS"): // Denver Nuggets
					if(strpos($this->programs, '2') !== false) {
						$cssFile = ($app == "production") ? secure_asset('css/teams/broncos.css') : asset('css/teams/broncos.css');
					} else {
						$cssFile = ($app == "production") ? secure_asset('css/teams/denver.css') : asset('css/teams/denver.css');
					}
					break;
				case ("MD"): // Philadelphia 76ers
					$cssFile = ($app == "production") ? secure_asset('css/teams/philadelphia.css') : asset('css/teams/philadelphia.css');
					break;
				case ("MI"): // Detroit Pistons
					$cssFile = ($app == "production") ? secure_asset('css/teams/detroit.css') : asset('css/teams/detroit.css');
					break;
				case ("MN"): // Milwaukee Bucks
					$cssFile = ($app == "production") ? secure_asset('css/teams/milwaukee.css') : asset('css/teams/milwaukee.css');
					break;
				case ("MT"): // Denver Nuggets
					if(strpos($this->programs, '2') !== false) {
						$cssFile = ($app == "production") ? secure_asset('css/teams/broncos.css') : asset('css/teams/broncos.css');
					} else {
						$cssFile = ($app == "production") ? secure_asset('css/teams/denver.css') : asset('css/teams/denver.css');
					}
					break;
				case ("NE"): // Denver Nuggets
					if(strpos($this->programs, '2') !== false) {
						$cssFile = ($app == "production") ? secure_asset('css/teams/broncos.css') : asset('css/teams/broncos.css');
					} else {
						$cssFile = ($app == "production") ? secure_asset('css/teams/denver.css') : asset('css/teams/denver.css');
					}
					break;
				case ("NV"): // Utah Jazz
					$cssFile = ($app == "production") ? secure_asset('css/teams/utah.css') : asset('css/teams/utah.css');
					break;
				case ("NJ"): // Philadelphia 76ers
					$cssFile = ($app == "production") ? secure_asset('css/teams/philadelphia.css') : asset('css/teams/philadelphia.css');
					break;
				case ("NM"): // Phoenix Suns
					$cssFile = ($app == "production") ? secure_asset('css/teams/phoenix.css') : asset('css/teams/phoenix.css');
					break;
				case ("NY"): // New York Knicks
					$cssFile = ($app == "production") ? secure_asset('css/teams/new-york.css') : asset('css/teams/new-york.css');
					break;
				case ("NC"): // Charlotte Hornets
					$cssFile = ($app == "production") ? secure_asset('css/teams/charlotte.css') : asset('css/teams/charlotte.css');
					break;
				case ("ND"): // Denver Nuggets
					if(strpos($this->programs, '2') !== false) {
						$cssFile = ($app == "production") ? secure_asset('css/teams/broncos.css') : asset('css/teams/broncos.css');
					} else {
						$cssFile = ($app == "production") ? secure_asset('css/teams/denver.css') : asset('css/teams/denver.css');
					}
					break;
				case ("OH"): // Cleveland Cavaliers
					$cssFile = ($app == "production") ? secure_asset('css/teams/cleveland.css') : asset('css/teams/cleveland.css');
					break;
				case ("OR"): // Portland Trailblazers
					$cssFile = ($app == "production") ? secure_asset('css/teams/portland.css') : asset('css/teams/portland.css');
					break;
				case ("PA"): // Philadelphia 76ers
					$cssFile = ($app == "production") ? secure_asset('css/teams/philadelphia.css') : asset('css/teams/philadelphia.css');
					break;
				case ("SC"): // Charlotte Hornets
					$cssFile = ($app == "production") ? secure_asset('css/teams/charlotte.css') : asset('css/teams/charlotte.css');
					break;
				case ("SD"): // Denver Nuggets
					if(strpos($this->programs, '2') !== false) {
						$cssFile = ($app == "production") ? secure_asset('css/teams/broncos.css') : asset('css/teams/broncos.css');
					} else {
						$cssFile = ($app == "production") ? secure_asset('css/teams/denver.css') : asset('css/teams/denver.css');
					}
					break;
				case ("UT"): // Utah Jazz
					$cssFile = ($app == "production") ? secure_asset('css/teams/utah.css') : asset('css/teams/utah.css');
					break;
				case ("VT"): // Boston
					$cssFile = ($app == "production") ? secure_asset('css/teams/boston.css') : asset('css/teams/boston.css');
					break;
				case ("MA"): // Boston
					$cssFile = ($app == "production") ? secure_asset('css/teams/boston.css') : asset('css/teams/boston.css');
					break;
				case ("NH"): // Boston
					$cssFile = ($app == "production") ? secure_asset('css/teams/boston.css') : asset('css/teams/boston.css');
					break;
				case ("ME"): // Boston
					$cssFile = ($app == "production") ? secure_asset('css/teams/boston.css') : asset('css/teams/boston.css');
					break;
				case ("WA"): // Portland Trailblazers
					$cssFile = ($app == "production") ? secure_asset('css/teams/portland.css') : asset('css/teams/portland.css');
					break;
				case ("WV"): // Cleveland Cavaliers
					$cssFile = ($app == "production") ? secure_asset('css/teams/cleveland.css') : asset('css/teams/cleveland.css');
					break;
				case ("WI"): // Milwaukee Bucks
					$cssFile = ($app == "production") ? secure_asset('css/teams/milwaukee.css') : asset('css/teams/milwaukee.css');
					break;
				case ("WY"): // Denver Nuggets
					if(strpos($this->programs, '2') !== false) {
						$cssFile = ($app == "production") ? secure_asset('css/teams/broncos.css') : asset('css/teams/broncos.css');
					} else {
						$cssFile = ($app == "production") ? secure_asset('css/teams/denver.css') : asset('css/teams/denver.css');
					}
					break;
			}
			
*/

			$team = \App\FundedRegion::where('zip_code',$zipcode)->first();
			
			if($team){
				$cssFile = ($app == "production") ? secure_asset('css/teams/' . $team->team . '.css') : asset('css/teams/' . $team->team . '.css');
				return "<link href='".$cssFile."' rel='stylesheet'>";
			}

			if(strpos(\Auth::user()->programs, '3') !== false){
				return "<link href='css/teams/as.css' rel='stylesheet'>";
			}
	
    }
    
    public function getSubAdmin()
    {
	    $subAdmin = SubAdmin::where('user','=',$this->id)->first();
	    $sa = User::find($subAdmin->admin);
	    return $sa['name'];
    }
    
    public function needsToCompleteCheckpoint()
    {
	  	$checkpoint = Checkpoint::where("open_date","<",\Carbon\Carbon::now('America/Los_Angeles'))->where("close_date",">",\Carbon\Carbon::now('America/Los_Angeles'))->first();
	  	if($checkpoint){
		  	$createDate = \Carbon\Carbon::parse($checkpoint->open_date, 'America/Los_Angeles');
		  	$checkCompleted = CheckpointResult::where([['user_id','=',$this->id],['checkpoint_id','=',$checkpoint->id]])->first();
		  	if(!$checkCompleted) {
			  	return true;
		  	}
	  	}
	  	return false;
    }
}
