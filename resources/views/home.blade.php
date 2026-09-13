@extends('homelayout')
@section('title')
Learn Online with India's Best Teachers - SuccessCurve
@endsection

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

<style>
  :root {
    --brand-dark: #0B0A1F;
    --brand-primary: #4B2BE8;
    --brand-purple-grad: linear-gradient(140deg, #1A1150 0%, #3A1B8C 45%, #6B2BD9 100%);
    --brand-lime: #D6FB5A;
    --brand-coral: #FF5B45;
  }
  body {
    background: #FFFFFF !important;
    color: #141033 !important;
    font-family: 'DM Sans', system-ui, -apple-system, sans-serif !important;
    overflow-x: hidden;
  }
  .new-home a {
    color: #4B2BE8;
    text-decoration: none;
    transition: all 0.2s ease;
  }
  .new-home a:hover {
    color: #FF5B45;
  }
  @keyframes slideL {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
  }
  @keyframes pulseRing {
    0%, 100% { transform: scale(1); opacity: .5; }
    50% { transform: scale(1.12); opacity: .9; }
  }
  @keyframes popIn {
    from { transform: scale(0); }
    to { transform: scale(1); }
  }

  .nav-blur-bar {
    display: flex;
    align-items: center;
    gap: 28px;
    padding: 16px 36px;
    background: #0B0A1F !important;
    position: sticky;
    top: 0;
    z-index: 1030;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
  }
  .nav-blur-bar a.nav-link-custom {
    color: #EDEBFF;
    font-size: 15px;
    font-weight: 500;
    white-space: nowrap;
  }
  .nav-blur-bar a.nav-link-custom:hover {
    color: #D6FB5A;
  }

  .hero-wrapper {
    background: linear-gradient(140deg, #1A1150 0%, #3A1B8C 45%, #6B2BD9 100%);
    padding: 76px 36px 88px;
    position: relative;
    overflow: hidden;
  }
  .hero-circle-glow {
    position: absolute;
    width: 520px;
    height: 520px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(214,251,90,0.22), rgba(214,251,90,0));
    top: -160px;
    right: -80px;
    animation: pulseRing 9s ease-in-out infinite;
    pointer-events: none;
  }
  .hero-container {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: minmax(0, 1.15fr) minmax(0, 0.85fr);
    gap: 52px;
    align-items: center;
    position: relative;
  }
  @media (max-width: 992px) {
    .hero-container {
      grid-template-columns: 1fr;
      gap: 40px;
    }
    .hero-wrapper {
      padding: 48px 20px 60px;
    }
    .nav-blur-bar {
      padding: 14px 20px;
    }
  }

  .search-pill-form {
    display: flex;
    gap: 8px;
    margin: 34px 0 0;
    background: #FFFFFF;
    border-radius: 16px;
    padding: 8px;
    max-width: 640px;
    box-shadow: 0 18px 40px rgba(11,10,31,0.35);
  }
  .search-pill-form input {
    flex: 1;
    min-width: 0;
    border: none;
    outline: none;
    font-family: inherit;
    font-size: 15px;
    padding: 13px 14px;
    color: #141033;
    background: transparent;
  }
  .search-pill-form select {
    border: none;
    outline: none;
    font-family: inherit;
    font-size: 14px;
    font-weight: 600;
    padding: 0 10px;
    color: #5B54A6;
    background: transparent;
  }
  .search-pill-form button {
    border: none;
    background: linear-gradient(120deg, #4B2BE8, #7A3BF0);
    color: #FFFFFF;
    font-family: inherit;
    font-size: 15px;
    font-weight: 700;
    padding: 14px 26px;
    border-radius: 11px;
    cursor: pointer;
    transition: all 0.2s;
  }
  .search-pill-form button:hover {
    background: #FF5B45;
  }

  .ticker-track {
    display: flex;
    gap: 24px;
    width: max-content;
    animation: slideL 32s linear infinite;
    font-family: 'Space Grotesk', sans-serif;
    font-size: 15px;
    font-weight: 600;
    color: #8E86D9;
    white-space: nowrap;
    align-items: center;
  }

  .class-chip-btn {
    position: relative;
    border: none;
    cursor: pointer;
    font-family: inherit;
    padding: 20px 10px 16px;
    border-radius: 16px;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: #F9F8FF;
    box-shadow: 0 1px 2px rgba(20,16,51,0.04);
    transition: transform 220ms cubic-bezier(.34,1.56,.64,1), box-shadow 220ms ease, background 220ms ease;
    text-decoration: none !important;
  }
  .class-chip-btn:hover, .class-chip-btn.active {
    background: linear-gradient(150deg, #4B2BE8, #7A3BF0) !important;
    box-shadow: 0 14px 30px rgba(75,43,232,0.35) !important;
    transform: translateY(-4px) scale(1.04) !important;
  }
  .class-chip-btn:hover .class-title, .class-chip-btn.active .class-title {
    color: #FFFFFF !important;
  }
  .class-chip-btn:hover .class-tag, .class-chip-btn.active .class-tag {
    color: #D6D1F5 !important;
  }
  .class-chip-btn:hover .class-icon, .class-chip-btn.active .class-icon {
    transform: scale(1.18) rotate(-4deg);
  }

  .subject-card {
    border-radius: 16px;
    padding: 22px;
    background: #FFFFFF;
    border: 1px solid #EDE9FB;
    display: block;
    color: #141033;
    transition: transform 240ms cubic-bezier(.34,1.56,.64,1), box-shadow 240ms ease, border-color 240ms ease;
    box-shadow: 0 1px 2px rgba(20,16,51,0.04);
    text-decoration: none !important;
  }
  .subject-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 34px rgba(75,43,232,0.14);
    border-color: #DAD3FA;
  }
  .subject-icon-box {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    transition: transform 240ms cubic-bezier(.34,1.56,.64,1);
  }
  .subject-card:hover .subject-icon-box {
    transform: scale(1.12) rotate(-6deg);
  }

  .course-scroll-container {
    display: flex;
    gap: 18px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding-bottom: 12px;
    -ms-overflow-style: none;
    scrollbar-width: none;
  }
  .course-scroll-container::-webkit-scrollbar {
    display: none;
  }
  .course-card-item {
    flex: 0 0 280px;
    border-radius: 18px;
    background: #FFFFFF;
    border: 1px solid #EAE6FF;
    overflow: hidden;
    color: #141033;
    display: block;
    box-shadow: 0 6px 20px rgba(75,43,232,0.07);
    transition: box-shadow 220ms ease, transform 220ms ease;
    text-decoration: none !important;
  }
  .course-card-item:hover {
    box-shadow: 0 16px 36px rgba(75,43,232,0.16);
    transform: translateY(-3px);
  }

  .faq-card {
    background: #F7F5FF;
    border-radius: 14px;
    padding: 18px 20px;
    margin-bottom: 10px;
    border: none;
  }
  .faq-card summary {
    list-style: none;
    cursor: pointer;
    font-size: 17px;
    font-weight: 700;
    display: flex;
    justify-content: space-between;
    gap: 16px;
    outline: none;
  }
  .faq-card summary::-webkit-details-marker {
    display: none;
  }

  /* Override old layout navbar if loaded */
  nav.navbar.fixed-top {
    display: none !important;
  }
</style>

<div class="new-home">

  <!-- Sticky Modern Nav Header -->
  <header class="nav-blur-bar">
    <div style="font-family:'Space Grotesk',sans-serif;font-size:23px;font-weight:700;letter-spacing:-0.025em;white-space:nowrap">
      <a href="{{ url('/') }}" style="text-decoration:none">
        <span style="color:#5AA9FF">Success</span><span style="color:#FF9A3D">Curve</span><sup style="font-size:0.46em;font-weight:600;color:#FFFFFF !important;margin-left:1px;top:-0.7em">.in</sup>
      </a>
    </div>
    <div class="header-nav-links" style="display:flex;gap:24px;align-items:center;font-size:15px;font-weight:500;flex-wrap:wrap;white-space:nowrap;background:transparent !important">
      <a href="{{ url('about-us') }}" class="nav-link-custom">About Us</a>
      <a href="{{ url('mock-test') }}" class="nav-link-custom">MockTest</a>
      <a href="{{ url('courses') }}" class="nav-link-custom">Courses</a>
      <a href="{{ url('testSeries') }}" class="nav-link-custom">Test Series</a>
      <a href="{{ url('contact') }}" class="nav-link-custom">Contact Us</a>
    </div>
    <div style="flex:1"></div>
    @if(Session::get('user'))
      <div class="dropdown">
        <button class="btn btn-sm dropdown-toggle" type="button" id="userMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background:#2A1B6D;color:#FFFFFF;font-weight:700;padding:8px 16px;border-radius:10px;border:1px solid #5A43A6;">
          👤 {{ Session::get('user') }}
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu" style="border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,0.2);">
          <a class="dropdown-item" href="{{ url('student/dashboard') }}">Dashboard</a>
          <a class="dropdown-item" href="{{ url('student/myCourses') }}">My Courses</a>
          <a class="dropdown-item" href="{{ url('student/tests') }}">My Tests</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" href="{{ url('logout') }}">Logout</a>
        </div>
      </div>
    @elseif(Session::get('auser'))
      <a href="{{ url('admin/dashboard') }}" style="background:#D6FB5A;color:#141033;font-size:14px;font-weight:700;padding:9px 18px;border-radius:10px;">Admin Console →</a>
    @elseif(Session::get('fuser'))
      <a href="{{ url('faculty/dashboard') }}" style="background:#D6FB5A;color:#141033;font-size:14px;font-weight:700;padding:9px 18px;border-radius:10px;">Faculty Dashboard →</a>
    @else
      <a href="{{ url('login') }}" style="color:#EDEBFF;font-size:15px;font-weight:600;white-space:nowrap;margin-right:12px;">Log in</a>
      <a href="{{ url('register') }}" style="background:#D6FB5A;color:#141033;font-size:15px;font-weight:700;padding:10px 20px;border-radius:10px;white-space:nowrap;">Start free →</a>
    @endif
  </header>

  <!-- Hero Section with Search and Trust Stats -->
  <section class="hero-wrapper">
    <div class="hero-circle-glow"></div>
    <div class="hero-container">
      <div style="min-width:0">
        <div style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:clamp(15px,1.7vw,20px);letter-spacing:0.02em;text-transform:uppercase;color:#8E86D9">
          Learn <span style="color:#D6FB5A">Anytime</span>, <span style="color:#FF9A7A">Anywhere</span>
        </div>
        <div style="display:inline-flex;align-items:center;gap:9px;background:rgba(255,255,255,0.14);border:1px solid rgba(255,255,255,0.28);color:#FFFFFF;font-size:13px;font-weight:700;padding:7px 15px;border-radius:999px;margin-top:14px">
          12 years · 40+ teachers · 18,000+ students
        </div>
        <h1 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:clamp(40px,5.2vw,72px);line-height:1.04;letter-spacing:-0.03em;color:#FFFFFF;margin:20px 0 0">
          Learn online with<br>India's <span style="color:#D6FB5A">best teachers.</span>
        </h1>
        <p style="font-size:18px;line-height:1.55;color:#D9D4FF;max-width:50ch;margin:20px 0 0">
          Class 5 to 12, UG and PG. Real lectures, real mock tests, and analytics that tell you exactly which chapter to open next.
        </p>

        <!-- Search Form -->
        <form action="{{ url('search') }}" method="POST" class="search-pill-form">
          @csrf
          <input type="text" name="name" placeholder="Search courses, tests, subjects..." required>
          <select name="sc">
            <option value="">All classes</option>
            @foreach($classes as $cls)
              <option value="{{ $cls->classId }}">{{ $cls->className }}</option>
            @endforeach
          </select>
          <button type="submit">Search</button>
        </form>

        <div style="display:flex;gap:10px;margin:16px 0 0;flex-wrap:wrap;font-size:13px;color:#CFC9FF;font-weight:500">
          <a href="{{ url('search?name=Maths') }}" style="background:rgba(255,255,255,0.12);padding:6px 12px;border-radius:999px;color:#FFFFFF">Class 10 Maths</a>
          <a href="{{ url('search?name=Biology') }}" style="background:rgba(255,255,255,0.12);padding:6px 12px;border-radius:999px;color:#FFFFFF">NEET Biology</a>
          <a href="{{ url('search?name=Physics') }}" style="background:rgba(255,255,255,0.12);padding:6px 12px;border-radius:999px;color:#FFFFFF">Class 12 Physics</a>
          <a href="{{ url('mock-test') }}" style="background:rgba(255,255,255,0.12);padding:6px 12px;border-radius:999px;color:#D6FB5A">Free Tests ⭐</a>
        </div>
      </div>

      <!-- Right Side Live Counters and Spotlight -->
      <div style="min-width:0;display:grid;gap:14px">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
          <div style="background:#D6FB5A;border-radius:20px;padding:22px;display:flex;flex-direction:column;justify-content:space-between;min-height:152px">
            <div style="font-size:12.5px;font-weight:800;letter-spacing:0.06em;text-transform:uppercase;color:#3F4E0C">Streaks today</div>
            <div>
              <div style="font-family:'Space Grotesk',sans-serif;font-size:42px;font-weight:700;line-height:1;color:#242E06">12,480+</div>
              <div style="font-size:13.5px;font-weight:700;margin-top:7px;color:#3F4E0C;line-height:1.4">students studying on a 7+ day streak</div>
            </div>
          </div>
          <div style="background:linear-gradient(150deg,#C2410C,#9A3412);border-radius:20px;padding:22px;display:flex;flex-direction:column;justify-content:space-between;min-height:152px;color:#FFFFFF">
            <div style="font-size:12.5px;font-weight:800;letter-spacing:0.06em;text-transform:uppercase;color:#FFFFFF">Score change</div>
            <div>
              <div style="font-family:'Space Grotesk',sans-serif;font-size:42px;font-weight:700;line-height:1">94%</div>
              <div style="font-size:13.5px;font-weight:700;margin-top:7px;line-height:1.4">improved their score after five tests</div>
            </div>
          </div>
        </div>

        <div style="background:#FFFFFF;border-radius:20px;padding:20px;box-shadow:0 20px 44px rgba(11,10,31,0.3)">
          <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap">
            <div style="font-family:'Space Grotesk',sans-serif;font-size:15px;font-weight:700">Live now</div>
            <div style="font-size:12px;font-weight:700;color:#C03A24;background:#FFEFEC;padding:5px 10px;border-radius:999px;white-space:nowrap;flex-shrink:0">
              🔴 2,410 attempting
            </div>
          </div>
          <div style="display:grid;gap:10px;margin-top:14px">
            @if(isset($tests) && count($tests) > 0)
              @foreach($tests->take(2) as $t)
                <a href="{{ url('exam/test/'.$t->tId.'/'.str_replace(' ', '-', $t->tName)) }}" style="display:flex;gap:12px;align-items:center;background:#F6F4FF;border-radius:13px;padding:12px;text-decoration:none;color:#141033">
                  <div style="width:46px;height:46px;border-radius:12px;background:linear-gradient(140deg,#4B2BE8,#7A3BF0);color:#FFFFFF;display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-weight:700;flex-shrink:0">
                    {{ substr($t->className ?? 'TS', 0, 3) }}
                  </div>
                  <div style="min-width:0">
                    <div style="font-size:14px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $t->tName }}</div>
                    <div style="font-size:12px;color:#6B64A8;margin-top:2px">{{ $t->total_questions ?? 30 }} Q · {{ $t->tDuration ?? 60 }} min</div>
                  </div>
                  <div style="margin-left:auto;font-size:12px;font-weight:800;color:{{ $t->tPrice == 0 ? '#1F6B3B' : '#C2410C' }}">
                    {{ $t->tPrice == 0 ? 'FREE' : '₹'.$t->tPrice }}
                  </div>
                </a>
              @endforeach
            @else
              <div style="display:flex;gap:12px;align-items:center;background:#F6F4FF;border-radius:13px;padding:12px">
                <div style="width:46px;height:46px;border-radius:12px;background:linear-gradient(140deg,#4B2BE8,#7A3BF0);color:#FFFFFF;display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-weight:700">10</div>
                <div>
                  <div style="font-size:14px;font-weight:700">Class 10 Maths — Full Syllabus Mock</div>
                  <div style="font-size:12px;color:#6B64A8;margin-top:2px">40 Q · 60 min</div>
                </div>
                <div style="margin-left:auto;font-size:12px;font-weight:800;color:#1F6B3B">FREE</div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Marquee Ticker: Prepare For -->
  <section style="background:#141033;padding:18px 0;overflow:hidden">
    <div class="ticker-track">
      <span style="color:#FFFFFF">Prepare for</span><span style="color:#D6FB5A">·</span><span>Bihar Board</span><span style="color:#D6FB5A">·</span><span>CBSE</span><span style="color:#D6FB5A">·</span><span>ICSE</span><span style="color:#D6FB5A">·</span><span>CUET UG</span><span style="color:#D6FB5A">·</span><span>JEE Mains</span><span style="color:#D6FB5A">·</span><span>NEET</span><span style="color:#D6FB5A">·</span><span>CUET PG</span><span style="color:#D6FB5A">·</span><span>GATE</span><span style="color:#D6FB5A">·</span><span>CSIR NET</span><span style="color:#D6FB5A">·</span><span>UGC NET</span><span style="color:#D6FB5A">·</span><span>PhD Entrance</span><span style="color:#D6FB5A">·</span><span>IIT JAM</span><span style="color:#D6FB5A">·</span>
      <span style="color:#FFFFFF">Prepare for</span><span style="color:#D6FB5A">·</span><span>Bihar Board</span><span style="color:#D6FB5A">·</span><span>CBSE</span><span style="color:#D6FB5A">·</span><span>ICSE</span><span style="color:#D6FB5A">·</span><span>CUET UG</span><span style="color:#D6FB5A">·</span><span>JEE Mains</span><span style="color:#D6FB5A">·</span><span>NEET</span><span style="color:#D6FB5A">·</span><span>CUET PG</span><span style="color:#D6FB5A">·</span><span>GATE</span><span style="color:#D6FB5A">·</span><span>CSIR NET</span><span style="color:#D6FB5A">·</span><span>UGC NET</span><span style="color:#D6FB5A">·</span><span>PhD Entrance</span><span style="color:#D6FB5A">·</span><span>IIT JAM</span><span style="color:#D6FB5A">·</span>
    </div>
  </section>

  <!-- Section: Explore Content By Class -->
  <section style="padding:72px 36px 30px;max-width:1400px;margin:0 auto;text-align:center">
    <div style="display:inline-flex;align-items:center;gap:8px;background:#FDF0EC;color:#C2410C;font-size:12.5px;font-weight:800;letter-spacing:0.06em;text-transform:uppercase;padding:8px 16px;border-radius:999px">
      📚 Pick your level
    </div>
    <h2 style="font-family:'Space Grotesk',sans-serif;font-size:clamp(30px,3.6vw,42px);font-weight:700;letter-spacing:-0.02em;margin:18px 0 0">
      Explore content by class
    </h2>
    <p style="font-size:16.5px;color:#6B64A8;max-width:52ch;margin:12px auto 0;line-height:1.55">
      Handpicked subjects and expert-crafted tests for every class from 5th to Post Graduate.
    </p>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(94px,1fr));gap:14px;margin-top:34px">
      @php
        $classIcons = [
          '5' => ['icon' => '✏️', 'tag' => 'Basics'],
          '6' => ['icon' => '📗', 'tag' => 'Basics'],
          '7' => ['icon' => '📘', 'tag' => 'Basics'],
          '8' => ['icon' => '📕', 'tag' => 'Basics'],
          '9' => ['icon' => '📐', 'tag' => 'Board'],
          '10' => ['icon' => '🎯', 'tag' => 'Board'],
          '11' => ['icon' => '🔬', 'tag' => 'Senior'],
          '12' => ['icon' => '🎓', 'tag' => 'Senior'],
          'UG' => ['icon' => '🏛️', 'tag' => 'Degree'],
          'PG' => ['icon' => '📜', 'tag' => 'Master']
        ];
      @endphp

      @foreach($classes as $cls)
        @php
          $tagInfo = ['icon' => '📚', 'tag' => 'General'];
          foreach($classIcons as $k => $val) {
            if(stripos($cls->className, (string)$k) !== false) {
              $tagInfo = $val;
              break;
            }
          }
        @endphp
        <a href="{{ url('exploreByClass/'.$cls->classId.'/'.str_replace(' ', '-', $cls->className)) }}" class="class-chip-btn">
          <div class="class-icon" style="font-size:26px;line-height:1;transition:transform 220ms ease;">{{ $tagInfo['icon'] }}</div>
          <div class="class-title" style="font-family:'Space Grotesk',sans-serif;font-size:18px;font-weight:700;margin-top:10px;color:#141033">{{ $cls->className }}</div>
          <div class="class-tag" style="font-size:10.5px;font-weight:800;letter-spacing:0.07em;text-transform:uppercase;margin-top:2px;color:#8079B8">{{ $tagInfo['tag'] }}</div>
        </a>
      @endforeach
    </div>
  </section>

  <!-- Section: Browse By Subject -->
  <section style="padding:60px 36px;max-width:1400px;margin:0 auto;text-align:center">
    <div style="display:inline-flex;align-items:center;gap:8px;background:#F1EEFF;color:#4B2BE8;font-size:12.5px;font-weight:800;letter-spacing:0.06em;text-transform:uppercase;padding:8px 16px;border-radius:999px">
      🧭 Browse by subject
    </div>
    <h2 style="font-family:'Space Grotesk',sans-serif;font-size:clamp(30px,3.6vw,42px);font-weight:700;letter-spacing:-0.02em;margin:18px 0 0">
      Learn any subject, your way
    </h2>
    <p style="font-size:16.5px;color:#6B64A8;max-width:52ch;margin:12px auto 0;line-height:1.55">
      Structured chapters, expert lectures and tests for every subject from Class 5 to Post Graduate.
    </p>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-top:34px;text-align:left">
      @php
        $subjectStyles = [
          'Mathematics' => ['bg' => '#EEF2FF', 'color' => '#2451C4', 'icon' => '±✕', 'meta' => 'Class 5–12 · 420 chapters'],
          'Physics'     => ['bg' => '#FEF1E6', 'color' => '#C2410C', 'icon' => '⚛️', 'meta' => 'Class 9–12 · 180 chapters'],
          'Chemistry'   => ['bg' => '#E9F7F3', 'color' => '#0E7C6B', 'icon' => '🧪', 'meta' => 'Class 9–12 · 165 chapters'],
          'Biology'     => ['bg' => '#EAF7EE', 'color' => '#1F6B3B', 'icon' => '🍃', 'meta' => 'Class 9–12 · 140 chapters'],
          'Social Science' => ['bg' => '#EAF1FE', 'color' => '#2451C4', 'icon' => '🌐', 'meta' => 'Class 5–12 · 210 chapters'],
          'English'     => ['bg' => '#F1EEFF', 'color' => '#4B2BE8', 'icon' => '📖', 'meta' => 'Class 5–12 · grammar + lit'],
          'Hindi'       => ['bg' => '#FDF6E4', 'color' => '#946B0A', 'icon' => 'ॐ', 'meta' => 'Class 5–12 · व्याकरण + गद्य'],
          'Competitive' => ['bg' => '#FEF1E6', 'color' => '#C2410C', 'icon' => '🏆', 'meta' => 'CUET · JEE · NET · GATE'],
          'Commerce'    => ['bg' => '#E9F7F3', 'color' => '#0E7C6B', 'icon' => '🧮', 'meta' => 'Class 11–12 · 5 subjects'],
          'Humanities'  => ['bg' => '#FDECEC', 'color' => '#B03A26', 'icon' => '📄', 'meta' => 'Class 11–12 · 6 subjects'],
        ];
      @endphp

      @foreach($products as $subj)
        @php
          $style = $subjectStyles[$subj->subjectName] ?? ['bg' => '#F1EEFF', 'color' => '#4B2BE8', 'icon' => '📚', 'meta' => 'Lectures & Chapter Tests'];
        @endphp
        <a href="{{ url('exploreBySubject/'.$subj->subjectId.'/'.str_replace(' ', '-', $subj->subjectName)) }}" class="subject-card">
          <div class="subject-icon-box" style="background:{{ $style['bg'] }};color:{{ $style['color'] }}">
            {{ $style['icon'] }}
          </div>
          <div style="font-size:17px;font-weight:700;margin-top:16px">{{ $subj->subjectName }}</div>
          <div style="font-size:13px;color:#6B64A8;margin-top:5px">{{ $style['meta'] }}</div>
        </a>
      @endforeach
    </div>
  </section>

  <!-- Section: Featured Courses Carousel -->
  <section style="padding:56px 36px;max-width:1400px;margin:0 auto">
    <div style="display:inline-flex;align-items:center;gap:7px;color:#C2410C;font-size:12.5px;font-weight:800;letter-spacing:0.07em;text-transform:uppercase">
      ⭐ Featured courses
    </div>
    <div style="display:flex;align-items:end;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-top:8px">
      <h2 style="font-family:'Space Grotesk',sans-serif;font-size:clamp(26px,3.2vw,34px);font-weight:700;letter-spacing:-0.02em;margin:0">
        Start with what students pick most
      </h2>
      <div style="display:flex;gap:8px;align-items:center">
        <button type="button" onclick="scrollCourses(-300)" style="width:38px;height:38px;border-radius:9px;border:1px solid #E0DAF7;background:#FFFFFF;color:#4B2BE8;font-size:15px;cursor:pointer">←</button>
        <button type="button" onclick="scrollCourses(300)" style="width:38px;height:38px;border-radius:9px;border:1px solid #E0DAF7;background:#FFFFFF;color:#4B2BE8;font-size:15px;cursor:pointer">→</button>
        <a href="{{ url('courses') }}" style="background:#141033;color:#FFFFFF;font-size:14px;font-weight:700;padding:11px 18px;border-radius:10px;margin-left:6px;white-space:nowrap">See all courses →</a>
      </div>
    </div>

    <div class="course-scroll-container mt-4" id="courseScroll">
      @foreach($courses as $c)
        <a href="{{ url('course/'.$c->courseId.'/'.str_replace(' ', '-', $c->courseTitle)) }}" class="course-card-item">
          <div style="position:relative;height:140px;background:linear-gradient(135deg, #2A1B6D, #5A35C2);display:flex;align-items:center;justify-content:center;color:#FFFFFF;overflow:hidden">
            @if(!empty($c->courseImage) && file_exists(public_path($c->courseImage)))
              <img src="{{ asset($c->courseImage) }}" alt="{{ $c->courseTitle }}" style="width:100%;height:100%;object-fit:cover">
            @else
              <span style="font-size:32px">🎓</span>
            @endif
            <span style="position:absolute;top:12px;right:12px;background:{{ $c->coursePrice == 0 ? '#1F6B3B' : '#4B2BE8' }};color:#FFFFFF;font-size:11.5px;font-weight:800;padding:5px 11px;border-radius:999px;z-index:2">
              {{ $c->coursePrice == 0 ? 'FREE' : '₹'.$c->coursePrice }}
            </span>
          </div>
          <div style="padding:16px">
            <div style="display:flex;flex-wrap:wrap;gap:6px">
              <span style="font-size:11.5px;font-weight:700;color:#2451C4;background:#EEF2FF;padding:4px 9px;border-radius:6px">{{ $c->subjectName }}</span>
              <span style="font-size:11.5px;font-weight:700;color:#946B0A;background:#FDF6E4;padding:4px 9px;border-radius:6px">{{ $c->className }}</span>
            </div>
            <div style="font-size:15.5px;font-weight:700;line-height:1.35;margin-top:11px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;min-height:42px">
              {{ $c->courseTitle }}
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;margin-top:12px;padding-top:12px;border-top:1px solid #F1EEFF">
              <span style="font-size:12.5px;color:#6B64A8;font-weight:600">By {{ $c->name ?? 'SuccessCurve' }}</span>
              <span style="font-size:13px;font-weight:700;color:#C2410C">Enroll →</span>
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </section>

  <!-- Section: Dual Column Mock Tests & Test Series -->
  <section style="background:#F7F5FF;padding:60px 36px">
    <div style="max-width:1400px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:44px">
      <!-- Mock Tests -->
      <div>
        <div style="display:flex;align-items:end;justify-content:space-between;gap:16px">
          <h2 style="font-family:'Space Grotesk',sans-serif;font-size:28px;font-weight:700;margin:0">Mock tests</h2>
          <a href="{{ url('mock-test') }}" style="font-size:15px;font-weight:700">All tests →</a>
        </div>
        <div style="display:grid;gap:12px;margin-top:20px">
          @foreach($tests->take(4) as $t)
            <a href="{{ url('exam/test/'.$t->tId.'/'.str_replace(' ', '-', $t->tName)) }}" style="display:flex;gap:13px;align-items:center;background:#FFFFFF;border-radius:15px;padding:14px;color:#141033;text-decoration:none;transition:background 0.2s" onmouseover="this.style.background='#EEEAFF'" onmouseout="this.style.background='#FFFFFF'">
              <div style="width:52px;height:52px;border-radius:13px;background:linear-gradient(140deg,#4B2BE8,#7A3BF0);color:#FFFFFF;display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-weight:700;flex-shrink:0">
                {{ substr($t->className ?? 'TS', 0, 3) }}
              </div>
              <div style="min-width:0">
                <div style="font-size:15px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $t->tName }}</div>
                <div style="font-size:12px;color:#6B64A8;margin-top:3px">{{ $t->subjectName }} · {{ $t->total_questions ?? 30 }} Q · {{ $t->tDuration ?? 60 }} min</div>
              </div>
              <div style="margin-left:auto;font-size:12px;font-weight:800;color:{{ $t->tPrice == 0 ? '#1F6B3B' : '#141033' }};white-space:nowrap">
                {{ $t->tPrice == 0 ? 'FREE' : '₹'.$t->tPrice }}
              </div>
            </a>
          @endforeach
        </div>
      </div>

      <!-- Test Series -->
      <div>
        <div style="display:flex;align-items:end;justify-content:space-between;gap:16px">
          <h2 style="font-family:'Space Grotesk',sans-serif;font-size:28px;font-weight:700;margin:0">Test series</h2>
          <a href="{{ url('testSeries') }}" style="font-size:15px;font-weight:700">All series →</a>
        </div>
        <div style="display:grid;gap:12px;margin-top:20px">
          @foreach($series->take(4) as $s)
            <a href="{{ url('testSeriesDetails/'.$s->tcId) }}" style="display:flex;gap:13px;align-items:center;background:#FFFFFF;border-radius:15px;padding:14px;color:#141033;text-decoration:none;transition:background 0.2s" onmouseover="this.style.background='#EEEAFF'" onmouseout="this.style.background='#FFFFFF'">
              <div style="width:52px;height:52px;border-radius:13px;background:#D6FB5A;color:#242E06;display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-weight:700;flex-shrink:0">
                {{ substr($s->className ?? 'TS', 0, 3) }}
              </div>
              <div style="min-width:0">
                <div style="font-size:15px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $s->tcName }}</div>
                <div style="font-size:12px;color:#6B64A8;margin-top:3px">{{ $s->className }} · Full Answer Keys & Rank</div>
              </div>
              <div style="margin-left:auto;font-size:12px;font-weight:800;color:{{ $s->tcPrice == 0 ? '#1F6B3B' : '#141033' }};white-space:nowrap">
                {{ $s->tcPrice == 0 ? 'FREE' : '₹'.$s->tcPrice }}
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <!-- Section: From The Blog -->
  @if(isset($blogs) && count($blogs) > 0)
  <section style="padding:56px 36px;max-width:1400px;margin:0 auto">
    <div style="display:inline-flex;align-items:center;gap:7px;color:#C2410C;font-size:12.5px;font-weight:800;letter-spacing:0.07em;text-transform:uppercase">
      📰 From the blog
    </div>
    <div style="display:flex;align-items:end;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-top:8px">
      <h2 style="font-family:'Space Grotesk',sans-serif;font-size:clamp(26px,3.2vw,34px);font-weight:700;letter-spacing:-0.02em;margin:0">
        Exam updates, strategy and study plans
      </h2>
      <a href="https://blog.successcurve.in" target="_blank" style="background:#141033;color:#FFFFFF;font-size:14px;font-weight:700;padding:11px 18px;border-radius:10px;white-space:nowrap">See all posts →</a>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;margin-top:24px">
      @foreach($blogs->take(3) as $post)
        <div style="border-radius:18px;background:#FFFFFF;border:1px solid #EAE6FF;overflow:hidden;box-shadow:0 6px 20px rgba(75,43,232,0.07);display:flex;flex-direction:column">
          <div style="height:140px;background:{{ $post->coverGradient ?? 'linear-gradient(135deg,#667eea,#764ba2)' }};display:flex;align-items:center;justify-content:center;color:#FFFFFF;font-size:36px">
            {{ $post->coverIcon ?? '📝' }}
          </div>
          <div style="padding:18px;flex:1;display:flex;flex-direction:column">
            <div style="font-size:12.5px;font-weight:700;color:#C2410C">
              {{ $post->category }} · {{ $post->readMinutes ?? 4 }} min read
            </div>
            <div style="font-size:17px;font-weight:700;line-height:1.35;margin-top:10px">
              {{ $post->title }}
            </div>
            <p style="font-size:13.5px;color:#6B64A8;line-height:1.55;margin:9px 0 0;flex:1">
              {{ $post->excerpt }}
            </p>
            <div style="font-size:13.5px;font-weight:700;color:#4B2BE8;margin-top:13px">
              Read article →
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>
  @endif

  <!-- Section: How It Works -->
  <section style="padding:64px 36px;max-width:1400px;margin:0 auto">
    <h2 style="font-family:'Space Grotesk',sans-serif;font-size:34px;font-weight:700;letter-spacing:-0.02em;margin:0 0 30px">How it works</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:18px">
      <div style="background:linear-gradient(150deg,#4B2BE8,#7A3BF0);border-radius:20px;padding:26px;color:#FFFFFF">
        <div style="font-family:'Space Grotesk',sans-serif;font-size:44px;font-weight:700;line-height:1;color:#D6FB5A">01</div>
        <div style="font-size:21px;font-weight:700;margin-top:12px">Pick class &amp; subject</div>
        <p style="font-size:15px;line-height:1.6;color:#FFFFFF;margin:10px 0 0">Content is filed by class first, so you only see the syllabus you are studying.</p>
      </div>
      <div style="background:#141033;border-radius:20px;padding:26px;color:#FFFFFF">
        <div style="font-family:'Space Grotesk',sans-serif;font-size:44px;font-weight:700;line-height:1;color:#FF5B45">02</div>
        <div style="font-size:21px;font-weight:700;margin-top:12px">Learn, then attempt</div>
        <p style="font-size:15px;line-height:1.6;color:#C9C4FF;margin:10px 0 0">Watch the lecture, then take its chapter test — timed like the real paper.</p>
      </div>
      <div style="background:#D6FB5A;border-radius:20px;padding:26px;color:#242E06">
        <div style="font-family:'Space Grotesk',sans-serif;font-size:44px;font-weight:700;line-height:1;color:#4B2BE8">03</div>
        <div style="font-size:21px;font-weight:700;margin-top:12px">See what to fix</div>
        <p style="font-size:15px;line-height:1.6;color:#3F4E0C;margin:10px 0 0">Accuracy per topic, time per question, and the two chapters to revise next.</p>
      </div>
    </div>
  </section>

  <!-- Section: FAQ Accordion -->
  <section style="padding:0 36px 64px;max-width:1400px;margin:0 auto">
    <div style="display:grid;grid-template-columns:minmax(0,300px) minmax(0,1fr);gap:48px">
      <h2 style="font-family:'Space Grotesk',sans-serif;font-size:34px;font-weight:700;letter-spacing:-0.02em;margin:0;line-height:1.1">
        Questions students ask
      </h2>
      <div style="display:grid;gap:10px">
        <details class="faq-card" open>
          <summary>Are the mock tests same pattern as the board exam?<span style="color:#4B2BE8">+</span></summary>
          <p style="font-size:15px;line-height:1.6;color:#5B54A6;margin:12px 0 0;max-width:70ch">
            Yes. Each test follows the current paper pattern for that class, including section-wise marks and negative marking where it applies.
          </p>
        </details>
        <details class="faq-card">
          <summary>Can I try before paying?<span style="color:#4B2BE8">+</span></summary>
          <p style="font-size:15px;line-height:1.6;color:#5B54A6;margin:12px 0 0;max-width:70ch">
            Every subject has free lectures and at least one free full-length test, with the same answer key and analysis as the paid ones.
          </p>
        </details>
        <details class="faq-card">
          <summary>How do I get a doubt answered?<span style="color:#4B2BE8">+</span></summary>
          <p style="font-size:15px;line-height:1.6;color:#5B54A6;margin:12px 0 0;max-width:70ch">
            Post it from the lecture or from a question in your answer key. A subject teacher replies, and the thread stays in your account.
          </p>
        </details>
        <details class="faq-card">
          <summary>Does a course expire?<span style="color:#4B2BE8">+</span></summary>
          <p style="font-size:15px;line-height:1.6;color:#5B54A6;margin:12px 0 0;max-width:70ch">
            Access runs to the end of the academic session you bought it for, including tests added during that session.
          </p>
        </details>
        <details class="faq-card">
          <summary>Who writes the questions?<span style="color:#4B2BE8">+</span></summary>
          <p style="font-size:15px;line-height:1.6;color:#5B54A6;margin:12px 0 0;max-width:70ch">
            Subject teachers write them and a separate review team checks accuracy, difficulty tagging and duplicates before they go live.
          </p>
        </details>
      </div>
    </div>
  </section>

  <!-- Section: Social Proof & Newsletter -->
  <section style="background:linear-gradient(160deg,#0B2E7A,#1447B8);padding:64px 36px">
    <div style="max-width:1400px;margin:0 auto;text-align:center">
      <div style="display:inline-flex;align-items:center;gap:8px;color:#FFD65A;font-size:12.5px;font-weight:800;letter-spacing:0.08em;text-transform:uppercase">
        ☀️ Trusted by students across India
      </div>
      <h2 style="font-family:'Space Grotesk',sans-serif;font-size:clamp(28px,3.4vw,38px);font-weight:700;color:#FFFFFF;margin:14px 0 0">
        Growing every single day
      </h2>

      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-top:38px">
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:18px;padding:26px 18px">
          <div style="width:52px;height:52px;border-radius:14px;background:rgba(255,255,255,0.14);display:flex;align-items:center;justify-content:center;font-size:24px;margin:0 auto">📚</div>
          <div style="font-family:'Space Grotesk',sans-serif;font-size:36px;font-weight:700;color:#FFFFFF;margin-top:14px">{{ $stats['courses'] ?? '10' }}+</div>
          <div style="font-size:14px;color:#C9DBFF;font-weight:600;margin-top:2px">Courses</div>
        </div>
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:18px;padding:26px 18px">
          <div style="width:52px;height:52px;border-radius:14px;background:rgba(255,255,255,0.14);display:flex;align-items:center;justify-content:center;font-size:24px;margin:0 auto">📝</div>
          <div style="font-family:'Space Grotesk',sans-serif;font-size:36px;font-weight:700;color:#FFFFFF;margin-top:14px">{{ $stats['tests'] ?? '100' }}+</div>
          <div style="font-size:14px;color:#C9DBFF;font-weight:600;margin-top:2px">Mock Tests</div>
        </div>
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:18px;padding:26px 18px">
          <div style="width:52px;height:52px;border-radius:14px;background:rgba(255,255,255,0.14);display:flex;align-items:center;justify-content:center;font-size:24px;margin:0 auto">🎓</div>
          <div style="font-family:'Space Grotesk',sans-serif;font-size:36px;font-weight:700;color:#FFFFFF;margin-top:14px">{{ $stats['students'] ?? '1000' }}+</div>
          <div style="font-size:14px;color:#C9DBFF;font-weight:600;margin-top:2px">Happy Learners</div>
        </div>
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:18px;padding:26px 18px">
          <div style="width:52px;height:52px;border-radius:14px;background:rgba(255,255,255,0.14);display:flex;align-items:center;justify-content:center;font-size:24px;margin:0 auto">🧭</div>
          <div style="font-family:'Space Grotesk',sans-serif;font-size:36px;font-weight:700;color:#FFFFFF;margin-top:14px">{{ $stats['subjects'] ?? '7' }}+</div>
          <div style="font-size:14px;color:#C9DBFF;font-weight:600;margin-top:2px">Subjects</div>
        </div>
      </div>

      <div style="font-size:15px;font-weight:700;color:#FFFFFF;margin-top:38px">📣 Join our community — follow us for free tests, updates &amp; study tips</div>
      <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;margin-top:16px">
        <a href="https://youtube.com/successcurve" target="_blank" style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.22);color:#FFFFFF;font-size:13.5px;font-weight:700;padding:11px 18px;border-radius:999px">▶️ YouTube</a>
        <a href="https://instagram.com/successcurve.in" target="_blank" style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.22);color:#FFFFFF;font-size:13.5px;font-weight:700;padding:11px 18px;border-radius:999px">📷 Instagram</a>
        <a href="https://www.facebook.com/Successcurve.in" target="_blank" style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.22);color:#FFFFFF;font-size:13.5px;font-weight:700;padding:11px 18px;border-radius:999px">👍 Facebook</a>
        <a href="https://api.whatsapp.com/send?phone=+919473099252" target="_blank" style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.22);color:#FFFFFF;font-size:13.5px;font-weight:700;padding:11px 18px;border-radius:999px">💬 WhatsApp</a>
      </div>

      <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.16);border-radius:20px;padding:34px;margin-top:38px;display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:26px;align-items:center;text-align:left">
        <div>
          <div style="font-family:'Space Grotesk',sans-serif;font-size:24px;font-weight:700;line-height:1.2;color:#FFFFFF">One email a week.<br><span style="color:#D6FB5A">The tests worth taking.</span></div>
          <p style="font-size:14.5px;color:#C9DBFF;margin:10px 0 0;max-width:44ch">New mock tests, revision notes and exam-date reminders for your class.</p>
        </div>
        <form style="display:flex;gap:10px;flex-wrap:wrap">
          <input type="email" placeholder="you@email.com" style="flex:1;min-width:180px;border:none;background:#FFFFFF;color:#141033;font-family:inherit;font-size:15px;padding:14px 16px;border-radius:12px;outline:none" required>
          <select style="border:none;background:#FFFFFF;color:#141033;font-family:inherit;font-size:14px;font-weight:600;padding:14px 12px;border-radius:12px;outline:none">
            @foreach($classes as $cls)
              <option value="{{ $cls->classId }}">{{ $cls->className }}</option>
            @endforeach
          </select>
          <button type="button" onclick="alert('Thank you for subscribing to SuccessCurve updates!')" style="border:none;background:#D6FB5A;color:#242E06;font-family:inherit;font-size:14.5px;font-weight:800;padding:14px 24px;border-radius:12px;cursor:pointer;white-space:nowrap">Subscribe</button>
        </form>
      </div>
    </div>
  </section>

  <!-- Modern Dark Footer matching New Design -->
  <footer style="background:#0B0A1F;padding:48px 36px;color:#FFFFFF">
    <div style="max-width:1400px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:32px">
      <div>
        <div style="font-family:'Space Grotesk',sans-serif;font-size:22px;font-weight:700;letter-spacing:-0.025em;white-space:nowrap">
          <span style="color:#5AA9FF">Success</span><span style="color:#FF9A3D">Curve</span><sup style="font-size:0.46em;font-weight:600;color:#9E97D9;margin-left:1px;top:-0.7em">.in</sup>
        </div>
        <p style="font-size:14px;color:#9E97D9;margin:14px 0 0;line-height:1.6">
          Courses and mock tests for Class 5 to 12, UG and PG.
        </p>
      </div>
      <div>
        <div style="font-family:'Space Grotesk',sans-serif;font-size:13px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#D6FB5A">Learn</div>
        <div style="display:grid;gap:9px;margin-top:14px;font-size:14px">
          <a href="{{ url('courses') }}" style="color:#C9C4FF">Courses</a>
          <a href="{{ url('mock-test') }}" style="color:#C9C4FF">MockTest</a>
          <a href="{{ url('testSeries') }}" style="color:#C9C4FF">Test Series</a>
          <a href="https://blog.successcurve.in" target="_blank" style="color:#C9C4FF">Free resources</a>
        </div>
      </div>
      <div>
        <div style="font-family:'Space Grotesk',sans-serif;font-size:13px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#D6FB5A">Company</div>
        <div style="display:grid;gap:9px;margin-top:14px;font-size:14px">
          <a href="{{ url('about-us') }}" style="color:#C9C4FF">About Us</a>
          <a href="{{ url('contact') }}" style="color:#C9C4FF">Contact Us</a>
          <a href="{{ url('sitemap') }}" style="color:#C9C4FF">Sitemap</a>
        </div>
      </div>
      <div>
        <div style="font-family:'Space Grotesk',sans-serif;font-size:13px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#D6FB5A">Support</div>
        <div style="display:grid;gap:9px;margin-top:14px;font-size:14px">
          <a href="{{ url('contact') }}" style="color:#C9C4FF">Help centre</a>
          <a href="{{ url('privacy-policy') }}" style="color:#C9C4FF">Privacy</a>
          <a href="{{ url('terms-and-contition') }}" style="color:#C9C4FF">Terms</a>
        </div>
      </div>
    </div>
    <div style="max-width:1400px;margin:36px auto 0;padding-top:20px;border-top:1px solid #241E52;font-size:13px;color:#7A72B8;display:flex;justify-content:space-between;flex-wrap:wrap;gap:10px">
      <div>© {{ date('Y') }} Successcurve.in · All rights reserved.</div>
      <div>Empowering students across India with quality education.</div>
    </div>
  </footer>

</div>

<script>
function scrollCourses(amount) {
  var container = document.getElementById('courseScroll');
  if (container) {
    container.scrollBy({ left: amount, behavior: 'smooth' });
  }
}
</script>
@endsection
