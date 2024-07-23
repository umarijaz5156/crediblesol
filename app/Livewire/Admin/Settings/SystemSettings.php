<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SystemSettings extends Component
{
    use WithFileUploads;

    public array $zones_array;
    public $logoPrev, $favIconPrev;
    public $app_logo, $app_favicon, $site_name, $site_title, $meta_title, $meta_description, $currency, $language, $timezone;

    public function mount()
    {
        $this->getSettings();

        $zones_array = array();
        $timestamp = time();
        foreach (timezone_identifiers_list() as $key => $zone) {
            date_default_timezone_set($zone);
            $zones_array[$key]['zone'] = $zone;
            $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
            $zones_array[$key]['label'] = $zones_array[$key]['diff_from_GMT'] . ' - ' . $zones_array[$key]['zone'];
        }
        $this->zones_array = $zones_array;
    }

    public function getSettings()
    {
        $settings = Setting::pluck('value', 'key')->all(); //whereIn('key', ['edit_review_par_day', 'admin_email'])->

        $this->logoPrev = $settings['app_logo'] ?? null;
        $this->favIconPrev = $settings['app_favicon'] ?? null;
        $this->site_name = $settings['site_name'] ?? null;
        $this->site_title = $settings['site_title'] ?? null;
        $this->meta_title = $settings['meta_title'] ?? null;
        $this->meta_description = $settings['meta_description'] ?? null;
        $this->currency = $settings['currency'] ?? null;
        $this->language = $settings['language'] ?? null;
        $this->timezone = $settings['timezone'] ?? null;
    }

    public function saveSettings()
    {
        $this->validate([
            'app_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'app_favicon' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'site_name' => 'nullable|string|min:3|max:255',
            'site_title' => 'nullable|string|min:3|max:255',
            'meta_title' => 'nullable|string|min:3|max:255',
            'meta_description' => 'nullable|string|min:3|max:300',
            'currency' => 'nullable',
            'language' => 'nullable',
            'timezone' => 'nullable'
        ]);

        $fields = [
            'app_logo' => $this->app_logo,
            'app_favicon' => $this->app_favicon,
            'site_name' => $this->site_name,
            'site_title' => $this->site_title,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'currency' => $this->currency,
            'language' => $this->language,
            'timezone' => $this->timezone
        ];

        foreach ($fields as $key => $value) {
            $settings = Setting::where('key', $key)->first();

            if ($key == 'app_logo') {
                
                if (is_null($value) || ($settings && ('images/' . $value->getClientOriginalName() == $settings->value))) {
                    continue;
                }

                //delete previous image from storage folder
                if ($settings && $settings['app_logo']) {
                    Storage::disk('public')->delete($settings['app_logo']);
                }

                //save new logo in the storage
                $logo_extension = $value->getClientOriginalExtension();
                $logoName = 'logo_' . time() . '.' . $logo_extension;
                // $logoName = time() . "_" . $value->getClientOriginalName();
                $value = $value->storeAs('images', $logoName, 'public');
            }

            if ($key == 'app_favicon') {
                if (is_null($value) || ($settings && ('images/' . $value->getClientOriginalName() == $settings->value))) {
                    continue;
                }

                //delete previous image from storage folder
                if ($settings && $settings['app_favicon']) {
                    Storage::disk('public')->delete($settings['app_favicon']);
                }

                $favicon_extension = $value->getClientOriginalExtension();
                $faviconName = 'favicon_' . time() . '.' . $favicon_extension;
                // $faviconName = time() . "_" . $value->getClientOriginalName();
                $value = $value->storeAs('images', $faviconName, 'public');
            }

            if ($key == 'timezone' && !empty($value)) {
                Config::set('app.timezone', $value);
            }

            if (!$settings) {
                $settings = new Setting();
                $settings->key = $key;
            }
            $settings->value = $value;
            $settings->save();

        }

        // $this->reset('app_logo', 'app_favicon', 'site_name', 'site_title', 'meta_title', 'meta_description', 'currency', 'language', 'timezone');
        return redirect()->route('admin.settings')->with('success', 'Settings saved successfully');
    }

    public function render()
    {
        return view('livewire.admin.settings.system-settings');
    }
}
