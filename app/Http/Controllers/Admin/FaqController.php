<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\CreateFaqRequest;
use App\Http\Requests\Faq\UpdateFaqRequest;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateFaqRequest $request)
    {
        Faq::create($request->validated());
        return redirect()->route('admin.faqs.index')->with('success', 'Faq created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $request, string $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->update($request->validated());
        return redirect()->route('admin.faqs.index')->with('success', 'Faq updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'Faq deleted successfully');
    }
}
