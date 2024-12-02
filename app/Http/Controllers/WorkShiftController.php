<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManageTime;
use App\Enum\Status;
use App\Models\ScheduleDay;

class WorkShiftController extends Controller
{
    public function deleteMonth($timestamp)
    {
        $year = date('Y', $timestamp);
        $month = date('m', $timestamp);

        ScheduleDay::where('year', $year)
            ->where('month', $month)
            ->delete();

        return redirect()->route('schedule-days.index')->with('info', 'Month has been deleted!');             
    }
}
