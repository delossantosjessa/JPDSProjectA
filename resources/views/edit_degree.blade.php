@extends('layout.format')

@section('title', 'Edit Degree')

@section('content')
    <section class="card">
        <div class="page-header">
            <div>
                <h2>Edit Degree</h2>
                <p>Update the selected degree title used across the app.</p>
            </div>

            <a href="{{ route('degree.show', $degree->id) }}" class="button button-secondary">View Degree</a>
        </div>

        <form action="{{ route('degree.update', $degree->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="degree_title">Degree Title</label>
                <input type="text" name="degree_title" id="degree_title" value="{{ old('degree_title', $degree->degree_title) }}" placeholder="Update degree title">
            </div>

            <div class="button-group">
                <button type="submit" class="button">Update Degree</button>
                <a href="{{ route('degree.index') }}" class="button button-secondary">Back to Degrees</a>
            </div>
        </form>
    </section>
@endsection
