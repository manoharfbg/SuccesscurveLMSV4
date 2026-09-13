<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('badges')->insertOrIgnore([
            ['badgeId' => 1, 'slug' => 'streak-14', 'title' => '14 Day', 'subtitle' => 'streak', 'icon' => '🔥', 'color' => '#FB743E', 'description' => 'Studied 14 consecutive days', 'created_at' => now(), 'updated_at' => now()],
            ['badgeId' => 2, 'slug' => 'topic-fixer', 'title' => 'Topic Fixer', 'subtitle' => 'cleared', 'icon' => '🎯', 'color' => '#024F9D', 'description' => 'Fixed 3 weak topic areas', 'created_at' => now(), 'updated_at' => now()],
            ['badgeId' => 3, 'slug' => 'tests-5', 'title' => '5 Tests Done', 'subtitle' => 'complete', 'icon' => '🏆', 'color' => '#0F9D76', 'description' => 'Attempted 5 mock tests', 'created_at' => now(), 'updated_at' => now()],
            ['badgeId' => 4, 'slug' => 'accuracy-80', 'title' => '80% Acc.', 'subtitle' => 'next badge', 'icon' => '⚡', 'color' => '#6B7A99', 'description' => 'Achieve 80% accuracy in Mathematics', 'created_at' => now(), 'updated_at' => now()],
        ]);

        \Illuminate\Support\Facades\DB::table('user_badges')->insertOrIgnore([
            ['userId' => 17, 'badgeId' => 1, 'earned_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['userId' => 17, 'badgeId' => 2, 'earned_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['userId' => 17, 'badgeId' => 3, 'earned_at' => now(), 'created_at' => now(), 'updated_at' => now()],
        ]);

        \Illuminate\Support\Facades\DB::table('student_daily_goals')->insertOrIgnore([
            'userId' => 17,
            'goal_date' => date('Y-m-d'),
            'target_minutes' => 60,
            'completed_minutes' => 45,
            'lectures_watched' => 2,
            'questions_attempted' => 18,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        \Illuminate\Support\Facades\DB::table('student_activities')->insertOrIgnore([
            ['userId' => 17, 'activity_type' => 'test_completed', 'icon' => '✓', 'icon_color' => '#0F9D76', 'bg_color' => '#E8F7EE', 'title' => 'Scored 74% on Board Series — Test 5', 'time_label' => '2 hours ago', 'created_at' => now(), 'updated_at' => now()],
            ['userId' => 17, 'activity_type' => 'lecture_watched', 'icon' => '▶', 'icon_color' => '#024F9D', 'bg_color' => '#EAF1FB', 'title' => 'Watched Trigonometry — Heights & Distances', 'time_label' => 'Yesterday · 38 min', 'created_at' => now(), 'updated_at' => now()],
            ['userId' => 17, 'activity_type' => 'badge_earned', 'icon' => '★', 'icon_color' => '#E0672C', 'bg_color' => '#FFF2EA', 'title' => 'Earned the “Topic fixer” badge', 'time_label' => 'Yesterday', 'created_at' => now(), 'updated_at' => now()],
            ['userId' => 17, 'activity_type' => 'doubt_asked', 'icon' => '?', 'icon_color' => '#C0564A', 'bg_color' => '#FDECEC', 'title' => 'Asked a doubt on Quadratic Equations', 'time_label' => '2 days ago · answered', 'created_at' => now(), 'updated_at' => now()],
        ]);

        \Illuminate\Support\Facades\DB::table('revenue_stats')->insertOrIgnore([
            ['month_key' => '2026-02', 'month_name' => 'Feb', 'total_revenue' => 110000, 'total_enrollments' => 62, 'course_revenue' => 57200, 'test_revenue' => 34100, 'series_revenue' => 18700, 'created_at' => now(), 'updated_at' => now()],
            ['month_key' => '2026-03', 'month_name' => 'Mar', 'total_revenue' => 132000, 'total_enrollments' => 74, 'course_revenue' => 68640, 'test_revenue' => 40920, 'series_revenue' => 22440, 'created_at' => now(), 'updated_at' => now()],
            ['month_key' => '2026-04', 'month_name' => 'Apr', 'total_revenue' => 158000, 'total_enrollments' => 92, 'course_revenue' => 82160, 'test_revenue' => 48980, 'series_revenue' => 26860, 'created_at' => now(), 'updated_at' => now()],
            ['month_key' => '2026-05', 'month_name' => 'May', 'total_revenue' => 146000, 'total_enrollments' => 84, 'course_revenue' => 75920, 'test_revenue' => 45260, 'series_revenue' => 24820, 'created_at' => now(), 'updated_at' => now()],
            ['month_key' => '2026-06', 'month_name' => 'Jun', 'total_revenue' => 195000, 'total_enrollments' => 110, 'course_revenue' => 101400, 'test_revenue' => 60450, 'series_revenue' => 33150, 'created_at' => now(), 'updated_at' => now()],
            ['month_key' => '2026-07', 'month_name' => 'Jul', 'total_revenue' => 224000, 'total_enrollments' => 124, 'course_revenue' => 116480, 'test_revenue' => 69440, 'series_revenue' => 38080, 'created_at' => now(), 'updated_at' => now()],
            ['month_key' => '2026-08', 'month_name' => 'Aug', 'total_revenue' => 268000, 'total_enrollments' => 142, 'course_revenue' => 139360, 'test_revenue' => 83080, 'series_revenue' => 45560, 'created_at' => now(), 'updated_at' => now()],
            ['month_key' => '2026-09', 'month_name' => 'Sep', 'total_revenue' => 312000, 'total_enrollments' => 160, 'course_revenue' => 162240, 'test_revenue' => 96720, 'series_revenue' => 53040, 'created_at' => now(), 'updated_at' => now()],
        ]);

        \Illuminate\Support\Facades\DB::table('admin_activity_logs')->insertOrIgnore([
            ['userId' => 1, 'action_type' => 'test_created', 'description' => 'Created mock test: All-Subject Board Series — T6', 'ip_address' => '127.0.0.1', 'created_at' => now(), 'updated_at' => now()],
            ['userId' => 1, 'action_type' => 'coupon_created', 'description' => 'Issued coupon code: DIWALI50 (50% off)', 'ip_address' => '127.0.0.1', 'created_at' => now(), 'updated_at' => now()],
            ['userId' => 1, 'action_type' => 'course_published', 'description' => 'Published course: Class 10 Science — Full Prep', 'ip_address' => '127.0.0.1', 'created_at' => now(), 'updated_at' => now()],
            ['userId' => 1, 'action_type' => 'qreport_reviewed', 'description' => 'Resolved reported question #52 (Typo corrected)', 'ip_address' => '127.0.0.1', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Reset password for admin accounts
        $adminUser = \App\User::where('email', 'admin@gmail.com')->first();
        if ($adminUser) {
            $adminUser->password = \Illuminate\Support\Facades\Crypt::encrypt('1234');
            $adminUser->save();
        }

        $superAdmin = \App\User::where('email', 'hello@successcurve.in')->first();
        if ($superAdmin) {
            $superAdmin->password = \Illuminate\Support\Facades\Crypt::encrypt('admin123');
            $superAdmin->save();
        }
    }
}
