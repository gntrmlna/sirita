<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

        // FILTER HARIAN
        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        // FILTER BULANAN
        if ($request->month) {
            [$year, $month] = explode('-', $request->month);
            $query->whereYear('created_at', $year)
                  ->whereMonth('created_at', $month);
        }

        // DEFAULT: hari ini
        if (!$request->date && !$request->month) {
            $query->whereDate('created_at', now());
        }

        $logs = $query->paginate(15);

        return view('activity_logs.index', compact('logs'));
    }
}
