<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\GetInTouch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function counts(Request $request){
        $todaysCount = GetInTouch::whereDate('created_at',  now()->format('Y-m-d'))->count();
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $yesterdaysCount = GetInTouch::whereDate('created_at', $yesterday)->count();

        $startDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');

        // Calculate the end date (today)
        $endDate = Carbon::now()->endOfDay()->format('Y-m-d');

        // Query to count records within the one-month period
        $oneMonthCount = GetInTouch::whereBetween('created_at', [$startDate, $endDate])->count();

        $totalCount = GetInTouch::count();

        return view('dashboard', compact('todaysCount','yesterdaysCount','oneMonthCount','totalCount'));
    }

}
