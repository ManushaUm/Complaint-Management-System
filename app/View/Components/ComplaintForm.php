<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComplaintForm extends Component
{
    public $complaintTypes;

    public function __construct($complaintTypes)
    {
        $this->complaintTypes = $complaintTypes;
    }

    public function render()
    {
        return view('components.complaint-form');
    }
}
