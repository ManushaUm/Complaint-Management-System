<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ComplaintAssignModal extends Component
{
    public $departmentNames;
    public $divisionNames;


    public function __construct($departmentNames, $divisionNames)
    {
        $this->departmentNames = $departmentNames;
        $this->divisionNames = $divisionNames;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.complaint-assign-modal');
    }
}
