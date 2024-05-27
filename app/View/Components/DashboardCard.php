<?php
 
namespace App\View\Components;
 
use Illuminate\View\Component;
 
class DashboardCard extends Component
{
    public $events;
    public $title;
    public $class;
 
    public function __construct($events, $title, $class)
    {
        $this->events = $events;
        $this->title = $title;
        $this->class = $class;
    }
 
    public function render()
    {
        return view('my-components.dashboard-card');
    }
}