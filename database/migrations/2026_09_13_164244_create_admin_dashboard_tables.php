<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Admin Activity Logs & Audit Trail
        if (!Schema::hasTable('admin_activity_logs')) {
            Schema::create('admin_activity_logs', function (Blueprint $table) {
                $table->id('logId');
                $table->unsignedBigInteger('userId')->index()->nullable();
                $table->string('action_type'); // course_created, test_created, question_reported, user_role_changed, etc.
                $table->string('description');
                $table->string('ip_address')->nullable();
                $table->timestamps();
            });
        }

        // 2. Revenue & Enrollment Monthly Metric Snapshots
        if (!Schema::hasTable('revenue_stats')) {
            Schema::create('revenue_stats', function (Blueprint $table) {
                $table->id('statId');
                $table->string('month_key'); // e.g. 2026-02, 2026-03
                $table->string('month_name'); // Feb, Mar, Apr
                $table->decimal('total_revenue', 12, 2)->default(0);
                $table->integer('total_enrollments')->default(0);
                $table->decimal('course_revenue', 12, 2)->default(0);
                $table->decimal('test_revenue', 12, 2)->default(0);
                $table->decimal('series_revenue', 12, 2)->default(0);
                $table->timestamps();

                $table->unique('month_key');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenue_stats');
        Schema::dropIfExists('admin_activity_logs');
    }
};
