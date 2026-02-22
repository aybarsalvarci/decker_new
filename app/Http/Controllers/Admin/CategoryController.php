<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Services\ImageService;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CreateRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($request, &$data) {

            if ($request->hasFile('image')) {
                $data['image'] =ImageService::upload($request->file('image'), 'images/categories', 400, 'webp');
            }

            $data['slug_en'] = $request->slug_en
                ? Str::slug($request->slug_en)
                : Str::slug($request->name_en);

            $data['slug_esp'] = $request->slug_esp
                ? Str::slug($request->slug_esp)
                : Str::slug($request->name_esp);

            $category = Category::create([
                'name_en' => $data['name_en'],
                'slug_en' => $data['slug_en'],
                'description_en' => $data['description_en'] ?? null,

                'name_esp' => $data['name_esp'],
                'slug_esp' => $data['slug_esp'],
                'description_esp' => $data['description_esp'] ?? null,

                'image' => $data['image'],
            ]);

            if (!empty($request->icons)) {

                $icons = [];

                foreach ($request->icons as $icon) {
                    $icons[] = [
                        'icon' => $icon['class'],
                        'text_en' => $icon['text_en'] ?? null,
                        'text_esp' => $icon['text_esp'] ?? null,
                    ];
                }

                $category->icons()->createMany($icons);
            }
        });

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category created successfully.');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $data = $request->validated();

        DB::transaction(function () use ($request, $category, $data) {

            if ($request->hasFile('image')) {
                $data['image'] = ImageService::upload($request->file('image'), 'images/categories', 400, 'webp');

                if ($category->image && Storage::disk('public')->exists($category->image)) {
                    Storage::disk('public')->delete($category->image);
                }
            }

            $data['slug_en'] = $request->slug_en ? Str::slug($request->slug_en) : Str::slug($request->name_en);
            $data['slug_esp'] = $request->slug_esp ? Str::slug($request->slug_esp) : Str::slug($request->name_esp);

            $category->update($data);

            $category->icons()->delete();

            if ($request->has('icons') && is_array($request->icons)) {

                $formattedIcons = [];

                foreach ($request->icons as $item) {
                    $formattedIcons[] = [
                        'icon' => $item['class'],
                        'text_en' => $item['text_en'],
                        'text_esp' => $item['text_esp'],
                    ];
                }

                $category->icons()->createMany($formattedIcons);
            }
        });

        return redirect()->route('admin.category.index')
            ->with('success', 'Category updated successfully.');
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
        $category = Category::with('icons')->findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function destroy(int $id)
    {
        $category = Category::with('icons')->findOrFail($id);

        $category->icons()->delete();

        if(Storage::disk('public')->exists($category->image))
        {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.category.index')
            ->with('success', 'Category deleted successfully.');
    }
}
