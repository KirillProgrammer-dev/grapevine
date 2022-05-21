<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'img_url' => '',
            'class' => 'Заказчик',
            'skills' => 'Python, Web, Html, C++',
            'describtion' => 'Всем привет! Я разрабатываю сайты и веб приложения. Буду рад с вами поработать, пишите, договоримся) Я участвовал в крупных проектах и работал в иностраных компаниях',
            'works' => 'Yandex',
        ]);
    }
}
