<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\FundedRegion;
use App\Notifications\WelcomeEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required',
            'site_state' => 'required',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
	    $shipping_name = "";
	    $shipping_email = "";
	    $shipping_address_1 = "";
	    $shipping_address_2 = "";
	    $shipping_city = "";
	    $shipping_state = "";
	    $shipping_zip_code = "";
	    
	    if($data['billing_shipping_same'] == "yes"){
		    $shipping_name = $data['first_name'] . " " . $data['last_name'];
			$shipping_email = $data['email'];
		    $shipping_address_1 = $data['site_address_1'];
		    $shipping_address_2 = $data['site_address_2'];
		    $shipping_city = $data['site_city'];
		    $shipping_state = $data['site_state'];
		    $shipping_zip_code = $data['site_zip_code'];
		} else {
			$shipping_name = $data['shipping_care_of'];
		    $shipping_email = $data['shipping_email'];
		    $shipping_address_1 = $data['shipping_address_1'];
		    $shipping_address_2 = $data['shipping_address_2'];
		    $shipping_city = $data['shipping_city'];
		    $shipping_state = $data['shipping_state'];
		    $shipping_zip_code = $data['shipping_zip_code'];
		}
	    
        $user = User::create([
            'name' => $data['first_name'] . " " . $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'estimated_students' => $data['estimated_students'],
            'password' => bcrypt($data['password']),
            'type' => $data['type'],
            'school_program_name' => $data['school_program_name'],
            'site_address_1' => $data['site_address_1'],
            'site_address_2' => $data['site_address_2'],
            'site_city' => $data['site_city'],
            'site_state' => $data['site_state'],
            'site_zip_code' => $data['site_zip_code'],
            'country' => $data['country'],
            'shipping_name' => $shipping_name,
            'shipping_email' => $shipping_email,
            'shipping_address_1' => $shipping_address_1,
            'shipping_address_2' => $shipping_address_2,
            'shipping_city' => $shipping_city,
            'shipping_state' => $shipping_state,
            'shipping_zip_code' => $shipping_zip_code,
        ]);
        
        //$user->notify(new WelcomeEmail());
        
        return $user;
    }
}
