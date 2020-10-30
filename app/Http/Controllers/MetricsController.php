<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Jobs\MetricJob;
use Carbon\Carbon;

class MetricsController extends Controller
{
    public function chart()
    {
        $from = "2020-01-01";
        $to = "2020-10-10"; 
        $metric = MetricJob::dispatch($from, $to);

    }
}
