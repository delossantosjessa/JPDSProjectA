@extends('layout.format')

@section('title', 'User Post')

@section('content')
    <section class="hero-card">
        <p class="eyebrow">Posts</p>
        <h1 class="hero-title">Announcements</h1>
        <p class="hero-copy">This module is reserved for future posting features. The route now loads safely inside the authenticated area.</p>
    </section>

    <section class="card">
        <div class="detail-grid">
            <article class="detail-item">
                <span>Account</span>
                <strong>{{ $userAccount['username'] ?? 'Unknown account' }}</strong>
            </article>
            <article class="detail-item">
                <span>Role</span>
                <strong>{{ ucfirst($userAccount['role'] ?? 'user') }}</strong>
            </article>
        </div>

        <p class="hero-copy">No announcement records are stored yet. This page no longer depends on seed data from Laravel's default `users` table.</p>
    </section>
@endsection
