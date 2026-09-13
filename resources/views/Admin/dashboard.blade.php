<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Command Center — Admin Dashboard | SuccessCurve</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --pageBg: #EEF2F8;
            --side: #0F1B33;
            --sideMuted: #C9D6EC;
            --text: #0F1B33;
            --sub: #5C6A85;
            --faint: #98A4BD;
            --card: #FFFFFF;
            --border: #E3E9F2;
            --track: #E8EDF6;
            --inputBg: #F5F8FC;
            --barSoft: #DCE6F4;
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
            --barSoft: #2A3550;
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
        @media (max-width: 960px) {
            .dashboard-container { grid-template-columns: 1fr; }
            .dash-sidebar { display: none; }
        }

        /* Tooltip style */
        .tooltip-wrap {
            position: relative;
            display: block;
            flex: 1;
            min-width: 0;
            overflow: hidden;
        }
        .tooltip-wrap:hover .tooltip-box {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .tooltip-box {
            position: absolute;
            bottom: calc(100% + 8px);
            left: 0;
            background: #0F1B33;
            color: #FFFFFF;
            font-size: 11.5px;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 7px;
            white-space: normal;
            word-break: break-word;
            max-width: 280px;
            width: max-content;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            opacity: 0;
            visibility: hidden;
            transform: translateY(4px);
            transition: opacity 140ms ease, transform 140ms ease;
            pointer-events: none;
            z-index: 999;
            line-height: 1.4;
        }
        [data-theme="dark"] .tooltip-box {
            background: #1E293B;
            border: 1px solid #334155;
            color: #F8FAFC;
        }

        /* Fixed Width Trending Cards Grid */
        .trending-grid {
            padding: 16px 32px 0;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
            align-items: start;
        }
        @media (max-width: 1200px) {
            .trending-grid {
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            }
        }

        /* Trending Item Row */
        .trending-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            margin-bottom: 7px;
        }
        .trending-title {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            cursor: pointer;
            line-height: 1.3;
        }
        .trending-count {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 13.5px;
            font-weight: 700;
            color: var(--text);
            flex-shrink: 0;
            text-align: right;
            min-width: 48px;
            letter-spacing: -0.01em;
        }
        .trending-track {
            height: 6px;
            background: var(--track);
            border-radius: 999px;
            overflow: hidden;
        }
    </style>
</head>
<body>

@php
    $adminUser = Session::get('auser') ?? 'Manohar K.';
    $adminEmail = Session::get('auserEmail') ?? 'admin@successcurve.in';
    $firstChar = strtoupper(substr($adminUser, 0, 1));
    $currentDate = $meta['current_date'] ?? date('l, d M Y');

    $qReportCount = 0;
    foreach($action_queues as $q) {
        if(($q['id'] ?? '') === 'qreports') { $qReportCount = $q['count'] ?? 23; }
    }
@endphp

<div class="dashboard-container">
    <!-- SIDEBAR -->
    <aside class="dash-sidebar" style="position:sticky;top:0;height:100vh;overflow:hidden;background:radial-gradient(700px 400px at 20% -10%, #0a5fb8, #024f9d 45%, #01356c)">
        <div style="position:absolute;inset:0;background-image:radial-gradient(circle at 1px 1px, rgba(255,255,255,.10) 1px, transparent 0);background-size:26px 26px;pointer-events:none"></div>
        <div style="position:absolute;top:-60px;right:-40px;width:200px;height:200px;border-radius:999px;background:radial-gradient(circle,rgba(251,116,62,0.22),transparent 70%);pointer-events:none"></div>
        
        <div style="position:relative;z-index:1;height:100%;padding:20px 14px;display:flex;flex-direction:column;gap:18px;overflow:auto">
            <div style="font-family:'Space Grotesk',sans-serif;font-size:21px;font-weight:700;letter-spacing:-0.025em;white-space:nowrap;padding:2px 6px">
                <a href="{{ url('/') }}"><span style="color:#8FC4F5">Success</span><span style="color:#FF9E6B">Curve</span><sup style="font-size:0.46em;font-weight:600;color:#B7C1D6;margin-left:1px;top:-0.7em">.in</sup></a>
            </div>

            <!-- Admin Profile Tag -->
            <div style="display:flex;align-items:center;gap:10px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.14);border-radius:12px;padding:9px 11px">
                <div style="width:34px;height:34px;border-radius:9px;background:#FB743E;color:#FFFFFF;display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-weight:700;flex-shrink:0">{{ $firstChar }}</div>
                <div style="min-width:0">
                    <div style="font-size:13.5px;font-weight:700;color:#FFFFFF;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $adminUser }}</div>
                    <div style="font-size:11.5px;color:#B7C1D6">Super Admin</div>
                </div>
            </div>

            <nav style="display:grid;gap:3px">
                <!-- Overview Section -->
                <div style="font-size:10.5px;font-weight:800;letter-spacing:0.11em;text-transform:uppercase;color:#7FA6D6;padding:8px 8px 3px">Overview</div>
                <a href="{{ url('admin/dashboard') }}" style="display:flex;align-items:center;gap:11px;padding:10px 12px;border-radius:11px;background:linear-gradient(120deg,#FB743E,#E0672C);color:#FFFFFF;font-size:13.5px;font-weight:700;box-shadow:0 8px 18px rgba(251,116,62,0.35)">
                    <span style="width:20px;text-align:center">📊</span> Dashboard
                </a>
                <a href="{{ url('admin/dashboard') }}" style="display:flex;align-items:center;gap:11px;padding:10px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500;transition:background 150ms ease" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">📈</span> Analytics
                </a>

                <!-- Catalog Section -->
                <div style="font-size:10.5px;font-weight:800;letter-spacing:0.11em;text-transform:uppercase;color:#7FA6D6;padding:12px 8px 3px">Catalog</div>
                <a href="{{ url('admin/courses') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">📚</span> Courses
                </a>
                <a href="{{ url('admin/tests') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">📝</span> Mock Tests
                </a>
                <a href="{{ url('admin/createTC') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">🎯</span> Test Series
                </a>
                <a href="{{ url('admin/classes') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">🏫</span> Classes
                </a>
                <a href="{{ url('admin/subjectMaster') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">📖</span> Subjects
                </a>

                <!-- Question Bank Section -->
                <div style="font-size:10.5px;font-weight:800;letter-spacing:0.11em;text-transform:uppercase;color:#7FA6D6;padding:12px 8px 3px">Question Bank</div>
                <a href="{{ url('admin/qbs') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">🗂️</span> Questions
                </a>
                <a href="{{ url('admin/questionReports') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">⚑</span> Question Reports
                    <span style="margin-left:auto;background:#FB743E;color:#FFFFFF;font-size:11px;font-weight:800;padding:2px 7px;border-radius:999px">{{ $qReportCount }}</span>
                </a>
                <a href="{{ url('admin/subjectTopic') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">🏷️</span> Topics &amp; Tags
                </a>

                <!-- People Section -->
                <div style="font-size:10.5px;font-weight:800;letter-spacing:0.11em;text-transform:uppercase;color:#7FA6D6;padding:12px 8px 3px">People</div>
                <a href="{{ url('admin/users/users') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">👥</span> Students
                </a>
                <a href="{{ url('admin/users/instructors') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">🧑‍🏫</span> Faculty
                </a>
                <a href="{{ url('admin/users/qas') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">⌨️</span> Question Operators
                </a>
                <a href="{{ url('admin/users/admins') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">🛡️</span> Admins
                </a>

                <!-- Growth & Marketing -->
                <div style="font-size:10.5px;font-weight:800;letter-spacing:0.11em;text-transform:uppercase;color:#7FA6D6;padding:12px 8px 3px">Growth</div>
                <a href="{{ url('admin/coupons') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">🏷️</span> Coupons
                </a>
                <a href="{{ url('admin/sliders') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">🖼️</span> Sliders
                </a>

                <!-- System Section -->
                <div style="font-size:10.5px;font-weight:800;letter-spacing:0.11em;text-transform:uppercase;color:#7FA6D6;padding:12px 8px 3px">System</div>
                <a href="{{ url('admin/doubts') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">💬</span> Doubts <span style="margin-left:auto;background:#FB743E;color:#FFFFFF;font-size:11px;font-weight:800;padding:2px 7px;border-radius:999px">2</span>
                </a>
                <a href="{{ url('admin/contacts') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">✉️</span> Contacts
                </a>
                <a href="{{ url('admin/profile') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#FFFFFF'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">⚙️</span> Profile
                </a>
                <a href="{{ url('logout') }}" style="display:flex;align-items:center;gap:11px;padding:9px 12px;border-radius:11px;color:#C9D6EC;font-size:13.5px;font-weight:500" onmouseover="this.style.background='rgba(229,72,77,0.2)';this.style.color='#FF8888'" onmouseout="this.style.background='transparent';this.style.color='#C9D6EC'">
                    <span style="width:20px;text-align:center">↩️</span> Logout
                </a>
            </nav>
        </div>
    </aside>

    <!-- MAIN DASHBOARD CONTENT -->
    <main style="min-width:0;padding:0 0 60px">
        <!-- HEADER -->
        <header style="display:flex;align-items:center;gap:14px;padding:16px 32px;background:var(--card);border-bottom:1px solid var(--border);position:sticky;top:0;z-index:20;flex-wrap:wrap">
            <div style="min-width:0">
                <div style="font-family:'Space Grotesk',sans-serif;font-size:21px;font-weight:700">Command Center</div>
                <div style="font-size:13.5px;color:var(--sub);margin-top:2px">{{ $currentDate }} · SuccessCurve Operations</div>
            </div>
            <div style="flex:1"></div>

            <!-- Time Range & Custom Date Filters -->
            <form id="filterForm" method="GET" action="{{ url('admin/dashboard') }}" style="display:flex;align-items:center;gap:8px;margin:0">
                <input type="hidden" name="range" id="rangeInput" value="{{ $meta['range'] ?? '30d' }}">
                
                <div style="display:flex;background:var(--inputBg);border:1px solid var(--border);border-radius:10px;padding:3px">
                    <button type="button" class="range-btn {{ ($meta['range'] ?? '30d') === '30d' ? 'active' : '' }}" data-range="30d" style="background:{{ ($meta['range'] ?? '30d') === '30d' ? 'var(--card)' : 'transparent' }};color:{{ ($meta['range'] ?? '30d') === '30d' ? 'var(--text)' : 'var(--sub)' }};font-size:12.5px;font-weight:700;padding:7px 12px;border-radius:8px;box-shadow:{{ ($meta['range'] ?? '30d') === '30d' ? '0 1px 3px rgba(0,0,0,0.08)' : 'none' }}">30d</button>
                    <button type="button" class="range-btn {{ ($meta['range'] ?? '') === '7d' ? 'active' : '' }}" data-range="7d" style="background:{{ ($meta['range'] ?? '') === '7d' ? 'var(--card)' : 'transparent' }};color:{{ ($meta['range'] ?? '') === '7d' ? 'var(--text)' : 'var(--sub)' }};font-size:12.5px;font-weight:700;padding:7px 12px;border-radius:8px">7d</button>
                    <button type="button" class="range-btn {{ ($meta['range'] ?? '') === 'QTD' ? 'active' : '' }}" data-range="QTD" style="background:{{ ($meta['range'] ?? '') === 'QTD' ? 'var(--card)' : 'transparent' }};color:{{ ($meta['range'] ?? '') === 'QTD' ? 'var(--text)' : 'var(--sub)' }};font-size:12.5px;font-weight:700;padding:7px 12px;border-radius:8px">QTD</button>
                    <button type="button" class="range-btn {{ ($meta['range'] ?? '') === 'YTD' ? 'active' : '' }}" data-range="YTD" style="background:{{ ($meta['range'] ?? '') === 'YTD' ? 'var(--card)' : 'transparent' }};color:{{ ($meta['range'] ?? '') === 'YTD' ? 'var(--text)' : 'var(--sub)' }};font-size:12.5px;font-weight:700;padding:7px 12px;border-radius:8px">YTD</button>
                </div>

                <!-- Custom Date Range Button & Expandable Popover -->
                <div style="position:relative">
                    <button type="button" id="toggleCustomDateBtn" style="display:flex;align-items:center;gap:6px;background:{{ ($meta['range'] ?? '') === 'custom' ? 'rgba(2,79,157,0.12)' : 'var(--inputBg)' }};border:1px solid {{ ($meta['range'] ?? '') === 'custom' ? '#024F9D' : 'var(--border)' }};color:{{ ($meta['range'] ?? '') === 'custom' ? '#024F9D' : 'var(--text)' }};font-size:12.5px;font-weight:700;padding:7px 12px;border-radius:10px">
                        <span>📅</span>
                        <span>{{ (!empty($meta['start_date']) && !empty($meta['end_date'])) ? ($meta['start_date'] . ' - ' . $meta['end_date']) : 'Custom Date' }}</span>
                        <span style="font-size:10px">▼</span>
                    </button>

                    <div id="customDatePopup" style="display:none;position:absolute;top:calc(100% + 8px);right:0;background:var(--card);border:1px solid var(--border);border-radius:14px;padding:16px;box-shadow:0 12px 28px rgba(0,0,0,0.15);width:290px;z-index:100">
                        <div style="font-size:13px;font-weight:700;margin-bottom:12px;display:flex;justify-content:space-between;align-items:center">
                            <span>Select Custom Timeline</span>
                            <span id="closeDatePopup" style="cursor:pointer;color:var(--faint);font-size:16px">&times;</span>
                        </div>
                        <div style="display:grid;gap:10px">
                            <div>
                                <label style="display:block;font-size:11.5px;font-weight:700;color:var(--sub);margin-bottom:4px">FROM DATE</label>
                                <input type="date" name="start_date" id="startDateInput" value="{{ $meta['start_date'] ?? '' }}" style="width:100%;box-sizing:border-box;background:var(--inputBg);border:1px solid var(--border);border-radius:8px;padding:7px 10px;font-family:inherit;font-size:12.5px;color:var(--text);outline:none">
                            </div>
                            <div>
                                <label style="display:block;font-size:11.5px;font-weight:700;color:var(--sub);margin-bottom:4px">TO DATE</label>
                                <input type="date" name="end_date" id="endDateInput" value="{{ $meta['end_date'] ?? '' }}" style="width:100%;box-sizing:border-box;background:var(--inputBg);border:1px solid var(--border);border-radius:8px;padding:7px 10px;font-family:inherit;font-size:12.5px;color:var(--text);outline:none">
                            </div>
                            <div style="display:flex;gap:8px;margin-top:4px">
                                <button type="submit" style="flex:1;background:#024F9D;color:#FFFFFF;font-size:12px;font-weight:700;padding:8px;border-radius:8px;cursor:pointer">Apply Timeline</button>
                                <a href="{{ url('admin/dashboard?range=30d') }}" style="background:var(--inputBg);border:1px solid var(--border);color:var(--sub);font-size:12px;font-weight:700;padding:8px 12px;border-radius:8px;text-align:center">Reset</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Global Search -->
            <input type="text" placeholder="Search students, courses, tests…" style="border:1px solid var(--border);background:var(--inputBg);border-radius:10px;padding:10px 14px;font-family:inherit;font-size:13.5px;flex:1;min-width:0;max-width:230px;outline:none;color:var(--text)">

            <!-- Dark / Light Mode -->
            <button type="button" id="adminThemeBtn" style="display:flex;align-items:center;gap:7px;border:1px solid var(--border);background:var(--inputBg);color:var(--text);font-size:13.5px;font-weight:700;padding:10px 13px;border-radius:10px">
                <span id="themeIcon">🌙</span>
            </button>

            <!-- Notification Bell -->
            <a href="{{ url('admin/questionReports') }}" style="position:relative;border:1px solid var(--border);background:var(--inputBg);color:var(--text);font-size:15px;padding:9px 12px;border-radius:10px">
                🔔<span style="position:absolute;top:-4px;right:-4px;background:#FB743E;color:#FFFFFF;font-size:10px;font-weight:800;width:17px;height:17px;border-radius:999px;display:flex;align-items:center;justify-content:center">6</span>
            </a>

            <!-- Quick Add CTA -->
            <a href="{{ url('admin/courses') }}" style="background:#FB743E;color:#FFFFFF;font-size:13.5px;font-weight:800;padding:11px 16px;border-radius:10px;transition:background 150ms ease" onmouseover="this.style.background='#E0672C'" onmouseout="this.style.background='#FB743E'">
                + New Course
            </a>
        </header>

        <!-- ========================================== -->
        <!-- SECTION 1: KEY METRIC KPI CARDS           -->
        <!-- ========================================== -->
        <div style="padding:24px 32px 0;display:flex;align-items:baseline;gap:12px">
            <h2 style="font-family:'Space Grotesk',sans-serif;font-size:14px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--sub);margin:0">Key Metrics</h2>
            <div style="flex:1;height:1px;background:var(--border)"></div>
        </div>

        <section style="padding:16px 32px 0;display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:16px">
            @foreach($kpis as $k)
                @if(!empty($k['feature']))
                    <!-- Feature Revenue Hero Card -->
                    <div style="background:linear-gradient(140deg,#024F9D,#0A5FB8);border-radius:18px;padding:20px;border:1px solid #024F9D;color:#FFFFFF">
                        <div style="display:flex;align-items:center;justify-content:space-between;gap:10px">
                            <div style="width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:19px;background:rgba(255,255,255,0.16);color:#FFFFFF">{{ $k['icon'] }}</div>
                            <div style="font-size:12px;font-weight:800;padding:4px 9px;border-radius:999px;background:rgba(255,255,255,0.16);color:#FFFFFF">{{ $k['delta'] }}</div>
                        </div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:30px;font-weight:700;line-height:1;margin-top:16px;color:#FFFFFF">{{ $k['value'] }}</div>
                        <div style="font-size:13px;font-weight:600;color:#C9DBFF;margin-top:5px">{{ $k['label'] }}</div>
                    </div>
                @else
                    <!-- Standard Metric Card -->
                    <div style="background:var(--card);border-radius:18px;padding:20px;border:1px solid var(--border)">
                        <div style="display:flex;align-items:center;justify-content:space-between;gap:10px">
                            <div style="width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:19px;background:{{ $k['tint'] ?? 'var(--inputBg)' }};color:{{ $k['ink'] ?? 'var(--primary)' }}">{{ $k['icon'] }}</div>
                            <div style="font-size:12px;font-weight:800;padding:4px 9px;border-radius:999px;background:var(--track);color:{{ !empty($k['is_up']) ? '#0F9D76' : '#E5484D' }}">{{ $k['delta'] }}</div>
                        </div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:30px;font-weight:700;line-height:1;margin-top:16px;color:var(--text)">{{ $k['value'] }}</div>
                        <div style="font-size:13px;font-weight:600;color:var(--sub);margin-top:5px">{{ $k['label'] }}</div>
                    </div>
                @endif
            @endforeach
        </section>

        <!-- ========================================== -->
        <!-- SECTION 2: REVENUE & GROWTH CHARTS         -->
        <!-- ========================================== -->
        <div style="padding:30px 32px 0;display:flex;align-items:baseline;gap:12px">
            <h2 style="font-family:'Space Grotesk',sans-serif;font-size:14px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--sub);margin:0">Revenue &amp; Growth</h2>
            <div style="flex:1;height:1px;background:var(--border)"></div>
        </div>

        <section style="padding:16px 32px 0;display:grid;grid-template-columns:2fr 1fr;gap:16px">
            <!-- 8-Month Revenue & Enrollment Trend SVG -->
            <div style="background:var(--card);border-radius:18px;padding:22px;border:1px solid var(--border);min-width:0">
                <div style="display:flex;justify-content:space-between;align-items:start;gap:12px;flex-wrap:wrap">
                    <div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Revenue &amp; Enrollments</div>
                        <div style="font-size:13px;color:var(--sub);margin-top:3px">Last 8 months performance</div>
                    </div>
                    <div style="text-align:right">
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:24px;font-weight:700;line-height:1">₹18.4L</div>
                        <div style="font-size:12px;color:#0F9D76;font-weight:700">↑ 23% vs last period</div>
                    </div>
                </div>

                <svg viewBox="0 0 640 260" style="width:100%;height:auto;margin-top:16px;overflow:visible">
                    <line x1="44" y1="30" x2="628" y2="30" stroke="var(--track)"></line>
                    <line x1="44" y1="78" x2="628" y2="78" stroke="var(--track)"></line>
                    <line x1="44" y1="126" x2="628" y2="126" stroke="var(--track)"></line>
                    <line x1="44" y1="174" x2="628" y2="174" stroke="var(--track)"></line>
                    <line x1="44" y1="212" x2="628" y2="212" stroke="var(--border)"></line>
                    <text x="38" y="34" text-anchor="end" font-family="DM Sans, sans-serif" font-size="11" fill="var(--faint)">3L</text>
                    <text x="38" y="82" text-anchor="end" font-family="DM Sans, sans-serif" font-size="11" fill="var(--faint)">2L</text>
                    <text x="38" y="130" text-anchor="end" font-family="DM Sans, sans-serif" font-size="11" fill="var(--faint)">1L</text>

                    <!-- Bar Chart for Enrollments -->
                    <g>
                        <rect x="66" y="150" width="20" height="62" rx="4" fill="var(--barSoft)"></rect>
                        <rect x="138" y="138" width="20" height="74" rx="4" fill="var(--barSoft)"></rect>
                        <rect x="210" y="120" width="20" height="92" rx="4" fill="var(--barSoft)"></rect>
                        <rect x="282" y="128" width="20" height="84" rx="4" fill="var(--barSoft)"></rect>
                        <rect x="354" y="102" width="20" height="110" rx="4" fill="var(--barSoft)"></rect>
                        <rect x="426" y="88" width="20" height="124" rx="4" fill="var(--barSoft)"></rect>
                        <rect x="498" y="70" width="20" height="142" rx="4" fill="var(--barSoft)"></rect>
                        <rect x="570" y="52" width="20" height="160" rx="4" fill="#FB743E"></rect>
                    </g>

                    <!-- Revenue Line & Gradient Fill -->
                    <path d="M76,140 L148,128 L220,110 L292,116 L364,90 L436,74 L508,58 L580,44 L580,212 L76,212 Z" fill="rgba(2,79,157,0.10)"></path>
                    <polyline points="76,140 148,128 220,110 292,116 364,90 436,74 508,58 580,44" fill="none" stroke="#024F9D" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></polyline>
                    
                    <g fill="var(--card)" stroke="#024F9D" stroke-width="2.5">
                        <circle cx="76" cy="140" r="4"></circle>
                        <circle cx="148" cy="128" r="4"></circle>
                        <circle cx="220" cy="110" r="4"></circle>
                        <circle cx="292" cy="116" r="4"></circle>
                        <circle cx="364" cy="90" r="4"></circle>
                        <circle cx="436" cy="74" r="4"></circle>
                        <circle cx="508" cy="58" r="4"></circle>
                        <circle cx="580" cy="44" r="4"></circle>
                    </g>

                    <g font-family="DM Sans, sans-serif" font-size="11.5" font-weight="600" fill="var(--sub)" text-anchor="middle">
                        <text x="76" y="232">Feb</text><text x="148" y="232">Mar</text><text x="220" y="232">Apr</text>
                        <text x="292" y="232">May</text><text x="364" y="232">Jun</text><text x="436" y="232">Jul</text>
                        <text x="508" y="232">Aug</text><text x="580" y="232">Sep</text>
                    </g>
                </svg>
                <div style="display:flex;gap:18px;font-size:12.5px;color:var(--sub);font-weight:600;margin-top:4px">
                    <span><span style="display:inline-block;width:11px;height:3px;border-radius:2px;background:#024F9D;vertical-align:middle;margin-right:6px"></span>Revenue (₹)</span>
                    <span><span style="display:inline-block;width:11px;height:11px;border-radius:3px;background:#FB743E;vertical-align:middle;margin-right:6px"></span>New enrollments</span>
                </div>
            </div>

            <!-- Revenue By Product Donut -->
            <div style="background:var(--card);border-radius:18px;padding:22px;border:1px solid var(--border)">
                <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Revenue by product</div>
                <div style="font-size:13px;color:var(--sub);margin-top:3px">This month breakdown</div>
                <div style="display:flex;justify-content:center;margin-top:18px">
                    <div style="position:relative;width:172px;height:172px;border-radius:999px;background:conic-gradient(#024F9D 0turn {{ ($product_share['courses_pct'] ?? 52)/100 }}turn, #FB743E {{ ($product_share['courses_pct'] ?? 52)/100 }}turn {{ (($product_share['courses_pct'] ?? 52) + ($product_share['mock_tests_pct'] ?? 31))/100 }}turn, #0F9D76 {{ (($product_share['courses_pct'] ?? 52) + ($product_share['mock_tests_pct'] ?? 31))/100 }}turn 1turn)">
                        <div style="position:absolute;inset:26px;background:var(--card);border-radius:999px;display:flex;flex-direction:column;align-items:center;justify-content:center">
                            <div style="font-family:'Space Grotesk',sans-serif;font-size:24px;font-weight:700;line-height:1">{{ $product_share['total_this_month'] ?? '₹4.2L' }}</div>
                            <div style="font-size:11.5px;color:var(--sub)">total</div>
                        </div>
                    </div>
                </div>
                <div style="display:grid;gap:11px;margin-top:20px">
                    <div style="display:flex;align-items:center;gap:10px;font-size:14px;font-weight:600">
                        <span style="width:12px;height:12px;border-radius:4px;background:#024F9D"></span>Courses
                        <span style="margin-left:auto;font-family:'Space Grotesk',sans-serif;font-weight:700">{{ $product_share['courses_pct'] ?? 52 }}%</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;font-size:14px;font-weight:600">
                        <span style="width:12px;height:12px;border-radius:4px;background:#FB743E"></span>Mock tests
                        <span style="margin-left:auto;font-family:'Space Grotesk',sans-serif;font-weight:700">{{ $product_share['mock_tests_pct'] ?? 31 }}%</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;font-size:14px;font-weight:600">
                        <span style="width:12px;height:12px;border-radius:4px;background:#0F9D76"></span>Test series
                        <span style="margin-left:auto;font-family:'Space Grotesk',sans-serif;font-weight:700">{{ $product_share['test_series_pct'] ?? 17 }}%</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- SECTION 2B: TRENDING SECTION & SIGNUPS BY CLASS (MATCHING EXACT DESIGN)   -->
        <!-- ========================================================================= -->
        <!-- ========================================================================= -->
        <!-- SECTION 2B: TRENDING SECTION & SIGNUPS BY CLASS (MATCHING EXACT DESIGN)   -->
        <!-- ========================================================================= -->
        <section class="trending-grid">
            
            <!-- COLUMN 1: Trending Courses + New Signups by Class -->
            <div style="display:grid;gap:20px">
                <!-- Trending Courses -->
                <div style="background:var(--card);border-radius:18px;padding:24px;border:1px solid var(--border);box-shadow:0 2px 10px rgba(0,0,0,0.02)">
                    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding-bottom:14px;border-bottom:1px solid var(--border)">
                        <div>
                            <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Trending courses</div>
                            <div style="font-size:12px;color:var(--sub);margin-top:2px">Ranked by active enrollments</div>
                        </div>
                        <a href="{{ url('admin/courses') }}" style="font-size:12.5px;font-weight:700;color:#024F9D;background:rgba(2,79,157,0.08);padding:6px 12px;border-radius:8px">All courses →</a>
                    </div>
                    <div style="display:grid;gap:18px;margin-top:18px">
                        @foreach($trending['courses'] ?? [] as $idx => $c)
                            <div>
                                <div class="trending-row">
                                    <div class="tooltip-wrap">
                                        <span class="trending-title">{{ $c['name'] }}</span>
                                        <div class="tooltip-box">{{ $c['name'] }}</div>
                                    </div>
                                    <span class="trending-count">{{ $c['count'] }}</span>
                                </div>
                                <div class="trending-track">
                                    <div style="width:{{ $c['pct'] }}%;height:100%;background:#024F9D;border-radius:999px"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- New Signups by Class -->
                <div style="background:var(--card);border-radius:18px;padding:22px;border:1px solid var(--border);box-shadow:0 2px 10px rgba(0,0,0,0.02)">
                    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap">
                        <div>
                            <div style="font-family:'Space Grotesk',sans-serif;font-size:16px;font-weight:700">New signups by class</div>
                            <div style="font-size:12px;color:var(--sub);margin-top:2px">Last 30 days student enrollment distribution</div>
                        </div>
                        <div style="display:flex;align-items:center;gap:12px;font-size:11.5px;color:var(--sub);font-weight:600">
                            <span><span style="display:inline-block;width:9px;height:9px;border-radius:3px;background:#024F9D;margin-right:5px"></span>Regular</span>
                            <span><span style="display:inline-block;width:9px;height:9px;border-radius:3px;background:#FB743E;margin-right:5px"></span>Peak</span>
                        </div>
                    </div>
                    <svg viewBox="0 0 420 140" style="width:100%;height:auto;margin-top:14px">
                        <line x1="10" y1="15" x2="410" y2="15" stroke="var(--track)"></line>
                        <line x1="10" y1="55" x2="410" y2="55" stroke="var(--track)"></line>
                        <line x1="10" y1="95" x2="410" y2="95" stroke="var(--border)"></line>
                        @php
                            $maxSignup = 160;
                            $classLabels = ['C5', 'C6', 'C7', 'C8', 'C9', 'C10', 'UG', 'PG'];
                        @endphp
                        @foreach($signups_by_class as $i => $sb)
                            @php
                                $barHeight = max(8, round(($sb['count'] / $maxSignup) * 75));
                                $fillColor = !empty($sb['is_peak']) ? '#FB743E' : '#024F9D';
                                $xPos = 18 + $i * 49;
                            @endphp
                            <rect x="{{ $xPos }}" y="{{ 95 - $barHeight }}" width="24" height="{{ $barHeight }}" rx="4" fill="{{ $fillColor }}"></rect>
                            <text x="{{ $xPos + 12 }}" y="{{ 90 - $barHeight }}" font-family="Space Grotesk, sans-serif" font-size="10" font-weight="700" fill="var(--text)" text-anchor="middle">{{ $sb['count'] }}</text>
                            <text x="{{ $xPos + 12 }}" y="115" font-family="DM Sans, sans-serif" font-size="11" font-weight="600" fill="var(--sub)" text-anchor="middle">{{ $sb['class_name'] ?? ($classLabels[$i] ?? '') }}</text>
                        @endforeach
                    </svg>
                </div>
            </div>

            <!-- COLUMN 2: Trending Mock Tests -->
            <div style="background:var(--card);border-radius:18px;padding:24px;border:1px solid var(--border);box-shadow:0 2px 10px rgba(0,0,0,0.02)">
                <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding-bottom:14px;border-bottom:1px solid var(--border)">
                    <div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Trending mock tests</div>
                        <div style="font-size:12px;color:var(--sub);margin-top:2px">Ranked by test attempts</div>
                    </div>
                    <a href="{{ url('admin/tests') }}" style="font-size:12.5px;font-weight:700;color:#E0672C;background:rgba(251,116,62,0.1);padding:6px 12px;border-radius:8px">All tests →</a>
                </div>
                <div style="display:grid;gap:18px;margin-top:18px">
                    @foreach($trending['tests'] ?? [] as $idx => $t)
                        <div>
                            <div class="trending-row">
                                <div class="tooltip-wrap">
                                    <span class="trending-title">{{ $t['name'] }}</span>
                                    <div class="tooltip-box">{{ $t['name'] }}</div>
                                </div>
                                <span class="trending-count">{{ $t['count'] }}</span>
                            </div>
                            <div class="trending-track">
                                <div style="width:{{ $t['pct'] }}%;height:100%;background:#FB743E;border-radius:999px"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- COLUMN 3: Trending Test Series -->
            <div style="background:var(--card);border-radius:18px;padding:24px;border:1px solid var(--border);box-shadow:0 2px 10px rgba(0,0,0,0.02)">
                <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;padding-bottom:14px;border-bottom:1px solid var(--border)">
                    <div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Trending test series</div>
                        <div style="font-size:12px;color:var(--sub);margin-top:2px">Ranked by series subscribers</div>
                    </div>
                    <a href="{{ url('admin/createTC') }}" style="font-size:12.5px;font-weight:700;color:#0F9D76;background:rgba(15,157,118,0.1);padding:6px 12px;border-radius:8px">All series →</a>
                </div>
                <div style="display:grid;gap:18px;margin-top:18px">
                    @foreach($trending['series'] ?? [] as $idx => $s)
                        <div>
                            <div class="trending-row">
                                <div class="tooltip-wrap">
                                    <span class="trending-title">{{ $s['name'] }}</span>
                                    <div class="tooltip-box">{{ $s['name'] }}</div>
                                </div>
                                <span class="trending-count">{{ $s['count'] }}</span>
                            </div>
                            <div class="trending-track">
                                <div style="width:{{ $s['pct'] }}%;height:100%;background:#0F9D76;border-radius:999px"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ========================================== -->
        <!-- SECTION 3: ACTION QUEUES (Needs Attention) -->
        <!-- ========================================== -->
        <div style="padding:30px 32px 0;display:flex;align-items:baseline;gap:12px">
            <h2 style="font-family:'Space Grotesk',sans-serif;font-size:14px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--sub);margin:0">Needs Attention</h2>
            <div style="flex:1;height:1px;background:var(--border)"></div>
        </div>

        <section style="padding:16px 32px 0;display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:16px">
            @foreach($action_queues as $q)
                <div style="background:var(--card);border-radius:18px;padding:20px;border:1px solid var(--border);border-top:3px solid {{ $q['accent'] }}">
                    <div style="display:flex;align-items:center;gap:12px">
                        <div style="width:46px;height:46px;border-radius:12px;background:{{ $q['tint'] ?? 'var(--inputBg)' }};color:{{ $q['ink'] ?? '#024F9D' }};display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0">{{ $q['icon'] }}</div>
                        <div style="min-width:0">
                            <div style="font-family:'Space Grotesk',sans-serif;font-size:26px;font-weight:700;line-height:1">{{ $q['count'] }}</div>
                            <div style="font-size:13px;color:var(--sub);font-weight:600;margin-top:2px">{{ $q['label'] }}</div>
                        </div>
                    </div>
                    <div style="font-size:13px;color:var(--sub);margin-top:14px;line-height:1.5">{{ $q['note'] }}</div>
                    <a href="{{ $q['href'] }}" style="display:block;text-align:center;margin-top:14px;background:var(--inputBg);border:1px solid var(--border);color:var(--text);font-size:13px;font-weight:700;padding:10px;border-radius:10px;transition:border-color 150ms ease" onmouseover="this.style.borderColor='#024F9D'" onmouseout="this.style.borderColor='var(--border)'">
                        {{ $q['cta'] }}
                    </a>
                </div>
            @endforeach
        </section>

        <!-- ========================================== -->
        <!-- SECTION 4: CONTENT & OPERATIONS           -->
        <!-- ========================================== -->
        <div style="padding:30px 32px 0;display:flex;align-items:baseline;gap:12px">
            <h2 style="font-family:'Space Grotesk',sans-serif;font-size:14px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--sub);margin:0">Content &amp; Operations</h2>
            <div style="flex:1;height:1px;background:var(--border)"></div>
        </div>

        <section style="padding:16px 32px 0;display:grid;grid-template-columns:1fr 1fr;gap:16px">
            <!-- Recent Payments Table -->
            <div style="background:var(--card);border-radius:18px;padding:22px;border:1px solid var(--border);min-width:0">
                <div style="display:flex;justify-content:space-between;align-items:center;gap:12px">
                    <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Recent payments</div>
                    <a href="{{ url('admin/users/users') }}" style="font-size:13px;font-weight:700;color:#024F9D">Ledger →</a>
                </div>
                <div style="overflow:auto;margin-top:14px">
                    <table style="width:100%;border-collapse:collapse;font-size:13.5px;min-width:440px">
                        <tr style="text-align:left">
                            <th style="padding:0 10px 10px 0;font-size:11px;font-weight:800;letter-spacing:0.05em;text-transform:uppercase;color:var(--sub)">Student</th>
                            <th style="padding:0 10px 10px 0;font-size:11px;font-weight:800;letter-spacing:0.05em;text-transform:uppercase;color:var(--sub)">Product</th>
                            <th style="padding:0 10px 10px 0;font-size:11px;font-weight:800;letter-spacing:0.05em;text-transform:uppercase;color:var(--sub)">Amount</th>
                            <th style="padding:0 0 10px 0;font-size:11px;font-weight:800;letter-spacing:0.05em;text-transform:uppercase;color:var(--sub)">Status</th>
                        </tr>
                        @foreach($payments as $p)
                            @php
                                $statusStyle = 'background:#E8F7EE;color:#0F9D76';
                                if($p['key'] === 'pending') { $statusStyle = 'background:#FEF6EC;color:#E0672C'; }
                                elseif($p['key'] === 'failed') { $statusStyle = 'background:#FDECEC;color:#E5484D'; }
                            @endphp
                            <tr style="border-top:1px solid var(--border)">
                                <td style="padding:11px 10px 11px 0;font-weight:600">{{ $p['name'] }}</td>
                                <td style="padding:11px 10px 11px 0;color:var(--sub)">{{ $p['product'] }}</td>
                                <td style="padding:11px 10px 11px 0;font-family:'Space Grotesk',sans-serif;font-weight:700">{{ $p['amount'] }}</td>
                                <td style="padding:11px 0"><span style="{{ $statusStyle }};font-size:11.5px;font-weight:700;padding:4px 9px;border-radius:999px">{{ $p['status'] }}</span></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <!-- Question Bank Health & Uploader Throughput -->
            <div style="display:grid;gap:16px;align-content:start;min-width:0">
                <!-- Question Bank Health -->
                <div style="background:var(--card);border-radius:18px;padding:22px;border:1px solid var(--border)">
                    <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Question bank health</div>
                    <div style="font-size:13px;color:var(--sub);margin-top:3px">{{ $kpis[8]['value'] ?? '14,280' }} questions · by question pattern</div>
                    <div style="display:grid;gap:12px;margin-top:16px">
                        @foreach($qbank_health as $qb)
                            <div>
                                <div style="display:flex;justify-content:space-between;font-size:13px;font-weight:600;margin-bottom:5px">
                                    <span>{{ $qb['name'] }}</span>
                                    <span style="color:var(--sub)">{{ $qb['count'] }}</span>
                                </div>
                                <div style="height:9px;background:var(--track);border-radius:999px;overflow:hidden">
                                    <div style="width:{{ $qb['pct'] }}%;height:100%;background:{{ $qb['color'] }};border-radius:999px"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Uploader Team Throughput -->
                <div style="background:var(--card);border-radius:18px;padding:22px;border:1px solid var(--border)">
                    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px">
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Uploader throughput</div>
                        <span style="font-size:11.5px;font-weight:700;color:var(--sub);background:var(--track);padding:4px 9px;border-radius:999px">This week</span>
                    </div>
                    <div style="display:grid;margin-top:12px">
                        @foreach($team_throughput as $idx => $t)
                            <div style="display:flex;align-items:center;gap:12px;padding:10px 0;{{ $idx > 0 ? 'border-top:1px solid var(--border)' : '' }}">
                                <div style="width:34px;height:34px;border-radius:9px;background:{{ $t['av_bg'] }};color:#FFFFFF;display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:13px;flex-shrink:0">{{ $t['initial'] }}</div>
                                <div style="min-width:0;flex:1">
                                    <div style="font-size:14px;font-weight:600">{{ $t['name'] }}</div>
                                    <div style="font-size:12px;color:var(--faint)">{{ $t['role'] }}</div>
                                </div>
                                <div style="text-align:right">
                                    <div style="font-family:'Space Grotesk',sans-serif;font-size:16px;font-weight:700">{{ $t['count'] }}</div>
                                    <div style="font-size:11px;color:var(--sub)">added</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================== -->
        <!-- SECTION 5: QUICK ACTIONS BANNER            -->
        <!-- ========================================== -->
        <section style="padding:16px 32px 0">
            <div style="background:linear-gradient(135deg,#024F9D,#0A5FB8);border-radius:18px;padding:22px;display:flex;gap:12px;align-items:center;flex-wrap:wrap">
                <div style="color:#FFFFFF;min-width:0;margin-right:auto">
                    <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700">Quick actions</div>
                    <div style="font-size:13px;color:#C9DBFF;margin-top:2px">Jump straight to frequent management tasks</div>
                </div>
                <a href="{{ url('admin/qbs') }}" style="background:rgba(255,255,255,0.14);border:1px solid rgba(255,255,255,0.22);color:#FFFFFF;font-size:13.5px;font-weight:700;padding:11px 16px;border-radius:11px;white-space:nowrap;transition:background 150ms ease" onmouseover="this.style.background='#FB743E';this.style.borderColor='#FB743E'" onmouseout="this.style.background='rgba(255,255,255,0.14)';this.style.borderColor='rgba(255,255,255,0.22)'">+ Add question</a>
                <a href="{{ url('admin/tests') }}" style="background:rgba(255,255,255,0.14);border:1px solid rgba(255,255,255,0.22);color:#FFFFFF;font-size:13.5px;font-weight:700;padding:11px 16px;border-radius:11px;white-space:nowrap;transition:background 150ms ease" onmouseover="this.style.background='#FB743E';this.style.borderColor='#FB743E'" onmouseout="this.style.background='rgba(255,255,255,0.14)';this.style.borderColor='rgba(255,255,255,0.22)'">+ Create test</a>
                <a href="{{ url('admin/courses') }}" style="background:rgba(255,255,255,0.14);border:1px solid rgba(255,255,255,0.22);color:#FFFFFF;font-size:13.5px;font-weight:700;padding:11px 16px;border-radius:11px;white-space:nowrap;transition:background 150ms ease" onmouseover="this.style.background='#FB743E';this.style.borderColor='#FB743E'" onmouseout="this.style.background='rgba(255,255,255,0.14)';this.style.borderColor='rgba(255,255,255,0.22)'">+ New course</a>
                <a href="{{ url('admin/coupons') }}" style="background:rgba(255,255,255,0.14);border:1px solid rgba(255,255,255,0.22);color:#FFFFFF;font-size:13.5px;font-weight:700;padding:11px 16px;border-radius:11px;white-space:nowrap;transition:background 150ms ease" onmouseover="this.style.background='#FB743E';this.style.borderColor='#FB743E'" onmouseout="this.style.background='rgba(255,255,255,0.14)';this.style.borderColor='rgba(255,255,255,0.22)'">+ Coupon</a>
                <a href="{{ url('admin/users/users') }}" style="background:rgba(255,255,255,0.14);border:1px solid rgba(255,255,255,0.22);color:#FFFFFF;font-size:13.5px;font-weight:700;padding:11px 16px;border-radius:11px;white-space:nowrap;transition:background 150ms ease" onmouseover="this.style.background='#FB743E';this.style.borderColor='#FB743E'" onmouseout="this.style.background='rgba(255,255,255,0.14)';this.style.borderColor='rgba(255,255,255,0.22)'">Export users</a>
            </div>
        </section>
    </main>
</div>

<script>
    // Theme toggle logic with persistence
    const themeBtn = document.getElementById('adminThemeBtn');
    const themeIcon = document.getElementById('themeIcon');

    function setAdminTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            themeIcon.textContent = '☀️';
            localStorage.setItem('sc_admin_theme', 'dark');
        } else {
            document.documentElement.removeAttribute('data-theme');
            themeIcon.textContent = '🌙';
            localStorage.setItem('sc_admin_theme', 'light');
        }
    }

    const savedAdminTheme = localStorage.getItem('sc_admin_theme') || 'light';
    setAdminTheme(savedAdminTheme);

    themeBtn.addEventListener('click', function() {
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        setAdminTheme(isDark ? 'light' : 'dark');
    });

    // Range buttons click handler -> reloads dashboard with ?range=...
    const rangeButtons = document.querySelectorAll('.range-btn');
    const rangeInput = document.getElementById('rangeInput');
    const filterForm = document.getElementById('filterForm');

    rangeButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const chosenRange = this.getAttribute('data-range');
            if (rangeInput && filterForm) {
                rangeInput.value = chosenRange;
                // Clear custom dates if selecting preset
                const sInput = document.getElementById('startDateInput');
                const eInput = document.getElementById('endDateInput');
                if (sInput) sInput.value = '';
                if (eInput) eInput.value = '';
                filterForm.submit();
            }
        });
    });

    // Custom Date Range Popover Toggle
    const toggleCustomDateBtn = document.getElementById('toggleCustomDateBtn');
    const customDatePopup = document.getElementById('customDatePopup');
    const closeDatePopup = document.getElementById('closeDatePopup');

    if (toggleCustomDateBtn && customDatePopup) {
        toggleCustomDateBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            customDatePopup.style.display = (customDatePopup.style.display === 'block') ? 'none' : 'block';
        });

        if (closeDatePopup) {
            closeDatePopup.addEventListener('click', function(e) {
                e.stopPropagation();
                customDatePopup.style.display = 'none';
            });
        }

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!customDatePopup.contains(e.target) && e.target !== toggleCustomDateBtn) {
                customDatePopup.style.display = 'none';
            }
        });
    }
</script>

</body>
</html>
