<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specializations', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('image_url', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('lawyer_specializations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lawyer_profile_id')->constrained('lawyer_profiles')->cascadeOnDelete();
            $table->foreignId('specialization_id')->constrained('specializations')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['lawyer_profile_id', 'specialization_id'], 'uq_lawyer_spec_profile_spec');
            $table->index('specialization_id', 'idx_lawyer_spec_specialization');
        });

        Schema::create('lawyer_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lawyer_profile_id')->unique()->constrained('lawyer_profiles')->cascadeOnDelete();
            $table->string('province', 100);
            $table->string('street_address', 255);
            $table->timestamps();

            $table->index('province', 'idx_lawyer_addresses_province');
        });

        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lawyer_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('status', 20)->default('OPEN');
            $table->timestamps();

            $table->index(['lawyer_id', 'start_time'], 'idx_slots_lawyer_start');
            $table->index(['status', 'start_time'], 'idx_slots_status_start');
        });

        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->unique()->constrained('appointments')->cascadeOnDelete();
            $table->unsignedTinyInteger('stars');
            $table->text('review_text')->nullable();
            $table->boolean('is_reported')->default(false);
            $table->boolean('is_removed')->default(false);
            $table->timestamps();

            $table->index(['is_removed', 'created_at'], 'idx_ratings_removed_created');
        });
        DB::statement('ALTER TABLE ratings ADD CONSTRAINT chk_ratings_stars_range CHECK (stars >= 1 AND stars <= 5)');

        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('slot_id')->nullable()->after('customer_id')->constrained('slots')->nullOnDelete();
            $table->decimal('consultation_fee_snapshot', 12, 2)->default(0)->after('final_amount');
            $table->decimal('deposit_amount', 12, 2)->default(0)->after('consultation_fee_snapshot');
            $table->enum('outcome_reported_by', ['LAWYER', 'CUSTOMER', 'ADMIN'])->nullable()->after('deposit_amount');
            $table->dateTime('outcome_reported_at')->nullable()->after('outcome_reported_by');

            $table->unique('slot_id', 'uq_appointments_slot_id');
            $table->index(['outcome_reported_by', 'outcome_reported_at'], 'idx_appointments_outcome');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropIndex('idx_appointments_outcome');
            $table->dropUnique('uq_appointments_slot_id');
            $table->dropConstrainedForeignId('slot_id');
            $table->dropColumn([
                'consultation_fee_snapshot',
                'deposit_amount',
                'outcome_reported_by',
                'outcome_reported_at',
            ]);
        });

        Schema::dropIfExists('ratings');
        Schema::dropIfExists('slots');
        Schema::dropIfExists('lawyer_addresses');
        Schema::dropIfExists('lawyer_specializations');
        Schema::dropIfExists('specializations');
    }
};
