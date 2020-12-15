<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\MetricJob;
use App\Jobs\UserMetricJob;
use App\MetricProduct;
use App\MetricUser;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class MetricsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ver reportes');
    }

    /**
     * Display charts for reports.
     *
     * @return View
     */
    public function index(): View
    {
        $from = Carbon::now()->subMonths(6);
        $to = Carbon::now();
        $metric = MetricJob::dispatch($from, $to);
        $user_metric = UserMetricJob::dispatch($from, $to);

        return view('admin.metrics.index');
    }

    /**
     * Return data for charts.
     *
     * @return JsonResponse
     */
    public function metricData(): JsonResponse
    {
        $prodData = MetricProduct::orderBy('total', 'desc')->take(5)->get();
        $productData = $prodData->pluck('total');
        $productTitle = $prodData->pluck('title');

        $usrData = MetricUser::orderBy('total', 'desc')->take(5)->get();
        $userData = $usrData->pluck('total');
        $userTitle = $usrData->pluck('name');

        return response()->json([
            'productData' => $productData,
            'productTitle' => $productTitle,
            'userData' => $userData,
            'userTitle' => $userTitle,
        ]);
    }

    /**
     * Return data for charts.
     *
     * @return JsonResponse
     */
    public function metricData2(): JsonResponse
    {
        $prodData = MetricProduct::orderBy('total', 'asc')->take(5)->get();
        $productData2 = $prodData->pluck('total');
        $productTitle2 = $prodData->pluck('title');

        return response()->json([
            'data2' => $productData2,
            'total2' => $productTitle2,
        ]);
    }
}
