<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use App\Models\Vizit;
use ElFactory\IpApi\IpApi;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VizitController;
use App\Http\Requests\Message\StoreRequest;
use App\Helpers\Breadcrumbs;

class TaskController extends Controller
{
    public function clear()
    {
        if (!Auth::user()->is_root) {
            return redirect()->back()->with('status', 'access denied!');              
        }

        DB::table('tasks')->truncate();

        return redirect()->back()->with('info', 'table messages cleaned!'); 
    }
}
