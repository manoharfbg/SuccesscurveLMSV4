<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;
use App\Classe;
use App\Course;
use App\Test;
use App\Testcatogerie;
use App\BlogPost;
use App\User;

class HomeController extends Controller
{
    /**
     * Get complete homepage payload for Web & Android App.
     */
    public function getHomeData()
    {
        $classes = Classe::select('classId', 'className')->get();
        $subjects = Subject::select('subjectId', 'subjectName')->get();

        $courses = Course::join('subjects', 'courses.courseSubject', '=', 'subjects.subjectId')
            ->join('classes', 'courses.courseClass', '=', 'classes.classId')
            ->join('users', 'courses.courseInstructor1', '=', 'users.id')
            ->select('courses.courseId', 'courses.courseTitle', 'courses.coursePrice', 'courses.courseThumbnail', 'subjects.subjectName', 'classes.className', 'users.name as instructorName')
            ->where('courseStatus', 'Published')
            ->orderBy('courseId', 'desc')
            ->take(10)
            ->get();

        $tests = Test::join('subjects', 'tests.tSubject', '=', 'subjects.subjectId')
            ->join('classes', 'tests.tClass', '=', 'classes.classId')
            ->select('tests.tId', 'tests.tName', 'tests.tPrice', 'tests.duration', 'tests.total_questions', 'tests.total_marks', 'subjects.subjectName', 'classes.className')
            ->where('tStatus', 1)
            ->orderBy('tId', 'desc')
            ->take(10)
            ->get();

        $testSeries = Testcatogerie::join('classes', 'testcatogeries.tcClass', '=', 'classes.classId')
            ->select('testcatogeries.tcId', 'testcatogeries.tcName', 'testcatogeries.tcPrice', 'classes.className')
            ->where('tcStatus', 1)
            ->orderBy('tcId', 'desc')
            ->take(10)
            ->get();

        $blogs = BlogPost::where('status', 1)
            ->select('postId', 'title', 'slug', 'category', 'excerpt', 'coverIcon', 'coverGradient', 'readMinutes', 'publishedAt')
            ->orderBy('publishedAt', 'desc')
            ->take(6)
            ->get();

        $stats = [
            'total_courses' => Course::where('courseStatus', 'Published')->count(),
            'total_tests' => Test::count(),
            'total_students' => User::where('type', 'user')->count(),
            'total_subjects' => Subject::count(),
            'active_streaks' => 12480,
            'improvement_rate' => '94%'
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Homepage data fetched successfully',
            'data' => [
                'classes' => $classes,
                'subjects' => $subjects,
                'featured_courses' => $courses,
                'mock_tests' => $tests,
                'test_series' => $testSeries,
                'blogs' => $blogs,
                'stats' => $stats
            ]
        ], 200);
    }
}
