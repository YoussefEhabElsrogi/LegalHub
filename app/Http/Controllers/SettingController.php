<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    protected $setting;

    public function __construct()
    {
        $this->setting = Setting::first();
    }

    public function show()
    {
        return view('settings.show', ['setting' => $this->setting]);
    }

    public function edit()
    {
        return view('settings.edit', ['setting' => $this->setting]);
    }

    public function update(UpdateSettingRequest $request)
    {
        $validatedData = $request->validated();

        $this->setting->update($validatedData);

        setFlashMessage('success', 'تم تحديث الأعدادات بنجاح');

        return Redirect::route('settings.show');
    }
}
