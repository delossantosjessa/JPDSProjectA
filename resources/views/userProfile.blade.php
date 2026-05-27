@extends('layout.format')

@section('title', 'User Profile')

@section('content')
    <section class="hero-card">
        <p class="eyebrow">Profile</p>
        <h1 class="hero-title">User Profile</h1>
        <p class="hero-copy">Review the signed-in account and its linked academic record.</p>
    </section>

    <section class="card">
        <div class="detail-grid">
            <article class="detail-item">
                <span>Username</span>
                <strong>{{ $account->username }}</strong>
            </article>
            <article class="detail-item">
                <span>Email</span>
                <strong>{{ $account->email }}</strong>
            </article>
            <article class="detail-item">
                <span>Role</span>
                <strong>{{ ucfirst($account->role) }}</strong>
            </article>
            <article class="detail-item">
                <span>Status</span>
                <strong>{{ $account->is_active ? 'Active' : 'Inactive' }}</strong>
            </article>
        </div>
    </section>

    @if ($student)
        <section class="card">
            <div class="page-header">
                <div>
                    <h2>Student Record</h2>
                    <p>Linked student information for this account.</p>
                </div>
            </div>

            <div class="detail-grid">
                <article class="detail-item">
                    <span>Full Name</span>
                    <strong>{{ trim($student->fname . ' ' . $student->mname . ' ' . $student->lname) }}</strong>
                </article>
                <article class="detail-item">
                    <span>Degree</span>
                    <strong>{{ $student->degree?->degree_title ?: 'No degree assigned' }}</strong>
                </article>
                <article class="detail-item">
                    <span>Contact Number</span>
                    <strong>{{ $student->contactno }}</strong>
                </article>
                <article class="detail-item">
                    <span>Student Email</span>
                    <strong>{{ $student->email }}</strong>
                </article>
            </div>
        </section>
    @endif

    @if ($teacher)
        <section class="card">
            <div class="page-header">
                <div>
                    <h2>Teacher Record</h2>
                    <p>Linked teacher information for this account.</p>
                </div>
            </div>

            <div class="detail-grid">
                <article class="detail-item">
                    <span>Full Name</span>
                    <strong>{{ trim($teacher->fname . ' ' . $teacher->mname . ' ' . $teacher->lname) }}</strong>
                </article>
                <article class="detail-item">
                    <span>Contact Number</span>
                    <strong>{{ $teacher->contactno }}</strong>
                </article>
                <article class="detail-item">
                    <span>Teacher Email</span>
                    <strong>{{ $teacher->email }}</strong>
                </article>
            </div>
        </section>
    @endif

    @if (! $student && ! $teacher)
        <section class="card">
            <p class="muted">No linked student or teacher profile is attached to this account.</p>
        </section>
    @endif
@endsection
