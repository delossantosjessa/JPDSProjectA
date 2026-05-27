@extends('layout.format')

@section('title', 'Add Degree')

@section('content')
    <section class="card">
        <div class="page-header">
            <div>
                <h2>Add Degree</h2>
                <p>Create a new degree option for the student forms.</p>
            </div>

            <a href="{{ route('degree.index') }}" class="button button-secondary">Back to Degrees</a>
        </div>

        <form action="{{ route('degree.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="degree_title">Degree Title</label>
                <input type="text" name="degree_title" id="degree_title" value="{{ old('degree_title') }}" placeholder="e.g. Bachelor of Science in Information Technology">
            </div>

            <div class="button-group">
                <button type="submit" class="button">Save Degree</button>
                <a href="{{ route('degree.index') }}" class="button button-secondary">Cancel</a>
            </div>
        </form>
    </section>
@endsection
