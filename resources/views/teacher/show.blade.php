@extends('layout.format')

@section('title', 'Teacher Details')

@section('content')
    <section class="card">
        <div class="page-header">
            <div>
                <h2>Teacher Details</h2>
                <p>Review the selected teacher profile and account information.</p>
            </div>

            <a href="{{ route('teacher.index') }}" class="button button-secondary">Back to Teachers</a>
        </div>

        <div class="detail-grid">
            <article class="detail-item">
                <span>Full Name</span>
                <strong>{{ trim($teacher->fname . ' ' . $teacher->mname . ' ' . $teacher->lname) }}</strong>
            </article>
            <article class="detail-item">
                <span>Email</span>
                <strong>{{ $teacher->email }}</strong>
            </article>
            <article class="detail-item">
                <span>Username</span>
                <strong>{{ $teacher->userAccount->username ?? 'No account' }}</strong>
            </article>
            <article class="detail-item">
                <span>Contact Number</span>
                <strong>{{ $teacher->contactno }}</strong>
            </article>
        </div>
    </section>
@endsection
