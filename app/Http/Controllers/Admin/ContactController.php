<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\CreateInfoRequest;
use App\Models\Contact;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.contact.index')->with('success', 'Contact deleted successfully');
    }

    public function infos()
    {
        $contact = ContactInfo::first();
        return view('admin.contacts.infos', compact('contact'));
    }

    public function infoUpdate(CreateInfoRequest $request)
    {
        $info = ContactInfo::firstOrFail();
        $info->update($request->all());
        return redirect()->route('admin.contact.infos')->with('success', 'Contact info updated successfully');
    }
}
