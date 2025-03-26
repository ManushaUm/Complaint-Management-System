<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CompletedTable extends Component
{
    /**
     * Create a new component instance.
     */
    public $complaints;

    public function __construct($complaints)
    {
        $this->complaints = $complaints;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.completed-table');
    }
}
