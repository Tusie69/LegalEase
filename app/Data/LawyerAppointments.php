<?php

namespace App\Data;

class LawyerAppointments
{
    public static function all(): array
    {
        return [
            [
                'customer_name'       => 'Phạm Thu Hà',
                'customer_phone'      => '+84 90 123 4567',
                'customer_initials'   => 'PH',
                'date'                => '2026-05-05',
                'time'                => '10:00',
                'booking_code'        => 'BK-20260505-T7F2H4',
                'status'              => 'CONFIRMED',
                'outcome_reported_at' => null,
            ],
            [
                'customer_name'       => 'Lê Quang Bình',
                'customer_phone'      => '+84 91 234 5678',
                'customer_initials'   => 'LB',
                'date'                => '2026-05-12',
                'time'                => '15:00',
                'booking_code'        => 'BK-20260512-X9K3M1',
                'status'              => 'CONFIRMED',
                'outcome_reported_at' => null,
            ],
            [
                'customer_name'       => 'Trần Mai Lan',
                'customer_phone'      => '+84 92 345 6789',
                'customer_initials'   => 'TL',
                'date'                => '2026-04-28',
                'time'                => '11:00',
                'booking_code'        => 'BK-20260428-D5N8R2',
                'status'              => 'CONFIRMED',
                'outcome_reported_at' => null,
            ],
            [
                'customer_name'       => 'Nguyễn Văn Đức',
                'customer_phone'      => '+84 93 456 7890',
                'customer_initials'   => 'NĐ',
                'date'                => '2026-04-22',
                'time'                => '14:00',
                'booking_code'        => 'BK-20260422-P4Q7S6',
                'status'              => 'COMPLETED',
                'outcome_reported_at' => '2026-04-23',
                'customer_review'     => [
                    'stars'       => 5,
                    'review_text' => 'Am hiểu và rõ ràng. Giúp tôi xử lý một cuộc đàm phán hợp đồng phức tạp, và tôi rời buổi tư vấn với sự tự tin về các bước tiếp theo.',
                    'reviewed_at' => '2026-04-25',
                ],
            ],
            [
                'customer_name'       => 'Đặng Thanh Tùng',
                'customer_phone'      => '+84 94 567 8901',
                'customer_initials'   => 'ĐT',
                'date'                => '2026-04-15',
                'time'                => '09:00',
                'booking_code'        => 'BK-20260415-V3W6Z4',
                'status'              => 'NO_SHOW_BY_CUSTOMER',
                'outcome_reported_at' => '2026-04-15',
            ],
        ];
    }

    public static function findByCode(string $code): ?array
    {
        foreach (self::all() as $a) {
            if ($a['booking_code'] === $code) {
                return $a;
            }
        }

        return null;
    }

    public static function withSessionOutcomes(): array
    {
        $outcomes = session('appointment_outcomes', []);

        return array_map(function ($a) use ($outcomes) {
            if (isset($outcomes[$a['booking_code']])) {
                $report = $outcomes[$a['booking_code']];
                $a['status'] = $report['outcome'] === 'completed' ? 'COMPLETED' : 'NO_SHOW_BY_CUSTOMER';
                $a['outcome_reported_at'] = $report['reported_at'];
            }
            return $a;
        }, self::all());
    }

    public static function findByCodeWithOutcome(string $code): ?array
    {
        foreach (self::withSessionOutcomes() as $a) {
            if ($a['booking_code'] === $code) {
                return $a;
            }
        }

        return null;
    }
}
