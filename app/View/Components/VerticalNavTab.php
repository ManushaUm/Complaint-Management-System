<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VerticalNavTab extends Component
{
    /**
     * Create a new component instance.
     */
    public $departmentNames;
    public $departments;
    public $employee;

    public function __construct($departments)
    {
        //$this->departmentNames = $departmentNames;
        $this->departments = $departments;
        //$this->employee = $employee;
    }
    //


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.vertical-nav-tab');
    }
}
