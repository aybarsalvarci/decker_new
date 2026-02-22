<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\InstallationGuides\CreateRequest;
use App\Http\Requests\Resources\InstallationGuides\UpdateRequest;
use App\Models\InstallationGuide;
use Illuminate\Http\Request;

class InstallationGuidesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = InstallationGuide::all();
        return view('admin.resources.installation_guides.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.resources.installation_guides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        InstallationGuide::create($request->validated());
        return redirect()->route('admin.resources.installation-guides.index')
            ->with('success', 'Installation Guide created successfully.');
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
        $video = InstallationGuide::findOrFail($id);
        return view('admin.resources.installation_guides.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $video = InstallationGuide::findOrFail($id);
        $video->update($request->validated());
        return redirect()->route('admin.resources.installation-guides.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $video = InstallationGuide::findOrFail($id);
        $video->delete();
        return redirect()->route('admin.resources.installation-guides.index');
    }
}
