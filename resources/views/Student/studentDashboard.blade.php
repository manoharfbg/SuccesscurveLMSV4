<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard - SuccessCurve</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --pageBg: #EEF2F8;
            --side: #0F1B33;
            --sideMuted: #B7C1D6;
            --text: #0F1B33;
            --sub: #5C6A85;
            --faint: #98A4BD;
            --card: #FFFFFF;
            --border: #E3E9F2;
            --track: #E8EDF6;
            --inputBg: #F5F8FC;
            --blueSoft: #EAF1FB;
            --orangeSoft: #FFF2EA;
            --greenSoft: #E8F7EE;
            --redSoft: #FDECEC;
            --primary: #024F9D;
            --accent: #FB743E;
            --success: #0F9D76;
            --danger: #E5484D;
        }

        [data-theme="dark"] {
            --pageBg: #0B1220;
            --side: #070C18;
            --sideMuted: #9AA6BF;
            --text: #EAF0FA;
            --sub: #9AA6BF;
            --faint: #6B7A99;
            --card: #141C2E;
            --border: #263049;
            --track: #26304A;
            --inputBg: #0F1626;
            --blueSoft: #16233F;
            --orangeSoft: #2A1B12;
            --greenSoft: #0F2A22;
            --redSoft: #2A1512;
            --primary: #4FA3F0;
            --accent: #FB743E;
            --success: #0F9D76;
            --danger: #E5484D;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { margin: 0; font-family: 'DM Sans', system-ui, sans-serif; background: var(--pageBg); color: var(--text); transition: background 200ms ease, color 200ms ease; }
        a { text-decoration: none; color: inherit; }
        button { font-family: inherit; cursor: pointer; border: none; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-thumb { background: var(--faint); border-radius: 4px; }
        .dashboard-container {
            display: grid;
            grid-template-columns: minmax(0, 244px) minmax(0, 1fr);
            min-height: 100vh;
        }
        @media (max-width: 900px) {
            .dashboard-container { grid-template-columns: 1fr; }
            .dash-sidebar { display: none; }
        }
    </style>
</head>
<body>

@php
    $student = $student ?? [];
    $today = $today ?? [];
    $perf = $performance ?? [];
    $ahead = $ahead ?? [];

    $resume = $today['resume'] ?? [];
    $streak = $today['streak'] ?? [];
    $dailyGoal = $today['daily_goal'] ?? ['target_minutes' => 60, 'completed_minutes' => 45, 'percentage' => 75];
    $rankSummary = $today['rank_summary'] ?? ['class_rank' => 142, 'total_students' => 2140, 'percentile' => 86.4, 'gain' => '+4.2'];
    $boardReadiness = $perf['board_readiness'] ?? ['score' => 68, 'total' => 100, 'monthly_gain' => 6];
    $weakTopics = $perf['weak_topics'] ?? [];
    $scoreHistory = $perf['score_history'] ?? [];
    $accuracy = $perf['accuracy_summary'] ?? ['percentage' => 74, 'correct' => 1184, 'wrong' => 288, 'skipped' => 128];
    $subjectStrengths = $perf['subject_strengths'] ?? [];
    $marksBreakdown = $perf['marks_breakdown'] ?? [];
    $curriculumPath = $ahead['curriculum_path'] ?? [];
    $enrolledCourses = $ahead['enrolled_courses'] ?? [];
    $recentActivities = $ahead['recent_activities'] ?? [];
    $recommended = $ahead['recommended'] ?? [];
    $upcomingTests = $ahead['upcoming_tests'] ?? [];
    $badges = $ahead['badges'] ?? [];
    $leaderboard = $ahead['leaderboard'] ?? [];

    $studentName = $student['name'] ?? Session::get('user') ?? 'Student';
    $firstChar = strtoupper(substr($studentName, 0, 1));
@endphp

<div class="dashboard-container">
    <!-- SIDEBAR -->
    <aside class="dash-sidebar" style="position:sticky;top:0;height:100vh;overflow:hidden;background:radial-gradient(700px 400px at 20% -10%, #0a5fb8, #024f9d 45%, #01356c)">
        <div style="position:absolute;inset:0;background-image:radial-gradient(circle at 1px 1px, rgba(255,255,255,.10) 1px, transparent 0);background-size:26px 26px;pointer-events:none"></div>
        <div style="position:absolute;top:-60px;right:-40px;width:200px;height:200px;border-radius:999px;background:radial-gradient(circle,rgba(251,116,62,0.22),transparent 70%);pointer-events:none"></div>
        
        <div style="position:relative;z-index:1;height:100%;padding:20px 16px;display:flex;flex-direction:column;gap:24px;overflow:auto">
            <div style="font-family:'Space Grotesk',sans-serif;font-size:21px;font-weight:700;letter-spacing:-0.025em;white-space:nowrap;padding:2px 4px">
                <a href="{{ url('/') }}"><span style="color:#4FA3F0">Success</span><span style="color:#FB743E">Curve</span><sup style="font-size:0.46em;font-weight:600;color:#FFFFFF;margin-left:1px;top:-0.7em">.in</sup></a>
            </div>

            <nav style="display:grid;gap:4px">
                <a href="{{ url('student/dashboard') }}" style="display:flex;align-items:center;gap:11px;padding:11px 13px;border-radius:11px;background:linear-gradient(120deg,#FB743E,#E0672C);color:#FFFFFF;font-size:14px;font-weight:700;box-shadow:0 8px 18px rgba(251,116,62,0.35)">
                    <span>📊</span> Dashboard
                </a>
                <a href="{{ url('student/myCourses') }}" style="display:flex;align-items:center;gap:11px;padding:11px 13px;border-radius:10px;color:#B7C1D6;font-size:14px;font-weight:500;transition:background 150ms ease" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#B7C1D6'">
                    <span>📚</span> My Learning
                </a>
                <a href="{{ url('student/tests') }}" style="display:flex;align-items:center;gap:11px;padding:11px 13px;border-radius:10px;color:#B7C1D6;font-size:14px;font-weight:500;transition:background 150ms ease" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#B7C1D6'">
                    <span>📝</span> Mock Tests
                </a>
                <a href="{{ url('student/testSeries') }}" style="display:flex;align-items:center;gap:11px;padding:11px 13px;border-radius:10px;color:#B7C1D6;font-size:14px;font-weight:500;transition:background 150ms ease" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#B7C1D6'">
                    <span>🎯</span> Test Series
                </a>
                <a href="{{ url('student/doubts') }}" style="display:flex;align-items:center;gap:11px;padding:11px 13px;border-radius:10px;color:#B7C1D6;font-size:14px;font-weight:500;transition:background 150ms ease" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#B7C1D6'">
                    <span>💬</span> My Doubts <span style="margin-left:auto;background:#FB743E;color:#FFFFFF;font-size:11px;font-weight:800;padding:2px 7px;border-radius:999px">2</span>
                </a>
                <a href="{{ url('student/testResults') }}" style="display:flex;align-items:center;gap:11px;padding:11px 13px;border-radius:10px;color:#B7C1D6;font-size:14px;font-weight:500;transition:background 150ms ease" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#B7C1D6'">
                    <span>🏆</span> Reports &amp; Rank
                </a>
                <a href="{{ url('student/profile') }}" style="display:flex;align-items:center;gap:11px;padding:11px 13px;border-radius:10px;color:#B7C1D6;font-size:14px;font-weight:500;transition:background 150ms ease" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#B7C1D6'">
                    <span>⚙️</span> Profile
                </a>
                <a href="{{ url('logout') }}" style="display:flex;align-items:center;gap:11px;padding:11px 13px;border-radius:10px;color:#B7C1D6;font-size:14px;font-weight:500;transition:background 150ms ease" onmouseover="this.style.background='rgba(229,72,77,0.2)';this.style.color='#FF8888'" onmouseout="this.style.background='transparent';this.style.color='#B7C1D6'">
                    <span>🚪</span> Logout
                </a>
            </nav>

            <div style="margin-top:auto;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.14);border-radius:14px;padding:16px">
                <div style="font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:#FFC9A8">🎯 Target Exam</div>
                <div style="font-family:'Space Grotesk',sans-serif;font-size:16px;font-weight:700;color:#FFFFFF;margin-top:5px">{{ $student['target_exam'] ?? 'Class 10 Boards' }}</div>
                <div style="font-size:12.5px;color:#B7C1D6;margin-top:3px">{{ $student['exam_date'] ?? '14 Feb 2027' }} · {{ $student['days_remaining'] ?? 155 }} days left</div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main style="min-width:0;padding:0 0 60px">
        <!-- HEADER -->
        <header style="display:flex;align-items:center;gap:16px;padding:16px 32px;background:var(--card);border-bottom:1px solid var(--border);position:sticky;top:0;z-index:20;flex-wrap:wrap">
            <div style="min-width:0">
                <div style="font-family:'Space Grotesk',sans-serif;font-size:20px;font-weight:700">👋 Welcome back, {{ $studentName }}</div>
                <div style="font-size:13.5px;color:var(--sub);margin-top:2px">{{ $student['class_name'] ?? 'Class 10' }} · Science stream · 4 subjects active</div>
            </div>
            <div style="flex:1"></div>
            
            <input type="text" placeholder="Search lectures, tests, topics..." style="border:1px solid var(--border);background:var(--inputBg);border-radius:10px;padding:10px 14px;font-family:inherit;font-size:13.5px;flex:1;min-width:0;max-width:260px;outline:none;color:var(--text)">
            
            <button type="button" id="themeToggleBtn" style="display:flex;align-items:center;gap:7px;border:1px solid var(--border);background:var(--inputBg);color:var(--text);font-size:13px;font-weight:700;padding:9px 14px;border-radius:10px">
                <span id="themeIcon">🌙</span> <span id="themeLabel">Dark</span>
            </button>
            
            <a href="{{ url('student/profile') }}" style="width:40px;height:40px;border-radius:999px;background:#024F9D;color:#FFFFFF;display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:16px;text-decoration:none">
                {{ $firstChar }}
            </a>
        </header>

        <!-- =================================================================== -->
        <!-- BAND 1: TODAY (Pick up, Streak, Daily Goal, Quick Rank)             -->
        <!-- =================================================================== -->
        <div style="padding:26px 32px 0;display:flex;align-items:baseline;gap:12px">
            <h2 style="font-family:'Space Grotesk',sans-serif;font-size:14px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--sub);margin:0">Today</h2>
            <div style="flex:1;height:1px;background:var(--border)"></div>
        </div>

        <section style="padding:18px 32px 0;display:grid;grid-template-columns:repeat(auto-fit,minmax(270px,1fr));gap:18px">
            <!-- 1. Resume Card -->
            <div style="background:linear-gradient(140deg,#024F9D,#0A5FB8);border-radius:20px;padding:24px;color:#FFFFFF;display:flex;flex-direction:column;justify-content:space-between;min-height:200px">
                <div>
                    <div style="font-size:12px;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#BCD4F2">Pick up where you stopped</div>
                    <div style="font-family:'Space Grotesk',sans-serif;font-size:23px;font-weight:700;line-height:1.25;margin-top:10px">{{ $resume['lecture_title'] ?? 'Trigonometry — Heights & Distances' }}</div>
                    <div style="font-size:13.5px;color:#D7E6FB;margin-top:6px">{{ $resume['course_title'] ?? 'Class 10 Mathematics' }} · {{ $resume['lecture_meta'] ?? 'Lecture 24 of 42 · 8 min left' }}</div>
                </div>
                <div style="margin-top:20px">
                    <div style="height:7px;background:rgba(255,255,255,0.25);border-radius:999px;overflow:hidden">
                        <div style="width:{{ $resume['progress_percentage'] ?? 57 }}%;height:100%;background:#FB743E"></div>
                    </div>
                    <div style="display:flex;align-items:center;gap:12px;margin-top:16px;flex-wrap:wrap">
                        <a href="{{ url('goToCourse?id='.($resume['course_id'] ?? 1)) }}" style="background:#FB743E;color:#FFFFFF;font-size:14px;font-weight:800;padding:11px 20px;border-radius:10px;text-decoration:none;transition:background 150ms ease" onmouseover="this.style.background='#E0672C'" onmouseout="this.style.background='#FB743E'">
                            ▶ Resume lecture
                        </a>
                        <a href="{{ url('student/tests') }}" style="border:1px solid rgba(255,255,255,0.45);color:#FFFFFF;font-size:14px;font-weight:600;padding:11px 18px;border-radius:10px;text-decoration:none" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='transparent'">
                            📝 Chapter test
                        </a>
                    </div>
                </div>
            </div>

            <!-- 2. Streak Card -->
            <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border);min-height:200px;display:flex;flex-direction:column;justify-content:space-between">
                <div style="display:flex;justify-content:space-between;align-items:start">
                    <div>
                        <div style="font-size:12px;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:var(--sub)">Study Streak</div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:42px;font-weight:700;line-height:1;margin-top:8px">
                            {{ $streak['current'] ?? 14 }} <span style="font-size:16px;color:var(--sub);font-weight:600">days</span>
                        </div>
                    </div>
                    <div style="background:var(--greenSoft);color:#0F7A57;font-size:12px;font-weight:800;padding:5px 10px;border-radius:999px">
                        Best: {{ $streak['longest'] ?? 21 }}
                    </div>
                </div>
                <div>
                    <div style="display:flex;gap:6px;margin-top:16px">
                        @php
                            $weekDays = $streak['weekly_history'] ?? [
                                ['day'=>'M','active'=>true],['day'=>'T','active'=>true],['day'=>'W','active'=>true],
                                ['day'=>'T','active'=>true],['day'=>'F','active'=>true],['day'=>'S','active'=>true,'is_today'=>true],
                                ['day'=>'S','active'=>false]
                            ];
                        @endphp
                        @foreach($weekDays as $w)
                            @if(!empty($w['is_today']))
                                <div style="flex:1;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:11.5px;font-weight:800;background:#024F9D;color:#FFFFFF">{{ $w['day'] }}</div>
                            @elseif(!empty($w['active']))
                                <div style="flex:1;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:11.5px;font-weight:800;background:#FB743E;color:#FFFFFF">{{ $w['day'] }}</div>
                            @else
                                <div style="flex:1;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:11.5px;font-weight:800;background:var(--track);color:var(--faint)">{{ $w['day'] }}</div>
                            @endif
                        @endforeach
                    </div>
                    <div style="font-size:12.5px;color:var(--sub);margin-top:10px">Study 15 more minutes today to keep your streak alive!</div>
                </div>
            </div>

            <!-- 3. Daily Goal Ring Card -->
            <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border);min-height:200px;display:flex;gap:18px;align-items:center;flex-wrap:wrap">
                <div style="position:relative;width:clamp(96px,30%,112px);aspect-ratio:1;flex-shrink:0;border-radius:999px;background:conic-gradient(#024F9D 0turn {{ ($dailyGoal['percentage'] ?? 75)/100 }}turn, var(--track) {{ ($dailyGoal['percentage'] ?? 75)/100 }}turn 1turn)">
                    <div style="position:absolute;inset:16px;border-radius:999px;background:var(--card);display:flex;flex-direction:column;align-items:center;justify-content:center">
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:22px;font-weight:700;line-height:1">{{ $dailyGoal['percentage'] ?? 75 }}%</div>
                        <div style="font-size:10px;color:var(--sub);margin-top:2px">of goal</div>
                    </div>
                </div>
                <div style="min-width:0;flex:1">
                    <div style="font-size:12px;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:var(--sub)">Today's Goal</div>
                    <div style="font-family:'Space Grotesk',sans-serif;font-size:22px;font-weight:700;margin-top:6px">{{ $dailyGoal['completed_minutes'] ?? 45 }} / {{ $dailyGoal['target_minutes'] ?? 60 }} min</div>
                    <div style="font-size:12.5px;color:var(--sub);margin-top:6px;line-height:1.5">
                        {{ $dailyGoal['lectures_watched'] ?? 2 }} lectures completed<br>
                        {{ $dailyGoal['questions_attempted'] ?? 18 }} questions practiced
                    </div>
                </div>
            </div>

            <!-- 4. Class Rank & Percentile -->
            <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border);min-height:200px;display:grid;grid-template-rows:1fr 1fr;gap:12px">
                <div style="display:flex;align-items:center;gap:14px">
                    <div style="width:46px;height:46px;border-radius:12px;background:var(--orangeSoft);color:#E0672C;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0">🏅</div>
                    <div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:24px;font-weight:700;line-height:1">{{ $rankSummary['class_rank'] ?? 142 }}</div>
                        <div style="font-size:12.5px;color:var(--sub);font-weight:600">class rank · of {{ number_format($rankSummary['total_students'] ?? 2140) }}</div>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:14px;border-top:1px solid var(--border);padding-top:12px">
                    <div style="width:46px;height:46px;border-radius:12px;background:var(--blueSoft);color:#024F9D;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0">📈</div>
                    <div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:24px;font-weight:700;line-height:1">{{ $rankSummary['percentile'] ?? 86.4 }}</div>
                        <div style="font-size:12.5px;color:var(--sub);font-weight:600">percentile · ↑ {{ $rankSummary['gain'] ?? '4.2' }}</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =================================================================== -->
        <!-- BAND 2: PERFORMANCE (Board Readiness, Weak Topics, SVG Analytics)  -->
        <!-- =================================================================== -->
        <div style="padding:34px 32px 0;display:flex;align-items:baseline;gap:12px">
            <h2 style="font-family:'Space Grotesk',sans-serif;font-size:14px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--sub);margin:0">Focus &amp; Performance</h2>
            <div style="flex:1;height:1px;background:var(--border)"></div>
        </div>

        <section style="padding:18px 32px 0;display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:18px">
            <!-- Board Readiness Card -->
            <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border)">
                <div style="font-size:12px;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:var(--sub)">Board Readiness</div>
                <div style="display:flex;align-items:baseline;gap:10px;margin-top:10px">
                    <div style="font-family:'Space Grotesk',sans-serif;font-size:46px;font-weight:700;line-height:1">{{ $boardReadiness['score'] ?? 68 }}</div>
                    <div style="font-size:15px;font-weight:600;color:var(--sub)">/ {{ $boardReadiness['total'] ?? 100 }}</div>
                    <div style="margin-left:auto;background:var(--greenSoft);color:#0F7A57;font-size:12px;font-weight:800;padding:5px 10px;border-radius:999px">
                        +{{ $boardReadiness['monthly_gain'] ?? 6 }} this month
                    </div>
                </div>
                <div style="height:10px;background:var(--track);border-radius:999px;overflow:hidden;margin-top:14px">
                    <div style="width:{{ $boardReadiness['score'] ?? 68 }}%;height:100%;background:linear-gradient(90deg,#024F9D,#0A5FB8)"></div>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:12px;color:var(--faint);margin-top:7px;font-weight:600">
                    <span>Needs work</span><span>On track</span><span>Exam ready</span>
                </div>
                <div style="font-size:13px;color:var(--sub);margin-top:14px;line-height:1.55">
                    Based on accuracy, syllabus coverage and your recent mock test performances.
                </div>
            </div>

            <!-- Fix These First (Weak Topics) -->
            <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border);grid-column:span 2;min-width:0">
                <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap">
                    <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Fix these first</div>
                    <a href="{{ url('student/tests') }}" style="font-size:13.5px;font-weight:700;color:#024F9D">All weak topics →</a>
                </div>
                <div style="display:grid;gap:10px;margin-top:16px">
                    @forelse($weakTopics as $w)
                        <div style="display:flex;gap:14px;align-items:center;flex-wrap:wrap;background:var(--redSoft);border-radius:13px;padding:13px 15px">
                            <div style="min-width:0;flex:1">
                                <div style="font-size:14.5px;font-weight:700;color:var(--text)">{{ $w['title'] }}</div>
                                <div style="font-size:12.5px;margin-top:3px;color:#C0564A">{{ $w['meta'] ?? 'Accuracy 38% · 6 wrong of 10' }}</div>
                            </div>
                            <a href="{{ url('student/myCourses') }}" style="background:var(--text);color:var(--card);font-size:13px;font-weight:700;padding:9px 15px;border-radius:9px;flex-shrink:0;text-decoration:none">Revise</a>
                            <a href="{{ url('student/tests') }}" style="background:var(--card);border:1px solid var(--border);color:var(--text);font-size:13px;font-weight:700;padding:9px 15px;border-radius:9px;flex-shrink:0;text-decoration:none">Practice</a>
                        </div>
                    @empty
                        <div style="padding:16px;text-align:center;color:var(--sub)">No weak topics identified yet. Great job!</div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- SVG Analytics Charts Section -->
        <section style="padding:18px 32px 0;display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:18px">
            <!-- 1. Performance Over Time (SVG Line Chart) -->
            <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border)">
                <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Performance over time</div>
                <div style="font-size:13px;color:var(--sub);margin-top:4px">Your score across the last 8 mock tests.</div>
                
                <svg viewBox="0 0 460 250" style="width:100%;height:auto;margin-top:14px;overflow:visible">
                    <line x1="44" y1="30" x2="452" y2="30" stroke="var(--track)"></line>
                    <line x1="44" y1="58" x2="452" y2="58" stroke="var(--track)"></line>
                    <line x1="44" y1="86" x2="452" y2="86" stroke="var(--track)"></line>
                    <line x1="44" y1="114" x2="452" y2="114" stroke="var(--track)"></line>
                    <line x1="44" y1="142" x2="452" y2="142" stroke="var(--track)"></line>
                    <line x1="44" y1="170" x2="452" y2="170" stroke="var(--border)"></line>
                    <text x="38" y="34" text-anchor="end" font-family="DM Sans, sans-serif" font-size="11" fill="var(--faint)">100</text>
                    <text x="38" y="62" text-anchor="end" font-family="DM Sans, sans-serif" font-size="11" fill="var(--faint)">90</text>
                    <text x="38" y="90" text-anchor="end" font-family="DM Sans, sans-serif" font-size="11" fill="var(--faint)">80</text>
                    <text x="38" y="118" text-anchor="end" font-family="DM Sans, sans-serif" font-size="11" fill="var(--faint)">70</text>
                    <text x="38" y="146" text-anchor="end" font-family="DM Sans, sans-serif" font-size="11" fill="var(--faint)">60</text>
                    <text x="38" y="174" text-anchor="end" font-family="DM Sans, sans-serif" font-size="11" fill="var(--faint)">50</text>
                    
                    <path d="M60,147.6 L112,125.2 L164,133.6 L216,102.8 L268,86 L320,74.8 L372,63.6 L424,46.8 L424,170 L60,170 Z" fill="rgba(251,116,62,0.13)"></path>
                    <polyline points="60,164.4 112,156 164,150.4 216,142 268,133.6 320,122.4 372,108.4 424,91.6" fill="none" stroke="#B7C1D6" stroke-width="2.5" stroke-dasharray="6 5" stroke-linecap="round"></polyline>
                    <polyline points="60,147.6 112,125.2 L164,133.6 L216,102.8 L268,86 L320,74.8 L372,63.6 L424,46.8" fill="none" stroke="#FB743E" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></polyline>
                    
                    <g fill="var(--card)" stroke="#FB743E" stroke-width="2.5">
                        <circle cx="60" cy="147.6" r="4"></circle>
                        <circle cx="112" cy="125.2" r="4"></circle>
                        <circle cx="164" cy="133.6" r="4"></circle>
                        <circle cx="216" cy="102.8" r="4"></circle>
                        <circle cx="268" cy="86" r="4"></circle>
                        <circle cx="320" cy="74.8" r="4"></circle>
                        <circle cx="372" cy="63.6" r="4"></circle>
                    </g>
                    
                    <g transform="translate(424,46.8)">
                        <rect x="-24" y="-34" width="48" height="24" rx="7" fill="#0F1B33"></rect>
                        <text x="0" y="-17" text-anchor="middle" font-family="Space Grotesk, sans-serif" font-size="13" font-weight="700" fill="#FFFFFF">94%</text>
                        <circle cx="0" cy="0" r="6" fill="#FB743E" stroke="var(--card)" stroke-width="2.5"></circle>
                    </g>
                    
                    <g font-family="DM Sans, sans-serif" font-size="12" font-weight="600" fill="var(--sub)" text-anchor="middle">
                        <text x="60" y="192">T1</text><text x="112" y="192">T2</text><text x="164" y="192">T3</text><text x="216" y="192">T4</text>
                        <text x="268" y="192">T5</text><text x="320" y="192">T6</text><text x="372" y="192">T7</text><text x="424" y="192">T8</text>
                    </g>
                </svg>
                <div style="display:flex;gap:18px;font-size:12.5px;color:var(--sub);font-weight:600;margin-top:6px">
                    <span><span style="display:inline-block;width:11px;height:3px;border-radius:2px;background:#FB743E;vertical-align:middle;margin-right:6px"></span>Your score</span>
                    <span><span style="display:inline-block;width:11px;height:3px;border-radius:2px;background:#B7C1D6;vertical-align:middle;margin-right:6px"></span>Class avg</span>
                </div>
            </div>

            <!-- 2. Answer Accuracy Donut Chart -->
            <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border)">
                <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Answer accuracy</div>
                <div style="font-size:13px;color:var(--sub);margin-top:4px">Across all test attempts.</div>
                <div style="display:flex;align-items:center;gap:22px;margin-top:20px;flex-wrap:wrap">
                    <div style="position:relative;width:130px;height:130px;flex-shrink:0;border-radius:999px;background:conic-gradient(#0F9D76 0turn 0.74turn,#E5484D 0.74turn 0.92turn,var(--track) 0.92turn 1turn)">
                        <div style="position:absolute;inset:20px;background:var(--card);border-radius:999px;display:flex;flex-direction:column;align-items:center;justify-content:center">
                            <div style="font-family:'Space Grotesk',sans-serif;font-size:25px;font-weight:700;line-height:1">{{ $accuracy['percentage'] ?? 74 }}%</div>
                            <div style="font-size:11px;color:var(--sub);margin-top:2px">correct</div>
                        </div>
                    </div>
                    <div style="display:grid;gap:11px;min-width:130px;flex:1">
                        <div style="display:flex;align-items:center;gap:10px;font-size:13.5px;font-weight:600">
                            <span style="width:12px;height:12px;border-radius:4px;background:#0F9D76"></span>Correct
                            <span style="margin-left:auto;font-family:'Space Grotesk',sans-serif;font-weight:700">{{ number_format($accuracy['correct'] ?? 1184) }}</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:10px;font-size:13.5px;font-weight:600">
                            <span style="width:12px;height:12px;border-radius:4px;background:#E5484D"></span>Wrong
                            <span style="margin-left:auto;font-family:'Space Grotesk',sans-serif;font-weight:700">{{ number_format($accuracy['wrong'] ?? 288) }}</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:10px;font-size:13.5px;font-weight:600">
                            <span style="width:12px;height:12px;border-radius:4px;background:var(--track)"></span>Skipped
                            <span style="margin-left:auto;font-family:'Space Grotesk',sans-serif;font-weight:700">{{ number_format($accuracy['skipped'] ?? 128) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Subject Strengths & Speed -->
            <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border)">
                <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Subject strengths</div>
                <div style="font-size:13px;color:var(--sub);margin-top:4px">Accuracy and average time per question.</div>
                <div style="display:grid;gap:14px;margin-top:18px">
                    @php $barColors = ['#024F9D', '#0A5FB8', '#FB743E', '#0F9D76']; @endphp
                    @foreach($subjectStrengths as $idx => $s)
                        <div>
                            <div style="display:flex;justify-content:space-between;font-size:13.5px;font-weight:600;margin-bottom:6px">
                                <span>{{ $s['name'] }}</span>
                                <span style="color:var(--sub)">{{ $s['accuracy'] }}% · {{ $s['avg_time'] ?? '1m 15s' }}</span>
                            </div>
                            <div style="height:12px;background:var(--track);border-radius:999px;overflow:hidden">
                                <div style="width:{{ $s['accuracy'] }}%;height:100%;background:{{ $barColors[$idx % count($barColors)] }}"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 4. Where Your Marks Go (Stacked Bars) -->
            <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border)">
                <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Where your marks go</div>
                <div style="font-size:13px;color:var(--sub);margin-top:4px">Correct, wrong and skipped over last 5 tests.</div>
                <div style="display:grid;gap:12px;margin-top:18px">
                    @foreach($marksBreakdown as $m)
                        <div style="display:flex;align-items:center;gap:12px">
                            <div style="font-size:12.5px;font-weight:700;width:26px;color:var(--sub)">{{ $m['label'] }}</div>
                            <div style="flex:1;height:20px;border-radius:6px;overflow:hidden;display:flex">
                                <div style="width:{{ $m['correct_pct'] }}%;background:#0F9D76" title="Correct: {{ $m['correct_pct'] }}%"></div>
                                <div style="width:{{ $m['wrong_pct'] }}%;background:#E5484D" title="Wrong: {{ $m['wrong_pct'] }}%"></div>
                                <div style="width:{{ $m['skipped_pct'] }}%;background:var(--track)" title="Skipped: {{ $m['skipped_pct'] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div style="display:flex;gap:16px;font-size:12.5px;color:var(--sub);font-weight:600;margin-top:16px">
                    <span><span style="display:inline-block;width:10px;height:10px;border-radius:3px;background:#0F9D76;vertical-align:middle;margin-right:6px"></span>Correct</span>
                    <span><span style="display:inline-block;width:10px;height:10px;border-radius:3px;background:#E5484D;vertical-align:middle;margin-right:6px"></span>Wrong</span>
                    <span><span style="display:inline-block;width:10px;height:10px;border-radius:3px;background:var(--track);vertical-align:middle;margin-right:6px"></span>Skipped</span>
                </div>
            </div>

            <!-- 5. Rank & Percentile Trend Chart -->
            <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border)">
                <div style="display:flex;justify-content:space-between;align-items:start;gap:12px">
                    <div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Rank &amp; percentile</div>
                        <div style="font-size:13px;color:var(--sub);margin-top:4px">All-Subject Board Series</div>
                    </div>
                    <div style="text-align:right">
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:26px;font-weight:700;line-height:1">{{ $rankSummary['percentile'] ?? 86.4 }}</div>
                        <div style="font-size:12px;color:var(--sub);font-weight:600">percentile now</div>
                    </div>
                </div>
                <svg viewBox="0 0 460 210" style="width:100%;height:auto;margin-top:14px;overflow:visible">
                    <line x1="46" y1="30" x2="452" y2="30" stroke="var(--track)"></line>
                    <line x1="46" y1="60" x2="452" y2="60" stroke="var(--track)"></line>
                    <line x1="46" y1="90" x2="452" y2="90" stroke="var(--track)"></line>
                    <line x1="46" y1="120" x2="452" y2="120" stroke="var(--track)"></line>
                    <line x1="46" y1="150" x2="452" y2="150" stroke="var(--border)"></line>
                    <text x="40" y="34" text-anchor="end" font-family="DM Sans, sans-serif" font-size="11" fill="var(--faint)">95</text>
                    <text x="40" y="64" text-anchor="end" font-family="DM Sans, sans-serif" font-size="11" fill="var(--faint)">90</text>
                    <text x="40" y="94" text-anchor="end" font-family="DM Sans, sans-serif" font-size="11" fill="var(--faint)">85</text>
                    <text x="40" y="124" text-anchor="end" font-family="DM Sans, sans-serif" font-size="11" fill="var(--faint)">80</text>
                    <text x="40" y="154" text-anchor="end" font-family="DM Sans, sans-serif" font-size="11" fill="var(--faint)">75</text>
                    
                    <path d="M80,132 L170,117 L260,106.8 L350,93 L440,81.6 L440,150 L80,150 Z" fill="rgba(2,79,157,0.10)"></path>
                    <polyline points="80,144 170,141 260,138 350,135.6 440,133.2" fill="none" stroke="#B7C1D6" stroke-width="2.5" stroke-dasharray="6 5" stroke-linecap="round"></polyline>
                    <polyline points="80,132 170,117 260,106.8 350,93 440,81.6" fill="none" stroke="#024F9D" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></polyline>
                    
                    <g fill="var(--card)" stroke="#024F9D" stroke-width="2.5">
                        <circle cx="80" cy="132" r="4"></circle>
                        <circle cx="170" cy="117" r="4"></circle>
                        <circle cx="260" cy="106.8" r="4"></circle>
                        <circle cx="350" cy="93" r="4"></circle>
                    </g>
                    
                    <g transform="translate(440,81.6)">
                        <rect x="-26" y="-34" width="52" height="24" rx="7" fill="#0F1B33"></rect>
                        <text x="0" y="-17" text-anchor="middle" font-family="Space Grotesk, sans-serif" font-size="12.5" font-weight="700" fill="#FFFFFF">86.4</text>
                        <circle cx="0" cy="0" r="6" fill="#FB743E" stroke="var(--card)" stroke-width="2.5"></circle>
                    </g>
                    
                    <g font-family="DM Sans, sans-serif" font-size="12" font-weight="600" fill="var(--sub)" text-anchor="middle">
                        <text x="80" y="172">T1</text><text x="170" y="172">T2</text><text x="260" y="172">T3</text><text x="350" y="172">T4</text><text x="440" y="172">T5</text>
                    </g>
                </svg>
                <div style="display:flex;gap:18px;font-size:12.5px;color:var(--sub);font-weight:600">
                    <span><span style="display:inline-block;width:11px;height:3px;background:#024F9D;vertical-align:middle;margin-right:6px"></span>You</span>
                    <span><span style="display:inline-block;width:11px;height:3px;background:#B7C1D6;vertical-align:middle;margin-right:6px"></span>Class avg</span>
                </div>
            </div>

            <!-- 6. Radar Comparison (You vs Topper) -->
            <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border)">
                <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">You, the topper, the class</div>
                <div style="font-size:13px;color:var(--sub);margin-top:4px">Accuracy by subject, normalized axis.</div>
                <svg viewBox="0 0 320 250" style="width:100%;height:auto;margin-top:6px">
                    <polygon points="160,35 268,97 268,190 160,222 52,190 52,97" fill="none" stroke="var(--track)" stroke-width="1.5"></polygon>
                    <polygon points="160,78 232,119 232,161 160,182 88,161 88,119" fill="none" stroke="var(--track)" stroke-width="1.5"></polygon>
                    <polygon points="160,52 252,104 245,175 160,200 76,168 74,108" fill="rgba(251,116,62,0.22)" stroke="#FB743E" stroke-width="2"></polygon>
                    <polygon points="160,62 236,112 228,168 160,192 92,160 94,114" fill="rgba(2,79,157,0.20)" stroke="#024F9D" stroke-width="2.5"></polygon>
                    
                    <text x="160" y="26" text-anchor="middle" font-family="DM Sans, sans-serif" font-size="11.5" fill="var(--sub)">Maths</text>
                    <text x="286" y="94" text-anchor="middle" font-family="DM Sans, sans-serif" font-size="11.5" fill="var(--sub)">Phy</text>
                    <text x="286" y="198" text-anchor="middle" font-family="DM Sans, sans-serif" font-size="11.5" fill="var(--sub)">Chem</text>
                    <text x="160" y="240" text-anchor="middle" font-family="DM Sans, sans-serif" font-size="11.5" fill="var(--sub)">Bio</text>
                    <text x="34" y="198" text-anchor="middle" font-family="DM Sans, sans-serif" font-size="11.5" fill="var(--sub)">SST</text>
                    <text x="34" y="94" text-anchor="middle" font-family="DM Sans, sans-serif" font-size="11.5" fill="var(--sub)">Eng</text>
                </svg>
                <div style="display:flex;gap:16px;font-size:12.5px;color:var(--sub);font-weight:600">
                    <span><span style="display:inline-block;width:10px;height:10px;border-radius:3px;background:#024F9D;vertical-align:middle;margin-right:6px"></span>You</span>
                    <span><span style="display:inline-block;width:10px;height:10px;border-radius:3px;background:#FB743E;vertical-align:middle;margin-right:6px"></span>Topper</span>
                </div>
            </div>
        </section>

        <!-- 12-Week Heatmap Study Activity -->
        <section style="padding:18px 32px 0">
            <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border)">
                <div style="display:flex;justify-content:space-between;align-items:end;gap:12px;flex-wrap:wrap">
                    <div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Study activity</div>
                        <div style="font-size:13px;color:var(--sub);margin-top:4px">Last 12 weeks. Darker blocks mean more time spent studying.</div>
                    </div>
                    <div style="display:flex;align-items:center;gap:7px;font-size:12px;color:var(--sub);font-weight:600">
                        Less
                        <span style="width:13px;height:13px;border-radius:3px;background:var(--track)"></span>
                        <span style="width:13px;height:13px;border-radius:3px;background:#9EC2EC"></span>
                        <span style="width:13px;height:13px;border-radius:3px;background:#3B82C4"></span>
                        <span style="width:13px;height:13px;border-radius:3px;background:#024F9D"></span>
                        <span style="width:13px;height:13px;border-radius:3px;background:#02305F"></span>
                        More
                    </div>
                </div>
                
                @php
                    $shades = ['var(--track)', '#9EC2EC', '#3B82C4', '#024F9D', '#02305F'];
                    $seed = [2,0,3,4,1,0,3,3,4,2,0,3,1,3,4,4,1,3,0,4,3,3,1,2,0,3,4,2,1,3,2,4,1,2,3,0,1,3,4,2,3,0,3,4,2,0,3,1,4,2,3,1,3,2,4,0,3,4,1,3,2,3,4,2,3,1,4,2,3,0,2,4,3,4,2,4,3,1,3,4,2,4,3,2];
                @endphp
                <div style="display:grid;grid-template-columns:repeat(12,1fr);gap:6px;margin-top:18px">
                    @for($col = 0; $col < 12; $col++)
                        <div style="display:grid;gap:6px">
                            @for($row = 0; $row < 7; $row++)
                                @php $val = $seed[($col * 7 + $row) % count($seed)]; @endphp
                                <div style="height:20px;border-radius:4px;background:{{ $shades[$val] }}"></div>
                            @endfor
                        </div>
                    @endfor
                </div>
                <div style="display:grid;grid-template-columns:repeat(12,1fr);gap:6px;margin-top:8px;font-size:11.5px;font-weight:700;color:var(--faint)">
                    <div style="grid-column:1 / span 4">Jul</div>
                    <div style="grid-column:5 / span 4">Aug</div>
                    <div style="grid-column:9 / span 4">Sep</div>
                </div>
            </div>
        </section>

        <!-- =================================================================== -->
        <!-- BAND 3: KEEP GOING & WHAT'S AHEAD                                  -->
        <!-- =================================================================== -->
        <div style="padding:34px 32px 0;display:flex;align-items:baseline;gap:12px">
            <h2 style="font-family:'Space Grotesk',sans-serif;font-size:14px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--sub);margin:0">Keep Going</h2>
            <div style="flex:1;height:1px;background:var(--border)"></div>
        </div>

        <section style="padding:18px 32px 0;display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:18px">
            <!-- Continue Learning (Enrolled Courses) -->
            <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border)">
                <div style="display:flex;justify-content:space-between;align-items:center;gap:12px">
                    <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Continue learning</div>
                    <a href="{{ url('student/myCourses') }}" style="font-size:13.5px;font-weight:700;color:#024F9D">My courses →</a>
                </div>
                <div style="display:grid;gap:12px;margin-top:16px">
                    @php $cColors = ['#024F9D', '#0F9D76', '#FB743E']; @endphp
                    @forelse($enrolledCourses as $i => $c)
                        <a href="{{ url('goToCourse?id='.($c['course_id'] ?? 1)) }}" style="display:flex;gap:13px;align-items:center;background:var(--inputBg);border-radius:13px;padding:13px;color:var(--text);text-decoration:none">
                            <div style="width:46px;height:46px;border-radius:11px;background:{{ $cColors[$i % 3] }};color:#FFFFFF;display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-weight:700;flex-shrink:0">
                                {{ substr($c['subject'] ?? 'SC', 0, 2) }}
                            </div>
                            <div style="min-width:0;flex:1">
                                <div style="font-size:14.5px;font-weight:700">{{ $c['title'] }}</div>
                                <div style="height:6px;background:var(--track);border-radius:999px;margin-top:8px;overflow:hidden">
                                    <div style="width:{{ $c['progress_pct'] ?? 50 }}%;height:100%;background:{{ $cColors[$i % 3] }}"></div>
                                </div>
                                <div style="font-size:12px;color:var(--sub);margin-top:5px;font-weight:600">{{ $c['meta'] }}</div>
                            </div>
                        </a>
                    @empty
                        <div style="padding:16px;text-align:center;color:var(--sub)">No courses enrolled yet. <a href="{{ url('courses') }}" style="color:#024F9D;font-weight:700">Explore Courses</a></div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Activity Timeline -->
            <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border)">
                <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Recent activity</div>
                <div style="display:grid;margin-top:14px">
                    @foreach($recentActivities as $idx => $act)
                        <div style="display:flex;gap:13px;padding:11px 0;{{ $loop->last ? '' : 'border-bottom:1px solid var(--border)' }}">
                            <div style="width:34px;height:34px;border-radius:10px;background:{{ $act['bg_color'] ?? 'var(--blueSoft)' }};color:{{ $act['color'] ?? '#024F9D' }};display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0">
                                {{ $act['icon'] ?? '▶' }}
                            </div>
                            <div style="min-width:0;flex:1">
                                <div style="font-size:13.5px;font-weight:600">{{ $act['title'] }}</div>
                                <div style="font-size:12px;color:var(--faint);margin-top:2px">{{ $act['time'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Chapter Roadmap & Recommendations -->
        <div style="padding:34px 32px 0;display:flex;align-items:baseline;gap:12px">
            <h2 style="font-family:'Space Grotesk',sans-serif;font-size:14px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--sub);margin:0">What's Ahead</h2>
            <div style="flex:1;height:1px;background:var(--border)"></div>
        </div>

        <section style="padding:18px 32px 0;display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:18px">
            <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border);grid-column:span 2;min-width:0">
                <div style="display:flex;justify-content:space-between;align-items:end;gap:12px;flex-wrap:wrap">
                    <div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Your Class 10 Maths Roadmap</div>
                        <div style="font-size:13px;color:var(--sub);margin-top:4px">9 of 15 chapters cleared</div>
                    </div>
                    <a href="{{ url('student/myCourses') }}" style="font-size:13.5px;font-weight:700;color:#024F9D">Full path →</a>
                </div>

                <div style="display:flex;flex-wrap:wrap;gap:8px;margin-top:18px">
                    @foreach($curriculumPath as $ch)
                        @php
                            $st = $ch['status'] ?? 'locked';
                            $bg = 'var(--track)'; $col = 'var(--faint)';
                            if ($st === 'done') { $bg = 'var(--greenSoft)'; $col = '#0F7A57'; }
                            elseif ($st === 'weak') { $bg = 'var(--redSoft)'; $col = '#C0564A'; }
                            elseif ($st === 'now') { $bg = '#024F9D'; $col = '#FFFFFF'; }
                        @endphp
                        <div style="font-size:13px;font-weight:{{ $st === 'locked' ? '600' : '700' }};padding:10px 14px;border-radius:10px;background:{{ $bg }};color:{{ $col }}">
                            {{ $ch['label'] }}
                        </div>
                    @endforeach
                </div>

                <div style="font-family:'Space Grotesk',sans-serif;font-size:15px;font-weight:700;margin-top:24px">Recommended next, for students like you</div>
                <div style="display:grid;gap:10px;margin-top:12px">
                    @foreach($recommended as $i => $r)
                        <a href="{{ url('mock-test') }}" style="display:flex;gap:13px;align-items:center;background:var(--inputBg);border-radius:13px;padding:13px;color:var(--text);text-decoration:none">
                            <div style="width:46px;height:46px;border-radius:11px;background:{{ $cColors[$i % 3] }};color:#FFFFFF;display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-weight:700;flex-shrink:0">
                                {{ substr($r['title'], 0, 2) }}
                            </div>
                            <div style="min-width:0;flex:1">
                                <div style="font-size:14.5px;font-weight:700">{{ $r['title'] }}</div>
                                <div style="font-size:12.5px;color:var(--sub);margin-top:2px">{{ $r['meta'] }}</div>
                            </div>
                            <div style="margin-left:auto;font-size:13px;font-weight:800;flex-shrink:0;color:{{ !empty($r['is_free']) ? '#0F7A57' : 'var(--text)' }}">
                                {{ $r['price'] }}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Right Column: Upcoming tests, Badges, Leaderboard -->
            <div style="display:grid;gap:18px;align-content:start">
                <!-- Upcoming Tests -->
                <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border)">
                    <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Coming up</div>
                    <div style="display:grid;gap:10px;margin-top:16px">
                        @foreach($upcomingTests as $u)
                            <div style="display:flex;gap:12px;align-items:center;background:{{ !empty($u['soon']) ? 'var(--orangeSoft)' : 'var(--inputBg)' }};border-radius:12px;padding:12px">
                                <div style="font-family:'Space Grotesk',sans-serif;font-size:13px;font-weight:800;color:{{ !empty($u['soon']) ? '#E0672C' : '#024F9D' }};flex-shrink:0;text-align:center;line-height:1.1">
                                    {{ $u['days_left'] }}<br><span style="font-size:10px">days</span>
                                </div>
                                <div style="min-width:0;flex:1">
                                    <div style="font-size:14px;font-weight:700">{{ $u['title'] }}</div>
                                    <div style="font-size:12px;color:var(--sub);margin-top:2px">{{ $u['meta'] }}</div>
                                </div>
                                <a href="{{ url('student/tests') }}" style="font-size:12px;font-weight:800;color:#024F9D;text-decoration:none;flex-shrink:0">Start</a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Badges -->
                <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border)">
                    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px">
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Badges</div>
                        <a href="#" style="font-size:13.5px;font-weight:700;color:#024F9D">All →</a>
                    </div>
                    <div style="display:flex;gap:10px;margin-top:16px;flex-wrap:wrap">
                        @foreach($badges as $b)
                            @if(!empty($b['earned']))
                                <div style="width:58px;height:58px;border-radius:14px;background:{{ $b['color'] }};display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-size:11px;font-weight:800;color:#FFFFFF;text-align:center;line-height:1.15" title="{{ $b['title'] }}">
                                    {!! str_replace(' ', '<br>', e($b['title'])) !!}
                                </div>
                            @else
                                <div style="width:58px;height:58px;border-radius:14px;background:var(--track);border:1.5px dashed var(--faint);display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-size:11px;font-weight:800;color:var(--faint);text-align:center;line-height:1.15" title="{{ $b['title'] }}">
                                    {!! str_replace(' ', '<br>', e($b['title'])) !!}
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div style="font-size:12.5px;color:var(--sub);margin-top:14px;line-height:1.5">
                        Next badge: reach 80% accuracy in Mathematics. You are at 72%.
                    </div>
                </div>

                <!-- Leaderboard (Opt-in) -->
                <div style="background:var(--card);border-radius:20px;padding:22px;border:1px solid var(--border)">
                    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px">
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Class leaderboard</div>
                        <div style="font-size:11.5px;font-weight:700;color:var(--sub);background:var(--track);padding:4px 9px;border-radius:999px">Opt-in</div>
                    </div>
                    <div style="display:grid;gap:4px;margin-top:14px">
                        @foreach($leaderboard as $l)
                            @if(!empty($l['is_me']))
                                <div style="display:flex;gap:12px;align-items:center;padding:11px 12px;background:#FB743E;border-radius:10px;margin-top:6px;color:#FFFFFF">
                                    <div style="font-family:'Space Grotesk',sans-serif;font-size:13.5px;font-weight:800;width:22px">{{ $l['rank'] }}</div>
                                    <div style="font-size:14px;font-weight:800;flex:1">{{ $l['name'] }} (You)</div>
                                    <div style="font-size:13px;font-weight:700">{{ $l['score'] }}%</div>
                                </div>
                            @else
                                <div style="display:flex;gap:12px;align-items:center;padding:9px 0;border-bottom:1px solid var(--border)">
                                    <div style="font-family:'Space Grotesk',sans-serif;font-size:13.5px;font-weight:800;width:22px;color:var(--sub)">{{ $l['rank'] }}</div>
                                    <div style="font-size:14px;font-weight:600;flex:1;color:var(--text)">{{ $l['name'] }}</div>
                                    <div style="font-size:13px;font-weight:700;color:var(--sub)">{{ $l['score'] }}%</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<script>
    // Dark / Light Theme Toggle with LocalStorage persistence
    const themeToggleBtn = document.getElementById('themeToggleBtn');
    const themeIcon = document.getElementById('themeIcon');
    const themeLabel = document.getElementById('themeLabel');

    function setTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            themeIcon.textContent = '☀️';
            themeLabel.textContent = 'Light';
            localStorage.setItem('sc_theme', 'dark');
        } else {
            document.documentElement.removeAttribute('data-theme');
            themeIcon.textContent = '🌙';
            themeLabel.textContent = 'Dark';
            localStorage.setItem('sc_theme', 'light');
        }
    }

    const savedTheme = localStorage.getItem('sc_theme') || 'light';
    setTheme(savedTheme);

    themeToggleBtn.addEventListener('click', function() {
        const current = document.documentElement.getAttribute('data-theme');
        setTheme(current === 'dark' ? 'light' : 'dark');
    });
</script>

</body>
</html>
