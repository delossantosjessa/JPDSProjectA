@extends('layout.format')

@section('title', 'Teacher Dashboard')

@section('content')
    <section class="hero-card">
        <p class="eyebrow">Teacher Access</p>
        <h1 class="hero-title">Teacher Dashboard</h1>
        <p class="hero-copy">
            Welcome back, {{ $userAccount['username'] ?? 'Teacher' }}. Your session is active.
        </p>
    </section>

    <section class="card">
        <div class="page-header">
            <div>
                <h2>Profile Details</h2>
                <p>View the current teacher account information stored in the system.</p>
            </div>
        </div>

        <div class="detail-grid">
            <article class="detail-item">
                <span>Full Name</span>
                <strong>{{ $teacher ? trim($teacher->fname . ' ' . $teacher->mname . ' ' . $teacher->lname) : 'No teacher profile linked' }}</strong>
            </article>
            <article class="detail-item">
                <span>Email</span>
                <strong>{{ $teacher->email ?? ($userAccount['email'] ?? 'N/A') }}</strong>
            </article>
            <article class="detail-item">
                <span>Contact Number</span>
                <strong>{{ $teacher->contactno ?? 'N/A' }}</strong>
            </article>
            <article class="detail-item">
                <span>Role</span>
                <strong>{{ ucfirst($userAccount['role'] ?? 'teacher') }}</strong>
            </article>
        </div>
    </section>
@endsection
