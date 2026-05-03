<?php

namespace App\Data;

class PastConsultations
{
    public static function all(): array
    {
        return [
            [
                'lawyer_slug'  => 'nguyen-minh-anh',
                'date'         => '2026-04-25',
                'time'         => '10:00',
                'booking_code' => 'BK-20260425-A8C3F2',
                'rated'        => false,
            ],
            [
                'lawyer_slug'  => 'tran-van-hung',
                'date'         => '2026-04-11',
                'time'         => '14:00',
                'booking_code' => 'BK-20260411-K5L9D7',
                'rated'        => true,
                'stars'        => 5,
                'review_text'  => "Luật sư Hùng giải thích từng điều khoản trong hợp đồng nhà cung cấp và chỉ ra hai điều khoản chúng tôi chưa nghĩ tới. Bình tĩnh, có phương pháp, không dùng thuật ngữ rối rắm. Chúng tôi sẽ quay lại vào quý tới khi ký hợp đồng thuê.",
                'reviewed_at'  => '2026-04-13',
            ],
            [
                'lawyer_slug'  => 'le-thi-huong',
                'date'         => '2026-03-28',
                'time'         => '15:00',
                'booking_code' => 'BK-20260328-M2N6P1',
                'rated'        => true,
                'stars'        => 4,
                'review_text'  => "Am hiểu và kiên nhẫn. Chúng tôi nhận được câu trả lời cần thiết về việc sang tên giấy tờ. Email theo dõi mất thêm vài ngày, đó là điểm vướng duy nhất trong một trải nghiệm nhìn chung rất suôn sẻ.",
                'reviewed_at'  => '2026-03-30',
            ],
        ];
    }

    public static function findByCode(string $code): ?array
    {
        foreach (self::all() as $c) {
            if ($c['booking_code'] === $code) {
                return $c;
            }
        }

        return null;
    }

    public static function withSessionReviews(): array
    {
        $sessionReviews = session('consultation_reviews', []);

        return array_map(function ($c) use ($sessionReviews) {
            if (isset($sessionReviews[$c['booking_code']])) {
                $review = $sessionReviews[$c['booking_code']];
                $c['rated']       = true;
                $c['stars']       = $review['stars'];
                $c['review_text'] = $review['review_text'] ?? null;
                $c['reviewed_at'] = $review['reviewed_at'];
            }
            return $c;
        }, self::all());
    }

    public static function findByCodeWithReview(string $code): ?array
    {
        foreach (self::withSessionReviews() as $c) {
            if ($c['booking_code'] === $code) {
                return $c;
            }
        }

        return null;
    }
}
