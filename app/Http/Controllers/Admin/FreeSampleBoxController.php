<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SampleBox\CreateRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\SampleBox\UpdateRequest;
use App\Http\Services\ImageService;
use App\Models\FreeSampleBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FreeSampleBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boxes = FreeSampleBox::all();
        return view('admin.sampleBoxes.index', compact('boxes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sampleBoxes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();

        if (request()->hasFile('image')) {
            $data['image'] = ImageService::upload(request()->file('image'), 'images/freeSampleBox', 800, 'webp');
        }

        FreeSampleBox::create($data);
        return redirect()->route('admin.free-sample.box.index')->withSuccess("Sample Box Created Successfully");

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
        $box = FreeSampleBox::findOrFail($id);
        return view('admin.sampleBoxes.edit', compact('box'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $box = FreeSampleBox::findOrFail($id);
        $data = $request->validated();

        if (request()->hasFile('image')) {
            if (Storage::disk('public')->exists($box->image)) {
                Storage::disk('public')->delete($box->image);
            }

            $data['image'] = ImageService::upload(request()->file('image'), 'images/freeSampleBox', 800, 'webp');
        }

        $box->update($data);

        return redirect()->route('admin.free-sample.box.index')->withSuccess("Sample Box Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $box = FreeSampleBox::findOrFail($id);
        if (Storage::disk('public')->exists($box->image)) {
            Storage::disk('public')->delete($box->image);
        }

        $box->delete();

        return redirect()->route('admin.free-sample.box.index')->withSuccess("Sample Box Deleted Successfully");
    }
}
