<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

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
    protected $redirectTo = "/";

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile_number' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
    }





    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     // Get the full mobile number from the hidden input
    //     $fullMobileNumber = str_replace('+', '', $data['full_mobile_number']);
        
    //     // Split the full mobile number into dialing code and actual phone number
    //     $dialingCode = substr($fullMobileNumber, 0, 4); // Adjust the length based on your requirements
    //     $mobileNumber = substr($fullMobileNumber, 4);
    //     $verificationToken = sha1(time() . $data['email']);
    
    //     // Create the user
    //     $user = User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'mobile_number' => $fullMobileNumber, // Store the full mobile number including the dialing code
    //         'password' => Hash::make($data['password']),
    //         'balance' => 0, // Default balance
    //         'avatar' => 'default_avatar.png', // Default avatar
    //         'email_verification_token' => $verificationToken,
    //     ]);
    
    //     // Send email verification notification
    //     $user->sendEmailVerificationNotification();
    
    //     return $user;
    // }
    
    
    protected function create(array $data)
    {
        // Get the full mobile number from the hidden input
        $fullMobileNumber = str_replace('+', '', $data['full_mobile_number']);
        
        // Split the full mobile number into dialing code and actual phone number
        $dialingCode = substr($fullMobileNumber, 0, 4); // Adjust the length based on your requirements
        $mobileNumber = substr($fullMobileNumber, 4);
        $verificationToken = sha1(time() . $data['email']);
    
        // Log or dump the data for debugging
        Log::info('Data to be saved to the database:', [
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile_number' => $fullMobileNumber,
            'password' => Hash::make($data['password']),
            'balance' => 0,
            'avatar' => 'default_avatar.png',
            'email_verification_token' => $verificationToken,
        ]);
    
        // Create the user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile_number' => $fullMobileNumber,
            'password' => Hash::make($data['password']),
            'balance' => 0,
            'avatar' => 'default_avatar.png',
            'email_verification_token' => $verificationToken,
        ]);
    
        // Send email verification notification
        $user->sendEmailVerificationNotification();
    
        return $user;
    }
    


    protected function registered(Request $request, $user)
    {
        return redirect()->route('home')->withSuccess(__('Account registered successfully! Please check your email for verification.'));
    }

    public function registerWithMobile(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Auth::login($user);

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }
}
