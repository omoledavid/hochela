<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BookedProperty;
use App\Models\Deposit;
use App\Models\EmailLog;
use App\Models\Gateway;
use App\Models\Roles;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ManageStaffsController extends Controller
{
    public function allUsers()
    {
        $pageTitle = 'Manage Utaffs';
        $emptyMessage = 'No user found';
        $staffs = Admin::orderBy('id','desc')->paginate(getPaginate());
        $roles = Roles::all();
        return view('admin.staffs.list', compact('pageTitle', 'emptyMessage', 'staffs', 'roles'));
    }

    public function activeUsers()
    {
        $pageTitle = 'Manage Active Utaffs';
        $emptyMessage = 'No active user found';
        $staffs = Admin::active()->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.staffs.list', compact('pageTitle', 'emptyMessage', 'staffs'));
    }

    public function bannedUsers()
    {
        $pageTitle = 'Banned Utaffs';
        $emptyMessage = 'No banned user found';
        $staffs = Admin::banned()->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.staffs.list', compact('pageTitle', 'emptyMessage', 'staffs'));
    }

    public function emailUnverifiedUsers()
    {
        $pageTitle = 'Email Unverified Utaffs';
        $emptyMessage = 'No email unverified user found';
        $staffs = Admin::emailUnverified()->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.staffs.list', compact('pageTitle', 'emptyMessage', 'staffs'));
    }
    public function emailVerifiedUsers()
    {
        $pageTitle = 'Email Verified Utaffs';
        $emptyMessage = 'No email verified user found';
        $staffs = Admin::emailVerified()->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.staffs.list', compact('pageTitle', 'emptyMessage', 'staffs'));
    }


    public function smsUnverifiedUsers()
    {
        $pageTitle = 'SMS Unverified Utaffs';
        $emptyMessage = 'No sms unverified user found';
        $staffs = Admin::smsUnverified()->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.staffs.list', compact('pageTitle', 'emptyMessage', 'staffs'));
    }


    public function smsVerifiedUsers()
    {
        $pageTitle = 'SMS Verified Utaffs';
        $emptyMessage = 'No sms verified user found';
        $staffs = Admin::smsVerified()->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.staffs.list', compact('pageTitle', 'emptyMessage', 'staffs'));
    }

    
    public function usersWithBalance()
    {
        $pageTitle = 'Utaffs with balance';
        $emptyMessage = 'No sms verified user found';
        $staffs = Admin::where('balance','!=',0)->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.staffs.list', compact('pageTitle', 'emptyMessage', 'staffs'));
    }



    public function search(Request $request, $scope)
    {
        $search = $request->search;
        $staffs = Admin::where(function ($user) use ($search) {
            $user->where('username', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        });
        $pageTitle = '';
        if ($scope == 'active') {
            $pageTitle = 'Active ';
            $staffs = $staffs->where('status', 1);
        }elseif($scope == 'banned'){
            $pageTitle = 'Banned';
            $staffs = $staffs->where('status', 0);
        }elseif($scope == 'emailUnverified'){
            $pageTitle = 'Email Unverified ';
            $staffs = $staffs->where('ev', 0);
        }elseif($scope == 'smsUnverified'){
            $pageTitle = 'SMS Unverified ';
            $staffs = $staffs->where('sv', 0);
        }elseif($scope == 'withBalance'){
            $pageTitle = 'With Balance ';
            $staffs = $staffs->where('balance','!=',0);
        }

        $staffs = $staffs->paginate(getPaginate());
        $pageTitle .= 'User Search - ' . $search;
        $emptyMessage = 'No search result found';
        return view('admin.staffs.list', compact('pageTitle', 'search', 'scope', 'emptyMessage', 'staffs'));
    }


    public function detail($id)
    {
        $pageTitle = 'User Detail';
        $user = Admin::findOrFail($id);
        $totalDeposit = Deposit::where('user_id',$user->id)->where('status',1)->sum('amount');
        $totalTickets = SupportTicket::where('user_id', $user->id)->count();
        $totalBookedProperties = $propertyBookings = BookedProperty::with('property')->where('user_id', $id)->where('status', 1)->count();
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        return view('admin.staffs.detail', compact('pageTitle', 'user','totalDeposit','totalTickets', 'totalBookedProperties', 'countries'));
    }


    public function update(Request $request, $id)
    {
        $user = Admin::findOrFail($id);

        $countryData = json_decode(file_get_contents(resource_path('views/partials/country.json')));

        $request->validate([
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'email' => 'required|email|max:90|unique:staffs,email,' . $user->id,
            'mobile' => 'required|unique:staffs,mobile,' . $user->id,
            'country' => 'required',
        ]);
        $countryCode = $request->country;
        $user->mobile = $request->mobile;
        $user->country_code = $countryCode;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->address = [
                            'address' => $request->address,
                            'city' => $request->city,
                            'state' => $request->state,
                            'zip' => $request->zip,
                            'country' => @$countryData->$countryCode->country,
                        ];
        $user->status = $request->status ? 1 : 0;
        $user->ev = $request->ev ? 1 : 0;
        $user->sv = $request->sv ? 1 : 0;
        $user->ts = $request->ts ? 1 : 0;
        $user->tv = $request->tv ? 1 : 0;
        $user->save();

        $notify[] = ['success', 'User detail has been updated'];
        return redirect()->back()->withNotify($notify);
    }

    public function userLoginHistory($id)
    {
        $user = Admin::findOrFail($id);
        $pageTitle = 'User Login History - ' . $user->username;
        $emptyMessage = 'No staffs login found.';
        $login_logs = $user->login_logs()->orderBy('id','desc')->with('user')->paginate(getPaginate());
        return view('admin.staffs.logins', compact('pageTitle', 'emptyMessage', 'login_logs'));
    }



    public function showEmailSingleForm($id)
    {
        $user = Admin::findOrFail($id);
        $pageTitle = 'Send Email To: ' . $user->username;
        return view('admin.staffs.email_single', compact('pageTitle', 'user'));
    }

    public function sendEmailSingle(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        $user = Admin::findOrFail($id);
        sendGeneralEmail($user->email, $request->subject, $request->message, $user->username);
        $notify[] = ['success', $user->username . ' will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function tickets($id){
        $user = Admin::findOrFail($id);
        $pageTitle = 'Support Tickets';
        $emptyMessage = 'No Data found.';
        $items = SupportTicket::where('user_id', $id)->orderBy('id','desc')->with('user', 'owner')->paginate(getPaginate());

        return view('admin.support.tickets', compact('items', 'pageTitle','emptyMessage'));
    }

    public function deposits(Request $request, $id)
    {
        $user = Admin::findOrFail($id);
        $userId = $user->id;
        if ($request->search) {
            $search = $request->search;
            $pageTitle = 'Search User Deposits : ' . $user->username;
            $deposits = $user->deposits()->where('trx', $search)->orderBy('id','desc')->paginate(getPaginate());
            $emptyMessage = 'No deposits';
            return view('admin.deposit.log', compact('pageTitle', 'search', 'user', 'deposits', 'emptyMessage','userId'));
        }

        $pageTitle = 'User Deposit : ' . $user->username;
        $deposits = $user->deposits()->orderBy('id','desc')->with(['gateway','user'])->paginate(getPaginate());
        $successful = $user->deposits()->orderBy('id','desc')->where('status',1)->sum('amount');
        $pending = $user->deposits()->orderBy('id','desc')->where('status',2)->sum('amount');
        $rejected = $user->deposits()->orderBy('id','desc')->where('status',3)->sum('amount');
        $emptyMessage = 'No deposits';
        $scope = 'all';
        return view('admin.deposit.log', compact('pageTitle', 'user', 'deposits', 'emptyMessage','userId','scope','successful','pending','rejected'));
    }


    public function depViaMethod($method,$type = null,$userId){
        $method = Gateway::where('alias',$method)->firstOrFail();        
        $user = Admin::findOrFail($userId);
        if ($type == 'approved') {
            $pageTitle = 'Approved Payment Via '.$method->name;
            $deposits = Deposit::where('method_code','>=',1000)->where('user_id',$user->id)->where('method_code',$method->code)->where('status', 1)->orderBy('id','desc')->with(['user', 'gateway'])->paginate(getPaginate());
        }elseif($type == 'rejected'){
            $pageTitle = 'Rejected Payment Via '.$method->name;
            $deposits = Deposit::where('method_code','>=',1000)->where('user_id',$user->id)->where('method_code',$method->code)->where('status', 3)->orderBy('id','desc')->with(['user', 'gateway'])->paginate(getPaginate());
        }elseif($type == 'successful'){
            $pageTitle = 'Successful Payment Via '.$method->name;
            $deposits = Deposit::where('status', 1)->where('user_id',$user->id)->where('method_code',$method->code)->orderBy('id','desc')->with(['user', 'gateway'])->paginate(getPaginate());
        }elseif($type == 'pending'){
            $pageTitle = 'Pending Payment Via '.$method->name;
            $deposits = Deposit::where('method_code','>=',1000)->where('user_id',$user->id)->where('method_code',$method->code)->where('status', 2)->orderBy('id','desc')->with(['user', 'gateway'])->paginate(getPaginate());
        }else{
            $pageTitle = 'Payment Via '.$method->name;
            $deposits = Deposit::where('status','!=',0)->where('user_id',$user->id)->where('method_code',$method->code)->orderBy('id','desc')->with(['user', 'gateway'])->paginate(getPaginate());
        }
        $pageTitle = 'Deposit History: '.$user->username.' Via '.$method->name;
        $methodAlias = $method->alias;
        $emptyMessage = 'Deposit Log';
        return view('admin.deposit.log', compact('pageTitle', 'emptyMessage', 'deposits','methodAlias','userId'));
    }

    public function bookedProperties(Request $request, $id){
        $user = Admin::findOrFail($id);
        $pageTitle = 'Booking History';
        $emptyMessage = 'No booking history found';
        $bookedProperties = BookedProperty::with('property')->where('user_id', $id)->where('status', 1)->latest()->paginate(getPaginate());
        
        return view('admin.staffs.booked_properties', compact('pageTitle', 'emptyMessage', 'bookedProperties'));
    }

    public function showEmailAllForm()
    {
        $pageTitle = 'Send Email To All Utaffs';
        return view('admin.staffs.email_all', compact('pageTitle'));
    }

    public function sendEmailAll(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        foreach (Admin::where('status', 1)->cursor() as $user) {
            sendGeneralEmail($user->email, $request->subject, $request->message, $user->username);
        }

        $notify[] = ['success', 'All staffs will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function login($id){
        $user = Admin::findOrFail($id);
        Auth::login($user);
        return redirect()->route('admin.home');
    }

    public function emailLog($id){
        $user = Admin::findOrFail($id);
        $pageTitle = 'Email log of '.$user->username;
        $logs = EmailLog::where('user_id',$id)->with('user')->orderBy('id','desc')->paginate(getPaginate());
        $emptyMessage = 'No data found';
        return view('admin.staffs.email_log', compact('pageTitle','logs','emptyMessage','user'));
    }

    public function emailDetails($id){
        $email = EmailLog::findOrFail($id);
        $pageTitle = 'Email details';
        return view('admin.staffs.email_details', compact('pageTitle','email'));
    }

}
