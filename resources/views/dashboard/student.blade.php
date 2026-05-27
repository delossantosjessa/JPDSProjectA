@extends('layout.format')

@section('title', 'Student Dashboard')

@section('content')
    <section class="hero-card">
        <p class="eyebrow">Student Access</p>
        <h1 class="hero-title">Student Dashboard</h1>
        <p class="hero-copy">
            Welcome back, {{ $userAccount['username'] ?? 'Student' }}. Your account is signed in successfully.
        </p>
    </section>

    <section class="card">
        <div class="page-header">
            <div>
                <h2>Profile Details</h2>
                <p>View the current student account information stored in the system.</p>
            </div>
        </div>

        <div class="detail-grid">
            <article class="detail-item">
                <span>Full Name</span>
                <strong>{{ $student ? trim($student->fname . ' ' . $student->mname . ' ' . $student->lname) : 'No student profile linked' }}</strong>
            </article>
            <article class="detail-item">
                <span>Email</span>
                <strong>{{ $student->email ?? ($userAccount['email'] ?? 'N/A') }}</strong>
            </article>
            <article class="detail-item">
                <span>Degree</span>
                <strong>{{ $student?->degree?->degree_title ?? 'No degree assigned' }}</strong>
            </article>
            <article class="detail-item">
                <span>Contact Number</span>
                <strong>{{ $student->contactno ?? 'N/A' }}</strong>
            </article>
        </div>
    </section>
@endsection
