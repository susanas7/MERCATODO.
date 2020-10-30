<?php

namespace App\Http\Controllers;

use App\Jobs\MetricJob;

class MetricsController extends Controller
{
    public function chart()
    {
        $from = '2020-01-01';
        $to = '2020-10-30';
        $metric = MetricJob::dispatch($from, $to);
    }
}
