<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\CreateInfoRequest;
use App\Http\Services\ImageService;
use App\Models\Contact;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $data = $request->except('hero_image');


        if ($request->hasFile('hero_image')) {
            if(!is_null($info->hero_image) && Storage::disk('public')->exists($info->hero_image)){
                Storage::disk('public')->delete($info->hero_image);
            }

            $data['hero_image'] = ImageService::upload($request->file('hero_image'), 'images/products', width: 1600, format: 'webp');
        }

        $info->update($data);
        return redirect()->route('admin.contact.infos')->with('success', 'Contact info updated successfully');
    }
}
