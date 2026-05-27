@extends('layout.format')

@section('title', 'Students')

@section('content')
    <section class="card">
        <div class="page-header">
            <div>
                <h2>Student List</h2>
                <p>Browse, review, and maintain all student records from one page.</p>
            </div>

            <a href="{{ route('student.create') }}" class="button">Add Student</a>
        </div>

        <p class="table-meta">
            @if ($students->count())
                Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} students.
            @else
                No student records have been added yet.
            @endif
        </p>

        <div id="studentMessage"></div>

        <div id="studentsTableRegion">
            @include('partials.students-table', ['students' => $students])
        </div>
    </section>

    <section class="card" id="studentDetailsCard" style="display: none;">
        <div class="page-header">
            <div>
                <h2 id="studentDetailsTitle">Student Details</h2>
                <p>Review the selected student record loaded through AJAX.</p>
            </div>
        </div>

        <div id="studentDetails"></div>
    </section>
@endsection
