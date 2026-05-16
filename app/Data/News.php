<?php

namespace App\Data;

class News
{
    public static function categories(): array
    {
        return [
            'Hôn nhân & Gia đình',
            'Doanh nghiệp',
            'Bất động sản',
            'Hình sự',
            'Lao động',
            'Dân sự',
        ];
    }

    /**
     * Author profile registry. Articles reference these via 'author_key'.
     * Fields are merged into each article entry by self::all().
     */
    public static function authors(): array
    {
        return [
            'blawyers' => [
                'author_name'       => 'BLawyers Vietnam',
                'author_slug'       => 'blawyers-vietnam',
                'author_avatar_url' => '/images/blawyersvn-logo.svg',
                'author_url'        => 'https://www.blawyersvn.com/blawyers-vietnam/',
                'author_bio'        => 'BLawyers Vietnam là hãng luật thành lập năm 2018, cung cấp giải pháp pháp lý phù hợp cho khách hàng trong nước và quốc tế, với mạng lưới đối tác tại Châu Âu, Hoa Kỳ và Châu Á.',
                'author_socials'    => [
                    'facebook' => 'https://www.facebook.com/BLawyersVietnam',
                    'linkedin' => 'https://www.linkedin.com/company/b-lawyers-vietnam/',
                    'x'        => 'https://x.com/BLawyers_VN',
                ],
            ],
            'dedica' => [
                'author_name'       => 'Dedica Law Firm',
                'author_slug'       => 'dedica-law-firm',
                'author_avatar_url' => '/images/dedica-logo.svg',
                'author_url'        => 'https://www.dedica-law.com/',
                'author_bio'        => 'DEDICA là hãng luật thành lập năm 2018, trụ sở tại TP.HCM, với đội ngũ luật sư từng làm việc tại các hãng luật quốc tế và tập đoàn đa quốc gia tại Việt Nam.',
                'author_socials'    => [
                    'facebook' => 'https://www.facebook.com/people/Dedica-Law/61575140197516/',
                    'linkedin' => 'https://www.linkedin.com/company/dedica-law/?viewAsMember=true',
                    'whatsapp' => 'https://api.whatsapp.com/send/?phone=84936060254&text&type=phone_number&app_absent=0',
                ],
            ],
            'anlaw' => [
                'author_name'       => 'An Law Vietnam',
                'author_slug'       => 'an-law-vietnam',
                'author_avatar_url' => '/images/anlaw-logo.svg',
                'author_url'        => 'https://anlawvietnam.com/',
                'author_bio'        => 'An Law Vietnam là hãng luật quốc tế tại TP. Hồ Chí Minh, chuyên sâu về hình sự với hơn 20 năm kinh nghiệm xử lý các vụ án phức tạp, đồng thời tư vấn toàn diện luật Việt Nam và quốc tế cho doanh nghiệp và cá nhân.',
                'author_socials'    => [
                    'facebook' => 'https://www.facebook.com/AnLawVN',
                    'linkedin' => 'https://www.linkedin.com/in/an-law-vietnam/',
                    'x'        => 'https://x.com/Anlawvietnam',
                ],
            ],
        ];
    }

    public static function all(): array
    {
        $authors = self::authors();
        $resolved = array_map(function ($article) use ($authors) {
            if (!empty($article['author_key']) && isset($authors[$article['author_key']])) {
                foreach ($authors[$article['author_key']] as $k => $v) {
                    if (!array_key_exists($k, $article)) {
                        $article[$k] = $v;
                    }
                }
                unset($article['author_key']);
            }
            return $article;
        }, self::raw());

        // Sort newest first by date
        usort($resolved, fn ($a, $b) => strcmp($b['date'] ?? '', $a['date'] ?? ''));

        return $resolved;
    }

    /**
     * Source of truth: each article lives in its own JSON file under articles/.
     * Field mapping (JSON → render shape):
     *   slug_vn → slug, topic_vn → category, title_vn → title, subtitle_vn → lead,
     *   hero_image_url → image_url, publish_date_display_vn (d/m/Y) → date (Y-m-d),
     *   read_time_vn → read_time, body_vn (string with blank-line breaks) → body (typed blocks).
     */
    private static function raw(): array
    {
        $files = glob(base_path('articles/art-*.json'));
        sort($files);

        $articles = [];
        foreach ($files as $file) {
            $data = json_decode(file_get_contents($file), true);
            if (!is_array($data)) continue;

            $articles[] = [
                'slug'         => $data['slug_vn'] ?? '',
                'category'     => $data['topic_vn'] ?? '',
                'title'        => $data['title_vn'] ?? '',
                'lead'         => $data['subtitle_vn'] ?? '',
                'image_url'    => $data['hero_image_url'] ?? '',
                'image_credit' => '',
                'date'         => self::parseDateDmy($data['publish_date_display_vn'] ?? ''),
                'author_key'   => self::deriveAuthorKey($data['author_name'] ?? ''),
                'read_time'    => $data['read_time_vn'] ?? '',
                'featured'     => (bool) ($data['featured'] ?? false),
                'body'         => self::parseBody($data['body_vn'] ?? ''),
            ];
        }
        return $articles;
    }

    /** "30/07/2025" → "2025-07-30". Returns "" if input is malformed. */
    private static function parseDateDmy(string $dmy): string
    {
        if (preg_match('|^(\d{2})/(\d{2})/(\d{4})$|', $dmy, $m)) {
            return "{$m[3]}-{$m[2]}-{$m[1]}";
        }
        return '';
    }

    /** Reverse-derive author_key (registry key) from the human-readable author name. */
    private static function deriveAuthorKey(string $name): string
    {
        return match (true) {
            str_contains($name, 'Dedica')    => 'dedica',
            str_contains($name, 'An Law')    => 'anlaw',
            str_contains($name, 'BLawyers')  => 'blawyers',
            default                          => 'blawyers',
        };
    }

    /**
     * Parse body_vn (flat string with blank-line paragraph separators) into typed blocks.
     * Heuristics:
     *   - Lines starting with "- " group into a single 'ul' block.
     *   - Short paragraphs (≤120 chars, no terminal punctuation, no URL) become 'h2'.
     *   - Everything else becomes 'p'.
     */
    private static function parseBody(string $body): array
    {
        $body = trim($body);
        if ($body === '') return [];

        $paragraphs = preg_split('/\n\s*\n/', $body);
        $blocks = [];
        $listBuffer = [];

        $flushList = function () use (&$blocks, &$listBuffer) {
            if (!empty($listBuffer)) {
                $blocks[] = ['type' => 'ul', 'items' => $listBuffer];
                $listBuffer = [];
            }
        };

        foreach ($paragraphs as $para) {
            $para = trim($para);
            if ($para === '') continue;

            // List item
            if (str_starts_with($para, '- ')) {
                $listBuffer[] = trim(substr($para, 2));
                continue;
            }
            $flushList();

            // Heading heuristic
            $len = mb_strlen($para);
            $lastChar = mb_substr($para, -1);
            $hasUrl = str_contains($para, 'http://') || str_contains($para, 'https://');
            $isHeading = $len <= 120
                && !$hasUrl
                && !in_array($lastChar, ['.', ',', '!', ':', ';'], true);

            $blocks[] = $isHeading
                ? ['type' => 'h2', 'text' => $para]
                : ['type' => 'p',  'text' => $para];
        }
        $flushList();

        return $blocks;
    }

    public static function featured(): array
    {
        return array_values(array_filter(self::all(), fn ($a) => !empty($a['featured'])));
    }

    public static function find(string $slug): ?array
    {
        foreach (self::all() as $article) {
            if ($article['slug'] === $slug) {
                return $article;
            }
        }
        return null;
    }

    public static function others(): array
    {
        return array_values(array_filter(self::all(), fn ($a) => empty($a['featured'])));
    }
}
