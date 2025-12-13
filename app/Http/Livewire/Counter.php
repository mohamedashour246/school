<?php

namespace App\Http\Livewire;

use App\Models\TypeBlood;
use Livewire\Component;

class Counter extends Component
{
    // public $count = 0;

    // public function increment()
    // {
    //     $this->count++;
    // }

    // public function minus()
    // {
    //     $this->count--;
    // }

    public $search = '';

    public function render()
    {
        return view('livewire.counter',
        ['bloods' => TypeBlood::where('name',$this->search)->get()
        ]);
    }
}
