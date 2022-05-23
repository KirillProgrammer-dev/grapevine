<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            "title" => "Создание сайта",
            "description" => "Сделаю сайт быстро и дешево",
            "min_price" => 1000,
            "max_price" => 15000,
            "deadline" => 14,
            "img" => "",
            "customer" => 1,
            "tags" => "",
            "executor" => "",
        ]);
    }
}
