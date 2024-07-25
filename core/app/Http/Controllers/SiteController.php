<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\Agent_review;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Location;
use App\Models\News;
use App\Models\Owner;
use App\Models\Page;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Subscriber;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\ViewedBlog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $count = Page::where('tempname', $this->activeTemplate)->where('slug', 'home')->count();
        if ($count == 0) {
            $page = new Page();
            $page->tempname = $this->activeTemplate;
            $page->name = 'HOME';
            $page->slug = 'home';
            $page->save();
        }

        $reference = @$_GET['reference'];
        if ($reference) {
            session()->put('reference', $reference);
        }

        $pageTitle = 'Home';
        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'home')->first();
        $locations = Location::where('status', 1)->limit(10)->get();
        $propertyTypes = PropertyType::where('status', 1)->limit(10)->get();

        //blog
        $latestNews = News::active()->approved()->latest()->limit(3)->get(['id', 'title', 'image', 'created_at']);
        return view($this->activeTemplate . 'home', compact('pageTitle', 'sections', 'locations', 'propertyTypes', 'latestNews'));
    }

    public function locations()
    {
        $pageTitle = 'All Locations';
        $emptyMessage = 'No location found';
        $locations = Location::where('status', 1)->paginate(getPaginate());
        return view($this->activeTemplate . 'locations', compact('pageTitle', 'emptyMessage', 'locations'));
    }

    public function faq()
    {
        $pageTitle = "Frequently Asked Questions";
        $elements = Frontend::where('data_keys', 'faq.element')->latest()->get();
        $heading = Frontend::where('data_keys', 'faq.content')->first();
        return view($this->activeTemplate . 'faq', compact('pageTitle', 'elements', 'heading'));
    }

    public function pages($slug)
    {
        $page = Page::where('tempname', $this->activeTemplate)->where('slug', $slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle', 'sections'));
    }


    public function contact()
    {
        $pageTitle = "About Us";
        $contact = Frontend::select('data_values')->where('data_keys', 'contact_us.content')->first();
        $blogs = Frontend::where('data_keys', 'blog.element')->latest()->limit(10)->paginate(getPaginate());
        $page = Page::where('tempname', $this->activeTemplate)->where('slug', 'contact')->first();
        $sections = $page->secs;

        return view($this->activeTemplate . 'contact', compact('pageTitle', 'contact', 'sections'));
    }


    public function contactSubmit(Request $request)
    {

        $attachments = $request->file('attachments');
        $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');

        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);

        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = 2;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'ticket created successfully!'];

        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function blogs()
    {
        $pageTitle = 'All Blogs Post';
        $emptyMessage = 'No blog post found';
        $blogs = News::latest()->limit(10)->paginate(getPaginate());
        $page = Page::where('tempname', $this->activeTemplate)->where('slug', 'blog')->first();
        $sections = $page->secs;

        return view($this->activeTemplate . 'blogs', compact('pageTitle', 'blogs', 'sections'));
    }

    public function blogDetails($id, $slug)
    {
        $blog = News::where('id', $id)->firstOrFail();

        // Check if the blog has been viewed in the current session
        $viewedBlogs = session()->get('viewed_blogs', []);
        if (!in_array($blog->id, $viewedBlogs)) {
            $blog->views = $blog->views + 1;
            $blog->save();

            // Add the blog ID to the session to prevent counting again
            session()->push('viewed_blogs', $blog->id);
        }

        $recentBlogs = News::where('id', '!=', $blog->id)->latest()->limit(5)->get();
        $pageTitle = $blog->title;
        $seo_blog = $blog;

        return view($this->activeTemplate . 'blog_details', compact('blog', 'pageTitle', 'recentBlogs', 'seo_blog'));
    }

    public function agents()
    {
        $pageTitle = 'Agents';
        $agents_landlords = Owner::where('status', 1)->whereNotNull('image')->limit(10)->paginate(getPaginate());
        return view($this->activeTemplate . 'agents', compact('pageTitle', 'agents_landlords'));
    }

    public function agents_details($id)
    {
        $agents = Owner::where('id', $id)->first();
        $pageTitle = $agents->firstname . ' ' . $agents->lastname;
        $properties = Property::where('owner_id', $agents->id)->count();
        $properties_all = Property::where('owner_id', $agents->id)->where('status', 1)->with('location')->with('rooms')->get();
        $review_count = Agent_review::where('agent_id', $agents->id)->count();
        return view($this->activeTemplate . 'agents_details', compact('pageTitle', 'agents', 'properties', 'properties_all', 'review_count'));
    }


    public function cookieAccept()
    {
        session()->put('cookie_accepted', true);
        $notify[] = ['success', 'Cookie accepted successfully'];
        return back()->withNotify($notify);
    }

    public function placeholderImage($size = null)
    {
        $imgWidth = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX = ($imgWidth - $textWidth) / 2;
        $textY = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function subscribe(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 200,
                'status' => 'error',
                'message' => $validator->errors()->all(),
            ]);
        }

        $subscribe = new Subscriber();
        $subscribe->email = $request->email;
        $subscribe->save();

        $notify = 'Thank you, we will notice you our latest news';

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => $notify
        ]);

    }

    public function policy($id)
    {
        $page = Frontend::where('id', $id)->where('data_keys', 'policy_pages.element')->firstOrFail();
        $pageTitle = $page->data_values->title;
        $description = $page->data_values->details;
        return view($this->activeTemplate . 'policy', compact('pageTitle', 'description'));
    }

    public function startChat(Request $request)
    {
        if (Auth::check()) {
            $notify[] = ['success', 'Your message has been sent.'];
            return redirect()->route('user.home')->withNotify($notify);
        } else {
            $notify[] = ['danger', 'Kindly Login first.'];
            return redirect()->barck()->withNotify($notify);
        }

    }

}
