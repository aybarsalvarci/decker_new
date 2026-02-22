<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomePage\UpdateRequest;
use App\Models\HomePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomePageController extends Controller
{
    public function index()
    {
        $settings = HomePage::firstOrFail();
        return view('admin.homePage.index', compact('settings'));
    }

    public function update(UpdateRequest $request)
    {
        $data = $request->validated();
        $homePage = HomePage::firstOrFail();

        if($request->hasFile('topVideo')){
            if(Storage::disk('public')->exists($homePage->topVideo)){
                Storage::disk('public')->delete($homePage->topVideo);
            }

            $fileName = Str::uuid() . '.' . $request->file('topVideo')->extension();
            $request->file('topVideo')->storeAs('videos', $fileName, 'public');
            $data['topVideo'] = 'videos/' . $fileName;
        }

        $homePage->update($data);
        return redirect()->route('admin.home-settings.index')->with('success', 'Home Page Updated Successfully');
    }
}
