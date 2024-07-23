<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;

class PaymentGateway extends Component
{
    public  $pay_tech_api_key,$pay_tech_secret_key;

    public function mount()
    {
        $this->pay_tech_api_key = env('PAY_TECH_API_KEY');
        $this->pay_tech_secret_key = env('PAY_TECH_SECRET_KEY');

    }

    public function updatePaymentGateway()
    {
        $stripeKeys = [
            'PAY_TECH_API_KEY' => $this->pay_tech_api_key !== null ? $this->pay_tech_api_key : '',
            'PAY_TECH_SECRET_KEY' => $this->pay_tech_secret_key !== null ? $this->pay_tech_secret_key : env('PAY_TECH_SECRET_KEY'),
        ];

        $this->setEnvironmentValue($stripeKeys);
        return redirect()->route('admin.settings')->with('success', __('Setting updated successfully'));
    }

    public static function setEnvironmentValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}='{$envValue}'\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}='{$envValue}'", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        $str .= "\n";
        if (!file_put_contents($envFile, $str)) {
            return false;
        }
        return true;
    }

    public function render()
    {
        return view('livewire.admin.settings.payment-gateway');
    }
}
