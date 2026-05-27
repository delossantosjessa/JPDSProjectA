<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Mode</title>
    <style>
        :root {
            color-scheme: light;
            --bg: #f6efe5;
            --card: #fffaf3;
            --text: #1f2937;
            --muted: #6b7280;
            --accent: #b45309;
            --border: #e5d3b3;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            font-family: Georgia, "Times New Roman", serif;
            background:
                radial-gradient(circle at top, rgba(245, 158, 11, 0.18), transparent 32%),
                linear-gradient(135deg, var(--bg), #fdf8f1);
            color: var(--text);
        }

        .panel {
            width: min(640px, 100%);
            padding: 40px 32px;
            border: 1px solid var(--border);
            border-radius: 24px;
            background: var(--card);
            box-shadow: 0 24px 60px rgba(31, 41, 55, 0.08);
            text-align: center;
        }

        .badge {
            display: inline-block;
            margin-bottom: 18px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(180, 83, 9, 0.12);
            color: var(--accent);
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0 0 16px;
            font-size: clamp(2rem, 4vw, 3rem);
        }

        p {
            margin: 0 auto;
            max-width: 44ch;
            color: var(--muted);
            font-size: 1rem;
            line-height: 1.7;
        }
    </style>
</head>
<body>
    <main class="panel">
        <div class="badge">Temporarily Unavailable</div>
        <h1>We&rsquo;re doing scheduled maintenance.</h1>
        <p>
            The system is currently offline while updates are being applied.
            Please check back again shortly.
        </p>
    </main>
</body>
</html>
