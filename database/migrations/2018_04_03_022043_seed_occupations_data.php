<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedOccupationsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $occupations = [
          ['name' => '学生'],
          ['name' => '服装设计师'],
          ['name' => '平面设计师'],
          ['name' => '摄影师'],
          ['name' => '动画师'],
          ['name' => '设计爱好者'],
          ['name' => '三维设计师'],
          ['name' => '网页设计师']
        ];

        DB::table('occupations')->insert($occupations);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('occupations')->truncate();
    }
}
