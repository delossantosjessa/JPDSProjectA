@extends('layout.format')

@section('title', 'Add Student')

@section('content')
    <section class="card">
        <div class="page-header">
            <div>
                <h2>Add Student</h2>
                <p>Create a new student profile and optionally assign a degree.</p>
            </div>

            <a href="{{ route('student.index') }}" class="button button-secondary">Back to Students</a>
        </div>

        <div id="studentMessage"></div>

        <div class="form-grid" id="studentCreateFields">
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname" value="{{ old('fname') }}" placeholder="Enter first name">
            </div>

            <div class="form-group">
                <label for="mname">Middle Name</label>
                <input type="text" name="mname" id="mname" value="{{ old('mname') }}" placeholder="Optional">
            </div>

            <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" name="lname" id="lname" value="{{ old('lname') }}" placeholder="Enter last name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="student@example.com">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Enter login username">
            </div>

            <div class="form-group">
                <label for="password">Temporary Password</label>
                <input type="password" name="password" id="password" placeholder="Enter temporary password">
                <p class="small-text">The student will be required to change this on first login.</p>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Temporary Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm temporary password">
            </div>

            <div class="form-group">
                <label for="contactno">Contact Number</label>
                <input type="text" name="contactno" id="contactno" value="{{ old('contactno') }}" placeholder="09xxxxxxxxx">
            </div>

            <div class="form-group">
                <label for="degree_id">Degree</label>
                <select name="degree_id" id="degree_id">
                    <option value="">Select Degree</option>
                    @foreach (($degrees ?? collect()) as $degree)
                        <option value="{{ $degree->id }}" {{ old('degree_id') == $degree->id ? 'selected' : '' }}>
                            {{ $degree->degree_title }}
                        </option>
                    @endforeach
                </select>
                <p class="small-text">If there are no choices yet, add degrees first.</p>
            </div>
        </div>

        <div class="button-group">
            <button type="button" class="button" id="saveBtn">Save Student</button>
            <a href="{{ route('student.index') }}" class="button button-secondary">Cancel</a>
        </div>
    </section>
@endsection
