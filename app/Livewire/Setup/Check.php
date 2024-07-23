<?php

namespace App\Livewire\Setup;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Check extends Component
{
    public $step = 1;
    public $summary = [];
    protected $listeners = ['change-step' => 'changeStep', 'summary'];
    
    #[Layout('layouts.setting')]
    public function render()
    {
        return view('livewire.setup.check');
    }

    public function changeStep($step)
    {
        $this->step = $step;
    }

    public function  summary($settings)
    {
        $this->summary = array_merge($this->summary, $settings);
    }
}
