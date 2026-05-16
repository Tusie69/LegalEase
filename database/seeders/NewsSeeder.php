<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Seeds `news` + `news_images` from App\Data\News::all() (reads articles/art-*.json).
// Missing in ERD: lead, category, date, read_time, featured, structured body, author_*, source_*.
class NewsSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        if (DB::table('news')->count() > 0) return;

        foreach (\App\Data\News::all() as $article) {
            // Flatten typed blocks to plain text for `content LONGTEXT` (loses h2/ul structure).
            $content = '';
            foreach ($article['body'] ?? [] as $block) {
                $content .= ($block['type'] ?? '') === 'ul'
                    ? implode("\n", array_map(fn ($i) => "- {$i}", $block['items'] ?? [])) . "\n\n"
                    : ($block['text'] ?? '') . "\n\n";
            }

            $newsId = DB::table('news')->insertGetId([
                'title'      => $article['title'],
                'slug'       => $article['slug'],
                'content'    => trim($content),
                'status'     => 'PUBLISHED',
                // 'lead'      => $article['lead'],          // card subtitle
                // 'category'  => $article['category'],      // chip filters
                // 'date'      => $article['date'],          // publish date
                // 'read_time' => $article['read_time'],     // "5 phút đọc"
                // 'featured'  => (bool) ($article['featured'] ?? false),  // homepage carousel
                // 'body'      => json_encode($article['body']),  // structured blocks; change content LONGTEXT → JSON
                // 'author_name'       => $article['author_name'],
                // 'author_avatar_url' => $article['author_avatar_url'],
                // 'author_url'        => $article['author_url'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (!empty($article['image_url'])) {
                DB::table('news_images')->insert([
                    'news_id'    => $newsId,
                    'image_url'  => $article['image_url'],
                    'is_cover'   => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
