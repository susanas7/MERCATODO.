<?php

namespace App\Http\Controllers;

use App\Jobs\MetricJob;
use App\MetricProduct;

class MetricsController extends Controller
{
    public function chart()
    {
        $from = '2020-01-01';
        $to = '2020-11-03';
        $metric = MetricJob::dispatch($from, $to);
        $data = MetricProduct::orderBy('total', 'desc')->take(5);
        $d = $data->pluck('total');
        $id = $data->pluck('product_id');
        //dd($id);

        return view('metrics.index', compact('data', 'd', 'id'));
    }

    public function metric()
    {
        $metrics = MetricProduct::get();
        return $metrics;
    }
}
