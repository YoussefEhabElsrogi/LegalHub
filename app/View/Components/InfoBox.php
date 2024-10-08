<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InfoBox extends Component
{
    public $label;
    public $value;
    public $badge;

    public function __construct($label, $value, $badge = null)
    {
        $this->label = $label;
        $this->value = $value;
        $this->badge = $badge;
    }

    public function render()
    {
        return view('components.info-box');
    }
}
