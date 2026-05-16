<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqsSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        if (DB::table('faqs')->count() > 0) return;

        $now = now();
        $rows = [];
        foreach (\App\Data\FAQs::all() as $i => $item) {
            $rows[] = [
                'category'      => $item['category'],
                'question'      => $item['q'],
                'answer'        => $item['a'],
                'status'        => 'PUBLISHED',
                'display_order' => $i + 1,
                'created_at'    => $now,
                'updated_at'    => $now,
            ];
        }

        DB::table('faqs')->insert($rows);
    }
}
