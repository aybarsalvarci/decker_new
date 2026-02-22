<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\UpdateRequest;
use App\Http\Services\ImageHelper;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::firstOrCreate(['id' => 1]);

        return view("admin.settings.index", compact("settings"));
    }

    public function update(UpdateRequest $request)
    {
        $settings = Setting::findOrFail(1);

        $data = $request->safe()->except(['header_logo', 'footer_logo', 'favicon']);

        if ($request->hasFile('header_logo')) {
            if ($settings->logo && Storage::disk("public")->exists($settings->header_logo)) {
                Storage::disk("public")->delete($settings->header_logo);
            }

            $data['header_logo'] = ImageHelper::uploadWithEncoding($request->file('header_logo'), 'images/settings', 400, "webp");
        }

        if ($request->hasFile('footer_logo')) {
            if ($settings->logo && Storage::disk("public")->exists($settings->footer_logo)) {
                Storage::disk("public")->delete($settings->footer_logo);
            }

            $data['footer_logo'] = ImageHelper::uploadWithEncoding($request->file('footer_logo'), 'images/settings', 400, "webp");
        }

        if ($request->hasFile('favicon')) {
            if ($settings->favicon && Storage::disk("public")->exists($settings->favicon)) {
                Storage::disk("public")->delete($settings->favicon);
            }

            $fileName = Str::uuid() . '.' . $request->file('favicon')->getClientOriginalExtension();
            $request->file('favicon')->storeAs('settings', $fileName, 'public');

            $data['favicon'] = ImageHelper::uploadWithoutEncoding($request->file('favicon'), 'images/settings', 100);
        }

        $settings->update($data);

        Cache::forget('app_settings');

        return redirect()->route('admin.setting.index')->with('success', "Settings updated successfully");
    }
}
