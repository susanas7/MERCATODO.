<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->unsignedBigInteger('product_id');
            $table->integer('total');
            $table->timestamps();
        });

        $sql = <<<'EOT'
        CREATE PROCEDURE `product_metrics_generate` (p_from date, p_until date)
        BEGIN
            START TRANSACTION;
            DELETE FROM `product_metrics` WHERE `date` BETWEEN p_from AND DATE_ADD(p_until, INTERVAL 1 DAY);
            INSERT INTO `product_metrics` (`date`, `product_id`, `total`)
            SELECT DATE(`created_at`) AS date, `product_id` as product_id, COUNT(*) as total
                FROM order_product
            WHERE `created_at` BETWEEN p_from AND DATE_ADD(p_until, INTERVAL 1 DAY)
            GROUP BY `date`, `product_id`;
            COMMIT;
        END
        EOT;
                DB::unprepared('DROP PROCEDURE IF EXISTS product_metrics_generate');
                DB::unprepared($sql);

                $oli = now()->subYear()->format('Y-m-d');
                $dateTo = now()->format('Y-m-d');

                DB::unprepared("call product_metrics_generate('$oli', '$dateTo')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_metrics');
    }
}
