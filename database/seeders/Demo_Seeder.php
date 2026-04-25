<?php

namespace Database\Seeders;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RealisticDemoSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create('vi_VN');

        DB::transaction(function () use ($faker): void {
            $roles = DB::table('roles')->pluck('id', 'code');

            if (!isset($roles['ADMIN'], $roles['LAWYER'], $roles['CUSTOMER'])) {
                throw new \RuntimeException('Missing role seeds. Please run migrations that insert roles first.');
            }

            $adminIds = [];
            $lawyerIds = [];
            $customerIds = [];

            $adminNames = ['Nguyen Minh Duc', 'Tran Hoang Vy', 'Le Quoc Bao'];
            foreach ($adminNames as $index => $name) {
                $adminIds[] = DB::table('users')->insertGetId([
                    'role_id' => $roles['ADMIN'],
                    'name' => $name,
                    'email' => 'admin' . ($index + 1) . '@legalease.vn',
                    'email_verified_at' => now(),
                    'password' => Hash::make('Password@123'),
                    'status' => 'ACTIVE',
                    'phone' => '09' . random_int(10000000, 99999999),
                    'avatar_url' => 'https://i.pravatar.cc/300?img=' . random_int(1, 70),
                    'last_login_at' => now()->subDays(random_int(0, 5)),
                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $specializationSeeds = [
                ['code' => 'CIVIL', 'name' => 'Dan su', 'description' => 'Tranh chap dan su va hop dong', 'image_url' => null],
                ['code' => 'CRIMINAL', 'name' => 'Hinh su', 'description' => 'Bao chua va tu van vu an hinh su', 'image_url' => null],
                ['code' => 'LABOR', 'name' => 'Lao dong', 'description' => 'Hop dong lao dong va tranh chap lao dong', 'image_url' => null],
                ['code' => 'CORPORATE', 'name' => 'Doanh nghiep', 'description' => 'Thanh lap, M&A, quan tri cong ty', 'image_url' => null],
                ['code' => 'LAND', 'name' => 'Dat dai', 'description' => 'So do, chuyen nhuong, thu hoi dat', 'image_url' => null],
                ['code' => 'TAX', 'name' => 'Thue', 'description' => 'Tu van thue doanh nghiep va ca nhan', 'image_url' => null],
                ['code' => 'IP', 'name' => 'So huu tri tue', 'description' => 'Nhan hieu, ban quyen, sang che', 'image_url' => null],
                ['code' => 'MARRIAGE', 'name' => 'Hon nhan gia dinh', 'description' => 'Ly hon, nuoi con, chia tai san', 'image_url' => null],
            ];

            $specializationIds = [];
            foreach ($specializationSeeds as $row) {
                $id = DB::table('specializations')->insertGetId([
                    'code' => $row['code'],
                    'name' => $row['name'],
                    'description' => $row['description'],
                    'image_url' => $row['image_url'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $specializationIds[] = $id;
            }

            $lawyerProfileByUser = [];

            for ($i = 1; $i <= 12; $i++) {
                $name = $faker->name();
                $userId = DB::table('users')->insertGetId([
                    'role_id' => $roles['LAWYER'],
                    'name' => $name,
                    'email' => 'lawyer' . $i . '@legalease.vn',
                    'email_verified_at' => now(),
                    'password' => Hash::make('Password@123'),
                    'status' => 'ACTIVE',
                    'phone' => '09' . random_int(10000000, 99999999),
                    'avatar_url' => 'https://i.pravatar.cc/300?img=' . random_int(1, 70),
                    'last_login_at' => now()->subDays(random_int(0, 10)),
                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $lawyerIds[] = $userId;

                $profileId = DB::table('lawyer_profiles')->insertGetId([
                    'user_id' => $userId,
                    'bar_association_name' => 'Doan luat su TP.HCM',
                    'bar_card_number' => 'LS' . random_int(100000, 999999),
                    'years_of_experience' => random_int(2, 20),
                    'expertise' => 'Tu van hop dong, giai quyet tranh chap, dai dien to tung',
                    'bio' => 'Luon uu tien giai phap thuc te, ro rang chi phi va lo trinh xu ly cho khach hang.',
                    'verification_status' => random_int(1, 100) <= 85 ? 'VERIFIED' : 'PENDING',
                    'cancellation_count' => random_int(0, 3),
                    'no_show_count' => random_int(0, 2),
                    'violation_count' => random_int(0, 2),
                    'last_violation_at' => random_int(0, 1) ? now()->subMonths(random_int(1, 8)) : null,
                    'is_search_visible' => true,
                    'locked_at' => null,
                    'locked_by_admin_id' => null,
                    'lock_reason' => null,
                    'verified_at' => now()->subDays(random_int(3, 30)),
                    'verified_by_admin_id' => $adminIds[array_rand($adminIds)],
                    'created_at' => now()->subMonths(2),
                    'updated_at' => now(),
                ]);

                $lawyerProfileByUser[$userId] = $profileId;

                DB::table('lawyer_addresses')->insert([
                    'lawyer_profile_id' => $profileId,
                    'province' => $faker->randomElement(['TP.HCM', 'Ha Noi', 'Da Nang', 'Can Tho', 'Binh Duong']),
                    'street_address' => $faker->streetAddress(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $pickedSpecializations = collect($specializationIds)->shuffle()->take(random_int(1, 3));
                foreach ($pickedSpecializations as $specializationId) {
                    DB::table('lawyer_specializations')->insert([
                        'lawyer_profile_id' => $profileId,
                        'specialization_id' => $specializationId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                foreach (['BAR_CARD', 'ID_CARD', 'DEGREE'] as $docType) {
                    DB::table('lawyer_documents')->insert([
                        'lawyer_profile_id' => $profileId,
                        'document_type' => $docType,
                        'document_number' => strtoupper(Str::random(10)),
                        'file_url' => 'https://example.com/docs/' . Str::uuid() . '.pdf',
                        'status' => random_int(1, 100) <= 80 ? 'APPROVED' : 'PENDING',
                        'reviewed_at' => now()->subDays(random_int(1, 20)),
                        'reviewed_by_admin_id' => $adminIds[array_rand($adminIds)],
                        'review_note' => 'Thong tin hop le theo doi chieu ho so.',
                        'created_at' => now()->subMonths(2),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('lawyer_verification_reviews')->insert([
                    'lawyer_profile_id' => $profileId,
                    'admin_id' => $adminIds[array_rand($adminIds)],
                    'decision' => 'APPROVED',
                    'reason' => 'Ho so day du, thong tin xac minh khop du lieu.',
                    'snapshot' => json_encode(['score' => random_int(85, 98), 'source' => 'admin_review']),
                    'reviewed_at' => now()->subDays(random_int(5, 30)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            for ($i = 1; $i <= 30; $i++) {
                $name = $faker->name();
                $userId = DB::table('users')->insertGetId([
                    'role_id' => $roles['CUSTOMER'],
                    'name' => $name,
                    'email' => 'customer' . $i . '@mail.vn',
                    'email_verified_at' => now(),
                    'password' => Hash::make('Password@123'),
                    'status' => 'ACTIVE',
                    'phone' => '09' . random_int(10000000, 99999999),
                    'avatar_url' => 'https://i.pravatar.cc/300?img=' . random_int(1, 70),
                    'last_login_at' => now()->subDays(random_int(0, 20)),
                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $customerIds[] = $userId;

                DB::table('customer_profiles')->insert([
                    'user_id' => $userId,
                    'date_of_birth' => Carbon::now()->subYears(random_int(22, 55))->subDays(random_int(0, 365)),
                    'gender' => $faker->randomElement(['MALE', 'FEMALE', 'OTHER']),
                    'address' => $faker->address(),
                    'identity_number' => (string) random_int(100000000000, 999999999999),
                    'identity_status' => random_int(1, 100) <= 75 ? 'VERIFIED' : 'UNVERIFIED',
                    'identity_verified_at' => now()->subDays(random_int(1, 60)),
                    'identity_verified_by_admin_id' => $adminIds[array_rand($adminIds)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $slotIds = [];
            foreach ($lawyerIds as $lawyerId) {
                for ($d = -8; $d <= 14; $d++) {
                    for ($k = 0; $k < 2; $k++) {
                        $start = now()->startOfDay()->addDays($d)->addHours(8 + ($k * 3));
                        $slotIds[] = DB::table('slots')->insertGetId([
                            'lawyer_id' => $lawyerId,
                            'start_time' => $start,
                            'end_time' => (clone $start)->addMinutes(90),
                            'status' => 'OPEN',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }

                DB::table('cancellation_policies')->insert([
                    'lawyer_id' => $lawyerId,
                    'hours_before_full_refund' => random_int(12, 48),
                    'refund_percentage' => random_int(50, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $appointmentIds = [];
            $completedAppointmentIds = [];
            $appointmentRowsById = [];

            $selectedSlotIds = collect($slotIds)->shuffle()->take(90)->values();
            foreach ($selectedSlotIds as $slotId) {
                $slot = DB::table('slots')->where('id', $slotId)->first();
                if ($slot === null) {
                    continue;
                }

                $customerId = $customerIds[array_rand($customerIds)];
                $status = collect(['COMPLETED', 'COMPLETED', 'CONFIRMED', 'PENDING', 'CANCELLED'])->random();

                $price = random_int(500000, 3000000);
                $final = $status === 'CANCELLED' ? (int) round($price * random_int(40, 90) / 100) : $price;

                $appointmentId = DB::table('appointments')->insertGetId([
                    'booking_code' => 'LE' . now()->format('ymd') . strtoupper(Str::random(6)),
                    'lawyer_id' => $slot->lawyer_id,
                    'customer_id' => $customerId,
                    'slot_id' => $slot->id,
                    'status' => $status,
                    'consultation_type' => collect(['ONLINE', 'OFFLINE'])->random(),
                    'consultation_topic' => collect([
                        'Tu van hop dong lao dong',
                        'Tranh chap dat dai va so do',
                        'Tu van thu tuc ly hon',
                        'Bao ve quyen loi trong tranh chap dan su',
                        'Soat xet hop dong mua ban',
                    ])->random(),
                    'consultation_summary' => 'Khach hang can danh gia phuong an phap ly va ho so can chuan bi.',
                    'scheduled_start_at' => $slot->start_time,
                    'scheduled_end_at' => $slot->end_time,
                    'timezone' => 'Asia/Ho_Chi_Minh',
                    'price_amount' => $price,
                    'final_amount' => $final,
                    'consultation_fee_snapshot' => $price,
                    'deposit_amount' => (int) round($price * 0.3),
                    'outcome_reported_by' => $status === 'COMPLETED' ? collect(['LAWYER', 'CUSTOMER'])->random() : null,
                    'outcome_reported_at' => $status === 'COMPLETED' ? Carbon::parse($slot->end_time)->addHour() : null,
                    'currency' => 'VND',
                    'meeting_channel' => collect(['GOOGLE_MEET', 'ZOOM', 'PHONE'])->random(),
                    'meeting_link' => 'https://meet.example.com/' . Str::lower(Str::random(8)),
                    'customer_note' => 'Can trao doi ky ve tai lieu chung minh.',
                    'completed_at' => $status === 'COMPLETED' ? Carbon::parse($slot->end_time) : null,
                    'cancelled_at' => $status === 'CANCELLED' ? Carbon::parse($slot->start_time)->subHours(random_int(2, 24)) : null,
                    'cancelled_by_user_id' => $status === 'CANCELLED' ? collect([$slot->lawyer_id, $customerId])->random() : null,
                    'cancellation_reason' => $status === 'CANCELLED' ? 'Thay doi lich trinh dot xuat.' : null,
                    'created_at' => Carbon::parse($slot->start_time)->subDays(random_int(1, 10)),
                    'updated_at' => now(),
                ]);

                $appointmentIds[] = $appointmentId;
                $appointmentRowsById[$appointmentId] = [
                    'lawyer_id' => $slot->lawyer_id,
                    'customer_id' => $customerId,
                    'status' => $status,
                ];

                if ($status === 'COMPLETED') {
                    $completedAppointmentIds[] = $appointmentId;
                }

                DB::table('slots')->where('id', $slot->id)->update([
                    'status' => $status === 'CANCELLED' ? 'OPEN' : 'BOOKED',
                    'updated_at' => now(),
                ]);
            }

            foreach ($appointmentIds as $appointmentId) {
                $appt = $appointmentRowsById[$appointmentId];

                DB::table('payments')->insert([
                    'appointment_id' => $appointmentId,
                    'amount' => random_int(300000, 900000),
                    'payment_type' => 'DEPOSIT',
                    'payment_method' => collect(['BANK_TRANSFER', 'MOMO', 'VNPAY'])->random(),
                    'status' => $appt['status'] === 'PENDING' ? 'PENDING' : 'PAID',
                    'transaction_id' => 'TXD' . strtoupper(Str::random(14)),
                    'paid_at' => $appt['status'] === 'PENDING' ? null : now()->subDays(random_int(1, 20)),
                    'created_at' => now()->subDays(random_int(1, 25)),
                    'updated_at' => now(),
                ]);

                if ($appt['status'] === 'COMPLETED') {
                    DB::table('payments')->insert([
                        'appointment_id' => $appointmentId,
                        'amount' => random_int(800000, 3000000),
                        'payment_type' => 'REMAINING',
                        'payment_method' => collect(['BANK_TRANSFER', 'MOMO', 'VNPAY'])->random(),
                        'status' => 'PAID',
                        'transaction_id' => 'TXR' . strtoupper(Str::random(14)),
                        'paid_at' => now()->subDays(random_int(0, 10)),
                        'created_at' => now()->subDays(random_int(0, 10)),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('appointment_events')->insert([
                    [
                        'appointment_id' => $appointmentId,
                        'event_type' => 'APPOINTMENT_CREATED',
                        'actor_id' => $appt['customer_id'],
                        'actor_type' => 'CUSTOMER',
                        'metadata' => json_encode(['source' => 'booking_flow']),
                        'created_at' => now()->subDays(random_int(1, 20)),
                        'updated_at' => now(),
                    ],
                    [
                        'appointment_id' => $appointmentId,
                        'event_type' => 'STATUS_' . $appt['status'],
                        'actor_id' => $appt['lawyer_id'],
                        'actor_type' => 'LAWYER',
                        'metadata' => json_encode(['note' => 'System synchronized status']),
                        'created_at' => now()->subDays(random_int(0, 10)),
                        'updated_at' => now(),
                    ],
                ]);
            }

            foreach (collect($completedAppointmentIds)->shuffle()->take(50) as $appointmentId) {
                DB::table('ratings')->insert([
                    'appointment_id' => $appointmentId,
                    'stars' => random_int(3, 5),
                    'title' => collect([
                        'Tu van ro rang, de hieu',
                        'Ho tro nhanh va co tam',
                        'Danh gia cao tinh chuyen mon',
                    ])->random(),
                    'review_text' => 'Luật sư tư vấn cụ thể, nêu rõ rủi ro và phương án xử lý thực tế.',
                    'is_public' => true,
                    'reviewed_at' => now()->subDays(random_int(0, 15)),
                    'is_reported' => false,
                    'is_removed' => false,
                    'created_at' => now()->subDays(random_int(0, 15)),
                    'updated_at' => now(),
                ]);
            }

            foreach (collect($appointmentIds)->shuffle()->take(60) as $appointmentId) {
                $appt = $appointmentRowsById[$appointmentId];

                $conversationId = DB::table('conversations')->insertGetId([
                    'appointment_id' => $appointmentId,
                    'customer_id' => $appt['customer_id'],
                    'lawyer_id' => $appt['lawyer_id'],
                    'created_at' => now()->subDays(random_int(0, 15)),
                    'updated_at' => now(),
                ]);

                $messageRows = [];
                $msgCount = random_int(2, 7);
                for ($m = 0; $m < $msgCount; $m++) {
                    $sender = ($m % 2 === 0) ? $appt['customer_id'] : $appt['lawyer_id'];
                    $messageRows[] = [
                        'conversation_id' => $conversationId,
                        'sender_id' => $sender,
                        'message_text' => $faker->sentence(random_int(8, 16)),
                        'attachment_url' => random_int(1, 100) <= 15 ? 'https://example.com/files/' . Str::uuid() . '.pdf' : null,
                        'read_at' => now()->subDays(random_int(0, 5)),
                        'created_at' => now()->subDays(random_int(0, 10)),
                        'updated_at' => now(),
                    ];
                }

                DB::table('messages')->insert($messageRows);
            }

            foreach (collect($appointmentIds)->shuffle()->take(35) as $appointmentId) {
                $appt = $appointmentRowsById[$appointmentId];
                DB::table('appointment_documents')->insert([
                    'appointment_id' => $appointmentId,
                    'uploaded_by' => collect([$appt['customer_id'], $appt['lawyer_id']])->random(),
                    'file_url' => 'https://example.com/appointments/' . Str::uuid() . '.pdf',
                    'file_type' => collect(['PDF', 'DOCX', 'IMAGE'])->random(),
                    'created_at' => now()->subDays(random_int(0, 10)),
                    'updated_at' => now(),
                ]);
            }

            foreach (collect($appointmentIds)->shuffle()->take(12) as $appointmentId) {
                $appt = $appointmentRowsById[$appointmentId];

                $disputeId = DB::table('appointment_disputes')->insertGetId([
                    'appointment_id' => $appointmentId,
                    'raised_by_user_id' => $appt['customer_id'],
                    'status' => collect(['OPEN', 'RESOLVED', 'IN_REVIEW'])->random(),
                    'description' => 'Co khac biet ve noi dung da thong nhat trong buoi tu van.',
                    'assigned_admin_id' => $adminIds[array_rand($adminIds)],
                    'resolved_at' => random_int(1, 100) <= 40 ? now()->subDays(random_int(1, 5)) : null,
                    'created_at' => now()->subDays(random_int(1, 8)),
                    'updated_at' => now(),
                ]);

                DB::table('appointment_dispute_messages')->insert([
                    [
                        'dispute_id' => $disputeId,
                        'sender_user_id' => $appt['customer_id'],
                        'message' => 'Toi can doi soat noi dung tu van va bien ban lam viec.',
                        'attachment_url' => null,
                        'created_at' => now()->subDays(random_int(1, 4)),
                        'updated_at' => now(),
                    ],
                    [
                        'dispute_id' => $disputeId,
                        'sender_user_id' => $appt['lawyer_id'],
                        'message' => 'Toi da cap nhat tai lieu bo sung de doi chieu.',
                        'attachment_url' => 'https://example.com/evidence/' . Str::uuid() . '.pdf',
                        'created_at' => now()->subDays(random_int(0, 3)),
                        'updated_at' => now(),
                    ],
                ]);

                DB::table('appointment_interventions')->insert([
                    'appointment_id' => $appointmentId,
                    'dispute_id' => $disputeId,
                    'admin_id' => $adminIds[array_rand($adminIds)],
                    'action' => 'FORCE_UPDATE_STATUS',
                    'reason' => 'Can can bang quyen loi 2 ben theo chinh sach nen tang.',
                    'before_status' => $appt['status'],
                    'after_status' => collect(['COMPLETED', 'CANCELLED'])->random(),
                    'acted_at' => now()->subDays(random_int(0, 3)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if (random_int(1, 100) <= 60) {
                    DB::table('appointment_refunds')->insert([
                        'appointment_id' => $appointmentId,
                        'processed_by_admin_id' => $adminIds[array_rand($adminIds)],
                        'refund_amount' => random_int(200000, 1200000),
                        'refund_ratio' => random_int(20, 100),
                        'currency' => 'VND',
                        'status' => collect(['PENDING', 'APPROVED', 'PAID'])->random(),
                        'reason' => 'Hoan tien theo ket qua xu ly tranh chap.',
                        'processed_at' => now()->subDays(random_int(0, 2)),
                        'created_at' => now()->subDays(random_int(1, 4)),
                        'updated_at' => now(),
                    ]);
                }
            }

            $customerSavedPairs = [];
            while (count($customerSavedPairs) < 80) {
                $customerId = $customerIds[array_rand($customerIds)];
                $lawyerId = $lawyerIds[array_rand($lawyerIds)];
                $key = $customerId . '-' . $lawyerId;
                if (isset($customerSavedPairs[$key])) {
                    continue;
                }

                $customerSavedPairs[$key] = true;

                DB::table('customer_saved_lawyers')->insert([
                    'customer_id' => $customerId,
                    'lawyer_id' => $lawyerId,
                    'created_at' => now()->subDays(random_int(0, 60)),
                    'updated_at' => now(),
                ]);
            }

            foreach (range(1, 16) as $i) {
                $lawyerId = $lawyerIds[array_rand($lawyerIds)];
                $slotId = $slotIds[array_rand($slotIds)];

                $sessionId = (string) Str::uuid();
                $migrated = random_int(1, 100) <= 45;
                $migratedAppointmentId = $migrated ? $appointmentIds[array_rand($appointmentIds)] : null;

                DB::table('guest_booking_sessions')->insert([
                    'id' => $sessionId,
                    'temp_token_hash' => hash('sha256', Str::random(30)),
                    'lawyer_id' => $lawyerId,
                    'slot_id' => $slotId,
                    'appointment_start' => now()->addDays(random_int(1, 15))->setTime(random_int(8, 18), 0),
                    'appointment_end' => now()->addDays(random_int(1, 15))->setTime(random_int(9, 20), 30),
                    'form_data' => json_encode([
                        'full_name' => $faker->name(),
                        'phone' => '09' . random_int(10000000, 99999999),
                        'topic' => 'Tu van phap ly ban dau',
                    ]),
                    'status' => $migrated ? 'MIGRATED' : collect(['INTENT_BOOKING', 'LOCKED'])->random(),
                    'migrated_to_customer_id' => $migrated ? $customerIds[array_rand($customerIds)] : null,
                    'migrated_appointment_id' => $migratedAppointmentId,
                    'migrated_at' => $migrated ? now()->subDays(random_int(0, 7)) : null,
                    'expires_at' => now()->addMinutes(random_int(20, 180)),
                    'created_at' => now()->subDays(random_int(0, 10)),
                    'updated_at' => now(),
                ]);

                if ($i <= 10) {
                    $start = now()->addDays($i)->setTime(9 + ($i % 5), 0);
                    DB::table('booking_locks')->insert([
                        'lawyer_id' => $lawyerId,
                        'customer_id' => random_int(1, 100) <= 60 ? $customerIds[array_rand($customerIds)] : null,
                        'guest_booking_session_id' => random_int(1, 100) <= 40 ? $sessionId : null,
                        'slot_id' => $slotId,
                        'appointment_start' => $start,
                        'appointment_end' => (clone $start)->addMinutes(90),
                        'expires_at' => (clone $start)->subMinutes(15),
                        'status' => collect(['ACTIVE', 'EXPIRED', 'CONSUMED'])->random(),
                        'created_at' => now()->subDays(random_int(0, 3)),
                        'updated_at' => now(),
                    ]);
                }
            }

            foreach (range(1, 160) as $n) {
                $userId = collect(array_merge($adminIds, $lawyerIds, $customerIds))->random();
                DB::table('notifications')->insert([
                    'user_id' => $userId,
                    'channel' => collect(['IN_APP', 'EMAIL'])->random(),
                    'type' => collect(['APPOINTMENT', 'PAYMENT', 'SYSTEM', 'DISPUTE'])->random(),
                    'title' => collect([
                        'Lich hen sap dien ra',
                        'Thanh toan thanh cong',
                        'Cap nhat ho so',
                        'Yeu cau bo sung thong tin',
                    ])->random(),
                    'message' => $faker->sentence(12),
                    'payload' => json_encode(['ref' => Str::uuid()]),
                    'sent_at' => now()->subDays(random_int(0, 15)),
                    'read_at' => random_int(1, 100) <= 70 ? now()->subDays(random_int(0, 7)) : null,
                    'created_at' => now()->subDays(random_int(0, 20)),
                    'updated_at' => now(),
                ]);
            }

            foreach (range(1, 45) as $n) {
                DB::table('admin_login_logs')->insert([
                    'user_id' => random_int(1, 100) <= 80 ? $adminIds[array_rand($adminIds)] : null,
                    'email' => 'admin' . random_int(1, 3) . '@legalease.vn',
                    'ip_address' => $faker->ipv4(),
                    'user_agent' => $faker->userAgent(),
                    'is_success' => random_int(1, 100) <= 88,
                    'failure_reason' => random_int(1, 100) <= 12 ? 'Sai mat khau' : null,
                    'attempted_at' => now()->subDays(random_int(0, 30))->subMinutes(random_int(0, 1440)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach (range(1, 180) as $n) {
                $cid = $customerIds[array_rand($customerIds)];
                DB::table('customer_login_logs')->insert([
                    'user_id' => random_int(1, 100) <= 90 ? $cid : null,
                    'email' => 'customer' . random_int(1, 30) . '@mail.vn',
                    'ip_address' => $faker->ipv4(),
                    'user_agent' => $faker->userAgent(),
                    'is_success' => random_int(1, 100) <= 92,
                    'failure_reason' => random_int(1, 100) <= 8 ? 'Tai khoan tam khoa' : null,
                    'attempted_at' => now()->subDays(random_int(0, 30))->subMinutes(random_int(0, 1440)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach (range(1, 14) as $n) {
                $reportedUser = collect(array_merge($lawyerIds, $customerIds))->random();
                $reporter = $customerIds[array_rand($customerIds)];
                DB::table('user_reports')->insert([
                    'reporter_id' => $reporter,
                    'reported_user_id' => $reportedUser,
                    'reason' => 'Noi dung trao doi chua phu hop va can admin xem xet.',
                    'status' => collect(['OPEN', 'IN_REVIEW', 'RESOLVED'])->random(),
                    'reviewed_by_admin_id' => random_int(1, 100) <= 65 ? $adminIds[array_rand($adminIds)] : null,
                    'reviewed_at' => random_int(1, 100) <= 65 ? now()->subDays(random_int(0, 10)) : null,
                    'created_at' => now()->subDays(random_int(1, 20)),
                    'updated_at' => now(),
                ]);
            }

            foreach (range(1, 10) as $n) {
                $target = collect($lawyerIds)->random();
                DB::table('user_violations')->insert([
                    'user_id' => $target,
                    'created_by_admin_id' => $adminIds[array_rand($adminIds)],
                    'violation_type' => collect(['NO_SHOW', 'LATE_RESPONSE', 'POLICY_BREACH'])->random(),
                    'description' => 'Vi pham quy dinh chat luong dich vu da duoc thong bao.',
                    'severity' => random_int(1, 3),
                    'occurred_at' => now()->subDays(random_int(2, 40)),
                    'recorded_at' => now()->subDays(random_int(1, 20)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach (range(1, 12) as $n) {
                $target = collect(array_merge($lawyerIds, $customerIds))->random();
                DB::table('account_actions')->insert([
                    'user_id' => $target,
                    'admin_id' => $adminIds[array_rand($adminIds)],
                    'action_type' => collect(['WARN', 'SUSPEND', 'UNLOCK'])->random(),
                    'previous_status' => 'ACTIVE',
                    'new_status' => collect(['ACTIVE', 'SUSPENDED'])->random(),
                    'reason' => 'Xu ly theo ket qua ra soat va bao cao he thong.',
                    'acted_at' => now()->subDays(random_int(0, 25)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach (range(1, 10) as $n) {
                DB::table('cms_articles')->insert([
                    'title' => collect([
                        '5 luu y khi ky hop dong lao dong',
                        'Thu tuc ly hon don phuong cap nhat',
                        'Mua ban dat nen: cac rui ro phap ly pho bien',
                        'Doanh nghiep can chuan bi gi khi bi thanh tra thue',
                    ])->random(),
                    'slug' => 'article-' . Str::lower(Str::random(8)) . '-' . $n,
                    'thumbnail_url' => 'https://picsum.photos/seed/legal' . $n . '/640/360',
                    'content' => $faker->paragraphs(6, true),
                    'status' => collect(['DRAFT', 'PUBLISHED'])->random(),
                    'author_admin_id' => $adminIds[array_rand($adminIds)],
                    'published_at' => now()->subDays(random_int(0, 30)),
                    'created_at' => now()->subDays(random_int(0, 40)),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ]);
            }

            foreach (range(1, 12) as $n) {
                DB::table('cms_faqs')->insert([
                    'question' => 'Cau hoi thuong gap #' . $n,
                    'answer' => 'Day la noi dung giai dap tong quan cho nguoi dung ve quy trinh su dung dich vu.',
                    'display_order' => $n,
                    'is_active' => true,
                    'updated_by_admin_id' => $adminIds[array_rand($adminIds)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $homeConfigId = DB::table('cms_home_configs')->insertGetId([
                'name' => 'default-' . now()->format('YmdHis'),
                'is_published' => true,
                'updated_by_admin_id' => $adminIds[array_rand($adminIds)],
                'published_at' => now()->subDays(1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach (collect($lawyerIds)->shuffle()->take(6)->values() as $idx => $lawyerId) {
                DB::table('cms_home_featured_lawyers')->insert([
                    'home_config_id' => $homeConfigId,
                    'lawyer_id' => $lawyerId,
                    'display_order' => $idx + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach (range(1, 5) as $n) {
                DB::table('cms_home_pins')->insert([
                    'home_config_id' => $homeConfigId,
                    'section_key' => collect(['hero', 'how_it_works', 'legal_news', 'cta'])->random(),
                    'title' => 'Noi bat #' . $n,
                    'content' => $faker->sentence(16),
                    'image_url' => 'https://picsum.photos/seed/pin' . $n . '/800/450',
                    'display_order' => $n,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach (range(1, 8) as $n) {
                DB::table('admin_report_exports')->insert([
                    'requested_by_admin_id' => $adminIds[array_rand($adminIds)],
                    'report_type' => collect(['BOOKING', 'REVENUE', 'DISPUTE', 'LAWYER_PERFORMANCE'])->random(),
                    'from_at' => now()->subDays(random_int(30, 90)),
                    'to_at' => now()->subDays(random_int(1, 29)),
                    'file_format' => collect(['CSV', 'XLSX'])->random(),
                    'status' => collect(['PENDING', 'PROCESSING', 'DONE'])->random(),
                    'file_path' => 'exports/report_' . Str::lower(Str::random(10)) . '.csv',
                    'summary' => json_encode([
                        'rows' => random_int(100, 1200),
                        'generated_by' => 'system',
                    ]),
                    'generated_at' => now()->subDays(random_int(0, 8)),
                    'created_at' => now()->subDays(random_int(0, 10)),
                    'updated_at' => now(),
                ]);
            }

            foreach (range(1, 60) as $n) {
                DB::table('admin_audit_logs')->insert([
                    'admin_id' => $adminIds[array_rand($adminIds)],
                    'action' => collect(['CREATE', 'UPDATE', 'VERIFY', 'SUSPEND', 'EXPORT'])->random(),
                    'entity_type' => collect(['USER', 'LAWYER_PROFILE', 'APPOINTMENT', 'CMS_ARTICLE', 'REPORT'])->random(),
                    'entity_id' => random_int(1, 200),
                    'before_data' => json_encode(['status' => 'PENDING']),
                    'after_data' => json_encode(['status' => 'UPDATED']),
                    'ip_address' => $faker->ipv4(),
                    'user_agent' => $faker->userAgent(),
                    'acted_at' => now()->subDays(random_int(0, 20)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }
}
