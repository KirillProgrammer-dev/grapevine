<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ManyTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++){
            Task::create([
                "title" => Str::random(50),
                "description" => Str::random(200),
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
}
