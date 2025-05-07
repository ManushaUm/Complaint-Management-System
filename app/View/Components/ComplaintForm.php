<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComplaintForm extends Component
{
    public $complaintTypes;
    public $branchData;

    public function __construct($complaintTypes, $branchData)
    {

        $this->complaintTypes = $complaintTypes;
        $this->branchData = $branchData;
    }

    public function render()
    {
        return view('components.complaint-form');
    }
}
