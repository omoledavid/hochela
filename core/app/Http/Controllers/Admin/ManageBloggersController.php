<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailLog;
use App\Models\GeneralSetting;
use App\Models\Bloggers;
use App\Models\Property;
use App\Models\Transaction;
use App\Models\Withdrawal;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageBloggersController extends Controller
{
    public function allBloggers()
    {
        $pageTitle = 'Manage Bloggers';
        $emptyMessage = 'No bloggers found';
        $bloggers = Bloggers::orderBy('id','desc')->paginate(getPaginate());
        return view('admin.bloggers.list', compact('pageTitle', 'emptyMessage', 'bloggers'));
    }

    public function activeBloggers()
    {
        $pageTitle = 'Manage Active Bloggers';
        $emptyMessage = 'No active bloggers found';
        $bloggers = Bloggers::active()->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.bloggers.list', compact('pageTitle', 'emptyMessage', 'bloggers'));
    }

    public function bannedBloggers()
    {
        $pageTitle = 'Banned Bloggers';
        $emptyMessage = 'No banned bloggers found';
        $bloggers = Bloggers::banned()->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.bloggers.list', compact('pageTitle', 'emptyMessage', 'bloggers'));
    }

    public function emailUnverifiedBloggers()
    {
        $pageTitle = 'Email Unverified Bloggers';
        $emptyMessage = 'No email unverified bloggers found';
        $bloggers = Bloggers::emailUnverified()->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.bloggers.list', compact('pageTitle', 'emptyMessage', 'bloggers'));
    }
    public function emailVerifiedBloggers()
    {
        $pageTitle = 'Email Verified Bloggers';
        $emptyMessage = 'No email verified bloggers found';
        $bloggers = Bloggers::emailVerified()->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.bloggers.list', compact('pageTitle', 'emptyMessage', 'bloggers'));
    }


    public function smsUnverifiedBloggers()
    {
        $pageTitle = 'SMS Unverified Bloggers';
        $emptyMessage = 'No sms unverified bloggers found';
        $bloggers = Bloggers::smsUnverified()->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.bloggers.list', compact('pageTitle', 'emptyMessage', 'bloggers'));
    }


    public function smsVerifiedBloggers()
    {
        $pageTitle = 'SMS Verified Bloggers';
        $emptyMessage = 'No sms verified bloggers found';
        $bloggers = Bloggers::smsVerified()->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.bloggers.list', compact('pageTitle', 'emptyMessage', 'bloggers'));
    }

    
    public function bloggersWithBalance()
    {
        $pageTitle = 'Bloggers with balance';
        $emptyMessage = 'No sms verified bloggers found';
        $bloggers = Bloggers::where('balance','!=',0)->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.bloggers.list', compact('pageTitle', 'emptyMessage', 'bloggers'));
    }


    public function search(Request $request, $scope)
    {
        $search = $request->search;
        $bloggers = Bloggers::where(function ($bloggers) use ($search) {
            $bloggers->where('username', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        });
        $pageTitle = '';
        if ($scope == 'active') {
            $pageTitle = 'Active ';
            $bloggers = $bloggers->where('status', 1);
        }elseif($scope == 'banned'){
            $pageTitle = 'Banned';
            $bloggers = $bloggers->where('status', 0);
        }elseif($scope == 'emailUnverified'){
            $pageTitle = 'Email Unverified ';
            $bloggers = $bloggers->where('ev', 0);
        }elseif($scope == 'smsUnverified'){
            $pageTitle = 'SMS Unverified ';
            $bloggers = $bloggers->where('sv', 0);
        }elseif($scope == 'withBalance'){
            $pageTitle = 'With Balance ';
            $bloggers = $bloggers->where('balance','!=',0);
        }

        $bloggers = $bloggers->paginate(getPaginate());
        $pageTitle .= 'Bloggers Search - ' . $search;
        $emptyMessage = 'No search result found';
        return view('admin.bloggers.list', compact('pageTitle', 'search', 'scope', 'emptyMessage', 'bloggers'));
    }


    public function detail($id)
    {
        $pageTitle = 'Bloggers Detail';
        $bloggers = Bloggers::findOrFail($id);
        $totalWithdraw = Withdrawal::where('bloggers_id',$bloggers->id)->where('status',1)->sum('amount');
        $totalTransaction = Transaction::where('bloggers_id',$bloggers->id)->count();
        $totalProperties = Property::where('bloggers_id', $bloggers->id)->count();
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        return view('admin.bloggers.detail', compact('pageTitle', 'bloggers','totalWithdraw','totalTransaction', 'totalProperties', 'countries'));
    }


    public function update(Request $request, $id)
    {
        $bloggers = Bloggers::findOrFail($id);

        $countryData = json_decode(file_get_contents(resource_path('views/partials/country.json')));

        $request->validate([
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'email' => 'required|email|max:90|unique:bloggers,email,' . $bloggers->id,
            'mobile' => 'required|unique:bloggers,mobile,' . $bloggers->id,
            'country' => 'required',
        ]);
        $countryCode = $request->country;
        $bloggers->mobile = $request->mobile;
        $bloggers->country_code = $countryCode;
        $bloggers->firstname = $request->firstname;
        $bloggers->lastname = $request->lastname;
        $bloggers->email = $request->email;
        $bloggers->address = [
                            'address' => $request->address,
                            'city' => $request->city,
                            'state' => $request->state,
                            'zip' => $request->zip,
                            'country' => @$countryData->$countryCode->country,
                        ];
        $bloggers->status = $request->status ? 1 : 0;
        $bloggers->ev = $request->ev ? 1 : 0;
        $bloggers->sv = $request->sv ? 1 : 0;
        $bloggers->ts = $request->ts ? 1 : 0;
        $bloggers->tv = $request->tv ? 1 : 0;
        $bloggers->save();

        $notify[] = ['success', 'Bloggers detail has been updated'];
        return redirect()->back()->withNotify($notify);
    }

    public function addSubBalance(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric|gt:0']);

        $bloggers = Bloggers::findOrFail($id);
        $amount = $request->amount;
        $general = GeneralSetting::first(['cur_text','cur_sym']);
        $trx = getTrx();

        if ($request->act) {
            $bloggers->balance += $amount;
            $bloggers->save();
            $notify[] = ['success', $general->cur_sym . $amount . ' has been added to ' . $bloggers->username . '\'s balance'];

            $transaction = new Transaction();
            $transaction->bloggers_id = $bloggers->id;
            $transaction->amount = $amount;
            $transaction->post_balance = $bloggers->balance;
            $transaction->charge = 0;
            $transaction->trx_type = '+';
            $transaction->details = 'Added Balance Via Admin';
            $transaction->trx =  $trx;
            $transaction->save();

            notify($bloggers, 'BAL_ADD', [
                'trx' => $trx,
                'amount' => showAmount($amount),
                'currency' => $general->cur_text,
                'post_balance' => showAmount($bloggers->balance),
            ], 'bloggers');

        } else {
            if ($amount > $bloggers->balance) {
                $notify[] = ['error', $bloggers->username . '\'s has insufficient balance.'];
                return back()->withNotify($notify);
            }
            $bloggers->balance -= $amount;
            $bloggers->save();

            $transaction = new Transaction();
            $transaction->bloggers_id = $bloggers->id;
            $transaction->amount = $amount;
            $transaction->post_balance = $bloggers->balance;
            $transaction->charge = 0;
            $transaction->trx_type = '-';
            $transaction->details = 'Subtract Balance Via Admin';
            $transaction->trx =  $trx;
            $transaction->save();


            notify($bloggers, 'BAL_SUB', [
                'trx' => $trx,
                'amount' => showAmount($amount),
                'currency' => $general->cur_text,
                'post_balance' => showAmount($bloggers->balance)
            ], 'bloggers');
            $notify[] = ['success', $general->cur_sym . $amount . ' has been subtracted from ' . $bloggers->username . '\'s balance'];
        }
        return back()->withNotify($notify);
    }


    public function bloggersLoginHistory($id)
    {
        $bloggers = Bloggers::findOrFail($id);
        $pageTitle = 'Bloggers Login History - ' . $bloggers->username;
        $emptyMessage = 'No bloggers login found.';
        $login_logs = $bloggers->login_logs()->orderBy('id','desc')->with('bloggers')->paginate(getPaginate());
        return view('admin.bloggers.logins', compact('pageTitle', 'emptyMessage', 'login_logs'));
    }



    public function showEmailSingleForm($id)
    {
        $bloggers = Bloggers::findOrFail($id);
        $pageTitle = 'Send Email To: ' . $bloggers->username;
        return view('admin.bloggers.email_single', compact('pageTitle', 'bloggers'));
    }

    public function sendEmailSingle(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        $bloggers = Bloggers::findOrFail($id);
        sendGeneralEmail($bloggers->email, $request->subject, $request->message, $bloggers->username);
        $notify[] = ['success', $bloggers->username . ' will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function transactions(Request $request, $id)
    {
        $bloggers = Bloggers::findOrFail($id);
        if ($request->search) {
            $search = $request->search;
            $pageTitle = 'Search Bloggers Transactions : ' . $bloggers->username;
            $transactions = $bloggers->transactions()->where('trx', $search)->with('bloggers')->orderBy('id','desc')->paginate(getPaginate());
            $emptyMessage = 'No transactions';
            return view('admin.reports.transactions', compact('pageTitle', 'search', 'bloggers', 'transactions', 'emptyMessage'));
        }
        $pageTitle = 'Bloggers Transactions : ' . $bloggers->username;
        $transactions = $bloggers->transactions()->with('bloggers')->orderBy('id','desc')->paginate(getPaginate());
        $emptyMessage = 'No transactions';
        return view('admin.reports.transactions', compact('pageTitle', 'bloggers', 'transactions', 'emptyMessage'));
    }

    public function properties(Request $request, $id){
        $bloggers = Bloggers::findOrFail($id);
        $pageTitle = 'Bloggers Properties : ' . $bloggers->username;
        $properties = Property::with('propertyType', 'location', 'amenities', 'rooms', 'roomCategories' )->where('bloggers_id', $id)->orderBy('id', 'DESC')->paginate(getPaginate());
        $emptyMessage = 'No properties';
        return view('admin.property.index', compact('pageTitle', 'bloggers', 'properties', 'emptyMessage'));
    }


    public function withdrawals(Request $request, $id)
    {
        $bloggers = Bloggers::findOrFail($id);
        if ($request->search) {
            $search = $request->search;
            $pageTitle = 'Search Bloggers Withdrawals : ' . $bloggers->username;
            $withdrawals = $bloggers->withdrawals()->where('trx', 'like',"%$search%")->orderBy('id','desc')->paginate(getPaginate());
            $emptyMessage = 'No withdrawals';
            return view('admin.withdraw.withdrawals', compact('pageTitle', 'bloggers', 'search', 'withdrawals', 'emptyMessage'));
        }
        $pageTitle = 'Bloggers Withdrawals : ' . $bloggers->username;
        $withdrawals = $bloggers->withdrawals()->orderBy('id','desc')->paginate(getPaginate());
        $emptyMessage = 'No withdrawals';
        $bloggersId = $bloggers->id;
        return view('admin.withdraw.withdrawals', compact('pageTitle', 'bloggers', 'withdrawals', 'emptyMessage','bloggersId'));
    }

    public  function withdrawalsViaMethod($method,$type,$bloggersId){
        $method = WithdrawMethod::findOrFail($method);
        $bloggers = Bloggers::findOrFail($bloggersId);
        if ($type == 'approved') {
            $pageTitle = 'Approved Withdrawal of '.$bloggers->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', 1)->where('bloggers_id',$bloggers->id)->with(['bloggers','method'])->orderBy('id','desc')->paginate(getPaginate());
        }elseif($type == 'rejected'){
            $pageTitle = 'Rejected Withdrawals of '.$bloggers->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', 3)->where('bloggers_id',$bloggers->id)->with(['bloggers','method'])->orderBy('id','desc')->paginate(getPaginate());

        }elseif($type == 'pending'){
            $pageTitle = 'Pending Withdrawals of '.$bloggers->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', 2)->where('bloggers_id',$bloggers->id)->with(['bloggers','method'])->orderBy('id','desc')->paginate(getPaginate());
        }else{
            $pageTitle = 'Withdrawals of '.$bloggers->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', '!=', 0)->where('bloggers_id',$bloggers->id)->with(['bloggers','method'])->orderBy('id','desc')->paginate(getPaginate());
        }
        $emptyMessage = 'Withdraw Log Not Found';
        return view('admin.withdraw.withdrawals', compact('pageTitle', 'withdrawals', 'emptyMessage','method'));
    }

    public function showEmailAllForm()
    {
        $pageTitle = 'Send Email To All Bloggers';
        return view('admin.bloggers.email_all', compact('pageTitle'));
    }

    public function sendEmailAll(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        foreach (Bloggers::where('status', 1)->cursor() as $bloggers) {
            sendGeneralEmail($bloggers->email, $request->subject, $request->message, $bloggers->username);
        }

        $notify[] = ['success', 'All bloggers will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function login($id){
        $bloggers = Bloggers::findOrFail($id);
        Auth::guard('bloggers')->login($bloggers);
        return redirect()->route('bloggers.dashboard');
    }

    public function emailLog($id){
        $bloggers = Bloggers::findOrFail($id);
        $pageTitle = 'Email log of '.$bloggers->username;
        $logs = EmailLog::where('bloggers_id',$id)->with('bloggers')->orderBy('id','desc')->paginate(getPaginate());
        $emptyMessage = 'No data found';
        return view('admin.bloggers.email_log', compact('pageTitle','logs','emptyMessage','bloggers'));
    }

    public function emailDetails($id){
        $email = EmailLog::findOrFail($id);
        $pageTitle = 'Email details';
        return view('admin.bloggers.email_details', compact('pageTitle','email'));
    }
}
