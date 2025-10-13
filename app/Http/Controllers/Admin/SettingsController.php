<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $groups = Setting::select('group')
            ->distinct()
            ->orderBy('group')
            ->pluck('group');

        $settings = [];
        foreach ($groups as $group) {
            $settings[$group] = Setting::getByGroup($group);
        }

        return view('admin.settings.index', compact('settings', 'groups'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable'
        ]);

        DB::beginTransaction();
        
        try {
            foreach ($request->settings as $key => $value) {
                if ($value !== null) {
                    Setting::set($key, $value);
                }
            }

            // Clear all settings cache
            Setting::clearCache();

            DB::commit();

            return redirect()->route('admin.settings.index')
                ->with('success', 'Settings updated successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->route('admin.settings.index')
                ->with('error', 'Failed to update settings: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new setting.
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created setting.
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:settings,key',
            'value' => 'nullable|string',
            'type' => 'required|in:text,textarea,image,boolean,number',
            'group' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        Setting::create($request->all());

        // Clear cache
        Setting::clearCache();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting created successfully!');
    }

    /**
     * Show the form for editing a setting.
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update a specific setting.
     */
    public function updateSetting(Request $request, Setting $setting)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:settings,key,' . $setting->id,
            'value' => 'nullable|string',
            'type' => 'required|in:text,textarea,image,boolean,number',
            'group' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        $setting->update($request->all());

        // Clear cache
        Setting::clearCache();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting updated successfully!');
    }

    /**
     * Remove a setting.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        // Clear cache
        Setting::clearCache();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting deleted successfully!');
    }
}
