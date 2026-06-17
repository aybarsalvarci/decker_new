<?php

namespace App\Observers;

use App\Mail\NewOfferMail;
use App\Models\Offer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OfferObserver
{
    public $afterCommit = true;

    /**
     * Handle the Offer "created" event.
     */
    public function created(Offer $offer): void
    {
        Log::info("Offer created");

        if(!is_null(config('mail.from.address')) && !is_null(config('settings.email'))){

            Log::info("Offer maild sending");

            $offer->load('items.product.mainImage');
            Mail::to(config('settings.email'))->send(new NewOfferMail($offer));
        }
    }

    /**
     * Handle the Offer "updated" event.
     */
    public function updated(Offer $offer): void
    {
        //
    }

    /**
     * Handle the Offer "deleted" event.
     */
    public function deleted(Offer $offer): void
    {
        //
    }

    /**
     * Handle the Offer "restored" event.
     */
    public function restored(Offer $offer): void
    {
        //
    }

    /**
     * Handle the Offer "force deleted" event.
     */
    public function forceDeleted(Offer $offer): void
    {
        //
    }
}
