<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\ImageService;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleryItems = Gallery::orderBy('created_at', 'DESC')->paginate(12);
        return view('admin.gallery.index', compact('galleryItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        foreach($request->images as $file)
        {
            $path = ImageService::upload($file, 'images/about-factory', 800, 'webp');
            Gallery::create(['path' => $path]);
        }

        return redirect()->route('admin.resources.gallery.index');
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
        $item = Gallery::findOrFail($id);

        if(Storage::disk('public')->exists($item->path))
        {
            Storage::disk('public')->delete($item->path);
        }
        $item->delete();

        return redirect()->back()->withSuccess("The gallery item has been deleted");
    }

}
