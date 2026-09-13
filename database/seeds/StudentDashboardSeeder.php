<?php

use Illuminate\Database\Seeder;

class StudentDashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
    }
}
