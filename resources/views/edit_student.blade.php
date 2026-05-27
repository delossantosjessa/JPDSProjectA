@extends('layout.format')

@section('title', 'Edit Student')

@section('content')
    <section class="card">
        <div class="page-header">
            <div>
                <h2>Edit Student</h2>
                <p>Update the selected student information and keep the record current.</p>
            </div>

            <a href="{{ route('student.show', $student->id) }}" class="button button-secondary">View Student</a>
        </div>

        <div id="studentMessage"></div>

        <input type="hidden" id="studentId" value="{{ $student->id }}">

        <div class="form-grid" id="studentEditFields">
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname" value="{{ old('fname', $student->fname) }}" placeholder="Enter first name">
            </div>

            <div class="form-group">
                <label for="mname">Middle Name</label>
                <input type="text" name="mname" id="mname" value="{{ old('mname', $student->mname) }}" placeholder="Optional">
            </div>

            <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" name="lname" id="lname" value="{{ old('lname', $student->lname) }}" placeholder="Enter last name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $student->email) }}" placeholder="student@example.com">
            </div>

            <div class="form-group">
                <label for="contactno">Contact Number</label>
                <input type="text" name="contactno" id="contactno" value="{{ old('contactno', $student->contactno) }}" placeholder="09xxxxxxxxx">
            </div>

            <div class="form-group">
                <label for="degree_id">Degree</label>
                <select name="degree_id" id="degree_id">
                    <option value="">Select Degree</option>
                    @foreach (($degrees ?? collect()) as $degree)
                        <option value="{{ $degree->id }}" {{ old('degree_id', $student->degree_id) == $degree->id ? 'selected' : '' }}>
                            {{ $degree->degree_title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="button-group">
            <button type="button" class="button" id="editStudentBtn">Update Student</button>
            <a href="{{ route('student.index') }}" class="button button-secondary">Back to List</a>
        </div>
    </section>
@endsection
