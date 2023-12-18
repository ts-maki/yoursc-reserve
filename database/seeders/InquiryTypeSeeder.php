<?php

namespace Database\Seeders;

use App\Models\Inquiry_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InquiryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $inquiry_types = [
            [
                'name' => 'ご予約について',
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
            ],
            [
                'name' => '施設について',
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
            ],
            [
                'name' => '宴会・会場について',
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
            ],
            [
                'name' => 'その他',
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
            ]
        ];
        Inquiry_type::insert($inquiry_types);
    }
}
