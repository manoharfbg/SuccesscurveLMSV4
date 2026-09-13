<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations for modern scalable student dashboard features.
     */
    public function up(): void
    {
        // 1. Daily Study Goals & Progress
        if (!Schema::hasTable('student_daily_goals')) {
            Schema::create('student_daily_goals', function (Blueprint $table) {
                $table->id('goalId');
                $table->unsignedBigInteger('userId')->index();
                $table->date('goal_date')->index();
                $table->integer('target_minutes')->default(60);
                $table->integer('completed_minutes')->default(0);
                $table->integer('lectures_watched')->default(0);
                $table->integer('questions_attempted')->default(0);
                $table->timestamps();

                $table->unique(['userId', 'goal_date']);
            });
        }

        // 2. Badges Master
        if (!Schema::hasTable('badges')) {
            Schema::create('badges', function (Blueprint $table) {
                $table->id('badgeId');
                $table->string('slug')->unique();
                $table->string('title');
                $table->string('subtitle')->nullable();
                $table->string('icon')->nullable();
                $table->string('color')->default('#024F9D');
                $table->text('description')->nullable();
                $table->string('criteria_type')->nullable(); // streak, accuracy, tests_completed, etc.
                $table->integer('criteria_value')->default(0);
                $table->timestamps();
            });
        }

        // 3. User Badges (Earned)
        if (!Schema::hasTable('user_badges')) {
            Schema::create('user_badges', function (Blueprint $table) {
                $table->id('ubId');
                $table->unsignedBigInteger('userId')->index();
                $table->unsignedBigInteger('badgeId')->index();
                $table->timestamp('earned_at')->useCurrent();
                $table->timestamps();

                $table->unique(['userId', 'badgeId']);
            });
        }

        // 4. Student Activities (Recent feed)
        if (!Schema::hasTable('student_activities')) {
            Schema::create('student_activities', function (Blueprint $table) {
                $table->id('activityId');
                $table->unsignedBigInteger('userId')->index();
                $table->string('activity_type'); // test_completed, lecture_watched, badge_earned, doubt_asked
                $table->string('icon')->default('▶');
                $table->string('icon_color')->default('#024F9D');
                $table->string('bg_color')->default('#EAF1FB');
                $table->string('title');
                $table->string('time_label')->default('Just now');
                $table->timestamps();
            });
        }

        // 5. Subject Strength & Speed Analytics Cache
        if (!Schema::hasTable('student_subject_stats')) {
            Schema::create('student_subject_stats', function (Blueprint $table) {
                $table->id('statId');
                $table->unsignedBigInteger('userId')->index();
                $table->unsignedBigInteger('subjectId')->index();
                $table->decimal('accuracy_percentage', 5, 2)->default(0);
                $table->integer('avg_time_seconds')->default(60);
                $table->integer('total_attempted')->default(0);
                $table->integer('total_correct')->default(0);
                $table->timestamps();

                $table->unique(['userId', 'subjectId']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_subject_stats');
        Schema::dropIfExists('student_activities');
        Schema::dropIfExists('user_badges');
        Schema::dropIfExists('badges');
        Schema::dropIfExists('student_daily_goals');
    }
};
