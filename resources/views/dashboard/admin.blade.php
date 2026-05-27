@extends('layout.format')

@section('title', 'Admin Dashboard')

@section('content')
    <section class="hero-card">
        <p class="eyebrow">Admin Access</p>
        <div class="hero-grid">
            <div>
                <h1 class="hero-title">Admin Dashboard</h1>
                <p class="hero-copy">
                    Manage students, teachers, degree programs, and user accounts from one place.
                </p>
                <div class="button-group">
                    <a href="{{ route('student.create') }}" class="button">Add Student</a>
                    <a href="{{ route('teacher.create') }}" class="button button-secondary">Add Teacher</a>
                </div>
            </div>

            <div class="stat-grid">
                <article class="stat-tile">
                    <span>Students</span>
                    <strong>{{ $studentCount }}</strong>
                </article>
                <article class="stat-tile">
                    <span>Teachers</span>
                    <strong>{{ $teacherCount }}</strong>
                </article>
                <article class="stat-tile">
                    <span>Degrees</span>
                    <strong>{{ $degreeCount }}</strong>
                </article>
                <article class="stat-tile">
                    <span>Accounts</span>
                    <strong>{{ $accountCount }}</strong>
                </article>
            </div>
        </div>
    </section>
@endsection
