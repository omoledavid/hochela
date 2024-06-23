<?php

namespace App\Http\Controllers\Bloggers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{
    public function checkValidCode($bloggers, $code, $add_min = 10000)
    {
        if (!$code) return false;
        if (!$bloggers->ver_code_send_at) return false;
        if ($bloggers->ver_code_send_at->addMinutes($add_min) < Carbon::now()) return false;
        if ($bloggers->ver_code !== $code) return false;
        return true;
    }


    public function authorizeForm()
    {
        if (auth()->guard('bloggers')->check()) {
            $bloggers = auth()->guard('bloggers')->user();
            if (!$bloggers->status) {
                Auth::guard('bloggers')->logout();
            }elseif (!$bloggers->ev) {
                if (!$this->checkValidCode($bloggers, $bloggers->ver_code)) {
                    $bloggers->ver_code = verificationCode(6);
                    $bloggers->ver_code_send_at = Carbon::now();
                    $bloggers->save();
                    sendEmail($bloggers, 'EVER_CODE', [
                        'code' => $bloggers->ver_code
                    ]);
                }
                $pageTitle = 'Email verification form';
                return view('bloggers.auth.authorization.email', compact('bloggers', 'pageTitle'));
            }elseif (!$bloggers->sv) {
                if (!$this->checkValidCode($bloggers, $bloggers->ver_code)) {
                    $bloggers->ver_code = verificationCode(6);
                    $bloggers->ver_code_send_at = Carbon::now();
                    $bloggers->save();
                    sendSms($bloggers, 'SVER_CODE', [
                        'code' => $bloggers->ver_code
                    ]);
                }
                $pageTitle = 'SMS verification form';
                return view('bloggers.auth.authorization.sms', compact('bloggers', 'pageTitle'));
            }elseif (!$bloggers->tv) {
                $pageTitle = 'Google Authenticator';
                return view('bloggers.auth.authorization.2fa', compact('bloggers', 'pageTitle'));
            }else{
                return redirect()->route('bloggers.dashboard');
            }

        }

        return redirect()->route('bloggers.login');
    }

    public function sendVerifyCode(Request $request)
    {
        $bloggers = Auth::guard('bloggers')->user();


        if ($this->checkValidCode($bloggers, $bloggers->ver_code, 2)) {
            $target_time = $bloggers->ver_code_send_at->addMinutes(2)->timestamp;
            $delay = $target_time - time();
            throw ValidationException::withMessages(['resend' => 'Please Try after ' . $delay . ' Seconds']);
        }
        if (!$this->checkValidCode($bloggers, $bloggers->ver_code)) {
            $bloggers->ver_code = verificationCode(6);
            $bloggers->ver_code_send_at = Carbon::now();
            $bloggers->save();
        } else {
            $bloggers->ver_code = $bloggers->ver_code;
            $bloggers->ver_code_send_at = Carbon::now();
            $bloggers->save();
        }



        if ($request->type === 'email') {
            sendEmail($bloggers, 'EVER_CODE',[
                'code' => $bloggers->ver_code
            ]);

            $notify[] = ['success', 'Email verification code sent successfully'];
            return back()->withNotify($notify);
        } elseif ($request->type === 'phone') {
            sendSms($bloggers, 'SVER_CODE', [
                'code' => $bloggers->ver_code
            ]);
            $notify[] = ['success', 'SMS verification code sent successfully'];
            return back()->withNotify($notify);
        } else {
            throw ValidationException::withMessages(['resend' => 'Sending Failed']);
        }
    }

    public function emailVerification(Request $request)
    {
        $request->validate([
            'email_verified_code'=>'required'
        ]);


        $email_verified_code = str_replace(' ','',$request->email_verified_code);
        $bloggers = Auth::guard('bloggers')->user();

        if ($this->checkValidCode($bloggers, $email_verified_code)) {
            $bloggers->ev = 1;
            $bloggers->ver_code = null;
            $bloggers->ver_code_send_at = null;
            $bloggers->save();
            return redirect()->route('bloggers.dashboard');
        }
        throw ValidationException::withMessages(['email_verified_code' => 'Verification code didn\'t match!']);
    }

    public function smsVerification(Request $request)
    {
        $request->validate([
            'sms_verified_code' => 'required',
        ]);


        $sms_verified_code =  str_replace(' ','',$request->sms_verified_code);

        $bloggers = Auth::guard('bloggers')->user();
        if ($this->checkValidCode($bloggers, $sms_verified_code)) {
            $bloggers->sv = 1;
            $bloggers->ver_code = null;
            $bloggers->ver_code_send_at = null;
            $bloggers->save();
            return redirect()->route('bloggers.dashboard');
        }
        throw ValidationException::withMessages(['sms_verified_code' => 'Verification code didn\'t match!']);
    }
    public function g2faVerification(Request $request)
    {
        $bloggers = auth()->guard('bloggers')->user();
        $request->validate([
            'code' => 'required',
        ]);
        $code = str_replace(' ','',$request->code);
        $response = verifyG2fa($bloggers,$code);
        if ($response) {
            $notify[] = ['success','Verification successful'];
        }else{
            $notify[] = ['error','Wrong verification code'];
        }
        return back()->withNotify($notify);
    }
}
