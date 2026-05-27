@extends('layout.format')

@section('title', 'Degree Details')

@section('content')
    <section class="card">
        <div class="page-header">
            <div>
                <h2>Degree Details</h2>
                <p>Review the selected degree entry and its student usage.</p>
            </div>

            <a href="{{ route('degree.index') }}" class="button button-secondary">Back to Degrees</a>
        </div>

        <div class="detail-grid">
            <article class="detail-item">
                <span>Degree Title</span>
                <strong>{{ $degree->degree_title }}</strong>
            </article>
            <article class="detail-item">
                <span>Assigned Students</span>
                <strong>{{ $degree->students_count }}</strong>
            </article>
            <article class="detail-item">
                <span>Created</span>
                <strong>{{ $degree->created_at->format('M d, Y') }}</strong>
            </article>
            <article class="detail-item">
                <span>Last Updated</span>
                <strong>{{ $degree->updated_at->format('M d, Y') }}</strong>
            </article>
        </div>

        <div class="button-group">
            <a href="{{ route('degree.edit', $degree->id) }}" class="button">Edit Degree</a>
            <form action="{{ route('degree.destroy', $degree->id) }}" method="POST" class="inline-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="button button-secondary">Delete Degree</button>
            </form>
        </div>
    </section>
@endsection
