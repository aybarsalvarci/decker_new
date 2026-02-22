<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechnicalCertificates\CreateRequest;
use App\Http\Requests\TechnicalCertificates\UpdateRequest;
use App\Http\Services\ImageHelper;
use App\Models\TechnicalCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TechnicalCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificates = TechnicalCertificate::all();
        return view('admin.technicalCertificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technicalCertificates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            $data['image'] = ImageHelper::uploadWithEncoding($request->file('image'), 'images/certificates', 800, "webp");
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension() ?: 'pdf';
            $fileName = Str::uuid() . "." . $extension;
            $file->storeAs('files/certificates', $fileName, 'public');
            $data['file'] = "files/certificates/" . $fileName;
        }


        TechnicalCertificate::create($data);

        return redirect()->route("admin.resources.technical-certificates.index")
            ->withSuccess("Certificate created successfully!");
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
        $technical = TechnicalCertificate::findOrFail($id);
        return view('admin.technicalCertificates.edit', compact('technical'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $certificate = TechnicalCertificate::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($certificate->image)) {
                Storage::disk('public')->delete($certificate->image);
            }

            $data['image'] = ImageHelper::uploadWithEncoding($request->file('image'), 'images/certificates', 800, "webp");
        }

        if ($request->hasFile('file')) {
            if (Storage::disk('public')->exists($certificate->file)) {
                Storage::disk('public')->delete($certificate->file);
            }

            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension() ?: 'pdf';
            $fileName = Str::uuid() . "." . $extension;
            $file->storeAs('files/certificates', $fileName, 'public');
            $data['file'] = "files/certificates/" . $fileName;
        }

        $certificate->update($data);

        return redirect()->route("admin.resources.technical-certificates.index")->withSuccess("Certificate updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $certificate = TechnicalCertificate::findOrFail($id);

        if (Storage::disk('public')->exists($certificate->file)) {
            Storage::disk('public')->delete($certificate->file);
        }

        if (Storage::disk('public')->exists($certificate->image)) {
            Storage::disk('public')->delete($certificate->image);
        }

        $certificate->delete();

        return redirect()->back()->withSuccess("Certificate deleted successfully!");
    }
}
