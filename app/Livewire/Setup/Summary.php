<?php

namespace App\Livewire\Setup;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Summary extends Component
{
    public $summary;

    public function mount(array $summary = [])
    {
        $this->summary = $summary;
    }

    public function render()
    {
        return view('livewire.setup.summary');
    }
}
