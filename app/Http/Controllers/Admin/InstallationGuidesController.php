<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\InstallationGuides\UpdateRequest;
use App\Http\Services\ImageService;
use App\Models\StaticPage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InstallationGuidesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $installationGuide = StaticPage::firstOrCreate(
            ['slug' => 'installation-guide'],
            [
                'title_en' => 'Installation Guides',
                'title_esp' => 'Guías de instalación',
            ]
        );

        return view('admin.resources.installation_guides', compact('installationGuide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request)
    {
        $installationGuide = StaticPage::where('slug', 'installation-guide')->firstOrFail();
        $data = $request->safe()->except('file');

        if ($request->hasFile('file') && !is_null($installationGuide->file)) {
            if (Storage::disk('public')->exists($installationGuide->file)) {
                Storage::disk('public')->delete($installationGuide->file);
            }

            $fileName = "catalog" . Str::uuid() . "." . $request->file->extension();
            $data['file'] = $request->file->storeAs('documents', $fileName, 'public');
        }

        $installationGuide->update($data);

        return redirect()->back()->withSuccess("Installation guide updated successfully");
    }

}
