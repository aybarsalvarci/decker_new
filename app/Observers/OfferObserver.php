<?php

namespace App\Observers;

use App\Mail\NewOfferMail;
use App\Models\Offer;
use Illuminate\Support\Facades\Mail;

class OfferObserver
{
    public $afterCommit = true;

    /**
     * Handle the Offer "created" event.
     */
    public function created(Offer $offer): void
    {
        if(!is_null(config('mail.from.address')) && !is_null(config('settings.mail'))){
            $offer->load('items.product.mainImage');
            Mail::to(config('settings.mail'))->send(new NewOfferMail($offer));
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
