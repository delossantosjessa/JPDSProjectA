<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
            background: linear-gradient(145deg, #f4efe6, #dcefe8);
        }

        .card {
            width: min(520px, 100%);
            padding: 32px;
            border-radius: 24px;
            background: #fffdf8;
            box-shadow: 0 20px 54px rgba(20, 52, 52, 0.12);
        }

        h1 {
            margin-top: 0;
            font-family: Georgia, "Times New Roman", serif;
        }

        label {
            display: block;
            margin: 14px 0 8px;
            font-weight: 700;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid #b8c9c5;
        }

        button {
            width: 100%;
            margin-top: 18px;
            padding: 13px 16px;
            border: 0;
            border-radius: 999px;
            background: #1b6b63;
            color: #fffdf8;
            font-weight: 700;
        }

        .errors {
            padding: 12px 14px;
            border-radius: 14px;
            background: #fde3da;
            color: #8d3125;
            margin-bottom: 14px;
        }
    </style>
</head>
<body>
    <main class="card">
        <h1>Change Password</h1>
        <p>First-time login requires a password change before access to the student page is granted.</p>

        @if ($errors->any())
            <div class="errors">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.change.update') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $userId }}">

            <label>Username</label>
            <input type="text" value="{{ session('user_account.username') }}" readonly>

            <label for="current_password">Current Password</label>
            <input type="password" id="current_password" name="current_password" required>

            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="new_password_confirmation">Confirm New Password</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>

            <button type="submit">Update Password</button>
        </form>
    </main>
</body>
</html>
