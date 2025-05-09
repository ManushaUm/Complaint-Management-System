<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReportAllComplaintsTable extends Component
{
    public $complaints;
    public $latestLogs;
    public $hrData;

    public function __construct($complaints, $latestLogs, $hrData)
    {
        $this->complaints = $complaints;
        $this->latestLogs = $latestLogs;
        $this->hrData = $hrData;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report-all-complaints-table');
    }
}
