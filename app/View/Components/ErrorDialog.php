<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ErrorDialog extends Component
{
    /**
     * Create a new component instance.
     */
    public $message, $confirmaction, $header, $xmid;
    public function __construct($message, $xmid, $confirmaction, $header)
    {
        $this->message = $message;
        $this->confirmaction = $confirmaction;
        $this->header = $header;
        $this->xmid = $xmid;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.error-dialog');
    }
}
