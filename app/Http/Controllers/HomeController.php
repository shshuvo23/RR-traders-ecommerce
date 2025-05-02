<?php

namespace App\Http\Controllers;

use App\Mail\SendContact;
use App\Models\Brand;
use App\Models\Faq;
use App\Models\User;
use App\Models\Card;
use App\Models\Category;
use App\Models\Contact;
use App\Models\CustomPage;
use App\Models\HomeContent;
use App\Models\Language;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Seo;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\SocialIcon;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;
use Sabberworm\CSS\Settings;

class HomeController extends Controller
{



    public function cacheClear()
    {
        // \Artisan::call('php artisan cache:forget spatie.permission.cache');
        Artisan::call('route:clear');
        Artisan::call('optimize');
        Artisan::call('optimize:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('storage:link');
        Artisan::call('cache:forget spatie.permission.cache');
        Artisan::call('config:cache');
        echo 'Done';
        die();
    }
    // public function changeLanguage(Request $request): RedirectResponse
    // {

    //     Session::put('languageName', $request->input('languageName'));
    //     $language = Language::where('iso_code', $request->input('languageName'))->first();
    //     Session::put('language', $language);
    //     return redirect()->back();
    // }
    public function changeCardLanguage(Request $request)
    {

        Session::put('cardLang', $request->input('locale'));
        return redirect()->back();
    }

    public function index()
    {
        $setting = getSetting();
        $data['title']          = $setting->site_name;
        $data['og_title']       = $setting->site_name;
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['faqs']           = Faq::where('is_active', 1)->orderBy('order_id','asc')->get();
        $data['seo']            = Seo::where('page_slug', 'home')->first();
        $data['testimonials']   = Testimonial::where('status', '1')->orderBy('order_id')->get();
        $data['sliders']        = Slider::where('status', '1')->orderBy('sorting_order')->get();
        $data['is_home_categories'] = Category::where('is_home', 1)
                                                ->where('status', 1)
                                                ->orderBy('orderby', 'asc')
                                                ->get();
        $data['is_highlighted_categories'] = Category::where('is_highlighted', 1)
                                                        ->where('status', 1)
                                                        ->orderBy('orderby', 'asc') // Orders based on user-defined orderby column
                                                        ->take(3)
                                                        ->get();
        $data['tranding_product'] = Product::Where('is_trending','1')->where('status','1')->orderBy('id', 'desc')->get();
        $data['new_arraivals'] = Product::Where('new_arraivals','1')->where('status','1')->orderBy('id', 'desc')->get();


        return view('frontend.index', $data);
    }

    public function shop(Request $request, $cat_slug=null)
    {
        $setting = getSetting();
        $data['title']          = 'Shop';
        $data['og_title']       = 'Shop';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        // $data['all_product'] = Product::where('status','1')->orderBy('id', 'desc')->Paginate(12);
        $data['category'] = Category::where('status','1')->withCount('products')->orderBy('name', 'asc')->get();
        $data['brands'] = Brand::where('status','1')->orderBy('name','asc')->get();

        $query = $request->get('q');
        $cat= $request->get('category_id');
        $brand_slug = $request->get('brand');
        $sortby = $request->get('sortby');

        $minFilter = $request->get('min_price');
        $maxFilter = $request->get('max_price');

        $category = Category::where('slug', $cat_slug)->first();
        $brand = Brand::where('slug', $brand_slug)->first();

        $productQuery = Product::where('status', '1')
                        ->when($query, function ($queryBuilder) use ($query) {
                            $queryBuilder->where(function ($q) use ($query) {
                                $q->where('title', 'LIKE', "%{$query}%")
                                    ->orWhere('description', 'LIKE', "%{$query}%");
                            });
                        })
                        ->when($category, function ($queryBuilder) use ($category) {
                            $queryBuilder->where('category_id', $category->id);
                        })
                        ->when($brand, function ($queryBuilder) use ($brand) {
                            $queryBuilder->where('brand_id', $brand->id);
                        });

        // Sorting logic
        if ($sortby == 'az') {
            $productQuery->orderBy('title', 'asc');
        } elseif ($sortby == 'za') {
            $productQuery->orderBy('title', 'desc');
        } elseif ($sortby == 'price_high_low') {
            $productQuery->orderByRaw('(price - (price * discount / 100)) DESC');
        } elseif ($sortby == 'price_low_high') {
            $productQuery->orderByRaw('(price - (price * discount / 100)) ASC');
        } else {
            $productQuery->orderBy('id', 'desc');
        }

        if ($minFilter && $maxFilter) {
            $productQuery->whereRaw('(price - (price * discount / 100)) BETWEEN ? AND ?', [$minFilter, $maxFilter]);
        }


        $data['all_product'] = $productQuery->paginate(24);


        // $data['all_product'] = Product::where('status', '1')
        //                     ->when($query, function ($queryBuilder) use ($query) {
        //                         $queryBuilder->where(function ($q) use ($query) {
        //                             $q->where('title', 'LIKE', "%{$query}%")
        //                             ->orWhere('description', 'LIKE', "%{$query}%");
        //                         });
        //                     })
        //                     ->when($category, function ($queryBuilder) use ($category) {
        //                         $queryBuilder->where('category_id', $category->id);
        //                     })
        //                     ->when($brand, function ($queryBuilder) use ($brand) {
        //                         $queryBuilder->where('brand_id', $brand->id);
        //                     })
        //                     ->orderBy('id', 'desc')
        //                     ->paginate(12);

                // $data['all_product'] = Product::where('status', '1')
                // ->when($query, function ($queryBuilder) use ($query) {
                //     $queryBuilder->where(function ($q) use ($query) {
                //         $q->where('title', 'LIKE', "%{$query}%")
                //         ->orWhere('description', 'LIKE', "%{$query}%");
                //     });
                // })
                // ->when($category, function ($queryBuilder) use ($category) {
                //     $queryBuilder->where('category_id', $category->id);
                // })
                // ->when($brand_id, function ($queryBuilder) use ($brand_id) {
                //     $queryBuilder->where('brand_id', $brand_id);
                // })
                // ->orderBy('id', 'desc')
                // ->paginate(12);




        return view('frontend.shop.all_product', $data);
    }

    public function productDetails($slug)
    {
        $setting = getSetting();
        $data['title']          = 'Product Details';
        $data['og_title']       = 'Product Details|Shop';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['product'] = Product::where('slug', $slug)->firstOrFail();

        // Assign the product variable first before using it
        $product = $data['product'];

        $data['shareComponent'] = \Share::page(
            route('productDetails', ['slug' => $product->slug]),
            $product->title
        )
        ->facebook()
        ->twitter()
        ->pinterest();
        // ->instagram();
        $data['relatedProducts'] = Product::where('category_id', $product->category_id)
                                    ->whereNotIn('id', [$product->id])
                                    ->take(6)
                                    ->get();

        return view('frontend.shop.product_details', $data);
    }

    public function privacyPolicy()
    {
        $setting = getSetting();
        $data['title']          = __('messages.footer.privacy_policy');
        $data['og_title']       = 'Privacy Policy';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['row']            = CustomPage::where('url_slug', 'privacy-policy')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }

    public function termsCondition()
    {
        $setting = getSetting();
        $data['title']          = __('messages.footer.terms_conditions');
        $data['og_title']       = 'Terms & Condition';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['row']            = CustomPage::where('url_slug', 'terms-and-conditions')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }

    public function imprint()
    {
        $setting = getSetting();
        $data['title']          = __('messages.footer.imprint');
        $data['og_title']       = 'Imprint';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['row']            = CustomPage::where('url_slug', 'imprint')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }
    public function rightOfWithdrawal()
    {
        $setting = getSetting();
        $data['title']          = __('messages.footer.right-of-withdrawal');
        $data['og_title']       = 'Right of Withdrawal';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['row']            = CustomPage::where('url_slug', 'right-of-withdrawal')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }
    public function generalTermsConditions()
    {
        $setting = getSetting();
        $data['title']          = __('messages.footer.general-terms-and-conditions');
        $data['og_title']       = 'General Terms & Conditions';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['row']            = CustomPage::where('url_slug', 'general-terms-and-conditions')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }

    public function faq()
    {
        $setting = getSetting();
        $data['title']          = 'FAQ - Frequently Asked Questions';
        $data['og_title']       = 'FAQ';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['faqs']           = Faq::where('is_active', 1)->orderBy('order_id','asc')->get();
        $data['seo']            = Seo::where('page_slug', 'faq')->first();
        return view('frontend.faq', $data);
    }
    public function dataProtectionDeclaration()
    {
        $setting = getSetting();
        $data['title']          = __('messages.footer.data-protection-declaration');
        $data['og_title']       = 'Data Protection Declaration';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['row']            = CustomPage::where('url_slug', 'data-protection-declaration')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }
    public function shippingConditions()
    {
        $setting = getSetting();
        $data['title']          = "Shipping";
        $data['og_title']       = 'Shipping';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['row']            = CustomPage::where('url_slug', 'shipping')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }

    public function returns()
    {
        $setting = getSetting();
        $data['title']          = 'Return Policy';
        $data['og_title']       = $setting->title;
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        // $data['seo']            = Seo::where('page_slug', 'return')->first();
        $data['row']            = CustomPage::where('url_slug', 'returns')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }

    public function HowToShop()
    {
        $setting = getSetting();
        $data['title']          = 'How to shop';
        $data['og_title']       = 'How to shop';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['seo']            = Seo::where('page_slug', 'how-to-shop-on-techalpha')->first();
        $data['row']            = CustomPage::where('url_slug','how-to-shop-on-techalpha')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }
    public function moneyBackGuarantee()
    {
        $setting = getSetting();
        $data['title']          = __('messages.footer.returns');
        $data['og_title']       = 'How to shop';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['row']            = CustomPage::where('url_slug', 'money-back-guarantee')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }



    public function about()
    {
        $setting = getSetting();
        $data['title']          = __('messages.nav.about');
        $data['og_title']       = 'About-Us';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['row']            = CustomPage::where('url_slug', 'about-us')->where('is_active', 1)->firstOrFail();
        $data['testimonial']    =Testimonial::where('status','1')->get();
        return view('frontend.about', $data);
    }

    public function pricing()
    {
        $setting = getSetting();
        $data['title']          = 'Pricing';
        $data['og_title']       = 'Pricing';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['seo']            = Seo::where('page_slug', 'pricing')->first();
        $data['plans']          = Plan::where('status', '1')->get();
        $data['homeContent']    = HomeContent::first();
        return view('frontend.pricing', $data);
    }



    public function contact()
    {
        $setting = getSetting();
        $data['title']          = 'Contact Us';
        $data['og_title']       = 'Contact';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['setting']        = $setting;
        $data['seo']            = Seo::where('page_slug', 'contact')->first();
        $data['settings'] = Setting::select('phone_no', 'email', 'office_address')->first();
        return view('frontend.contact', $data);
    }

    public function termsOfUse()
    {
        $setting = getSetting();
        $data['title']          = 'Terms of use';
        $data['og_title']       = 'Terms of use';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        // $data['seo']            = Seo::where('page_slug', 'term-of-use')->first();
        $data['row']            = CustomPage::where('url_slug','terms-of-use')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }


    public function contactSub(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100|string',
            'reason'  => 'required|max:100|string',
            'email'      => 'required|max:80|string',
            'message'    => 'required|max:512|string'
        ]);

        DB::beginTransaction();
        try {
            $contact = new Contact();
            $contact->name      = $request->name;
            $contact->email     = $request->email;
            $contact->reason    = $request->reason;
            $contact->message   = $request->message;
            $contact->save();

            // Send Contact Mail
            $data = [];
            $data = [
                'greeting'    => 'Hello, Admin,',
                'body'        => 'An user send a contact message to your system. Please review and respond to the users query as soon as possible.',
                'name'        => 'User name- '.$request->first_name.' '.$request->last_name,
                'email'       => 'User email- '.$request->email,
                'link'        => route('admin.contact.index'),
                'msg'         => 'Click here to navigate to the query',
                'thanks'      => 'Thank you and stay with ' . ' ' . config('app.name'),
                'site_url'    => route('home'),
                'footer'      => '0',
                'site_name'   => config('app.name'),
                'copyright'   => ' © ' . ' ' . Carbon::now()->format('Y') .' '. config('app.name') . ' ' . 'All rights reserved.',
            ];

            $setting =  Setting::first();
            //if mail exist
            $support_email = $setting->email ?? $setting->support_email;
            if ($support_email) {
                Mail::to($support_email)->send(new SendContact($data));
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Toastr::error(trans('An unexpected error occured while submit your query'), 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
        DB::commit();
        Toastr::success(trans('Your query is submitted'), 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function userRegister(Request $request)
    {
        $setting = getSetting();

        $request->validate([
            'name'      => "required",
            'email'     => "required|email|unique:users,email",
            'password'  => "required|confirmed|min:8|max:50",
        ]);

        $created = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        if ($created) {
            Auth::guard('user')->logout();
            Auth::guard('admin')->logout();
            Auth::guard('user')->login($created);
            if ($setting->customer_email_verification) {
                return redirect()->route('verification.notice');
            } else {
                return redirect()->route('user.dashboard');
            }
        }
    }

    public function testEmail()
    {
        $message = [
            'msg' => 'Test mail'
        ];
        $mail = false;
        try {
            Mail::to(ENV('MAIL_FROM_ADDRESS'))->send(new \App\Mail\TestMail($message));
            $mail = true;
        } catch (\Exception $e) {
            dd($e);
            Toastr::success(trans('Email configuration wrong.'), 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
        if ($mail == true) {

            Toastr::success(trans('Test mail send successfully.'), 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }

    public function getPreview(Request $request, $cardurl)
    {

        $card = Card::where('url_alias', $cardurl)->first();


        if (!isset($card) && !empty($card))
        {
            abort(404);
        }

        //  check plan validity, if expired then redirect to home page
        $planValidity = User::where('id', $card->user_id)->first('current_pan_valid_date')->current_pan_valid_date;
        $currentDay = Carbon::today();

        if($currentDay->greaterThan($planValidity)){
            {
                abort(404);
            }
        }

        if (!empty($card)) {
            $icons = SocialIcon::where('vcard_id', $card->id)->first();

            if ($card->status == "0") {
                // if ($request->headers->get('referer')) {
                //     Toastr::warning('This card has been de-activated, please contact with Linksmartt');
                //     return redirect()->back();
                // } else {
                    abort(404);
                // }
                // return redirect()->back();
            }
            if ($card->status == "2") {
                // if ($request->headers->get('referer')) {
                //     Toastr::warning('This card has been deleted');
                //     return redirect()->back();
                // } else {
                    abort(404);
                // }

            }
            // DB::table('business_cards')->where('id', $card->id)->increment('total_view', 1);
            // $inserted_id = self::insertHistory($card, "history_card_browsing");

            return view('user.card.preview.template' . $card->template_id, compact('card', 'icons'));
        }
    }

}
