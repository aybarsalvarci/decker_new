<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mail\SendNewslaterRequest;
use App\Jobs\SendNewsletterJob;
use App\Mail\NewslaterMail;
use App\Models\EmailSubscription;
use App\Models\SentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SentMailController extends Controller
{
    public function index()
    {
        $mails = SentMail::all();
        return view('admin.email_subscription.sentMail', compact('mails'));
    }

    public function destroy(int $id)
    {
        $mail = SentMail::findOrFail($id);
        $mail->delete();
        return redirect()->route('admin.sent-mail.index')->with('success', 'Mail deleted successfully');
    }

    public function sendPage()
    {
        return view('admin.email_subscription.sendMailPage');
    }

    public function send(SendNewslaterRequest $request)
    {
        SentMail::create($request->validated());

        SendNewsletterJob::dispatch($request->validated());
        return redirect()->route('admin.sent-mail.index')->with('success', 'Newsletter queued to be sent.');
    }
}
