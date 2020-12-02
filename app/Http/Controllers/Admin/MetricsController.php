<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\MetricJob;
use App\Jobs\UserMetricJob;
use App\MetricProduct;
use App\MetricUser;
use Carbon\Carbon;

class MetricsController extends Controller
{
    public function chart()
    {
        $this->authorize('viewAny', auth()->user());
        $from = Carbon::now()->subMonths(6);
        $to = Carbon::now();
        $metric = MetricJob::dispatch($from, $to);
        $user_metric = UserMetricJob::dispatch($from, $to);

        return view('admin.metrics.index');
    }

    public function metricData()
    {
        $data = MetricProduct::orderBy('total', 'desc')->take(5)->get();
        $d = $data->pluck('total');
        $c = $data->pluck('title');

        $userData = MetricUser::orderBy('total', 'desc')->take(5)->get();
        $a = $userData->pluck('total');
        $b = $userData->pluck('name');

        return response()->json([
            'productData' => $d,
            'productTitle' => $c,
            'userData' => $a,
            'userTitle' => $b,
        ]);
    }

    public function metricData2()
    {
        $data2 = MetricProduct::orderBy('total', 'asc')->take(5)->get();
        $x = $data2->pluck('total');
        $z = $data2->pluck('title');

        return response()->json([
            'data2' => $x,
            'total2' => $z,
        ]);
    }
}
