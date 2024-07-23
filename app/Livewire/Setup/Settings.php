<?php

namespace App\Livewire\Setup;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Settings extends Component
{
    public $app_name, $app_env, $app_debug, $app_key;
    public function mount(array $summary = [])
    {
        $this->app_name = isset($summary['APP_NAME']) ? $summary['APP_NAME'] :  config('app.name');
        $this->app_env = isset($summary['APP_ENV']) ? $summary['APP_ENV'] :  config('app.env');
        $this->app_debug = isset($summary['APP_DEBUG']) ? $summary['APP_DEBUG'] :  config('app.debug');
        $this->app_key = isset($summary['APP_KEY']) ? $summary['APP_KEY'] :  config('app.key');
    }

    public function render()
    {
        return view('livewire.setup.settings');
    }

    public function getNewAppKey()
    {
        Artisan::call('key:generate', ['--show' => true]);
        $output = (Artisan::output());
        $output = substr($output, 0, -2);
        $this->app_key = $output;
    }
    
    public function submitData()
    {
        $this->validate([
            'app_name' => 'required|min:2',
            'app_env' => 'required|in:production,local,testing',
            'app_debug' => 'required',
            'app_key' => 'required'
        ]);
        
        $data = [];
        if ($this->app_name != config('app.name')) {
            $data['APP_NAME'] = $this->app_name;
        }
        
        if ($this->app_env != config('app.env')) {
            $data['APP_ENV'] = $this->app_env;
        }

        if ($this->app_debug !== config('app.debug')) {
            $data['APP_DEBUG'] = $this->app_debug;
        }

        if ($this->app_key != config('app.key')) {
            $data['APP_KEY'] = $this->app_key;
        }

        if (count($data) > 0) {
            $this->dispatch('summary', settings: $data);
        }

        $this->dispatch('change-step', 3);

    }
}
