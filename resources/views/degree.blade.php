@extends('layout.format')

@section('title', 'Degrees')

@section('content')
    <section class="card">
        <div class="page-header">
            <div>
                <h2>Degree List</h2>
                <p>Maintain the degree catalog used by student profiles.</p>
            </div>

            <a href="{{ route('degree.create') }}" class="button">Add Degree</a>
        </div>

        <p class="table-meta">
            @if ($degrees->count())
                Showing {{ $degrees->firstItem() }} to {{ $degrees->lastItem() }} of {{ $degrees->total() }} degrees.
            @else
                No degree records have been added yet.
            @endif
        </p>

        <div class="table-box">
            <table>
                <thead>
                    <tr>
                        <th>Degree</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($degrees as $degree)
                        <tr>
                            <td>
                                <span class="table-title">{{ $degree->degree_title }}</span>
                                <span class="muted">Degree ID {{ $degree->id }}</span>
                            </td>
                            <td>{{ $degree->updated_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('degree.show', $degree->id) }}" class="action-btn">View</a>
                                <a href="{{ route('degree.edit', $degree->id) }}" class="action-btn">Edit</a>
                                <form action="{{ route('degree.destroy', $degree->id) }}" method="POST" class="inline-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No degrees available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($degrees->hasPages())
            <div class="pagination">
                @if ($degrees->onFirstPage())
                    <span class="disabled-page">Previous</span>
                @else
                    <a href="{{ $degrees->previousPageUrl() }}">Previous</a>
                @endif

                @foreach ($degrees->getUrlRange(1, $degrees->lastPage()) as $page => $url)
                    @if ($page == $degrees->currentPage())
                        <span class="active-page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($degrees->hasMorePages())
                    <a href="{{ $degrees->nextPageUrl() }}">Next</a>
                @else
                    <span class="disabled-page">Next</span>
                @endif
            </div>
        @endif
    </section>
@endsection
