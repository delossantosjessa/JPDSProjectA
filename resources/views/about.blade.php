@extends('layout.format')

@section('title', 'About')

@section('content')
    <section class="hero-card">
        <p class="eyebrow">About The Project</p>
        <h1 class="hero-title">A focused Laravel CRUD app for academic record management.</h1>
        <p class="hero-copy">
            Campus Record Hub uses Blade layouts, resource controllers, Eloquent relationships, and paginated lists to
            manage student profiles together with their degree assignments.
        </p>
    </section>

    <section class="section-grid">
        <article class="card">
            <p class="eyebrow">Stack</p>
            <h2>Built with Laravel conventions</h2>
            <ul class="info-list">
                <li>Resource routes organize the create, read, update, and delete flows.</li>
                <li>Eloquent relationships connect students to their assigned degrees.</li>
                <li>Shared Blade layout styling keeps all pages visually consistent.</li>
            </ul>
        </article>

        <article class="card">
            <p class="eyebrow">Scope</p>
            <h2>Designed for clarity</h2>
            <ul class="info-list">
                <li>Student pages focus on names, contact details, and degree assignment.</li>
                <li>Degree pages keep the catalog separate and easier to maintain.</li>
                <li>The updated theme uses warmer colors and clearer hierarchy for better readability.</li>
            </ul>
        </article>
    </section>
@endsection
