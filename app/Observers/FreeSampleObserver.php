<?php

namespace App\Observers;

use App\Mail\NewFreeSampleRequestMail;
use App\Models\FreeSample;
use Illuminate\Support\Facades\Mail;

class FreeSampleObserver
{
    /**
     * Handle the FreeSample "created" event.
     */
    public function created(FreeSample $freeSample): void
    {
        if(!is_null(config('mail.from.address')) && !is_null(config('settings.mail'))){
            $freeSample->load('box');
            Mail::to(config('settings.mail'))->send(new NewFreeSampleRequestMail($freeSample));
        }
    }

    /**
     * Handle the FreeSample "updated" event.
     */
    public function updated(FreeSample $freeSample): void
    {
        //
    }

    /**
     * Handle the FreeSample "deleted" event.
     */
    public function deleted(FreeSample $freeSample): void
    {
        //
    }

    /**
     * Handle the FreeSample "restored" event.
     */
    public function restored(FreeSample $freeSample): void
    {
        //
    }

    /**
     * Handle the FreeSample "force deleted" event.
     */
    public function forceDeleted(FreeSample $freeSample): void
    {
        //
    }
}
