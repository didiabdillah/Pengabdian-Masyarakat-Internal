<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class WilayahIndonesiaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path('sql/wilayah_indo.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }
}
