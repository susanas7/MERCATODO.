<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetricUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metric_users', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->unsignedBigInteger('user_id');
            $table->integer('total');
            $table->timestamps();
        });

        $sql = <<<'EOT'
        CREATE PROCEDURE `user_metrics_generate` (p_from date, p_until date)
        BEGIN
            START TRANSACTION;
            DELETE FROM `metric_users` WHERE `date` BETWEEN p_from AND DATE_ADD(p_until, INTERVAL 1 DAY);
            INSERT INTO `metric_users` (`date`, `user_id`, `total`)
            SELECT DATE(`created_at`) AS date, `user_id` as user_id, COUNT(*) as total
                FROM orders
            WHERE `created_at` BETWEEN p_from AND DATE_ADD(p_until, INTERVAL 1 DAY)
            GROUP BY `date`, `user_id`;
            COMMIT;
        END
        EOT;
                DB::unprepared('DROP PROCEDURE IF EXISTS user_metrics_generate');
                DB::unprepared($sql);
        
                $oli = now()->subYear()->format('Y-m-d');
                $dateTo = now()->format('Y-m-d');
        
                DB::unprepared("call user_metrics_generate('$oli', '$dateTo')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metric_users');
    }
}
