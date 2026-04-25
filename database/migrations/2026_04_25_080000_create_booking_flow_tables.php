<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_lawyers', function (Blueprint $table) {
            $table->id();
            $table->string('display_name', 150);
            $table->string('specialty', 120);
            $table->string('location', 120);
            $table->unsignedSmallInteger('experience_years')->default(0);
            $table->decimal('consultation_fee', 12, 2)->default(0);
            $table->decimal('rating', 3, 2)->default(5);
            $table->text('bio')->nullable();
            $table->string('avatar_initials', 6)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['specialty', 'location'], 'idx_booking_lawyers_specialty_location');
            $table->index(['is_active', 'rating'], 'idx_booking_lawyers_active_rating');
        });

        Schema::create('booking_time_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_lawyer_id')
                ->constrained('booking_lawyers')
                ->cascadeOnDelete();
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->boolean('is_booked')->default(false);
            $table->timestamps();

            $table->unique(['booking_lawyer_id', 'start_at'], 'uq_booking_time_slots_lawyer_start');
            $table->index(['is_booked', 'start_at'], 'idx_booking_time_slots_booked_start');
        });

        Schema::create('booking_appointments', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code', 40)->unique();
            $table->unsignedBigInteger('customer_user_id');
            $table->string('customer_name', 150);
            $table->string('customer_email', 255);
            $table->string('customer_phone', 30);
            $table->foreignId('booking_lawyer_id')
                ->constrained('booking_lawyers')
                ->cascadeOnDelete();
            $table->foreignId('booking_time_slot_id')
                ->nullable()
                ->constrained('booking_time_slots')
                ->nullOnDelete();
            $table->dateTime('appointment_start_at');
            $table->dateTime('appointment_end_at');
            $table->text('issue_summary')->nullable();
            $table->string('status', 30)->default('CONFIRMED');
            $table->dateTime('cancelled_at')->nullable();
            $table->timestamps();

            $table->index(['customer_user_id', 'appointment_start_at'], 'idx_booking_appt_customer_start');
            $table->index(['status', 'appointment_start_at'], 'idx_booking_appt_status_start');
        });

        $this->seedBookingData();
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_appointments');
        Schema::dropIfExists('booking_time_slots');
        Schema::dropIfExists('booking_lawyers');
    }

    private function seedBookingData(): void
    {
        $now = Carbon::now();
        $lawyers = [
            [
                'display_name' => 'Luat su Tran Minh Anh',
                'specialty' => 'Hop dong doanh nghiep',
                'location' => 'Ho Chi Minh',
                'experience_years' => 12,
                'consultation_fee' => 950000,
                'rating' => 4.90,
                'bio' => 'Tu van hop dong va xu ly tranh chap thuong mai cho doanh nghiep SME.',
                'avatar_initials' => 'TA',
                'is_active' => true,
            ],
            [
                'display_name' => 'Luat su Nguyen Hoang Long',
                'specialty' => 'Lao dong va bao hiem',
                'location' => 'Ha Noi',
                'experience_years' => 9,
                'consultation_fee' => 800000,
                'rating' => 4.80,
                'bio' => 'Ho tro doanh nghiep va nguoi lao dong ve hop dong lao dong, tranh chap luong thuong.',
                'avatar_initials' => 'NL',
                'is_active' => true,
            ],
            [
                'display_name' => 'Luat su Le Gia Han',
                'specialty' => 'So huu tri tue',
                'location' => 'Da Nang',
                'experience_years' => 7,
                'consultation_fee' => 1100000,
                'rating' => 4.95,
                'bio' => 'Dang ky nhan hieu, ban quyen va xu ly xam pham so huu tri tue.',
                'avatar_initials' => 'LH',
                'is_active' => true,
            ],
            [
                'display_name' => 'Luat su Pham Quoc Bao',
                'specialty' => 'Dat dai va nha o',
                'location' => 'Can Tho',
                'experience_years' => 11,
                'consultation_fee' => 900000,
                'rating' => 4.85,
                'bio' => 'Tu van thu tuc sang ten, tranh chap quyen su dung dat va hop dong mua ban nha.',
                'avatar_initials' => 'PB',
                'is_active' => true,
            ],
        ];

        foreach ($lawyers as $lawyer) {
            $lawyerId = DB::table('booking_lawyers')->insertGetId([
                ...$lawyer,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            for ($day = 1; $day <= 7; $day++) {
                $date = $now->copy()->addDays($day);
                $slotStarts = [9, 11, 14, 16];

                foreach ($slotStarts as $hour) {
                    $start = $date->copy()->setTime($hour, 0);

                    DB::table('booking_time_slots')->insert([
                        'booking_lawyer_id' => $lawyerId,
                        'start_at' => $start,
                        'end_at' => $start->copy()->addMinutes(45),
                        'is_booked' => false,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }
};
