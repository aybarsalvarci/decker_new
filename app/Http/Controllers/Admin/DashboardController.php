<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailSubscription;
use App\Models\FreeSample;
use App\Models\Offer;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'productsCount' => Product::count(),
            'offersCount'   => Offer::count(),
            'samplesCount'  => FreeSample::count(),
            'subscribersCount' => EmailSubscription::count(),
            'latestOffers'  => Offer::with('items.product.mainImage')->latest()->take(5)->get(),
            'latestProducts'=> Product::with('category', 'mainImage')->latest()->take(4)->get(),
        ]);
    }
}
