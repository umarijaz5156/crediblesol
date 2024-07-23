<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Checkout extends Component
{

    #[Layout('layouts.web')]
    public function render()
    {
        return view('livewire.front.checkout');
    }
}
