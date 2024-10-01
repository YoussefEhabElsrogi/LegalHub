<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NoDataMessage extends Component
{
    public $message;
    public $colspan;

    public function __construct($message, $colspan)
    {
        $this->message = $message;
        $this->colspan = $colspan;
    }

    public function render()
    {
        return view('components.no-data-message');
    }
}
