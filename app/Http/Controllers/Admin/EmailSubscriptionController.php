<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailSubscriptions\CreateRequest;
use App\Http\Requests\EmailSubscriptions\UpdateRequest;
use App\Models\EmailSubscription;
use Illuminate\Http\Request;

class EmailSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subs = EmailSubscription::all();
        return view('admin.email_subscription.index', compact('subs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.email_subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();
        EmailSubscription::create($data);
        return redirect()->route('admin.email-subscription.index')->with('success', 'Email Subscription created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sub = EmailSubscription::findOrFail($id);
        return view('admin.email_subscription.edit', compact('sub'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $sub = EmailSubscription::findOrFail($id);
        $data = $request->validated();
        $sub->update($data);
        return redirect()->route('admin.email-subscription.index')->with('success', 'Email Subscription updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sub = EmailSubscription::findOrFail($id);
        $sub->delete();
        return redirect()->route('admin.email-subscription.index')->with('success', 'Email Subscription deleted successfully');
    }

    public function unsubscribe(string $email)
    {
        $decodedEmail = base64_decode($email);

        $sub = EmailSubscription::where('email', $decodedEmail)->first();
        if ($sub) {
            $sub->delete();
            return "deleted successfully";
        }

        return "geçersiz istek veya email aboneliği zaten iptal edilmiş.";
    }
}
