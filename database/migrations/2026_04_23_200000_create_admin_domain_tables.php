<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
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

        Schema::create('admin_login_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('email', 255);
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->boolean('is_success')->default(false);
            $table->string('failure_reason', 255)->nullable();
            $table->dateTime('attempted_at');
            $table->timestamps();

            $table->index(['email', 'attempted_at'], 'idx_admin_login_email_attempt');
            $table->index(['is_success', 'attempted_at'], 'idx_admin_login_success_attempt');
        });

        Schema::create('lawyer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('bar_association_name', 255)->nullable();
            $table->string('bar_card_number', 100)->nullable();
            $table->unsignedSmallInteger('years_of_experience')->default(0);
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

        Schema::create('lawyer_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lawyer_profile_id')->constrained('lawyer_profiles')->cascadeOnDelete();
            $table->string('document_type', 50);
            $table->string('document_number', 100)->nullable();
            $table->string('file_url');
            $table->string('status', 20)->default('PENDING');
            $table->dateTime('reviewed_at')->nullable();
            $table->foreignId('reviewed_by_admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('review_note')->nullable();
            $table->timestamps();

            $table->index(['lawyer_profile_id', 'document_type'], 'idx_lawyer_doc_profile_type');
            $table->index(['status', 'reviewed_at'], 'idx_lawyer_doc_status_review');
        });

        Schema::create('lawyer_verification_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lawyer_profile_id')->constrained('lawyer_profiles')->cascadeOnDelete();
            $table->foreignId('admin_id')->constrained('users')->cascadeOnDelete();
            $table->string('decision', 20);
            $table->text('reason')->nullable();
            $table->json('snapshot')->nullable();
            $table->dateTime('reviewed_at');
            $table->timestamps();

            $table->index(['lawyer_profile_id', 'reviewed_at'], 'idx_lawyer_review_profile_time');
            $table->index(['decision', 'reviewed_at'], 'idx_lawyer_review_decision_time');
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

        Schema::create('user_violations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('created_by_admin_id')->constrained('users')->cascadeOnDelete();
            $table->string('violation_type', 100);
            $table->text('description');
            $table->smallInteger('severity')->default(1);
            $table->dateTime('occurred_at')->nullable();
            $table->dateTime('recorded_at');
            $table->timestamps();

            $table->index(['user_id', 'recorded_at'], 'idx_user_violations_user_time');
            $table->index(['violation_type', 'severity'], 'idx_user_violations_type_sev');
        });

        Schema::create('account_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('admin_id')->constrained('users')->cascadeOnDelete();
            $table->string('action_type', 30);
            $table->string('previous_status', 20)->nullable();
            $table->string('new_status', 20);
            $table->text('reason')->nullable();
            $table->dateTime('acted_at');
            $table->timestamps();

            $table->index(['user_id', 'acted_at'], 'idx_account_actions_user_time');
            $table->index(['action_type', 'acted_at'], 'idx_account_actions_type_time');
        });

        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code', 50)->unique();
            $table->foreignId('lawyer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->string('status', 20)->default('PENDING');
            $table->dateTime('scheduled_start_at');
            $table->dateTime('scheduled_end_at')->nullable();
            $table->string('timezone', 50)->default('Asia/Ho_Chi_Minh');
            $table->decimal('price_amount', 12, 2)->default(0);
            $table->decimal('final_amount', 12, 2)->default(0);
            $table->string('currency', 10)->default('VND');
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->foreignId('cancelled_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('cancellation_reason')->nullable();
            $table->timestamps();

            $table->index(['status', 'scheduled_start_at'], 'idx_appointments_status_start');
            $table->index(['lawyer_id', 'scheduled_start_at'], 'idx_appointments_lawyer_start');
            $table->index(['customer_id', 'scheduled_start_at'], 'idx_appointments_customer_start');
        });

        Schema::create('appointment_disputes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments')->cascadeOnDelete();
            $table->foreignId('raised_by_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('status', 20)->default('OPEN');
            $table->text('description');
            $table->foreignId('assigned_admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('resolved_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at'], 'idx_appt_disputes_status_time');
            $table->index(['appointment_id', 'status'], 'idx_appt_disputes_appt_status');
        });

        Schema::create('appointment_dispute_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dispute_id')->constrained('appointment_disputes')->cascadeOnDelete();
            $table->foreignId('sender_user_id')->constrained('users')->cascadeOnDelete();
            $table->text('message');
            $table->string('attachment_url')->nullable();
            $table->timestamps();

            $table->index(['dispute_id', 'created_at'], 'idx_appt_dispute_msg_dispute_time');
        });

        Schema::create('appointment_interventions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments')->cascadeOnDelete();
            $table->foreignId('dispute_id')->nullable()->constrained('appointment_disputes')->nullOnDelete();
            $table->foreignId('admin_id')->constrained('users')->cascadeOnDelete();
            $table->string('action', 30);
            $table->text('reason');
            $table->string('before_status', 20)->nullable();
            $table->string('after_status', 20);
            $table->dateTime('acted_at');
            $table->timestamps();

            $table->index(['appointment_id', 'acted_at'], 'idx_appt_interventions_appt_time');
            $table->index(['action', 'acted_at'], 'idx_appt_interventions_action_time');
        });

        Schema::create('appointment_refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments')->cascadeOnDelete();
            $table->foreignId('processed_by_admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('refund_amount', 12, 2);
            $table->decimal('refund_ratio', 5, 2)->nullable();
            $table->string('currency', 10)->default('VND');
            $table->string('status', 20)->default('PENDING');
            $table->text('reason')->nullable();
            $table->dateTime('processed_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at'], 'idx_appt_refunds_status_time');
            $table->index(['appointment_id', 'status'], 'idx_appt_refunds_appt_status');
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('channel', 20)->default('IN_APP');
            $table->string('type', 50);
            $table->string('title', 255);
            $table->text('message');
            $table->json('payload')->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->dateTime('read_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'read_at'], 'idx_notifications_user_read');
            $table->index(['type', 'created_at'], 'idx_notifications_type_time');
        });

        Schema::create('cms_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->string('thumbnail_url')->nullable();
            $table->longText('content');
            $table->string('status', 20)->default('DRAFT');
            $table->foreignId('author_admin_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'published_at'], 'idx_cms_articles_status_pub');
        });

        Schema::create('cms_faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question', 500);
            $table->text('answer');
            $table->unsignedInteger('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('updated_by_admin_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->index(['is_active', 'display_order'], 'idx_cms_faqs_active_order');
        });

        Schema::create('cms_home_configs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->default('default');
            $table->boolean('is_published')->default(false);
            $table->foreignId('updated_by_admin_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();

            $table->unique('name');
        });

        Schema::create('cms_home_featured_lawyers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_config_id')->constrained('cms_home_configs')->cascadeOnDelete();
            $table->foreignId('lawyer_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();

            $table->unique(['home_config_id', 'lawyer_id'], 'uq_home_featured_cfg_lawyer');
            $table->index(['home_config_id', 'display_order'], 'idx_home_featured_cfg_order');
        });

        Schema::create('cms_home_pins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_config_id')->constrained('cms_home_configs')->cascadeOnDelete();
            $table->string('section_key', 100);
            $table->string('title', 255)->nullable();
            $table->text('content')->nullable();
            $table->string('image_url')->nullable();
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();

            $table->index(['home_config_id', 'section_key'], 'idx_home_pins_cfg_section');
        });

        Schema::create('admin_report_exports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requested_by_admin_id')->constrained('users')->cascadeOnDelete();
            $table->string('report_type', 50);
            $table->dateTime('from_at');
            $table->dateTime('to_at');
            $table->string('file_format', 10);
            $table->string('status', 20)->default('PENDING');
            $table->string('file_path')->nullable();
            $table->json('summary')->nullable();
            $table->dateTime('generated_at')->nullable();
            $table->timestamps();

            $table->index(['report_type', 'from_at', 'to_at'], 'idx_admin_reports_type_range');
            $table->index(['status', 'created_at'], 'idx_admin_reports_status_time');
        });

        Schema::create('admin_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action', 100);
            $table->string('entity_type', 100);
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->json('before_data')->nullable();
            $table->json('after_data')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->dateTime('acted_at');
            $table->timestamps();

            $table->index(['entity_type', 'entity_id'], 'idx_admin_audit_entity');
            $table->index(['action', 'acted_at'], 'idx_admin_audit_action_time');
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_audit_logs');
        Schema::dropIfExists('admin_report_exports');
        Schema::dropIfExists('cms_home_pins');
        Schema::dropIfExists('cms_home_featured_lawyers');
        Schema::dropIfExists('cms_home_configs');
        Schema::dropIfExists('cms_faqs');
        Schema::dropIfExists('cms_articles');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('appointment_refunds');
        Schema::dropIfExists('appointment_interventions');
        Schema::dropIfExists('appointment_dispute_messages');
        Schema::dropIfExists('appointment_disputes');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('account_actions');
        Schema::dropIfExists('user_violations');
        Schema::dropIfExists('customer_profiles');
        Schema::dropIfExists('lawyer_verification_reviews');
        Schema::dropIfExists('lawyer_documents');
        Schema::dropIfExists('lawyer_profiles');
        Schema::dropIfExists('admin_login_logs');

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('idx_users_role_status');
            $table->dropConstrainedForeignId('role_id');
            $table->dropColumn(['status', 'phone', 'avatar_url', 'last_login_at']);
        });

        Schema::dropIfExists('roles');
    }
};
