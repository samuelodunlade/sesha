<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SingleSecret extends Component
{

    public $secret;

    public function __construct($secret)
    {
        $this->secret = $secret;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.single-secret');
    }
}
