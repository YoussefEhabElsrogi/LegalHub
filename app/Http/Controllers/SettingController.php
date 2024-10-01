<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;

class SettingController extends Controller
{
    public function show()
    {
        $setting = Setting::first();
        return view('settings.index', compact('setting'));
    }
    public function edit()
    {
        $setting = Setting::first();
        return view('settings.edit', compact('setting'));
    }
    public function update(UpdateSettingRequest $request)
    {
        $validatedData = $request->validated();

        $setting = Setting::first();

        $setting->update($validatedData);

        setFlashMessage('success', 'تم تحديث الأعدادات بنجاح');

        return to_route('settings.index');
    }
}
