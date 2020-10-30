<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;

class MetricJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $from;
    protected $to;
    
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::statement('call product_metrics_generate (?,?)', [$this->from, $this->to]);
    }
    
}
