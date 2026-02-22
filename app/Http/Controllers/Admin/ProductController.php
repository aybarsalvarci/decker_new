<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Services\ImageHelper;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'mainImage'])->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $colors = ProductColor::all();
        return view('admin.product.create', compact('categories', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();

        $data['slug_en'] = $data['slug_en'] ? Str::slug($data['slug_en']) : Str::slug($data['name_en']);
        $data['slug_esp'] = $data['slug_esp'] ? Str::slug($data['slug_esp']) : Str::slug($data['name_esp']);

        if (!$data['isSized']) {
            $data['size'] = null;
            $data['actual_size'] = null;
            $data['weight'] = null;
        }

        $product = Product::create($data);

        if (isset($data['colors'])) {
            $product->colors()->sync($data['colors']);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = ImageHelper::uploadWithEncoding($image, 'images/products', 800, 'webp');

                ProductImages::create([
                    'product_id' => $product->id,
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully');
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
        $product = Product::with('category', 'colors', 'images')->findOrFail($id);
        $categories = Category::all();
        $colors = ProductColor::all();
        return view('admin.product.edit', compact('product', 'categories', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();
        $data['slug_en'] = $data['slug_en'] ? Str::slug($data['slug_en']) : Str::slug($data['name_en']);
        $data['slug_esp'] = $data['slug_esp'] ? Str::slug($data['slug_esp']) : Str::slug($data['name_esp']);

        if (!$data['isSized']) {
            $data['size'] = null;
            $data['actual_size'] = null;
            $data['weight'] = null;
        }
        if ($request->has('deleted_images')) {
            $imagesToDelete = ProductImages::whereIn('id', array_values($request->deleted_images))->get();
            foreach ($imagesToDelete as $img) {
                if (Storage::disk('public')->exists($img->image)) {
                    Storage::disk('public')->delete($img->image);
                }
                $img->delete();
            }
        }
        if ($request->has('new_images')) {
            foreach ($request->file('new_images') as $image) {
                $path = ImageHelper::uploadWithEncoding($image, 'images/products', 800, 'webp');

                ProductImages::create([
                    'product_id' => $product->id,
                    'image' => $path
                ]);
            }
        }

        $product->colors()->sync($data['colors'] ?? []);

        $product->update($data);

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        foreach($product->images as $image){
            $image->delete();
        }

        $delete = $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully');
    }
}
