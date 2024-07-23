<?php

namespace App\Livewire\Admin;

use App\Models\SellerAccount;
use App\Models\Setting;
use Livewire\Attributes\Layout;

use Livewire\Component;

class FeatureSellers extends Component
{

    #[Layout('layouts.app')]

    public $featureSellers = [];
    public $selectedSellers = [];
    public function render()
    {
        return view('livewire.admin.feature-sellers');
    }

    public function mount()
    {
        $this->featureSellers = SellerAccount::where('is_approved', true)
        ->orderBy('username', 'asc')
        ->get();

        $setting = Setting::where('key', 'feature_sellers')->first();
        if ($setting) {
            $this->selectedSellers = json_decode($setting->value);
        }
    }

    public function saveSelectedSellers(){
        $key = 'feature_sellers';
        $value = json_encode($this->selectedSellers);
        $setting = Setting::where('key', $key)->first();
    
        if ($setting) {
            $setting->update(['value' => $value]);
        } else {
            Setting::create(['key' => $key, 'value' => $value]);
        }
        return redirect()->route('admin.feature.sellers')->with('success', 'Action performed successfully.');

    }
 
    protected $listeners = ['updateSelectedSellers'];

    public function updateSelectedSellers($selectedSellers)
    {
        $this->selectedSellers = $selectedSellers;
    }
}
