<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatCard extends Component
{
    public $title;
    public $count;
    public $icon;
    public $cardBorderClass;
    public $avatarBgClass;
    public $route;

    public function __construct($title, $count, $icon, $cardBorderClass, $avatarBgClass, $route)
    {
        $this->title = $title;
        $this->count = $count;
        $this->icon = $icon;
        $this->cardBorderClass = $cardBorderClass;
        $this->avatarBgClass = $avatarBgClass;
        $this->route = $route;
    }

    public function render()
    {
        return view('components.stat-card');
    }
}
