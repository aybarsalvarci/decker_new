<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstimateCost\CreateRequest;
use App\Http\Requests\FreeSamples\CreateRequest as FreeSamplesCreateRequest;
use App\Http\Requests\Contact\CreateRequest as ContactCreateRequest;
use App\Models\About;
use App\Models\AboutFactory;
use App\Models\Category;
use App\Models\Contact;
use App\Models\ContactInfo;
use App\Models\EmailSubscription;
use App\Models\Faq;
use App\Models\FreeSample;
use App\Models\FreeSampleBox;
use App\Models\Gallery;
use App\Models\HomePage;
use App\Models\InstallationGuide;
use App\Models\Offer;
use App\Models\OfferItem;
use App\Models\Product;
use App\Models\Report;
use App\Models\StaticPage;
use App\Models\TechnicalCertificate;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $reports = Report::limit(5)->get();
        $homePageSettings = HomePage::firstOrFail();
        return view('front.home', compact('categories', 'homePageSettings', 'reports'));
    }

    public function getInspiredPage()
    {
        $galleryItems = Gallery::orderBy('created_at', 'DESC')->limit(10)->get();
        return view('front.getInspired', compact('galleryItems'));
    }

    public function getInspireds($count)
    {
        $galleryItems = Gallery::orderBy('created_at', 'desc')->offset($count)->limit(6)->get();
        return json_encode($galleryItems);
    }

    public function about()
    {
        $about = About::first();
        $factories = AboutFactory::orderBy("order", "ASC")->get();
        return view('front.about', compact('about', 'factories'));
    }

    public function faq()
    {
        $faqs = Faq::all();
        return view('front.faq', compact('faqs'));
    }

    public function estimateCost()
    {
        $products = Product::with('mainImage')->where('isPriceable', true)->paginate(6);
        return view('front.estimate-cost', compact('products'));
    }

    public function saveEstimateCost(CreateRequest $request)
    {
        $data = $request->validated();

        $offer = Offer::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'message' => $data['message']
        ]);

        foreach ($data['items'] as $item) {
            $item['offer_id'] = $offer->id;
            OfferItem::create($item);
        }

        return redirect()->back()->withSuccess(__("estimateCost.offer-create-success"));
    }

    public function news($slug, $id)
    {
        $news = Report::with('images')->findOrFail($id);
        return view('front.news-single', compact('news'));
    }

    public function allNews()
    {
        $news = Report::with('images')->latest()->limit(8)->get();
        return view('front.news', compact('news'));
    }

    public function getNews(Request $request)
    {
        $news = Report::with('images')
            ->latest()
            ->skip($request->count)
            ->take(4)->get();

        $view = view('front.news-list', compact('news'))->render();

        return response()->json(['view' => $view]);

    }

    public function subscribeEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        EmailSubscription::create($request->only('email'));

        return redirect()->back()->withSuccess(__("front.subscribe-success.message"));
    }

    public function category($slug)
    {
        $category = Category::with('products.colors', 'products.images', 'icons')->where('slug_en', $slug)->orWhere('slug_esp', $slug)->firstOrFail();
        return view('front.category', compact('category'));
    }

    public function freeSamples()
    {
        $samples = FreeSampleBox::all();
        return view('front.free-samples', compact('samples'));
    }

    public function saveFreeSamples(FreeSamplesCreateRequest $request)
    {
        $data = $request->validated();

        $freeSample = FreeSample::create([
            "full_name" => $data["full_name"],
            "email" => $data["email"],
            "phone" => $data["phone"],
            "state" => $data["state"],
            "town" => $data['town_select'] == "Other" ? $data["town_custom"] : $data["town_select"],
            "address" => $data["address"],
            "box_id" => $data["sample_box_id"],
        ]);

        return redirect()->back()->withSuccess("Free samples request received successfully");
    }

    public function contact()
    {
        $info = ContactInfo::first();
        return view('front.contact', compact('info'));
    }

    public function saveContact(ContactCreateRequest $request)
    {
        Contact::create($request->validated());
        return redirect()->back()->withSuccess("Contact request received successfully");
    }
    // resource routes.
    public function resources()
    {
        return view('front.resources');
    }

    public function catalog()
    {
        $catalog = StaticPage::where('slug', 'catalog')->firstOrFail();
        return view('front.catalog', compact('catalog'));
    }

    public function warranties()
    {
        $page = StaticPage::where('slug', 'warranties')->firstOrFail();
        return view('front.warranties', compact('page'));
    }

    public function careAndMaintenance()
    {
        $page = StaticPage::where('slug', 'care-and-maintenance')->firstOrFail();
        return view('front.care-and-maintenance', compact('page'));
    }

    public function installationGuides()
    {
        $videos = InstallationGuide::all();
        return view('front.installation-guides', compact('videos'));
    }

    public function technicalCertificates()
    {
        $certificates = TechnicalCertificate::all();
        return view('front.technicals', compact('certificates'));
    }
}
