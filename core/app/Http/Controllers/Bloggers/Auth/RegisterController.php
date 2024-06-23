<?php

namespace App\Http\Controllers\Bloggers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\Bloggers;
use App\Models\UserLogin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware('Bloggers.guest');
    }

    public function showRegistrationForm(){
        $pageTitle = 'Bloggers Registration Page';
        $info = json_decode(json_encode(getIpInfo()), true);
        $mobile_code = @implode(',', $info['code']);
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        return view('bloggers.auth.register', compact('pageTitle','mobile_code','countries'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $general = GeneralSetting::first();
        $password_validation = Password::min(6);
        if ($general->secure_password) {
            $password_validation = $password_validation->mixedCase()->numbers()->symbols()->uncompromised();
        }
        $agree = 'nullable';
        if ($general->agree) {
            $agree = 'required';
        }
        $countryData = (array)json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countryCodes = implode(',', array_keys($countryData));
        $mobileCodes = implode(',',array_column($countryData, 'dial_code'));
        $countries = implode(',',array_column($countryData, 'country'));
        $validate = Validator::make($data, [
            'firstname' => 'sometimes|required|string|max:50',
            'lastname' => 'sometimes|required|string|max:50',
            'email' => 'required|string|email|max:90|unique:bloggers',
            'mobile' => 'required|string|max:50|unique:bloggers',
            'password' => ['required','confirmed',$password_validation],
            'username' => 'required|alpha_num|unique:bloggers|min:6',
            'captcha' => 'sometimes|required',
            'mobile_code' => 'required|in:'.$mobileCodes,
            'country_code' => 'required|in:'.$countryCodes,
            'country' => 'required|in:'.$countries,
            'agree' => $agree
        ]);
        return $validate;
    }

    public function register(Request $request)
    {

        $this->validator($request->all())->validate();
        $exist = Bloggers::where('mobile',$request->mobile_code.$request->mobile)->first();
        if ($exist) {
            $notify[] = ['error', 'The mobile number already exists'];
            return back()->withNotify($notify)->withInput();
        }

        if (isset($request->captcha)) {
            if (!captchaVerify($request->captcha, $request->captcha_secret)) {
                $notify[] = ['error', "Invalid captcha"];
                return back()->withNotify($notify)->withInput();
            }
        }


        event(new Registered($bloggers = $this->create($request->all())));

        Auth::guard('bloggers')->login($bloggers);

        return $this->registered($request, $bloggers)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {


        $general = GeneralSetting::first();

        //Bloggers Create
        $bloggers = new Bloggers();
        $bloggers->firstname = isset($data['firstname']) ? $data['firstname'] : null;
        $bloggers->lastname = isset($data['lastname']) ? $data['lastname'] : null;
        $bloggers->email = strtolower(trim($data['email']));
        $bloggers->password = Hash::make($data['password']);
        $bloggers->username = trim($data['username']);
        $bloggers->country_code = $data['country_code'];
        $bloggers->mobile = $data['mobile_code'].$data['mobile'];
        $bloggers->address = [
            'address' => '',
            'state' => '',
            'zip' => '',
            'country' => isset($data['country']) ? $data['country'] : null,
            'city' => ''
        ];
        $bloggers->status = 1;
        $bloggers->ev = $general->ev ? 0 : 1;
        $bloggers->sv = $general->sv ? 0 : 1;
        $bloggers->ts = 0;
        $bloggers->tv = 1;
        $bloggers->save();


        $adminNotification = new AdminNotification();
        $adminNotification->bloggers_id = $bloggers->id;
        $adminNotification->title = 'New Bloggers registered';
        $adminNotification->click_url = urlPath('admin.bloggers.detail',$bloggers->id);
        $adminNotification->save();

        //Login Log Create
        $ip = $_SERVER["REMOTE_ADDR"];
        $exist = UserLogin::where('user_ip',$ip)->first();
        $userLogin = new UserLogin();

        //Check exist or not
        if ($exist) {
            $userLogin->longitude =  $exist->longitude;
            $userLogin->latitude =  $exist->latitude;
            $userLogin->city =  $exist->city;
            $userLogin->country_code = $exist->country_code;
            $userLogin->country =  $exist->country;
        }else{
            $info = json_decode(json_encode(getIpInfo()), true);
            $userLogin->longitude =  @implode(',',$info['long']);
            $userLogin->latitude =  @implode(',',$info['lat']);
            $userLogin->city =  @implode(',',$info['city']);
            $userLogin->country_code = @implode(',',$info['code']);
            $userLogin->country =  @implode(',', $info['country']);
        }

        $userbloggers = osBrowser();
        $userLogin->bloggers_id = $bloggers->id;
        $userLogin->user_ip =  $ip;

        $userLogin->browser = @$userbloggers['browser'];
        $userLogin->os = @$userbloggers['os_platform'];
        $userLogin->save();


        return $bloggers;
    }

    public function checkUser(Request $request){
        $exist['data'] = null;
        $exist['type'] = null;
        if ($request->email) {
            $exist['data'] = Bloggers::where('email',$request->email)->first();
            $exist['type'] = 'email';
        }
        if ($request->mobile) {
            $exist['data'] = Bloggers::where('mobile',$request->mobile)->first();
            $exist['type'] = 'mobile';
        }
        if ($request->username) {
            $exist['data'] = Bloggers::where('username',$request->username)->first();
            $exist['type'] = 'username';
        }
        return response($exist);
    }

    public function registered()
    {
        return redirect()->route('bloggers.dashboard');
    }
}
