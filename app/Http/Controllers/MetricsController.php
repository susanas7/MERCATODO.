<?php

namespace App\Http\Controllers;

use App\Jobs\MetricJob;
use Carbon\Carbon;
use App\MetricProduct;
use Illuminate\Support\Collection;

class MetricsController extends Controller
{
    public function chart()
    {
        $from = '2020-01-01';
        $to = '2020-11-03';
        $metric = MetricJob::dispatch($from, $to);
        $data = MetricProduct::get();
        $d = $data->pluck('total');

        return view('metrics.index', compact('data', 'd'));
    }
}
