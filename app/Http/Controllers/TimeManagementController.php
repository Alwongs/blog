<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManageTime;
use App\Enum\Status;

class TimeManagementController extends Controller
{
    public function activateTimes($manage_day_id)
    {
        ManageTime::where('manage_day_id', $manage_day_id)
            ->where('status', Status::DISABLE)
            ->update(['status' => Status::ACTIVE]);

        return redirect()->back()->with('info', 'All manage times are active!'); 
    }

    public function disableTimes($manage_day_id)
    {
        ManageTime::where('manage_day_id', $manage_day_id)
            ->where('status', Status::ACTIVE)
            ->update(['status' => Status::DISABLE]);

        return redirect()->back()->with('info', 'All manage times are disable!'); 
    }
}
