@extends('layout.format')

@section('title', 'Student Courses')

@section('content')
    <section class="hero-card">
        <p class="eyebrow">Courses</p>
        <h1 class="hero-title">Student Courses</h1>
        <p class="hero-copy">Review enrolled courses and the course catalog stored in the system.</p>
    </section>

    @if ($student)
        <section class="card">
            <div class="page-header">
                <div>
                    <h2>Your Enrollment</h2>
                    <p>{{ trim($student->fname . ' ' . $student->lname) }}{{ $student->degree?->degree_title ? ' • ' . $student->degree->degree_title : '' }}</p>
                </div>
            </div>

            <div class="table-box">
                <table>
                    <thead>
                        <tr>
                            <th>Course</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                            <tr>
                                <td><span class="table-title">{{ $course->course_name }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td>No courses assigned to this student yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    @endif

    @if (($userAccount['role'] ?? null) !== 'student')
        <section class="card">
            <div class="page-header">
                <div>
                    <h2>Student Enrollments</h2>
                    <p>Overview of all students currently linked to courses.</p>
                </div>
            </div>

            <div class="table-box">
                <table>
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Username</th>
                            <th>Courses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allStudentCourses as $enrolledStudent)
                            <tr>
                                <td>
                                    <span class="table-title">{{ trim($enrolledStudent->fname . ' ' . $enrolledStudent->lname) }}</span>
                                    <span class="muted">{{ $enrolledStudent->degree?->degree_title ?: 'No degree assigned' }}</span>
                                </td>
                                <td>{{ $enrolledStudent->userAccount?->username ?: 'No account' }}</td>
                                <td>{{ $enrolledStudent->courses->pluck('course_name')->join(', ') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No student-course assignments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    @endif

    <section class="card">
        <div class="page-header">
            <div>
                <h2>Course Catalog</h2>
                <p>Courses available in the current database.</p>
            </div>
        </div>

        <div class="table-box">
            <table>
                <thead>
                    <tr>
                        <th>Course</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($availableCourses as $course)
                        <tr>
                            <td><span class="table-title">{{ $course->course_name }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td>No courses available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
