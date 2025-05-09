<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DHeadComplaintReopenModal extends Component
{
    public $id;
    public $prevData;
    public $newData;
    public function __construct($id, $prevData, $newData)
    {
        $this->id = $id;
        $this->prevData = $prevData;
        $this->newData = $newData;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.d-head-complaint-reopen-modal');
    }
}
