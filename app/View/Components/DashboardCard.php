<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardCard extends Component
{
   
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('components.dashboard-card');
    }
}
