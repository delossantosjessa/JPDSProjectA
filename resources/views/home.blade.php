@extends('layout.format')

@section('title', 'Home')

@section('content')
    <section class="hero-card">
        <div class="hero-grid">
            <div>
                <p class="eyebrow">Campus Records</p>
                <h1 class="hero-title">Organize students, align degrees, and keep every record easy to maintain.</h1>
                <p class="hero-copy">
                    This dashboard combines student profiles and degree management in one clean workflow, with simple
                    Laravel CRUD pages that are easier to navigate and easier to read.
                </p>

                <div class="button-group">
                    <a href="{{ route('student.index') }}" class="button">Browse Students</a>
                    <a href="{{ route('student.create') }}" class="button button-secondary">Add Student</a>
                    <a href="{{ route('degree.index') }}" class="button button-secondary">Browse Degrees</a>
                </div>
            </div>

            <div class="stat-grid">
                <article class="stat-tile">
                    <span>Student Profiles</span>
                    <strong>Clean record pages</strong>
                    <p>View names, contact details, and assigned degrees in one place.</p>
                </article>
                <article class="stat-tile">
                    <span>Degree Catalog</span>
                    <strong>Simple course mapping</strong>
                    <p>Maintain degree titles separately so student forms stay consistent.</p>
                </article>
                <article class="stat-tile">
                    <span>Daily Workflow</span>
                    <strong>Fewer clicks, clearer actions</strong>
                    <p>All pages now share the same visual system for lists, forms, and detail screens.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section-grid">
        <article class="card">
            <p class="eyebrow">What You Can Do</p>
            <h2>Manage the full student lifecycle</h2>
            <ul class="info-list">
                <li>Create and update student records with degree selection.</li>
                <li>Review detailed profile pages before editing or deleting data.</li>
                <li>Keep degree titles separate so forms stay organized.</li>
            </ul>
        </article>

        <article class="card">
            <p class="eyebrow">Quick Start</p>
            <h2>Recommended flow</h2>
            <ul class="info-list">
                <li>Add your degree catalog first so student forms have options ready.</li>
                <li>Create student records and assign a degree where applicable.</li>
                <li>Use the detail pages to review information before making changes.</li>
            </ul>
        </article>
    </section>
@endsection
