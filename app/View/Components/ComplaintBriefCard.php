<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ComplaintBriefCard extends Component
{
    public $Initcomplaint;

    public function __construct($Initcomplaint)
    {
        $this->Initcomplaint = $Initcomplaint;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.complaint-brief-card');
    }
}
