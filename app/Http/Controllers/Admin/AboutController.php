<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\About\UpdateAboutRequest;
use App\Http\Services\ImageService;
use App\Models\About;
use App\Models\AboutFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    /**
     * Display the editing form.
     */
    public function index()
    {
        $about = About::firstOrCreate(['id' => 1]);

        $factories = AboutFactory::orderBy('order', 'asc')->get();

        return view('admin.about.index', compact('about', 'factories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAboutRequest $request, string $id)
    {
        $about = About::findOrFail($id);

        $data = $request->safe()->except(['story_image']);

        if ($request->hasFile('story_image')) {
            if ($about->story_image && Storage::disk('public')->exists($about->story_image)) {
                Storage::disk('public')->delete($about->story_image);
            }

            $data['story_image'] = ImageService::upload(request()->file('story_image'), 'images/about', 800, 'webp');
        }

        $about->update($data);

        return redirect()->back()->with('success', 'About page main sections updated successfully.');
    }
}
