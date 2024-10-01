<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardHeader extends Component
{
    public $title;
    public $actionUrl;
    public $actionText;

    public function __construct($title, $actionUrl, $actionText)
    {
        $this->title = $title;
        $this->actionUrl = $actionUrl;
        $this->actionText = $actionText;
    }

    public function render()
    {
        return view('components.card-header');
    }
}
