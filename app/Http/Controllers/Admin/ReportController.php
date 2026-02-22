<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\CreateRequest;
use App\Http\Requests\Report\UpdateRequest;
use App\Http\Services\ImageService;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::all();
        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();

        if($request->hasFile('image')){
            $data['image'] = ImageService::upload($request->file('image'), 'images/reports', 800, 'webp');
        }

        //slug
        $data["slug_en"] = $data["slug_en"] ? Str::slug($data["slug_en"]) : Str::slug($data["title_en"]);
        $data["slug_esp"] = $data["slug_esp"] ? Str::slug($data["slug_esp"]) : Str::slug($data["title_esp"]);

        $report = Report::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = ImageService::upload($request->file('image'), 'images/reports', 800, 'webp');

                $report->images()->create([
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('admin.report.index')->with('success', 'Report created successfully.');
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
        $report = Report::With('images')->findOrFail($id);
        return view('admin.reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $report = Report::with('images')->findOrFail($id);
        $data = $request->except(['images', 'old_images']);

        // 1. Kapak Görseli Güncelleme
        if($request->hasFile('image')){
            // Eski dosyayı sil
            if($report->image && Storage::disk("public")->exists($report->image)){
                Storage::disk("public")->delete($report->image);
            }

            $imageName = Str::uuid().'.'.$request->image->getClientOriginalExtension();
            $request->image->storeAs('images', $imageName, 'public');
            $data['image'] = 'images/' . $imageName;
        }

        $oldImageIds = $request->input('old_images', []);

        $imagesToDelete = $report->images()->whereNotIn('id', $oldImageIds)->get();

        foreach ($imagesToDelete as $img) {
            if (Storage::disk("public")->exists($img->path)) {
                Storage::disk("public")->delete($img->path);
            }
            $img->delete();
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $newName = Str::uuid().'.'.$file->getClientOriginalExtension();
                $file->storeAs('reports/slider', $newName, 'public');

                $report->images()->create([
                    'path' => 'reports/slider/' . $newName
                ]);
            }
        }

        $data["slug_en"] = $request->slug_en ? Str::slug($request->slug_en) : Str::slug($request->title_en);
        $data["slug_esp"] = $request->slug_esp ? Str::slug($request->slug_esp) : Str::slug($request->title_esp);

        $report->update($data);

        return redirect()->route('admin.report.index')->with('success', 'Report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $report = Report::with('images')->findOrFail($id);

        if ($report->image && Storage::disk("public")->exists($report->image)) {
            Storage::disk("public")->delete($report->image);
        }

        foreach ($report->images as $image) {
            if ($image->path && Storage::disk("public")->exists($image->path)) {
                Storage::disk("public")->delete($image->path);
            }
            $image->delete();
        }

        $report->delete();

        return redirect()->route('admin.report.index')->with('success', 'Report and all associated images deleted successfully.');
    }

    public function uploadImage(Request $request)
    {
        if($request->hasFile('image')) {
            $image = ImageService::upload($request->file('image'), 'images/reports/content', 800, 'webp');

            return response()->json([
                "url" => asset('storage/' . $image)
            ]);
        }
    }

    public function deleteImage(Request $request)
    {
        $src = $request->src;
        $path = str_replace(asset('storage/'), '', $src);

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return response()->json(['success' => true]);
        }
    }
}
