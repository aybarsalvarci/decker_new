<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FreeSample;
use Illuminate\Http\Request;

class FreeSampleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $freeSamples = FreeSample::with('box')
            ->latest()
            ->get();

        return view('admin.freeSamples.index', compact('freeSamples'));
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
        $sample = FreeSample::with('box')->findOrFail($id);
        return view('admin.freeSamples.show', compact('sample'));
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
        $sample = FreeSample::findOrFail($id);
        $sample->delete();
        return redirect()->route('admin.free-sample.index')->withSuccess("Sample deleted successfully!");
    }
}
