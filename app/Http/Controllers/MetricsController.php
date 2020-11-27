<?php

namespace App\Http\Controllers;

use App\Jobs\MetricJob;
use App\MetricProduct;

class MetricsController extends Controller
{
    public function chart()
    {
        $from = '2020-01-01';
        $to = '2020-12-12';
        $metric = MetricJob::dispatch($from, $to);
        $data = MetricProduct::orderBy('total', 'desc')->take(5);
        $d = $data->pluck('total');

        return view('metrics.index', compact('data', 'd'));
    }

    public function metric()
    {
        $data = MetricProduct::orderBy('total', 'desc')->take(5);
        $d = $data->pluck('total');
        return response()->json([
            'data' => $d,
        ]);
    }
}
