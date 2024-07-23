<?php

namespace App\Livewire\Setup;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ServerRequirements extends Component
{
    public $requiredPhpVersion;
    public $extensionStatus = [];
    public $isBootstrapWritable = true;
    public $isStorageWritable = true;

    public function mount()
    {
        // Load the composer.lock file
        $composerJson = json_decode(file_get_contents(base_path('composer.lock')), true);

        // Get the required PHP version from the "platform" section
        $this->requiredPhpVersion = $composerJson['platform']['php'];

        //  Check installed PHP  extensions
        $this->checkPHPExtensions();

        $this->checkFilesPermission();
    }

    public function checkFilesPermission()
    {
        $bootstrapPath = base_path('bootstrap/cache');
        $bootstrapPermissions = fileperms($bootstrapPath);

        // Storage directory
        $storagePath = storage_path();
        $storagePermissions = fileperms($storagePath);
        
        // Check if Bootstrap directory has 777 permissions
        $this->isBootstrapWritable = $this->checkPermissionsOctal($bootstrapPermissions, 0777);

        // Check if Storage directory has 777 permissions
        $this->isStorageWritable = $this->checkPermissionsOctal($storagePermissions, 0777);
    }

    public function render()
    {
        return view('livewire.setup.server-requirements');
    }

    public function checkPHPExtensions()
    {
        // required php extension for laravel-10
        $extensions = ['openssl', 'gd', 'fileinfo', 'dom', 'pdo', 'mbstring', 'curl', 'tokenizer', 'xml', 'mysqli'];

        $extensionStatus = [];

        foreach ($extensions as $extension) {
            $isLoaded = $extension == 'pdo' ? defined('PDO::ATTR_DRIVER_NAME') : extension_loaded($extension);
            $extensionStatus[$extension] = $isLoaded ? 'Installed' : 'Not Installed';
        }

        $this->extensionStatus = $extensionStatus;

    }

    public function comparePHPVersion(): bool
    {
        // Get the curren PHP version
        $currentPhpVersion = phpversion();

        return version_compare($currentPhpVersion, $this->requiredPhpVersion, ">=");
    }


    public function checkServerRequirements()
    {
        $php_version_error = false;
        $php_extension_error = false;
        $bootstrap_file_error = false;
        $storage_file_error = false;

        if (!$this->comparePHPVersion()) {
            $php_version_error = true;
            $this->addError('php_version', 'PHP version does not meet the requirements');
        }

        // show errors for not installed extensions
        if (count($this->extensionStatus)) {
            collect($this->extensionStatus)->filter(function ($status) {return $status == 'Not Installed';})
                ->each(function ($status, $extension) {
                    $php_extension_error  = true;
                    $this->addError('php_ext.' . $extension, 'The PHP extension is not installed on your server: ' . $extension);
                }
            );
        }

        if (!$this->isBootstrapWritable) {
            $bootstrap_file_error = true;
            $this->addError('bootstrap_file_error', 'The \'bootstrap/cache\' directory is not writable, please change permission to 777 ');
        }

        if (!$this->isStorageWritable) {
            $storage_file_error = true;
            $this->addError('bootstrap_file_error', 'The \'storage\' directory is not writable, please change permission to 777 ');
        }

        if(!$php_version_error  && !$php_extension_error && !$bootstrap_file_error && !$storage_file_error) {
            $this->dispatch('change-step',  step: 2);
        }    
    }

    public function checkPermissionsOctal($actual, $expected)
    {
        // Convert octal permissions to decimal for comparison
        $actualDecimal = octdec(substr(sprintf('%o', $actual), -4));
        $expectedDecimal = octdec(substr(sprintf('%o', $expected), -4));
        return $actualDecimal === $expectedDecimal;
    }
}
