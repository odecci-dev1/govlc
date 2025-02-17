<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Error extends Component
{
    /**
     * Create a new component instance.
     */
    public $message, $words, $header;
    public function __construct($message, $words, $header)
    {
        $this->message = $message;
        $this->words = $words;
        $this->header = $header;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.error');
    }
}
