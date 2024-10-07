<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('components.layout')]
#[Title('MBA - Market Analysis')]
class TopSellingProduct extends Component
{
    public function render()
    {
        return view('livewire.top-selling-product');
    }
}
