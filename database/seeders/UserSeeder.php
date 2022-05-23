<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Иванов Иван Иванович',
            'email' => 'ivanov@gmail.com',
            'password' => Hash::make('12345678'),
            'img_url' => '',
            'class' => 'Заказчик',
            'skills' => '',
            'describtion' => 'Всем привет! Я разрабатываю стартапы и мне нужны специалисты для создания сайта для моих стартапов.',
            'works' => '',
        ]);
        User::create([
            'name' => 'Васильев Василий Васильевич',
            'email' => 'vasiliev@gmail.com',
            'password' => Hash::make('12345678'),
            'img_url' => '',
            'class' => 'Исполнитель',
            'skills' => 'Python, Web, Html, C++',
            'describtion' => 'Всем привет! Я разрабатываю сайты и веб приложения. Буду рад с вами поработать, пишите, договоримся) Я участвовал в крупных проектах и работал в иностраных компаниях',
            'works' => 'Yandex',
        ]);
    }
}
