<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchInput extends Component
{
    public $id;
    public $placeholder;

    public function __construct($id, $placeholder)
    {
        $this->id = $id;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.search-input');
    }
}
