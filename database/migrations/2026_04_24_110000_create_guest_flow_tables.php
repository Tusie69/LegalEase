<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guest_booking_sessions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('temp_token_hash', 191)->unique();
            $table->foreignId('lawyer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('slot_id')->nullable()->constrained('slots')->nullOnDelete();
            $table->dateTime('appointment_start')->nullable();
            $table->dateTime('appointment_end')->nullable();
            $table->json('form_data')->nullable();
            $table->string('status', 30)->default('INTENT_BOOKING');
            $table->foreignId('migrated_to_customer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('migrated_appointment_id')->nullable()->constrained('appointments')->nullOnDelete();
            $table->dateTime('migrated_at')->nullable();
            $table->dateTime('expires_at');
            $table->timestamps();

            $table->index('expires_at', 'idx_guest_sessions_expires');
            $table->index(['status', 'expires_at'], 'idx_guest_sessions_status_exp');
        });

        Schema::create('booking_locks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lawyer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->uuid('guest_booking_session_id')->nullable();
            $table->foreign('guest_booking_session_id', 'fk_booking_locks_guest_session')
                ->references('id')
                ->on('guest_booking_sessions')
                ->nullOnDelete();
            $table->foreignId('slot_id')->nullable()->constrained('slots')->nullOnDelete();
            $table->dateTime('appointment_start');
            $table->dateTime('appointment_end');
            $table->dateTime('expires_at');
            $table->string('status', 20)->default('ACTIVE');
            $table->timestamps();

            $table->unique(['lawyer_id', 'appointment_start'], 'uq_booking_locks_lawyer_start');
            $table->index('expires_at', 'idx_booking_locks_expires');
            $table->index(['status', 'expires_at'], 'idx_booking_locks_status_exp');
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments')->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->string('payment_type', 20); // DEPOSIT, REMAINING, REFUND
            $table->string('payment_method', 50)->nullable();
            $table->string('status', 20)->default('PENDING'); // PENDING, PAID, FAILED
            $table->string('transaction_id', 120)->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->timestamps();

            $table->index(['appointment_id', 'payment_type'], 'idx_payments_appt_type');
            $table->index(['status', 'created_at'], 'idx_payments_status_time');
            $table->unique('transaction_id', 'uq_payments_transaction_id');
        });

        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->nullOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('lawyer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['appointment_id', 'created_at'], 'idx_conversations_appt_time');
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained('conversations')->cascadeOnDelete();
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
            $table->text('message_text')->nullable();
            $table->string('attachment_url')->nullable();
            $table->dateTime('read_at')->nullable();
            $table->timestamps();

            $table->index(['conversation_id', 'created_at'], 'idx_messages_conversation_time');
            $table->index(['sender_id', 'created_at'], 'idx_messages_sender_time');
        });

        Schema::create('appointment_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments')->cascadeOnDelete();
            $table->foreignId('uploaded_by')->constrained('users')->cascadeOnDelete();
            $table->text('file_url');
            $table->string('file_type', 50)->nullable();
            $table->timestamps();

            $table->index(['appointment_id', 'created_at'], 'idx_appt_documents_appt_time');
        });

        Schema::create('user_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reporter_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('reported_user_id')->constrained('users')->cascadeOnDelete();
            $table->text('reason');
            $table->string('status', 20)->default('OPEN');
            $table->foreignId('reviewed_by_admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('reviewed_at')->nullable();
            $table->timestamps();

            $table->index(['reported_user_id', 'status'], 'idx_user_reports_user_status');
            $table->index(['status', 'created_at'], 'idx_user_reports_status_time');
        });

        Schema::create('cancellation_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lawyer_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedInteger('hours_before_full_refund')->nullable();
            $table->unsignedInteger('refund_percentage')->nullable();
            $table->timestamps();

            $table->unique('lawyer_id', 'uq_cancellation_policies_lawyer');
        });

        Schema::create('appointment_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments')->cascadeOnDelete();
            $table->string('event_type', 50);
            $table->foreignId('actor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('actor_type', 20)->default('SYSTEM');
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['appointment_id', 'created_at'], 'idx_appt_events_appt_time');
            $table->index(['event_type', 'created_at'], 'idx_appt_events_type_time');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment_events');
        Schema::dropIfExists('cancellation_policies');
        Schema::dropIfExists('user_reports');
        Schema::dropIfExists('appointment_documents');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('conversations');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('booking_locks');
        Schema::dropIfExists('guest_booking_sessions');
    }
};
