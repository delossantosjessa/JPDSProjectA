@extends('layout.format')

@section('title', 'Edit Teacher')

@section('content')
    <section class="card">
        <div class="page-header">
            <div>
                <h2>Edit Teacher</h2>
                <p>Update the selected teacher profile and linked account details.</p>
            </div>

            <a href="{{ route('teacher.index') }}" class="button button-secondary">Back to Teachers</a>
        </div>

        <form action="{{ route('teacher.update', $teacher->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname" value="{{ old('fname', $teacher->fname) }}">
                </div>

                <div class="form-group">
                    <label for="mname">Middle Name</label>
                    <input type="text" name="mname" id="mname" value="{{ old('mname', $teacher->mname) }}">
                </div>

                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" value="{{ old('lname', $teacher->lname) }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $teacher->email) }}">
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username', $teacher->userAccount->username) }}">
                </div>

                <div class="form-group">
                    <label for="contactno">Contact Number</label>
                    <input type="text" name="contactno" id="contactno" value="{{ old('contactno', $teacher->contactno) }}">
                </div>
            </div>

            <div class="button-group">
                <button type="submit" class="button">Update Teacher</button>
                <a href="{{ route('teacher.index') }}" class="button button-secondary">Cancel</a>
            </div>
        </form>
    </section>
@endsection
