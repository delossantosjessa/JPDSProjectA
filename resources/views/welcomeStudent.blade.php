<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Landing Page</title>
    <style>
        :root {
            --bg: #eef6f1;
            --card: #fffdf8;
            --text: #18312f;
            --muted: #5f7673;
            --heading: #143c3c;
            --primary: #1b6b63;
            --accent: #d97745;
            --success-bg: #d9f0e5;
            --success-text: #18533c;
            --shadow: 0 20px 54px rgba(20, 52, 52, 0.12);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 24px;
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top, rgba(217, 119, 69, 0.16), transparent 30%),
                linear-gradient(145deg, #f4efe6, var(--bg));
        }

        .page {
            width: min(860px, 100%);
            margin: 0 auto;
            padding: 36px 32px;
            border-radius: 28px;
            background: rgba(255, 253, 248, 0.92);
            box-shadow: var(--shadow);
        }

        h1, h2 {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--heading);
        }

        .message {
            padding: 14px 16px;
            border-radius: 16px;
            margin-bottom: 18px;
            background: var(--success-bg);
            color: var(--success-text);
        }

        .grid {
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin: 24px 0;
        }

        .tile {
            padding: 18px;
            border-radius: 20px;
            background: var(--card);
            border: 1px solid rgba(27, 107, 99, 0.12);
        }

        .label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--accent);
            font-weight: 700;
        }

        .value {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .muted {
            color: var(--muted);
            line-height: 1.7;
        }

        button {
            padding: 12px 18px;
            border: 0;
            border-radius: 999px;
            background: var(--primary);
            color: #fffdf8;
            font-weight: 700;
            cursor: pointer;
        }

        @media (max-width: 720px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        @if (session('success'))
            <div class="message">{{ session('success') }} Redirected to <strong>/student/welcome</strong>.</div>
        @endif

        <h1>Student Landing Page</h1>
        <p class="muted">
            The login was successful. This page confirms the session-based redirect target for student users.
        </p>

        <div class="grid">
            <article class="tile">
                <span class="label">Username</span>
                <span class="value">{{ $userAccount['username'] ?? 'N/A' }}</span>
            </article>
            <article class="tile">
                <span class="label">Email</span>
                <span class="value">{{ $userAccount['email'] ?? 'N/A' }}</span>
            </article>
            <article class="tile">
                <span class="label">Role</span>
                <span class="value">{{ $userAccount['role'] ?? 'N/A' }}</span>
            </article>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Log Out</button>
        </form>
    </main>
</body>
</html>
