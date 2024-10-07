<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatCard extends Component
{
    public $title;
    public $count;
    public $icon;
    public $route;

    public function __construct($title, $count, $icon, $route)
    {
        $this->title = $title;
        $this->count = $count;
        $this->icon = $icon;
        $this->route = $route;
    }

    public function render()
    {
        return view('components.stat-card');
    }
}
