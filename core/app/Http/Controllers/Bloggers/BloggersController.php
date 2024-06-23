<?php

namespace App\Http\Controllers\Bloggers;

use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\Property;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Transaction;
use App\Models\Withdrawal;
use App\Models\WithdrawMethod;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class BloggersController extends Controller
{
    public function dashboard()
    {
        $pageTitle = 'Dashboard';
        $widget['balance'] = Auth::guard('bloggers')->user()->balance;
        $widget['total_properties'] = Property::where('bloggers_id', Auth::guard('bloggers')->id())->count();
        $widget['total_rooms'] = Room::with('property')
        ->whereHas('property', function($property){
            $property->where('bloggers_id', Auth::guard('bloggers')->id());
        })->count();
        $widget['total_room_category'] = RoomCategory::with('property')
        ->whereHas('property', function($property){
            $property->where('bloggers_id', Auth::guard('bloggers')->id());
        })->count();
        return view('bloggers.dashboard', compact('pageTitle', 'widget'));
    }

    public function profile()
    {
        $pageTitle = 'Profile';
        $bloggers = Auth::guard('bloggers')->user();
        return view('bloggers.profile', compact('pageTitle', 'bloggers'));
    }

    public function profileUpdate(Request $request)
    {

        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'address' => 'sometimes|required|max:80',
            'state' => 'sometimes|required|max:80',
            'zip' => 'sometimes|required|integer|min:1',
            'city' => 'sometimes|required|max:50',
        ],[
            'firstname.required'=>'First name field is required',
            'lastname.required'=>'Last name field is required'
        ]);
        $bloggers = Auth::guard('bloggers')->user();

        if ($request->hasFile('image')) {
            try {
                $old = $bloggers->image ?: null;
                $bloggers->image = uploadImage($request->image, imagePath()['profile']['user']['path'], imagePath()['profile']['user']['size'], $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $bloggers->firstname= $request->firstname;
        $bloggers->lastname= $request->lastname;
      

        $in['address'] = [
            'address' => $request->address,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => @$bloggers->address->country,
            'city' => $request->city,
        ];

        $bloggers->fill($in)->save();

        $notify[] = ['success', 'Profile updated successfully.'];
        return back()->withNotify($notify);

    }

    public function changePassword()
    {
        $pageTitle = 'Change password';
        $bloggers = Auth::guard('bloggers')->user();
        return view('bloggers.password', compact('pageTitle', 'bloggers'));
    }

    public function submitPassword(Request $request)
    {
        $password_validation = Password::min(6);
        $general = GeneralSetting::first();
        if ($general->secure_password) {
            $password_validation = $password_validation->mixedCase()->numbers()->symbols()->uncompromised();
        }

        $this->validate($request, [
            'current_password' => 'required',
            'password' => ['required','confirmed',$password_validation]
        ]);
        

        try {
            $bloggers = auth()->guard('bloggers')->user();
            if (Hash::check($request->current_password, $bloggers->password)) {
                $password = Hash::make($request->password);
                $bloggers->password = $password;
                $bloggers->save();
                $notify[] = ['success', 'Password changes successfully.'];
                return back()->withNotify($notify);
            } else {
                $notify[] = ['error', 'The password doesn\'t match!'];
                return back()->withNotify($notify);
            }
        } catch (\PDOException $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
    }

    public function show2faForm()
    {
        $general = GeneralSetting::first();
        $ga = new GoogleAuthenticator();
        $bloggers = auth()->guard('bloggers')->user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($bloggers->username . '@' . $general->sitename, $secret);
        $pageTitle = 'Two Factor';
        return view('bloggers.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request)
    {
        $bloggers = auth()->guard('bloggers')->user();
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($bloggers,$request->code,$request->key);
        if ($response) {
            $bloggers->tsc = $request->key;
            $bloggers->ts = 1;
            $bloggers->save();
            $bloggersAgent = getIpInfo();
            $osBrowser = osBrowser();
            notify($bloggers, '2FA_ENABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser' => @$osBrowser['browser'],
                'ip' => @$bloggersAgent['ip'],
                'time' => @$bloggersAgent['time']
            ], 'bloggers');
            $notify[] = ['success', 'Google authenticator enabled successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }


    public function disable2fa(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $bloggers = auth()->guard('bloggers')->user();
        $response = verifyG2fa($bloggers,$request->code);
        if ($response) {
            $bloggers->tsc = null;
            $bloggers->ts = 0;
            $bloggers->save();
            $bloggersAgent = getIpInfo();
            $osBrowser = osBrowser();
            notify($bloggers, '2FA_DISABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser' => @$osBrowser['browser'],
                'ip' => @$bloggersAgent['ip'],
                'time' => @$bloggersAgent['time']
            ], 'bloggers');
            $notify[] = ['success', 'Two factor authenticator disable successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }
        return back()->withNotify($notify);
    }


     /*
     * Withdraw Operation
     */

    public function withdrawMoney()
    {
        $withdrawMethod = WithdrawMethod::where('status',1)->get();
        $pageTitle = 'Withdraw Money';
        return view('bloggers.withdraw.methods', compact('pageTitle','withdrawMethod'));
    }

    public function withdrawStore(Request $request)
    {
        $this->validate($request, [
            'method_code' => 'required',
            'amount' => 'required|numeric'
        ]);
        $method = WithdrawMethod::where('id', $request->method_code)->where('status', 1)->firstOrFail();
        $bloggers = Auth::guard('bloggers')->user();
        if ($request->amount < $method->min_limit) {
            $notify[] = ['error', 'Your requested amount is smaller than minimum amount.'];
            return back()->withNotify($notify);
        }
        if ($request->amount > $method->max_limit) {
            $notify[] = ['error', 'Your requested amount is larger than maximum amount.'];
            return back()->withNotify($notify);
        }

        if ($request->amount > $bloggers->balance) {
            $notify[] = ['error', 'You do not have sufficient balance for withdraw.'];
            return back()->withNotify($notify);
        }


        $charge = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);
        $afterCharge = $request->amount - $charge;
        $finalAmount = $afterCharge * $method->rate;

        $withdraw = new Withdrawal();
        $withdraw->method_id = $method->id; // wallet method ID
        $withdraw->bloggers_id = $bloggers->id;
        $withdraw->amount = $request->amount;
        $withdraw->currency = $method->currency;
        $withdraw->rate = $method->rate;
        $withdraw->charge = $charge;
        $withdraw->final_amount = $finalAmount;
        $withdraw->after_charge = $afterCharge;
        $withdraw->trx = getTrx();
        $withdraw->save();
        session()->put('wtrx', $withdraw->trx);
        return redirect()->route('bloggers.withdraw.preview');
    }

    public function withdrawPreview()
    {
        $withdraw = Withdrawal::with('method','bloggers')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id','desc')->firstOrFail();
        $pageTitle = 'Withdraw Preview';
        return view('bloggers.withdraw.preview', compact('pageTitle','withdraw'));
    }


    public function withdrawSubmit(Request $request)
    {
        $general = GeneralSetting::first();
        $withdraw = Withdrawal::with('method','bloggers')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id','desc')->firstOrFail();

        $rules = [];
        $inputField = [];
        if ($withdraw->method->user_data != null) {
            foreach ($withdraw->method->user_data as $key => $cus) {
                $rules[$key] = [$cus->validation];
                if ($cus->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], new FileTypeValidate(['jpg','jpeg','png']));
                    array_push($rules[$key], 'max:2048');
                }
                if ($cus->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($cus->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }

        $this->validate($request, $rules);
        
        $bloggers = Auth::guard('bloggers')->user();
        if ($bloggers->ts) {
            $response = verifyG2fa($bloggers,$request->authenticator_code);
            if (!$response) {
                $notify[] = ['error', 'Wrong verification code'];
                return back()->withNotify($notify);
            }   
        }


        if ($withdraw->amount > $bloggers->balance) {
            $notify[] = ['error', 'Your request amount is larger then your current balance.'];
            return back()->withNotify($notify);
        }

        $directory = date("Y")."/".date("m")."/".date("d");
        $path = imagePath()['verify']['withdraw']['path'].'/'.$directory;
        $collection = collect($request);
        $reqField = [];
        if ($withdraw->method->user_data != null) {
            foreach ($collection as $k => $v) {
                foreach ($withdraw->method->user_data as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {
                        if ($inVal->type == 'file') {
                            if ($request->hasFile($inKey)) {
                                try {
                                    $reqField[$inKey] = [
                                        'field_name' => $directory.'/'.uploadImage($request[$inKey], $path),
                                        'type' => $inVal->type,
                                    ];
                                } catch (\Exception $exp) {
                                    $notify[] = ['error', 'Could not upload your ' . $request[$inKey]];
                                    return back()->withNotify($notify)->withInput();
                                }
                            }
                        } else {
                            $reqField[$inKey] = $v;
                            $reqField[$inKey] = [
                                'field_name' => $v,
                                'type' => $inVal->type,
                            ];
                        }
                    }
                }
            }
            $withdraw['withdraw_information'] = $reqField;
        } else {
            $withdraw['withdraw_information'] = null;
        }


        $withdraw->status = 2;
        $withdraw->save();
        $bloggers->balance  -=  $withdraw->amount;
        $bloggers->save();

        $transaction = new Transaction();
        $transaction->bloggers_id = $withdraw->bloggers_id;
        $transaction->amount = $withdraw->amount;
        $transaction->post_balance = $bloggers->balance;
        $transaction->charge = $withdraw->charge;
        $transaction->trx_type = '-';
        $transaction->details = showAmount($withdraw->final_amount) . ' ' . $withdraw->currency . ' Withdraw Via ' . $withdraw->method->name;
        $transaction->trx =  $withdraw->trx;
        $transaction->save();

        $adminNotification = new AdminNotification();
        $adminNotification->bloggers_id = $bloggers->id;
        $adminNotification->title = 'New withdraw request from '.$bloggers->username;
        $adminNotification->click_url = urlPath('admin.withdraw.details',$withdraw->id);
        $adminNotification->save();

        notify($bloggers, 'WITHDRAW_REQUEST', [
            'method_name' => $withdraw->method->name,
            'method_currency' => $withdraw->currency,
            'method_amount' => showAmount($withdraw->final_amount),
            'amount' => showAmount($withdraw->amount),
            'charge' => showAmount($withdraw->charge),
            'currency' => $general->cur_text,
            'rate' => showAmount($withdraw->rate),
            'trx' => $withdraw->trx,
            'post_balance' => showAmount($bloggers->balance),
            'delay' => $withdraw->method->delay
        ], 'bloggers');

        $notify[] = ['success', 'Withdraw request sent successfully'];
        return redirect()->route('bloggers.withdraw.history')->withNotify($notify);
    }

    public function withdrawLog()
    {
        $pageTitle = "Withdraw Log";
        $emptyMessage = "No withdraw history found";
        $withdraws = Withdrawal::where('bloggers_id', Auth::guard('bloggers')->id())->where('status', '!=', 0)->with('method')->orderBy('id','desc')->paginate(getPaginate());
        $data['emptyMessage'] = "No Data Found!";
        return view('bloggers.withdraw.log', compact('pageTitle', 'emptyMessage', 'withdraws'));
    }
}
