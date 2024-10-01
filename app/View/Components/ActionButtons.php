<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionButtons extends Component
{
    public $modelId;
    public $routePrefix;

    public function __construct($modelId, $routePrefix)
    {
        $this->modelId = $modelId;
        $this->routePrefix = $routePrefix;
    }

    public function render()
    {
        return view('components.action-buttons');
    }
}
