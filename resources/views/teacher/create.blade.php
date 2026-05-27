@extends('layout.format')

@section('title', 'Add Teacher')

@section('content')
    <section class="card">
        <div class="page-header">
            <div>
                <h2>Add Teacher</h2>
                <p>Create a new teacher profile and login account.</p>
            </div>

            <a href="{{ route('teacher.index') }}" class="button button-secondary">Back to Teachers</a>
        </div>

        <form action="{{ route('teacher.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname" value="{{ old('fname') }}">
                </div>

                <div class="form-group">
                    <label for="mname">Middle Name</label>
                    <input type="text" name="mname" id="mname" value="{{ old('mname') }}">
                </div>

                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" value="{{ old('lname') }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}">
                </div>

                <div class="form-group">
                    <label for="contactno">Contact Number</label>
                    <input type="text" name="contactno" id="contactno" value="{{ old('contactno') }}">
                </div>

                <div class="form-group">
                    <label for="password">Temporary Password</label>
                    <input type="password" name="password" id="password">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Temporary Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation">
                </div>
            </div>

            <div class="button-group">
                <button type="submit" class="button">Save Teacher</button>
                <a href="{{ route('teacher.index') }}" class="button button-secondary">Cancel</a>
            </div>
        </form>
    </section>
@endsection
