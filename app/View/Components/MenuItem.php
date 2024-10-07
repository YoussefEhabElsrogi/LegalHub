<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MenuItem extends Component
{
    public $title;
    public $icon;
    public $createRoute;
    public $createLabel;
    public $indexRoute;
    public $indexLabel;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $icon, $createRoute, $createLabel, $indexRoute, $indexLabel)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->createRoute = $createRoute;
        $this->createLabel = $createLabel;
        $this->indexRoute = $indexRoute;
        $this->indexLabel = $indexLabel;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.menu-item');
    }
}
