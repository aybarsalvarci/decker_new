<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductColor\CreateRequest;
use App\Http\Requests\ProductColor\UpdateRequest;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productColors = ProductColor::all();
        return view('admin.product-color.index', compact('productColors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product-color.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();

        if($request->hasFile('image')){
            $imageName = Str::uuid().'.'.$request->image->getClientOriginalExtension();
            $request->image->storeAs('images', $imageName, 'public');
            $data['image'] = 'images/' . $imageName;
        }

        ProductColor::create($data);

        return redirect()->route('admin.product-color.index')->with('success', 'Product color added successfully.');
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
        $color = ProductColor::findOrFail($id);
        return view('admin.product-color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $color = ProductColor::findOrFail($id);
        $data = $request->validated();

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($color->image)){
                Storage::disk('public')->delete($color->image);
            }

            $imageName = Str::uuid().'.'.$request->image->getClientOriginalExtension();
            $request->image->storeAs('images', $imageName, 'public');
            $data['image'] = 'images/' . $imageName;
        }

        $color->update($data);

        return redirect()->route('admin.product-color.index')->with('success', 'Product color updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $color = ProductColor::findOrFail($id);

        $delete = $color->delete();

        if($delete){
            if(Storage::disk('public')->exists($color->image)){
                Storage::disk('public')->delete($color->image);
            }
        }

        return redirect()->route('admin.product-color.index')->with('success', 'Product color deleted successfully.');
    }
}
