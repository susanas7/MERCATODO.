<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\MetricJob;
use App\Jobs\UserMetricJob;
use App\MetricProduct;
use Carbon\Carbon;
use App\MetricUser;

class MetricsController extends Controller
{
    public function chart()
    {
        $from = Carbon::now()->subMonths(6);
        $to = Carbon::now();
        $metric = MetricJob::dispatch($from, $to);
        $user_metric = UserMetricJob::dispatch($from, $to);

        return view('admin.metrics.index');
    }

    public function metric()
    {
        $data = MetricProduct::orderBy('total', 'desc')->take(5)->get();
        $d = $data->pluck('total');
        $c = $data->pluck('title');

        return response()->json([
            'data' => $d,
            'total' => $c,
        ]);
    }

    public function met()
    {
        $data2 = MetricProduct::orderBy('total', 'asc')->take(5)->get();
        $x = $data2->pluck('total');
        $z = $data2->pluck('title');

        return response()->json([
            'data2' => $x,
            'total2' => $z,
        ]);
    }

    public function userMetric()
    {
        $data = MetricUser::orderBy('total', 'desc')->take(5)->get();
        $d = $data->pluck('total');
        $c = $data->pluck('name');

        return response()->json([
            'data3' => $d,
            'total3' => $c,
        ]);
    }
}
