<?php

namespace App\Jobs;

use App\Mail\NewslaterMail;
use App\Models\EmailSubscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendNewsletterJob implements ShouldQueue
{
    use Queueable;

    public $tries = 3;

    public $backoff = 60;

    private array $data;
    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $content = $this->data['message'];

        $fullContent = str_replace('src="/', 'src="' . config('app.url') . '/', $content);
        $this->data['message'] = $fullContent;

        EmailSubscription::chunk(100, function ($subs) {
            foreach ($subs as $sub) {
                try {
                    $individualData = $this->data;
                    $individualData['email'] = $sub->email;
                    Mail::to($sub->email)->queue(new NewslaterMail($individualData));
                }
                catch (\Exception $e) {
                    Log::error("Send mail error: {$e->getMessage()}");
                }
            }
        });
    }
}
