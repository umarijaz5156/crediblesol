<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;
use Livewire\Attributes\Layout;

class CommissionPercentage extends Component
{

    public $commissionPercentage = 0;

    public function mount(){
        $settings = Setting::whereIn('key', ['commission_percentage'])
        ->pluck('value', 'key')
        ->all();

        $this->commissionPercentage = $settings['commission_percentage'] ?? '';
    }

    public function saveInfo()
    {
        $this->validate([
            'commissionPercentage' => ['required', 'numeric', 'between:0,100'],
        ]);

        Setting::updateOrCreate(['key' => 'commission_percentage'], ['value' => $this->commissionPercentage]);

        session()->flash('success', 'Commission percentage saved successfully.');
    }

    #[Layout('layouts.app')]

    public function render()
    {
        return view('livewire.admin.commission-percentage');
    }
}
