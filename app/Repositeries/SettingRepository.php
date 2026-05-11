<?php

namespace App\Repositeries;

use App\Interfaces\CommonInterface;
use App\Models\Setting;

class SettingRepository implements CommonInterface
{
    public function getAll()
    {
        return Setting::all();
    }

    public function getFirst()
    {
        return Setting::first();
    }

    public function create(array $details)
    {
        return Setting::create($details);
    }

    public function update($id, array $details)
    {
        $setting = Setting::findOrFail($id);
        $setting->update($details);
        return $setting;
    }

    public function delete($id)
    {
        $setting = Setting::findOrFail($id);
        $setting->delete();
        return true;
    }

    public function show($id)
    {
        return Setting::findOrFail($id);
    }

    public function findById($id)
    {
        return Setting::find($id);
    }
}
