<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
        :root {
            --bg: #f4efe6;
            --card: rgba(255, 252, 247, 0.92);
            --border: rgba(20, 68, 68, 0.14);
            --text: #18312f;
            --muted: #5f7673;
            --heading: #143c3c;
            --primary: #1b6b63;
            --accent: #d97745;
            --error-bg: #fde3da;
            --error-text: #8d3125;
            --success-bg: #d9f0e5;
            --success-text: #18533c;
            --shadow: 0 24px 60px rgba(20, 52, 52, 0.14);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(217, 119, 69, 0.18), transparent 30%),
                radial-gradient(circle at bottom right, rgba(27, 107, 99, 0.16), transparent 28%),
                linear-gradient(145deg, #f4efe6, #dcefe8);
        }

        .shell {
            width: min(980px, 100%);
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(320px, 420px);
            overflow: hidden;
            border-radius: 28px;
            background: var(--card);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
        }

        .intro, .panel {
            padding: 40px 34px;
        }

        .intro {
            background: linear-gradient(160deg, rgba(27, 107, 99, 0.98), rgba(20, 73, 66, 0.94));
            color: #fffaf4;
        }

        .intro h1, .panel h2 {
            font-family: Georgia, "Times New Roman", serif;
            margin: 0 0 14px;
        }

        .intro p {
            max-width: 44ch;
            line-height: 1.7;
            color: rgba(255, 250, 244, 0.82);
        }

        .eyebrow {
            display: inline-block;
            margin-bottom: 16px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.12);
            font-size: 0.78rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 700;
        }

        .panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .panel p {
            margin-top: 0;
            color: var(--muted);
        }

        .message {
            padding: 14px 16px;
            border-radius: 16px;
            margin-bottom: 16px;
        }

        .message-error {
            background: var(--error-bg);
            color: var(--error-text);
        }

        .message-success {
            background: var(--success-bg);
            color: var(--success-text);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: var(--heading);
        }

        input {
            width: 100%;
            margin-bottom: 16px;
            padding: 13px 15px;
            border-radius: 16px;
            border: 1px solid rgba(27, 107, 99, 0.16);
            background: rgba(255, 255, 255, 0.94);
            color: var(--text);
            font-size: 0.98rem;
        }

        input:focus {
            outline: none;
            border-color: rgba(27, 107, 99, 0.55);
            box-shadow: 0 0 0 4px rgba(27, 107, 99, 0.12);
        }

        button {
            width: 100%;
            padding: 14px 18px;
            border: 0;
            border-radius: 999px;
            background: var(--primary);
            color: #fffdf8;
            font-weight: 700;
            cursor: pointer;
        }

        .hint {
            margin-top: 14px;
            font-size: 0.92rem;
        }

        @media (max-width: 820px) {
            .shell {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <main class="shell">
        <section class="intro">
    
            <h1>Student records access portal</h1>
        </section>

        <section class="panel">
            <h2>Login Form</h2>
            <p>Enter your username and password.</p>

            @if (session('success'))
                <div class="message message-success">{{ session('success') }}</div>
            @endif

            @if ($errors->has('login'))
                <div class="message message-error">{{ $errors->first('login') }}</div>
            @endif

            <form method="POST" action="{{ route('login.authenticate') }}">
                @csrf
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Log In</button>
            </form>

           
        </section>
    </main>
</body>
</html>
