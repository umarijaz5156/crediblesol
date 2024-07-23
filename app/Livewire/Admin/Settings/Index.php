<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{

    public $adminEmail;
    public $orange_money_idType;
    public $orange_money_id;
    public $orange_money_pin;

    public $commissionPercentage = 0;

    public $numberOfDaysHoldPayment;


    public function mount(){
        $settings = Setting::whereIn('key', ['commission_percentage','days_hold_payment'])
        ->pluck('value', 'key')
        ->all();

        $this->commissionPercentage = $settings['commission_percentage'] ?? '';
        $this->numberOfDaysHoldPayment = $settings['days_hold_payment'] ?? '';

    }

    #[Layout('layouts.app')]
    public function render()
    {
        $settings = Setting::whereIn('key', ['orange_money_idType','orange_money_id','orange_money_pin', 'admin_email'])
        ->pluck('value', 'key')
        ->all();

        $this->adminEmail = $settings['admin_email'] ?? '';
        $this->orange_money_idType = $settings['orange_money_idType'] ?? '';
        $this->orange_money_id = $settings['orange_money_id'] ?? '';
        $this->orange_money_pin = $settings['orange_money_pin'] ?? '';


        return view('livewire.admin.settings.index');
    }


    public function saveInfo()
    {
        $this->validate([
            'commissionPercentage' => ['required', 'numeric', 'between:0,100'],
        ]);

        Setting::updateOrCreate(['key' => 'commission_percentage'], ['value' => $this->commissionPercentage]);
        
        return redirect()->route('admin.settings')->with('success', 'Commission percentage saved successfully.');
    }


    public function saveHoldPayment()
    {
        $this->validate([
            'numberOfDaysHoldPayment' => ['required', 'numeric', 'between:0,100'],
        ]);

        Setting::updateOrCreate(['key' => 'days_hold_payment'], ['value' => $this->numberOfDaysHoldPayment]);
        
        return redirect()->route('admin.settings')->with('success', 'Action performed successfully.');
    }
    

    public function saveAdminEmail()
    {
        $this->validate([
            'adminEmail' => 'required|email'
        ]);

        $settings = Setting::updateOrCreate(['key' => 'admin_email'], ['value' => $this->adminEmail]);
        return redirect()->route('admin.settings')->with('success', 'Admin email saved successfully.');
    }

    public function saveOrangeMoneyInfo()
    {
        $this->validate([
            'orange_money_idType' => 'required|min:3|max:10',
            'orange_money_id' => 'required|min:9|max:9',
            'orange_money_pin' => 'required|min:3|max:10',
        ]);

        $settings = Setting::updateOrCreate(['key' => 'orange_money_idType'], ['value' => $this->orange_money_idType]);
        $settings = Setting::updateOrCreate(['key' => 'orange_money_id'], ['value' => $this->orange_money_id]);
        $settings = Setting::updateOrCreate(['key' => 'orange_money_pin'], ['value' => $this->orange_money_pin]);

        return redirect()->route('admin.settings')->with('success', 'Information of Orange Money saved successfully.');
    }

    
}
