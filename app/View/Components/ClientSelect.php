<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ClientSelect extends Component
{
    public $clients;

    public function __construct($clients)
    {
        $this->clients = $clients;
    }

    public function render()
    {
        return view('components.client-select');
    }
}
