<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomerDetailsModal extends Component
{
    /**
     * Create a new component instance.
     */
    public $initcomplaint;

    public function __construct($initcomplaint)
    {
        $this->initcomplaint = $initcomplaint;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.customer-details-modal');
    }
}
