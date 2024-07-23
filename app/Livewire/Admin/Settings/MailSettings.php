<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Attributes\Layout;
use Livewire\Component;

class MailSettings extends Component
{
    public $mail_driver, $mail_host, $mail_port, $mail_username, $mail_password, $mail_encryption, $mail_from_address, $mail_from_name;

    public function mount()
    {
        $this->fillForm();
    }

    protected function fillForm()
    {
        $this->mail_driver = env('MAIL_MAILER');
        $this->mail_host = env('MAIL_HOST');
        $this->mail_port = env('MAIL_PORT');
        $this->mail_username = env('MAIL_USERNAME');
        $this->mail_password = env('MAIL_PASSWORD');
        $this->mail_encryption = env('MAIL_ENCRYPTION');
        $this->mail_from_name = env('MAIL_FROM_ADDRESS');
        $this->mail_from_address = env('MAIL_FROM_NAME');
    }

    public function updateSmtpSettings()
    {
        $this->validate([
            'mail_driver' => 'required|string|max:255',
            'mail_host' => 'required|string|max:255',
            'mail_port' => 'required|string|max:255',
            'mail_username' => 'required|string|max:255',
            'mail_password' => 'required|string|max:255',
            'mail_encryption' => 'nullable|string|max:255',
            'mail_from_address' => 'required|string|max:255',
            'mail_from_name' => 'required|string|max:255',
        ]);

        $arrEnv = [
            'MAIL_MAILER' => $this->mail_driver,
            'MAIL_HOST' => $this->mail_host,
            'MAIL_PORT' => $this->mail_port,
            'MAIL_USERNAME' => $this->mail_username,
            'MAIL_PASSWORD' => $this->mail_password,
            'MAIL_ENCRYPTION' => $this->mail_encryption,
            'MAIL_FROM_NAME' => $this->mail_from_name,
            'MAIL_FROM_ADDRESS' => $this->mail_from_address,
        ];

        $this->setEnvironmentValue($arrEnv);

        session()->flash('success', 'Mail settings updated successfully.');
        // return redirect()->route('admin.settings')->with('success', 'SMTP settings updated successfully.');
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
                    $str .= "\r\n{$envKey}='{$envValue}'\r\n";
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
        return view('livewire.admin.settings.mail-settings');
    }
}
