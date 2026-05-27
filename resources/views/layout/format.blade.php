<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Campus Record Hub')</title>
    <style>
        :root {
            --bg-start: #f4efe6;
            --bg-end: #dcefe8;
            --surface: rgba(255, 252, 247, 0.88);
            --surface-strong: #fffdf8;
            --border: rgba(20, 68, 68, 0.14);
            --text: #18312f;
            --muted: #5f7673;
            --heading: #143c3c;
            --primary: #1b6b63;
            --primary-dark: #124942;
            --accent: #d97745;
            --danger: #bd4c42;
            --success-bg: #d9f0e5;
            --success-text: #18533c;
            --error-bg: #fde3da;
            --error-text: #8d3125;
            --shadow: 0 18px 45px rgba(20, 52, 52, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--text);
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top left, rgba(217, 119, 69, 0.18), transparent 30%),
                radial-gradient(circle at bottom right, rgba(27, 107, 99, 0.16), transparent 28%),
                linear-gradient(145deg, var(--bg-start), var(--bg-end));
        }

        h1,
        h2,
        h3,
        h4,
        th,
        .brand-title {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--heading);
        }

        .container {
            width: min(1120px, calc(100% - 32px));
            margin: 0 auto;
        }

        .navbar {
            padding: 24px 0 0;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 18px 22px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            background: rgba(18, 73, 66, 0.88);
            box-shadow: var(--shadow);
            backdrop-filter: blur(14px);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: #fff6f0;
        }

        .brand-mark {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            border-radius: 16px;
            background: linear-gradient(135deg, #f7e4d8, #d6ece7);
            color: var(--primary-dark);
            font-weight: 800;
            letter-spacing: 0.08em;
        }

        .brand-title {
            display: block;
            font-size: 1.4rem;
            color: #fffdf8;
        }

        .brand-subtitle {
            display: block;
            margin-top: 2px;
            color: rgba(255, 246, 240, 0.76);
            font-size: 0.9rem;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .nav-links a {
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 999px;
            color: rgba(255, 248, 242, 0.9);
            border: 1px solid transparent;
            transition: 0.2s ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--primary-dark);
            background: #fff5ee;
            border-color: rgba(255, 255, 255, 0.5);
        }

        .main-content {
            flex: 1;
            padding: 28px 0 44px;
        }

        .hero-card,
        .card {
            position: relative;
            overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 28px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(8px);
        }

        .hero-card {
            padding: 34px;
            margin-bottom: 24px;
        }

        .card {
            padding: 28px;
            margin-bottom: 22px;
        }

        .hero-grid,
        .section-grid,
        .detail-grid,
        .stat-grid {
            display: grid;
            gap: 18px;
        }

        .hero-grid {
            grid-template-columns: minmax(0, 1.5fr) minmax(280px, 0.95fr);
            align-items: center;
        }

        .section-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .detail-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin-top: 10px;
        }

        .eyebrow {
            margin: 0 0 10px;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            font-size: 0.74rem;
            font-weight: 800;
            color: var(--accent);
        }

        .hero-title {
            margin: 0;
            font-size: clamp(2.2rem, 4vw, 3.4rem);
            line-height: 1.05;
        }

        .hero-copy,
        .muted,
        .page-header p,
        .small-text,
        .detail-item span,
        .stat-tile p,
        .table-meta,
        .info-list li {
            color: var(--muted);
        }

        .hero-copy {
            max-width: 640px;
            margin: 16px 0 0;
            font-size: 1.02rem;
            line-height: 1.7;
        }

        .stat-tile,
        .detail-item {
            padding: 18px 20px;
            border-radius: 22px;
            background: var(--surface-strong);
            border: 1px solid rgba(27, 107, 99, 0.1);
        }

        .stat-tile span,
        .detail-item span {
            display: block;
            margin-bottom: 8px;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 700;
        }

        .stat-tile strong,
        .detail-item strong {
            display: block;
            font-size: 1.15rem;
            color: var(--heading);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 22px;
        }

        .page-header h2 {
            margin: 0 0 8px;
            font-size: clamp(1.9rem, 2vw, 2.35rem);
        }

        .button-group {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .button,
        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 18px;
            border-radius: 999px;
            border: 1px solid transparent;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease, border-color 0.18s ease;
        }

        .button,
        .action-btn {
            background: var(--primary);
            color: #fffdf8;
            box-shadow: 0 10px 24px rgba(27, 107, 99, 0.2);
        }

        .button:hover,
        .action-btn:hover {
            transform: translateY(-1px);
        }

        .button-secondary {
            background: rgba(255, 248, 242, 0.78);
            color: var(--primary-dark);
            border-color: rgba(27, 107, 99, 0.16);
            box-shadow: none;
        }

        .action-btn {
            padding: 8px 14px;
            margin-right: 8px;
            margin-bottom: 8px;
            background: rgba(27, 107, 99, 0.1);
            color: var(--primary-dark);
            border-color: rgba(27, 107, 99, 0.12);
            box-shadow: none;
        }

        .delete-btn {
            background: rgba(189, 76, 66, 0.09);
            color: var(--danger);
            border-color: rgba(189, 76, 66, 0.12);
        }

        .table-box {
            overflow-x: auto;
            border-radius: 22px;
            border: 1px solid rgba(27, 107, 99, 0.12);
            background: rgba(255, 253, 248, 0.9);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 16px 18px;
            text-align: left;
            vertical-align: top;
        }

        th {
            font-size: 0.76rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            background: rgba(27, 107, 99, 0.08);
        }

        td {
            border-top: 1px solid rgba(20, 68, 68, 0.08);
        }

        tr:nth-child(even) td {
            background: rgba(255, 255, 255, 0.42);
        }

        .table-title {
            display: block;
            font-weight: 700;
            color: var(--heading);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(217, 119, 69, 0.14);
            color: #8c4a20;
            font-size: 0.84rem;
            font-weight: 700;
        }

        .status-empty {
            background: rgba(95, 118, 115, 0.12);
            color: var(--muted);
        }

        .pagination {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin-top: 24px;
        }

        .pagination a,
        .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            padding: 10px 14px;
            border-radius: 999px;
            text-decoration: none;
            background: rgba(255, 248, 242, 0.86);
            color: var(--primary-dark);
            border: 1px solid rgba(27, 107, 99, 0.12);
        }

        .pagination .active-page {
            background: var(--primary);
            color: #fffdf8;
        }

        .pagination .disabled-page {
            color: #9aa9a7;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.94rem;
            font-weight: 700;
            color: var(--heading);
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 13px 15px;
            border-radius: 16px;
            border: 1px solid rgba(27, 107, 99, 0.16);
            background: rgba(255, 255, 255, 0.9);
            color: var(--text);
            font-size: 0.98rem;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: rgba(27, 107, 99, 0.55);
            box-shadow: 0 0 0 4px rgba(27, 107, 99, 0.12);
        }

        .message {
            padding: 15px 18px;
            border-radius: 20px;
            margin-bottom: 18px;
            border: 1px solid transparent;
        }

        .message strong {
            display: block;
            margin-bottom: 8px;
        }

        .message ul {
            margin: 0 0 0 18px;
            padding: 0;
        }

        .message-success {
            background: var(--success-bg);
            color: var(--success-text);
            border-color: rgba(24, 83, 60, 0.14);
        }

        .message-error {
            background: var(--error-bg);
            color: var(--error-text);
            border-color: rgba(141, 49, 37, 0.12);
        }

        .inline-form {
            display: inline;
        }

        #studentMessage:empty {
            display: none;
        }

        .info-list {
            margin: 16px 0 0;
            padding-left: 18px;
            line-height: 1.7;
        }

        .footer {
            padding: 0 0 26px;
        }

        .footer-inner {
            padding: 18px 22px;
            border-radius: 22px;
            background: rgba(20, 60, 60, 0.88);
            color: rgba(255, 250, 244, 0.8);
            text-align: center;
            box-shadow: var(--shadow);
        }

        .footer p {
            margin: 0;
        }

        @media (max-width: 860px) {
            .navbar-content,
            .hero-grid,
            .section-grid,
            .detail-grid,
            .form-grid {
                grid-template-columns: 1fr;
                display: grid;
            }
        }

        @media (max-width: 640px) {
            .hero-card,
            .card,
            .navbar-content,
            .footer-inner {
                padding: 22px;
            }
        }
    </style>
</head>
<body>
    @php($userAccount = session('user_account'))
    <nav class="navbar">
        <div class="container">
            <div class="navbar-content">
                <a href="{{ route('dashboard') }}" class="brand">
                    <span class="brand-mark">SDM</span>
                    <span>
                        <span class="brand-subtitle">Student and degree management</span>
                    </span>
                </a>

                <div class="nav-links">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Home</a>
                    @if (($userAccount['role'] ?? null) === 'admin')
                        <a href="{{ route('student.index') }}" class="{{ request()->routeIs('student.*') ? 'active' : '' }}">Students</a>
                        <a href="{{ route('teacher.index') }}" class="{{ request()->routeIs('teacher.*') ? 'active' : '' }}">Teachers</a>
                        <a href="{{ route('degree.index') }}" class="{{ request()->routeIs('degree.*') ? 'active' : '' }}">Degrees</a>
                    @endif
                    @if ($userAccount)
                        <form method="POST" action="{{ route('logout') }}" class="inline-form">
                            @csrf
                            <button type="submit" class="button">Logout</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            @if (session('success'))
                <div class="message message-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="message message-error">
                    <strong>Please fix the following errors:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-inner">
                <p>&copy; {{ date('Y') }} Student Management.</p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('app.js') }}"></script>
</body>
</html>
