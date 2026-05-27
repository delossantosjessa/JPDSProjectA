@extends('layout.format')

@section('title', 'Teachers')

@section('content')
    <section class="card">
        <div class="page-header">
            <div>
                <h2>Teacher List</h2>
                <p>Browse, review, and maintain all teacher records from one page.</p>
            </div>

            <a href="{{ route('teacher.create') }}" class="button">Add Teacher</a>
        </div>

        <p class="table-meta">
            @if ($teachers->count())
                Showing {{ $teachers->firstItem() }} to {{ $teachers->lastItem() }} of {{ $teachers->total() }} teachers.
            @else
                No teacher records have been added yet.
            @endif
        </p>

        <div class="table-box">
            <table>
                <thead>
                    <tr>
                        <th>Teacher</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($teachers as $teacher)
                        <tr>
                            <td>
                                <span class="table-title">{{ trim($teacher->fname . ' ' . $teacher->mname . ' ' . $teacher->lname) }}</span>
                                <span class="muted">Teacher ID {{ $teacher->id }}</span>
                            </td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->userAccount->username ?? 'No account' }}</td>
                            <td>{{ $teacher->contactno }}</td>
                            <td>
                                <a href="{{ route('teacher.show', $teacher->id) }}" class="action-btn">View</a>
                                <a href="{{ route('teacher.edit', $teacher->id) }}" class="action-btn">Edit</a>
                                <form action="{{ route('teacher.destroy', $teacher->id) }}" method="POST" class="inline-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No teachers available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
