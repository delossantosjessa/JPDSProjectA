@extends('layout.format')

@section('title', 'Student Details')

@section('content')
    <section class="card">
        <div class="page-header">
            <div>
                <h2>Student Details</h2>
                <p>Review the complete student profile before making changes.</p>
            </div>

            <a href="{{ route('student.index') }}" class="button button-secondary">Back to Students</a>
        </div>

        @include('partials.student-details', ['student' => $student])

        <div id="studentMessage"></div>

        <div class="button-group">
            <a href="{{ route('student.edit', $student->id) }}" class="button">Edit Student</a>
            <button type="button" class="button button-secondary delete-student-btn" data-id="{{ $student->id }}">Delete Student</button>
        </div>
    </section>
@endsection
