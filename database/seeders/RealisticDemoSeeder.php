<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RealisticDemoSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create('vi_VN');

        DB::transaction(function () use ($faker): void {
            $now = now();
            $roles = DB::table('roles')->pluck('id', 'code');

            if (!isset($roles['ADMIN'], $roles['LAWYER'], $roles['CUSTOMER'])) {
                throw new \RuntimeException('Missing roles. Run migrations first.');
            }

            $adminIds = [];
            $lawyerIds = [];
            $customerIds = [];

            for ($i = 1; $i <= 8; $i++) {
                $adminIds[] = DB::table('users')->insertGetId([
                    'role_id' => $roles['ADMIN'],
                    'name' => $faker->name(),
                    'email' => "admin{$i}@legalease.vn",
                    'email_verified_at' => $now,
                    'password' => Hash::make('Password@123'),
                    'status' => 'ACTIVE',
                    'phone' => '09' . random_int(10000000, 99999999),
                    'avatar_url' => 'https://i.pravatar.cc/300?img=' . random_int(1, 70),
                    'last_login_at' => $now->copy()->subDays(random_int(0, 7)),
                    'remember_token' => Str::random(10),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            $expertisePool = [
                'Doanh nghiep va hop dong',
                'Dat dai va nha o',
                'Lao dong va bao hiem',
                'Hon nhan gia dinh',
                'So huu tri tue',
                'Dan su va to tung',
                'Hinh su',
                'Thue va tai chinh',
            ];

            $lawyerCount = 50;
            for ($i = 1; $i <= $lawyerCount; $i++) {
                $lawyerId = DB::table('users')->insertGetId([
                    'role_id' => $roles['LAWYER'],
                    'name' => $faker->name(),
                    'email' => "lawyer{$i}@legalease.vn",
                    'email_verified_at' => $now,
                    'password' => Hash::make('Password@123'),
                    'status' => random_int(1, 100) <= 95 ? 'ACTIVE' : 'SUSPENDED',
                    'phone' => '09' . random_int(10000000, 99999999),
                    'avatar_url' => 'https://i.pravatar.cc/300?img=' . random_int(1, 70),
                    'last_login_at' => $now->copy()->subDays(random_int(0, 20)),
                    'remember_token' => Str::random(10),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                $lawyerIds[] = $lawyerId;

                DB::table('lawyer_profiles')->insert([
                    'user_id' => $lawyerId,
                    'bar_association_name' => $faker->randomElement(['Doan luat su TP.HCM', 'Doan luat su Ha Noi', 'Doan luat su Da Nang']),
                    'bar_card_number' => 'LS-' . random_int(100000, 999999),
                    'years_of_experience' => random_int(2, 25),
                    'consultation_fee' => random_int(700000, 3000000),
                    'rating' => number_format(random_int(38, 50) / 10, 2, '.', ''),
                    'expertise' => implode(', ', collect($expertisePool)->shuffle()->take(random_int(1, 3))->all()),
                    'bio' => $faker->realText(180),
                    'verification_status' => random_int(1, 100) <= 90 ? 'VERIFIED' : 'PENDING',
                    'cancellation_count' => random_int(0, 8),
                    'no_show_count' => random_int(0, 4),
                    'violation_count' => random_int(0, 3),
                    'last_violation_at' => random_int(1, 100) <= 30 ? $now->copy()->subDays(random_int(20, 200)) : null,
                    'is_search_visible' => random_int(1, 100) <= 92,
                    'locked_at' => null,
                    'locked_by_admin_id' => null,
                    'lock_reason' => null,
                    'verified_at' => $now->copy()->subDays(random_int(10, 300)),
                    'verified_by_admin_id' => $adminIds[array_rand($adminIds)],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            for ($i = 1; $i <= 260; $i++) {
                $customerId = DB::table('users')->insertGetId([
                    'role_id' => $roles['CUSTOMER'],
                    'name' => $faker->name(),
                    'email' => "customer{$i}@mail.vn",
                    'email_verified_at' => random_int(1, 100) <= 95 ? $now->copy()->subDays(random_int(1, 90)) : null,
                    'password' => Hash::make('Password@123'),
                    'status' => random_int(1, 100) <= 97 ? 'ACTIVE' : 'INACTIVE',
                    'phone' => '09' . random_int(10000000, 99999999),
                    'avatar_url' => 'https://i.pravatar.cc/300?img=' . random_int(1, 70),
                    'last_login_at' => $now->copy()->subDays(random_int(0, 60)),
                    'remember_token' => Str::random(10),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                $customerIds[] = $customerId;

                DB::table('customer_profiles')->insert([
                    'user_id' => $customerId,
                    'date_of_birth' => Carbon::now()->subYears(random_int(20, 65))->subDays(random_int(0, 365)),
                    'gender' => $faker->randomElement(['MALE', 'FEMALE', 'OTHER']),
                    'address' => $faker->address(),
                    'identity_number' => (string) random_int(100000000000, 999999999999),
                    'identity_status' => random_int(1, 100) <= 82 ? 'VERIFIED' : 'UNVERIFIED',
                    'identity_verified_at' => random_int(1, 100) <= 82 ? $now->copy()->subDays(random_int(1, 120)) : null,
                    'identity_verified_by_admin_id' => random_int(1, 100) <= 82 ? $adminIds[array_rand($adminIds)] : null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            $slotsByLawyer = [];
            foreach ($lawyerIds as $lawyerId) {
                $slotsByLawyer[$lawyerId] = [];
                for ($d = -20; $d <= 40; $d++) {
                    $base = Carbon::now()->startOfDay()->addDays($d);
                    foreach ([8, 10, 14, 16] as $hour) {
                        $start = $base->copy()->setTime($hour, 0);
                        $slotId = DB::table('slots')->insertGetId([
                            'lawyer_id' => $lawyerId,
                            'start_time' => $start,
                            'end_time' => $start->copy()->addMinutes(90),
                            'status' => 'OPEN',
                            'locked_by_user_id' => null,
                            'locked_at' => null,
                            'lock_expires_at' => null,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]);
                        $slotsByLawyer[$lawyerId][] = $slotId;
                    }
                }
            }

            $appointmentIds = [];
            $completedForRating = [];
            $topics = [
                'Tu van tranh chap dat dai',
                'Ra soat hop dong mua ban',
                'Tu van ly hon va nuoi con',
                'Huong dan xu ly tranh chap lao dong',
                'Tu van dang ky nhan hieu',
                'Tu van thu tuc khoi kien dan su',
            ];

            for ($i = 0; $i < 1300; $i++) {
                $lawyerId = $lawyerIds[array_rand($lawyerIds)];
                if (empty($slotsByLawyer[$lawyerId])) {
                    continue;
                }

                $slotIdx = array_rand($slotsByLawyer[$lawyerId]);
                $slotId = $slotsByLawyer[$lawyerId][$slotIdx];
                unset($slotsByLawyer[$lawyerId][$slotIdx]);

                $slot = DB::table('slots')->where('id', $slotId)->first();
                if ($slot === null) {
                    continue;
                }

                $customerId = $customerIds[array_rand($customerIds)];
                $status = collect(['COMPLETED', 'COMPLETED', 'CONFIRMED', 'PENDING', 'CANCELLED'])->random();
                $price = random_int(700000, 4000000);
                $deposit = (int) round($price * 0.3);
                $refundAmount = $status === 'CANCELLED' ? random_int((int) round($deposit * 0.2), $deposit) : null;

                $appointmentId = DB::table('appointments')->insertGetId([
                    'booking_code' => 'LE' . now()->format('ymd') . strtoupper(Str::random(7)),
                    'lawyer_id' => $lawyerId,
                    'customer_id' => $customerId,
                    'slot_id' => $slotId,
                    'status' => $status,
                    'consultation_topic' => $topics[array_rand($topics)],
                    'consultation_summary' => $faker->realText(220),
                    'scheduled_start_at' => $slot->start_time,
                    'scheduled_end_at' => $slot->end_time,
                    'timezone' => 'Asia/Ho_Chi_Minh',
                    'price_amount' => $price,
                    'deposit_amount' => $deposit,
                    'final_amount' => $price,
                    'customer_note' => random_int(1, 100) <= 65 ? $faker->sentence(12) : null,
                    'paid_at' => $status === 'PENDING' ? null : Carbon::parse($slot->start_time)->subDays(random_int(1, 10)),
                    'outcome_reported_at' => $status === 'COMPLETED' ? Carbon::parse($slot->end_time)->addHour() : null,
                    'completed_at' => $status === 'COMPLETED' ? Carbon::parse($slot->end_time) : null,
                    'cancelled_at' => $status === 'CANCELLED' ? Carbon::parse($slot->start_time)->subHours(random_int(1, 48)) : null,
                    'cancelled_by_user_id' => $status === 'CANCELLED' ? collect([$lawyerId, $customerId])->random() : null,
                    'cancellation_reason' => $status === 'CANCELLED' ? $faker->sentence(10) : null,
                    'refund_amount' => $refundAmount,
                    'refund_status' => $status === 'CANCELLED' ? collect(['PENDING', 'APPROVED', 'PAID'])->random() : null,
                    'admin_note' => random_int(1, 100) <= 20 ? $faker->sentence(10) : null,
                    'created_at' => Carbon::parse($slot->start_time)->subDays(random_int(1, 30)),
                    'updated_at' => $now,
                ]);

                $appointmentIds[] = $appointmentId;
                if ($status === 'COMPLETED') {
                    $completedForRating[] = $appointmentId;
                }

                DB::table('slots')->where('id', $slotId)->update([
                    'status' => $status === 'CANCELLED' ? 'OPEN' : 'BOOKED',
                    'updated_at' => $now,
                ]);

                DB::table('payments')->insert([
                    'appointment_id' => $appointmentId,
                    'submitted_by_user_id' => $customerId,
                    'reviewed_by_user_id' => $adminIds[array_rand($adminIds)],
                    'amount' => $deposit,
                    'payment_type' => 'DEPOSIT',
                    'payment_method' => collect(['BANK_TRANSFER', 'MOMO', 'VNPAY'])->random(),
                    'bank_name' => collect(['Vietcombank', 'ACB', 'Techcombank', 'MB Bank'])->random(),
                    'transfer_reference' => 'TRX-' . strtoupper(Str::random(12)),
                    'customer_note' => random_int(1, 100) <= 40 ? $faker->sentence(8) : null,
                    'admin_note' => random_int(1, 100) <= 30 ? 'Da doi soat giao dich.' : null,
                    'status' => $status === 'PENDING' ? 'PENDING' : 'PAID',
                    'transaction_id' => 'TX' . strtoupper(Str::random(16)),
                    'submitted_at' => Carbon::parse($slot->start_time)->subDays(random_int(3, 15)),
                    'reviewed_at' => $status === 'PENDING' ? null : Carbon::parse($slot->start_time)->subDays(random_int(2, 10)),
                    'paid_at' => $status === 'PENDING' ? null : Carbon::parse($slot->start_time)->subDays(random_int(1, 8)),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                if ($status === 'COMPLETED') {
                    DB::table('payments')->insert([
                        'appointment_id' => $appointmentId,
                        'submitted_by_user_id' => $customerId,
                        'reviewed_by_user_id' => $adminIds[array_rand($adminIds)],
                        'amount' => $price - $deposit,
                        'payment_type' => 'REMAINING',
                        'payment_method' => collect(['BANK_TRANSFER', 'MOMO', 'VNPAY'])->random(),
                        'bank_name' => collect(['VietinBank', 'BIDV', 'TPBank', 'VPBank'])->random(),
                        'transfer_reference' => 'TRX-' . strtoupper(Str::random(12)),
                        'customer_note' => null,
                        'admin_note' => 'Thanh toan phan con lai sau buoi tu van.',
                        'status' => 'PAID',
                        'transaction_id' => 'TX' . strtoupper(Str::random(16)),
                        'submitted_at' => Carbon::parse($slot->end_time)->subHours(random_int(6, 48)),
                        'reviewed_at' => Carbon::parse($slot->end_time)->subHours(random_int(2, 24)),
                        'paid_at' => Carbon::parse($slot->end_time)->subHours(random_int(1, 12)),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }

            foreach (collect($completedForRating)->shuffle()->take(900) as $appointmentId) {
                DB::table('ratings')->insert([
                    'appointment_id' => $appointmentId,
                    'stars' => random_int(3, 5),
                    'title' => $faker->randomElement([
                        'Tu van ro rang, de ap dung',
                        'Luon dung gio va chuyen nghiep',
                        'Giai thich de hieu, co tam',
                        'Huong dan day du ho so',
                    ]),
                    'review_text' => $faker->realText(140),
                    'is_public' => random_int(1, 100) <= 95,
                    'reviewed_at' => $now->copy()->subDays(random_int(0, 20)),
                    'is_reported' => random_int(1, 100) <= 3,
                    'is_removed' => false,
                    'created_at' => $now->copy()->subDays(random_int(0, 20)),
                    'updated_at' => $now,
                ]);
            }

            for ($i = 1; $i <= 120; $i++) {
                DB::table('news')->insert([
                    'title' => $faker->sentence(8),
                    'content' => $faker->paragraphs(random_int(4, 8), true),
                    'image_url' => 'https://picsum.photos/seed/news' . $i . '/1200/700',
                    'status' => random_int(1, 100) <= 85 ? 'PUBLISHED' : 'DRAFT',
                    'created_at' => $now->copy()->subDays(random_int(0, 300)),
                    'updated_at' => $now,
                ]);
            }

            for ($i = 1; $i <= 80; $i++) {
                DB::table('faqs')->insert([
                    'question' => 'Cau hoi thuong gap #' . $i,
                    'answer' => $faker->realText(220),
                    'created_at' => $now->copy()->subDays(random_int(0, 200)),
                    'updated_at' => $now,
                ]);
            }

            $allUserIds = array_merge($adminIds, $lawyerIds, $customerIds);
            for ($i = 0; $i < 2400; $i++) {
                DB::table('notifications')->insert([
                    'user_id' => $allUserIds[array_rand($allUserIds)],
                    'title' => $faker->randomElement([
                        'Co lich hen moi',
                        'Lich hen da duoc xac nhan',
                        'Lich hen da bi huy',
                        'Thanh toan da duoc ghi nhan',
                        'Ho so can bo sung thong tin',
                    ]),
                    'message' => $faker->sentence(14),
                    'is_read' => random_int(1, 100) <= 68,
                    'created_at' => $now->copy()->subDays(random_int(0, 120)),
                ]);
            }
        });
    }
}
