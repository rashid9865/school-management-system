<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositeries\SettingRepository;

class SettingsController extends Controller
{
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function index()
    {
        $setting = $this->settingRepository->getFirst();
        return view('users.admin.settings', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'school_name' => 'nullable|string|max:255',
            'school_email' => 'nullable|email|max:255',
            'school_phone' => 'nullable|string|max:50',
            'school_address' => 'nullable|string|max:2000',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $setting = $this->settingRepository->getFirst();
        $data = [
            'school_name' => $request->school_name,
            'school_email' => $request->school_email,
            'school_phone' => $request->school_phone,
            'school_address' => $request->school_address,
        ];

        if ($request->hasFile('logo_path')) {
            if ($setting && $setting->logo_path && Storage::disk('public')->exists($setting->logo_path)) {
                Storage::disk('public')->delete($setting->logo_path);
            }
            $data['logo_path'] = $request->file('logo_path')->store('settings', 'public');
        }

        if ($setting) {
            $this->settingRepository->update($setting->id, $data);
        } else {
            $this->settingRepository->create($data);
        }

        return redirect()->route('admin.settings.index')->with('success', 'School settings saved successfully.');
    }
}
