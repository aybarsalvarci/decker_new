<?php

namespace App\Observers;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactObserver
{
    /**
     * Handle the Contact "created" event.
     */
    public function created(Contact $contact): void
    {
        Log::info("İletişim mesajı kaydedildi");

        if (!is_null(config('mail.from.address')) && !is_null(config('settings.mail'))) {
            Log::info("Contact email sending");
            Mail::from(config('mail.from.address'))->to(config('settings.mail'))->send(new ContactMail($contact));
        }
    }

    /**
     * Handle the Contact "updated" event.
     */
    public function updated(Contact $contact): void
    {
        //
    }

    /**
     * Handle the Contact "deleted" event.
     */
    public function deleted(Contact $contact): void
    {
        //
    }

    /**
     * Handle the Contact "restored" event.
     */
    public function restored(Contact $contact): void
    {
        //
    }

    /**
     * Handle the Contact "force deleted" event.
     */
    public function forceDeleted(Contact $contact): void
    {
        //
    }
}
