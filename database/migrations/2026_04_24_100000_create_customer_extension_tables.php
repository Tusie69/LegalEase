<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_login_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('email', 255);
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->boolean('is_success')->default(false);
            $table->string('failure_reason', 255)->nullable();
            $table->dateTime('attempted_at');
            $table->timestamps();

            $table->index(['email', 'attempted_at'], 'idx_customer_login_email_attempt');
            $table->index(['is_success', 'attempted_at'], 'idx_customer_login_success_attempt');
        });

        Schema::create('customer_saved_lawyers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('lawyer_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['customer_id', 'lawyer_id'], 'uq_customer_saved_lawyer');
            $table->index(['customer_id', 'created_at'], 'idx_customer_saved_customer_time');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->string('consultation_type', 30)->default('ONLINE')->after('status');
            $table->string('consultation_topic', 255)->nullable()->after('consultation_type');
            $table->text('consultation_summary')->nullable()->after('consultation_topic');
            $table->string('meeting_channel', 30)->nullable()->after('currency');
            $table->string('meeting_link')->nullable()->after('meeting_channel');
            $table->text('customer_note')->nullable()->after('meeting_link');

            $table->index(['consultation_type', 'scheduled_start_at'], 'idx_appt_consultation_type_start');
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->string('title', 255)->nullable()->after('stars');
            $table->boolean('is_public')->default(true)->after('review_text');
            $table->dateTime('reviewed_at')->nullable()->after('is_public');
        });
    }

    public function down(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropColumn(['title', 'is_public', 'reviewed_at']);
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->dropIndex('idx_appt_consultation_type_start');
            $table->dropColumn([
                'consultation_type',
                'consultation_topic',
                'consultation_summary',
                'meeting_channel',
                'meeting_link',
                'customer_note',
            ]);
        });

        Schema::dropIfExists('customer_saved_lawyers');
        Schema::dropIfExists('customer_login_logs');
    }
};
