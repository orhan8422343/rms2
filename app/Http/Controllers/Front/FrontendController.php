<?php

namespace App\Http\Controllers\Front;

use App\Events\WaiterCalled;
use App\Http\Controllers\Controller;
use App\Http\Helpers\MegaMailer;
use App\Models\BasicExtended as BE;
use App\Models\BasicSetting as BS;
use App\Models\Bcategory;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Gallery;
use App\Models\IntroPoint as Ifi;
use App\Models\Jcategory;
use App\Models\Job;
use App\Models\Language;
use App\Models\Member;
use App\Models\Page;
use App\Models\Pcategory;
use App\Models\Product;
use App\Models\ReservationInput;
use App\Models\Slider;
use App\Models\Subscriber;
use App\Models\TableBook;
use App\Models\Testimonial;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\PHPMailer;
use Validator;
use Auth;

class FrontendController extends Controller
{

    public function __construct()
    {
        $bs = BS::first();
        $be = BE::first();

        Config::set('captcha.sitekey', $bs->google_recaptcha_site_key);
        Config::set('captcha.secret', $bs->google_recaptcha_secret_key);
        Config::set('mail.host', $be->smtp_host);
        Config::set('mail.port', $be->smtp_port);
        Config::set('mail.username', $be->smtp_username);
        Config::set('mail.password', $be->smtp_password);
        Config::set('mail.encryption', $be->encryption);
    }

    public function index()
    {
       
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        $lang_id = $currentLang->id;
        $bs = $currentLang->basic_setting;
        $be = $currentLang->basic_extended;

        $data['sliders'] = Slider::where('language_id', $lang_id)->orderBy('serial_number', 'ASC')->get();
        $data['features'] = Feature::where('language_id', $lang_id)->orderBy('serial_number','ASC')->get();

        $data['members'] = Member::where('language_id', $lang_id)->where('feature', 1)->get();
        $data['testimonials'] = Testimonial::where('language_id', $lang_id)->orderBy('serial_number', 'ASC')->get();
        $data['special_product'] = Product::where('language_id', $lang_id)->where('status', 1)->where('is_special', 1)->orderBy('id', 'desc')->get();
        $data['categories'] = Pcategory::where('status', 1)->where('is_feature', 1)->where('language_id', $currentLang->id)->get();

        $data['products'] = Product::where('language_id', $lang_id)->where('status', 1)->paginate(10);

        $data['shapeImg'] = $bs->home_version == 'slider' ? $be->slider_shape_img : $be->hero_shape_img;
        $data['bottomImg'] = $bs->home_version == 'slider' ? $be->slider_bottom_img : $be->hero_bottom_img;

        $currentTheme = $bs->theme;

        if ($currentTheme == "multipurpose") {
            $data['blogs'] = Blog::where('language_id', $lang_id)->orderBy('id', 'desc')->take(2)->get();
            return view('front.multipurpose.index', $data);
        } elseif ($currentTheme == "bakery") {
            $data['blogs'] = Blog::where('language_id', $lang_id)->orderBy('id', 'desc')->take(4)->get();
            $data['intro_feature_items'] = Ifi::where('language_id', $lang_id)->orderBy('serial_number', 'ASC')->get();
            return view('front.bakery.index', $data);
        } elseif ($currentTheme == "pizza") {
            $data['blogs'] = Blog::where('language_id', $lang_id)->orderBy('id', 'desc')->take(3)->get();
            $data['intro_feature_items'] = Ifi::where('language_id', $lang_id)->orderBy('serial_number', 'ASC')->get();
            return view('front.pizza.index', $data);
        } elseif ($currentTheme == "coffee") {
            $data['blogs'] = Blog::where('language_id', $lang_id)->orderBy('id', 'desc')->take(3)->get();
            $data['intro_feature_items'] = Ifi::where('language_id', $lang_id)->orderBy('serial_number', 'ASC')->get();
            return view('front.coffee.index', $data);
        } elseif ($currentTheme == "medicine") {
            $data['intro_feature_items'] = Ifi::where('language_id', $lang_id)->orderBy('serial_number', 'ASC')->get();
            return view('front.medicine.index', $data);
        } elseif ($currentTheme == "grocery") {
            $data['intro_feature_items'] = Ifi::where('language_id', $lang_id)->orderBy('serial_number', 'ASC')->get();
            $data['blogs'] = Blog::where('language_id', $lang_id)->orderBy('id', 'desc')->take(3)->get();
            return view('front.grocery.index', $data);
        } elseif ($currentTheme == "beverage") {
            $data['intro_feature_items'] = Ifi::where('language_id', $lang_id)->orderBy('serial_number', 'ASC')->get();
            $data['blogs'] = Blog::where('language_id', $lang_id)->orderBy('id', 'desc')->take(3)->get();
            return view('front.beverage.index', $data);
        }
    }

    public function subscribe(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:subscribers',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $subsc = new Subscriber;
        $subsc->email = $request->email;
        $subsc->save();

        return "success";
    }

    public function reservationForm()
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        $bs = $currentLang->basic_setting;
        $bs = BS::first();

        if ($bs->is_quote == 0) {
            return view('errors.404');
        }

        $data['inputs'] = ReservationInput::where('language_id', $currentLang->id)
            ->orderBy('order_number', 'ASC')
            ->with('reservation_input_options')
            ->get();

        if ($bs->is_quote == 1) {
            return view('front.multipurpose.reservation', $data);
        }
    }

    public function tableBook(Request $request)
    {


        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }



        $bs = $currentLang->basic_setting;
        $reservation_inputs = $currentLang->reservation_inputs;

        $messages = [];


        //action Type is Admin ..that is admin request
        if ($request->actionType != 'admin') {

            $messages = [
                'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
                'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
            ];
        }


        $rules = [
            'name' => 'required',
            'email' => 'required|email',
        ];




        foreach ($reservation_inputs as $input) {
            if ($input->required == 1) {
                $rules["$input->name"] = 'required';
            }
        }

        //action Type is Admin ..that is admin request
        if ($request->actionType != 'admin') {
            if ($bs->is_recaptcha == 1 && empty($request->type)) {

                $rules['g-recaptcha-response'] = 'required|captcha';
            }
        }

        $request->validate($rules, $messages);

        $fields = [];
        foreach ($reservation_inputs as $key => $input) {
            $in_name = $input->name;
            if ($request["$in_name"]) {
                $fields["$in_name"] = $request["$in_name"];
            }
        }
        $jsonfields = json_encode($fields);
        $jsonfields = str_replace("\/", "/", $jsonfields);

        $data = new TableBook;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->fields = $jsonfields;

        $data->save();
        if (empty($request->admin)) {
            $mailer = new MegaMailer();
            $data = [
                'fromMail' => $request->email,
                'fromName' => $request->name,
                'subject' => 'Table Reservation Request',
                'body' => 'You have received a new table reservation request',
            ];
            $mailer->mailToAdmin($data);
        }
        Session::flash('success', 'Reservation request sent successfully. We will contact you soon.');
        return back();
    }

    // blog section start
    public function blogs(Request $request)
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $data['currentLang'] = $currentLang;

        $lang_id = $currentLang->id;

        $category = $request->category;
        if (!empty($category)) {
            $data['category'] = Bcategory::findOrFail($category);
        }
        $term = $request->term;

        $data['bcats'] = Bcategory::where('language_id', $lang_id)->where('status', 1)->orderBy('serial_number', 'ASC')->get();

        $data['blogs'] = Blog::when($category, function ($query, $category) {
            return $query->where('bcategory_id', $category);
        })
            ->when($term, function ($query, $term) {
                return $query->where('title', 'like', '%' . $term . '%');
            })
            ->when($currentLang, function ($query, $currentLang) {
                return $query->where('language_id', $currentLang->id);
            })->orderBy('serial_number', 'ASC')->paginate(9);
        return view('front.multipurpose.blogs', $data);
    }

    public function blogdetails($slug, $id)
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $lang_id = $currentLang->id;

        $data['blog'] = Blog::findOrFail($id);
        $data['bcats'] = Bcategory::where('status', 1)->where('language_id', $lang_id)->orderBy('serial_number', 'ASC')->get();
        return view('front.multipurpose.blog-details', $data);
    }

    public function contact()
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $data['contact'] = BS::where('language_id', $currentLang->id)->select(
            'contact_form_title',
            'contact_info_title',
            'contact_address',
            'contact_number',
            'contact_text'
        )->first();

        return view('front.multipurpose.contact', $data);
    }

    public function sendmail(Request $request)
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $bs = $currentLang->basic_setting;

        $messages = [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
        ];

        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',

        ];

        if ($bs->is_recaptcha == 1) {
            $rules['g-recaptcha-response'] = 'required|captcha';
        }

        $request->validate($rules, $messages);

        $be = BE::firstOrFail();
        $from = $request->email;
        $to = $be->to_mail;
        $subject = $request->subject;
        $message = $request->message;

        try {

            $mail = new PHPMailer(true);
            $mail->setFrom($from, $request->name);
            $mail->addAddress($to); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
        } catch (\Exception $e) {
        }

        Session::flash('success', 'Email sent successfully!');
        return back();
    }

    public function career(Request $request)
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $data['jcats'] = $currentLang->jcategories()->where('status', 1)->orderBy('serial_number', 'ASC')->get();

        $category = $request->category;
        $term = $request->term;

        if (!empty($category)) {
            $data['category'] = Jcategory::findOrFail($category);
        }

        $data['jobs'] = Job::when($category, function ($query, $category) {
            return $query->where('jcategory_id', $category);
        })->when($term, function ($query, $term) {
            return $query->where('title', 'like', '%' . $term . '%');
        })->when($currentLang, function ($query, $currentLang) {
            return $query->where('language_id', $currentLang->id);
        })->orderBy('serial_number', 'ASC')->paginate(4);

        $data['jobscount'] = Job::when($currentLang, function ($query, $currentLang) {
            return $query->where('language_id', $currentLang->id);
        })->count();

        return view('front.multipurpose.career', $data);
    }

    public function careerdetails($slug, $id)
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $data['jcats'] = $currentLang->jcategories()->where('status', 1)->orderBy('serial_number', 'ASC')->get();

        $data['job'] = Job::findOrFail($id);

        $data['jobscount'] = Job::when($currentLang, function ($query, $currentLang) {
            return $query->where('language_id', $currentLang->id);
        })->count();

        return view('front.multipurpose.career-details', $data);
    }

    public function gallery()
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $lang_id = $currentLang->id;

        $data['galleries'] = Gallery::where('language_id', $lang_id)->orderBy('serial_number', 'ASC')->get();
        return view('front.multipurpose.gallery', $data);
    }

    public function faq()
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $lang_id = $currentLang->id;

        $data['faqs'] = Faq::where('language_id', $lang_id)->orderBy('serial_number', 'ASC')->get();

        return view('front.multipurpose.faq', $data);
    }

    public function team()
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $data['members'] = Member::when($currentLang, function ($query, $currentLang) {
            return $query->where('language_id', $currentLang->id);
        })->get();
       
        $bs = $currentLang->basic_setting;
        $activeTheme = $bs->theme;
        return view('front.multipurpose.teams', $data);
    }

    public function dynamicPage($slug, $id)
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $data['page'] = Page::findOrFail($id);

        return view('front.multipurpose.dynamic', $data);
    }

    public function changeLanguage($lang, $type = 'website')
    {
        session()->put('lang', $lang);
        app()->setLocale($lang);

        if ($type == 'qr') {
            return redirect()->route('front.qrmenu');
        } else {
            return redirect()->route('front.index');
        }
    }

    public function callwaiter(Request $request)
    {
        $request->validate([
            'table' => 'required',
        ]);

        event(new WaiterCalled($request->table));

        Session::flash('success', __('Restaurant is informed!'));
        return back();
    }

    public function offline()
    {
        return view('front.multipurpose.offline');
    }
}
