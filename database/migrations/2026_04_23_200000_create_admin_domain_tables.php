<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('id')->constrained('roles')->nullOnDelete();
            $table->string('status', 20)->default('ACTIVE')->after('password');
            $table->string('phone', 30)->nullable()->after('email');
            $table->string('avatar_url')->nullable()->after('phone');
            $table->dateTime('last_login_at')->nullable()->after('remember_token');

            $table->index(['role_id', 'status'], 'idx_users_role_status');
        });

        Schema::create('lawyer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('bar_association_name', 255)->nullable();
            $table->string('bar_card_number', 100)->nullable();
            $table->unsignedSmallInteger('years_of_experience')->default(0);
            $table->decimal('consultation_fee', 12, 2)->default(0);
            $table->decimal('rating', 3, 2)->default(5.00);
            $table->text('expertise')->nullable();
            $table->text('bio')->nullable();
            $table->string('verification_status', 20)->default('UNVERIFIED');
            $table->unsignedInteger('cancellation_count')->default(0);
            $table->unsignedInteger('no_show_count')->default(0);
            $table->unsignedInteger('violation_count')->default(0);
            $table->dateTime('last_violation_at')->nullable();
            $table->boolean('is_search_visible')->default(true);
            $table->dateTime('locked_at')->nullable();
            $table->foreignId('locked_by_admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('lock_reason')->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->foreignId('verified_by_admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['verification_status', 'verified_at'], 'idx_lawyer_profile_verif');
            $table->index(['is_search_visible', 'verification_status'], 'idx_lawyer_profile_search');
            $table->index(['violation_count', 'no_show_count'], 'idx_lawyer_profile_risk');
        });

        Schema::create('customer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->date('date_of_birth')->nullable();
            $table->string('gender', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('identity_number', 100)->nullable();
            $table->string('identity_status', 20)->default('UNVERIFIED');
            $table->dateTime('identity_verified_at')->nullable();
            $table->foreignId('identity_verified_by_admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['identity_status', 'identity_verified_at'], 'idx_cust_profile_identity');
        });

        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lawyer_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('status', 20)->default('OPEN');
            $table->foreignId('locked_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('locked_at')->nullable();
            $table->dateTime('lock_expires_at')->nullable();
            $table->timestamps();

            $table->unique(['lawyer_id', 'start_time'], 'uq_slots_lawyer_start');
            $table->index(['lawyer_id', 'start_time'], 'idx_slots_lawyer_start');
            $table->index(['status', 'start_time'], 'idx_slots_status_start');
            $table->index(['lock_expires_at', 'status'], 'idx_slots_lock_exp_booked');
        });

        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code', 50)->unique();
            $table->foreignId('lawyer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('slot_id')->nullable()->constrained('slots')->nullOnDelete();
            $table->string('status', 30)->default('PENDING');
            $table->string('consultation_topic', 255)->nullable();
            $table->text('consultation_summary')->nullable();
            $table->dateTime('scheduled_start_at');
            $table->dateTime('scheduled_end_at')->nullable();
            $table->string('timezone', 50)->default('Asia/Ho_Chi_Minh');
            $table->decimal('price_amount', 12, 2)->default(0);
            $table->decimal('deposit_amount', 12, 2)->default(0);
            $table->decimal('final_amount', 12, 2)->default(0);
            $table->text('customer_note')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->dateTime('outcome_reported_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->foreignId('cancelled_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('cancellation_reason')->nullable();
            $table->decimal('refund_amount', 12, 2)->nullable();
            $table->string('refund_status', 30)->nullable();
            $table->text('admin_note')->nullable();
            $table->timestamps();

            $table->unique('slot_id', 'uq_appointments_slot_id');
            $table->index(['status', 'scheduled_start_at'], 'idx_appointments_status_start');
            $table->index(['lawyer_id', 'scheduled_start_at'], 'idx_appointments_lawyer_start');
            $table->index(['customer_id', 'scheduled_start_at'], 'idx_appointments_customer_start');
            $table->index(['outcome_reported_at'], 'idx_appointments_outcome');
            $table->index(['status', 'paid_at'], 'idx_appt_status_paid_at');
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments')->cascadeOnDelete();
            $table->foreignId('submitted_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('reviewed_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('amount', 12, 2);
            $table->string('payment_type', 20);
            $table->string('payment_method', 50)->nullable();
            $table->string('bank_name', 120)->nullable();
            $table->string('transfer_reference', 120)->nullable();
            $table->text('customer_note')->nullable();
            $table->text('admin_note')->nullable();
            $table->string('status', 30)->default('PENDING');
            $table->string('transaction_id', 120)->nullable()->unique('uq_payments_transaction_id');
            $table->dateTime('submitted_at')->nullable();
            $table->dateTime('reviewed_at')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->timestamps();

            $table->index(['appointment_id', 'payment_type'], 'idx_payments_appt_type');
            $table->index(['status', 'created_at'], 'idx_payments_status_time');
        });

        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->unique()->constrained('appointments')->cascadeOnDelete();
            $table->unsignedTinyInteger('stars');
            $table->string('title', 255)->nullable();
            $table->text('review_text')->nullable();
            $table->boolean('is_public')->default(true);
            $table->dateTime('reviewed_at')->nullable();
            $table->boolean('is_reported')->default(false);
            $table->boolean('is_removed')->default(false);
            $table->timestamps();

            $table->index(['is_removed', 'created_at'], 'idx_ratings_removed_created');
        });
        DB::statement('ALTER TABLE ratings ADD CONSTRAINT chk_ratings_stars_range CHECK (stars >= 1 AND stars <= 5)');

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('content');
            $table->string('image_url', 255)->nullable();
            $table->string('status', 20)->default('PUBLISHED');
            $table->timestamps();

            $table->index(['status', 'created_at'], 'idx_news_status_created');
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question', 255);
            $table->text('answer');
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title', 255);
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamp('created_at')->nullable();

            $table->index(['user_id', 'is_read', 'created_at'], 'idx_notifications_user_read');
        });

        DB::table('roles')->insert([
            [
                'code' => 'ADMIN',
                'name' => 'Administrator',
                'description' => 'Platform administrator with full moderation privileges.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'LAWYER',
                'name' => 'Lawyer',
                'description' => 'Legal expert account for consultations.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'CUSTOMER',
                'name' => 'Customer',
                'description' => 'Client account booking consultations.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('news');
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('slots');
        Schema::dropIfExists('customer_profiles');
        Schema::dropIfExists('lawyer_profiles');

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('idx_users_role_status');
            $table->dropConstrainedForeignId('role_id');
            $table->dropColumn(['status', 'phone', 'avatar_url', 'last_login_at']);
        });

        Schema::dropIfExists('roles');
    }
};
