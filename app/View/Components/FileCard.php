<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FileCard extends Component
{
    public $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function render()
    {
        return view('components.file-card');
    }
}
