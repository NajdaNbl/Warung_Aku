<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'store_name' => Setting::getValue('store_name', 'Warung Aku'),
            'wa_number' => Setting::getValue('wa_number', '621235331414'),
            'wa_api_key' => Setting::getValue('wa_api_key', ''),
            'wa_api_url' => Setting::getValue('wa_api_url', 'https://api.fonnte.com/send'),
            'address' => Setting::getValue('address', ''),
            'operational_hours' => Setting::getValue('operational_hours', '08.00 - 21.00'),
            'description' => Setting::getValue('description', 'Warung Aku adalah warung sembako yang menyediakan kebutuhan harian dengan harga bersahabat.'),
            'logo' => Setting::getValue('logo', ''),
            'banner' => Setting::getValue('banner', ''),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'store_name' => 'required|max:255',
            'wa_number' => 'required|max:20',
            'wa_api_key' => 'nullable|max:255',
            'wa_api_url' => 'nullable|url|max:255',
            'address' => 'nullable',
            'operational_hours' => 'nullable|max:255',
            'description' => 'nullable',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        foreach ($data as $key => $value) {
            if (in_array($key, ['logo', 'banner'])) {
                if ($request->hasFile($key)) {
                    $value = $request->file($key)->store('settings', 'public');
                    Setting::setValue($key, $value);
                }
            } else {
                Setting::setValue($key, $value);
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui');
    }
}
