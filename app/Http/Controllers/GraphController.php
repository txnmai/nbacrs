<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class GraphController extends Controller
{
    //
    public function index()
    {
        return view('graph');
    }
    public function chartByDay()
    {
        $start = Carbon::now()->subDays(6)->startOfDay();
        $end = Carbon::now()->endOfDay(); 

        $rawData = ServiceUser::select(
                DB::raw("DATE(date) as day_date"),
                DB::raw("COUNT(*) as count")
            )
            ->whereBetween('date', [$start, $end])
            ->groupBy('day_date')
            ->orderBy('day_date')
            ->pluck('count', 'day_date'); 

        $fullData = [];
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->subDays(6 - $i)->format('Y-m-d');
            $label = Carbon::createFromFormat('Y-m-d', $date)->format('D');
            $fullData[] = [
                'label' => $label,
                'count' => $rawData[$date] ?? 0
            ];
        }

        return response()->json([
            'labels' => array_column($fullData, 'label'),
            'data' => array_column($fullData, 'count'),
        ]);
    }

        public function chartByWeek()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $rawData = ServiceUser::select(
                DB::raw("FLOOR((DAY(date) - 1) / 7) + 1 as week"),
                DB::raw("COUNT(*) as count")
            )
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->groupBy('week')
            ->pluck('count', 'week'); // [1 => 2, 2 => 0, 3 => 5, ...]

        $fullData = [];
        for ($i = 1; $i <= 5; $i++) {
            $fullData[] = [
                'label' => "สัปดาห์ที่ $i",
                'count' => $rawData[$i] ?? 0
            ];
        }

        return response()->json([
            'labels' => array_column($fullData, 'label'),
            'data' => array_column($fullData, 'count'),
        ]);
    }

        public function chartByMonth()
    {
        $year = Carbon::now()->year;

        $rawData = ServiceUser::select(
                DB::raw("MONTH(date) as month"),
                DB::raw("COUNT(*) as count")
            )
            ->whereYear('date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month'); // ได้ key-value: [1 => 5, 2 => 0, ...]

        $fullData = [];
        for ($i = 1; $i <= 12; $i++) {
            $fullData[] = [
                'label' => 'เดือนที่ ' . $i,
                'count' => $rawData[$i] ?? 0
            ];
        }

        return response()->json([
            'labels' => array_column($fullData, 'label'),
            'data' => array_column($fullData, 'count'),
        ]);
    }

    public function chartByYear()
    {
        $minYear = ServiceUser::min(DB::raw("YEAR(date)"));
        $maxYear = ServiceUser::max(DB::raw("YEAR(date)"));

        $rawData = ServiceUser::select(
                DB::raw("YEAR(date) as year"),
                DB::raw("COUNT(*) as count")
            )
            ->groupBy('year')
            ->pluck('count', 'year'); // [2022 => 3, 2023 => 9, ...]

        $fullData = [];
        for ($i = $minYear; $i <= $maxYear; $i++) {
            $fullData[] = [
                'label' => (string) $i,
                'count' => $rawData[$i] ?? 0
            ];
        }

        return response()->json([
            'labels' => array_column($fullData, 'label'),
            'data' => array_column($fullData, 'count'),
        ]);
    }
    public function showChartPage(){
        $done = ServiceUser::where('status', true)->count();
        $notDone = ServiceUser::where('status', false)->count();

        return response()->json([
            'done' => $done,
            'not_done' => $notDone
        ]);
    }
}
