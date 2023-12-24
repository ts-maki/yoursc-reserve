<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => '和室',
                'description' => '時を忘れるかのような落ち着ける和室です',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ],
            [
                'name' => '洋室',
                'description' => '優雅な時間を過ごせるヨーロッパ風の洋室です',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ],
            [
                'name' => '和洋室',
                'description' => '和室と洋室の雰囲気を楽しめえるお部屋です',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ],
            [
                'name' => '宴会会場',
                'description' => '大人数で宴会を楽しみたい方に最適なお部屋です',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ],
        ];

        Room::insert($rooms);
    }
}
