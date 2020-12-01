<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\MetricJob;
use App\MetricProduct;

class MetricsController extends Controller
{
    public function chart()
    {
        $from = '2020-01-01';
        $to = '2020-12-12';
        $metric = MetricJob::dispatch($from, $to);

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
}
