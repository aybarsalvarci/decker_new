<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutFactoryController extends Controller
{
    public function store(Request $request)
    {
        // Validasyon: İki resmi de kontrol ediyoruz
        $request->validate([
            'image1'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3072', // İlk resim zorunlu olsun
            'image2'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3072', // İkinci resim zorunlu olsun
            'title_en' => 'required',
        ]);

        $data = $request->except(['image1', 'image2', '_token']);

        if ($request->hasFile('image1')) {
            $fileName1 = Str::uuid() . "." . $request->image1->extension();
            $data['image1'] = $request->file('image1')->storeAs('about-factory', $fileName1, 'public');
        }

        if ($request->hasFile('image2')) {
            $fileName2 = Str::uuid() . "." . $request->image2->extension();
            $data['image2'] = $request->file('image2')->storeAs('about-factory', $fileName2, 'public');
        }

        AboutFactory::create($data);

        return redirect()->back()->with('success', 'Factory facility added successfully.');
    }

    public function update(Request $request, $id)
    {
        $factory = AboutFactory::findOrFail($id);

        $request->validate([
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3072',
        ]);

        $data = $request->except(['image1', 'image2', '_token', '_method']);

        if ($request->hasFile('image1')) {
            if ($factory->image1 && Storage::disk('public')->exists($factory->image1)) {
                Storage::disk('public')->delete($factory->image1);
            }
            $fileName1 = Str::uuid() . "." . $request->image1->extension();
            $data['image1'] = $request->file('image1')->storeAs('about-factory', $fileName1, 'public');
        }

        if ($request->hasFile('image2')) {
            if ($factory->image2 && Storage::disk('public')->exists($factory->image2)) {
                Storage::disk('public')->delete($factory->image2);
            }
            $fileName2 = Str::uuid() . "." . $request->image2->extension();
            $data['image2'] = $request->file('image2')->storeAs('about-factory', $fileName2, 'public');
        }

        $factory->update($data);

        return redirect()->back()->with('success', 'Factory facility updated successfully.');
    }

    public function destroy($id)
    {
        $factory = AboutFactory::findOrFail($id);

        if ($factory->image1 && Storage::disk('public')->exists($factory->image1)) {
            Storage::disk('public')->delete($factory->image1);
        }

        if ($factory->image2 && Storage::disk('public')->exists($factory->image2)) {
            Storage::disk('public')->delete($factory->image2);
        }

        $factory->delete();

        return redirect()->back()->with('success', 'Factory facility deleted successfully.');
    }
}
