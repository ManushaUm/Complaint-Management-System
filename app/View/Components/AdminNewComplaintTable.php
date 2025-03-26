<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminNewComplaintTable extends Component
{
    public $complaints;
    public $departmentNames;
    public $divisionNames;

    public function __construct($complaints, $departmentNames, $divisionNames)
    {
        $this->complaints = $complaints;
        $this->departmentNames = $departmentNames;
        $this->divisionNames = $divisionNames;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-new-complaint-table');
    }
}
