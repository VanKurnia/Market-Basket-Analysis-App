<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layout')]
#[Title('MBA - Analysis Overview')]
class Overview extends Component
{

    public function render()
    {
        return view('livewire.overview');
    }
}