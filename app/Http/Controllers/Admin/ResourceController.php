<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\UpdateCareAndMaintenanceRequest;
use App\Http\Requests\Resources\UpdateCatalogRequest;
use App\Http\Requests\Resources\UpdateWarrantiesRequest;
use App\Models\InstallationGuide;
use App\Models\StaticPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\NoReturn;

class ResourceController extends Controller
{
    public function catalog()
    {
        $catalog = StaticPage::where('slug', 'catalog')->firstOrFail();
        return view('admin.resources.catalog', compact('catalog'));
    }

    public function updateCatalog(UpdateCatalogRequest $request)
    {
        $catalog = StaticPage::where('slug', 'catalog')->firstOrFail();
        $data = $request->validated();

        if ($request->hasFile('file')) {
            if (Storage::disk('public')->exists($catalog->file)) {
                Storage::disk('public')->delete($catalog->file);
            }

            $fileName = "catalog" . Str::uuid() . "." . $request->file->extension();
            $data['file'] = $request->file->storeAs('documents', $fileName, 'public');

        }
        $catalog->update($data);

        return redirect()->back()->withSuccess("Catalog updated successfully");
    }

    public function warranties()
    {
        $page = StaticPage::firstOrCreate(
            ['slug' => 'warranties'],
            [
                'title_en' => 'Warranty & Registration',
                'title_esp' => 'Garantía y Registro',
                'content_en' => '<p>Warranty content goes here...</p>',
                'content_esp' => '<p>Contenido de la garantía aquí...</p>',
            ]
        );

        return view('admin.resources.warranties', compact('page'));
    }

    public function updateWarranties(UpdateWarrantiesRequest $request)
    {
        $page = StaticPage::firstOrCreate(['slug' => 'warranties']);

        $page->update($request->validated());

        return redirect()->back()->withSuccess("Warranties page updated successfully.");
    }

    public function careAndMaintenance()
    {
        $page = StaticPage::where('slug', 'care-and-maintenance')->firstOrFail();
        return view('admin.resources.care-and-maintenance', compact('page'));
    }

    public function updateCareAndMaintenance(UpdateCareAndMaintenanceRequest $request)
    {
        $page = StaticPage::where('slug', 'care-and-maintenance')->firstOrFail();
        $page->update($request->validated());

        return redirect()->back()->withSuccess("Care and maintenance updated successfully");
    }
}
