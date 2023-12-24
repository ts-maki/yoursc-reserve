<?php

namespace Database\Seeders;

use App\Models\Inquiry_status;
use Illuminate\Database\Seeder;

class InquiryStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inquiry_status = [
            [
                'status' => '対応待ち',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ],
            [
                'status' => '対応中',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ],
            [
                'status' => '完了',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ],
        ];

        Inquiry_status::insert($inquiry_status);
    }
}
